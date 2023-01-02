<?php

namespace core;

class DB
{
    protected \PDO $pdo;

    public function __construct($hostname, $login, $password, $database)
    {
        $this->pdo = new \PDO("mysql: host={$hostname};dbname={$database}", $login, $password);
    }

    public function select($tableName, $fieldsList = "*", $conditionList = null, $orderBy = null ,$limit = null, $offset = null, $innerJoin = null)
    {
        $fieldsPartString = "";
        $innerJoinPartString = "";
        $wherePartString = "";
        $orderByPartString = "";
        $limitAndOffsetPartString = "";
        if (is_string($fieldsList))
        {
            $fieldsPartString = $fieldsList;
        }
        else if(is_array($fieldsList))
        {
            $fieldsPartString = implode(", ", $fieldsList);
        }
        if (is_string($innerJoin))
        {
            $innerJoinPartString = $innerJoin;
        }
        if(is_array($conditionList) && count($conditionList) > 0)
        {
            $parts = [];
            $i = 0;
            foreach ($conditionList as $key => $value)
            {
                if ((Utils::isStringContains($key, ">") || Utils::isStringContains($key, "<")) && !Utils::isStringContains($key, "="))
                {
                    $key2 = mb_substr($key, 0, -2);
                    $parts []= "{$key} :{$key2}{$i}";
                    unset($conditionList[$key]);
                    $conditionList["$key2$i"] = $value;
                }
                else if (Utils::isStringContains($key, ">=") || Utils::isStringContains($key, "<="))
                {
                    $key2 = mb_substr($key, 0, -3);
                    $parts []= "{$key} :{$key2}{$i}";
                    unset($conditionList[$key]);
                    $conditionList["$key2$i"] = $value;
                }
                else
                {
                    $parts []= "{$key} = :{$key}";
                }
                $i++;
            }
            $wherePartString = "WHERE ".implode(" AND ", $parts);
        }
        if (is_string($conditionList))
        {
            $wherePartString = $conditionList;
        }
        if (is_array($orderBy) && count($orderBy) > 0)
        {
            $orderByParts = [];
            foreach ($orderBy as $key => $value)
            {
                $orderByParts []= "{$key} {$value}";
            }
            $orderByPartString = " ORDER BY ".implode(", ", $orderByParts);
        }
        if (!empty($limit))
        {
            if (!empty($offset))
            {
                $limitAndOffsetPartString = " LIMIT {$offset}, {$limit}";
            }
            else
            {
                $limitAndOffsetPartString = " LIMIT {$limit}";
            }
        }
        $stmt = $this->pdo->prepare("SELECT {$fieldsPartString} FROM {$tableName} {$innerJoinPartString}{$wherePartString}{$orderByPartString}{$limitAndOffsetPartString}");
        $stmt->execute($conditionList);
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function update($tableName, $newValuesArray, $conditionList)
    {
        $setParts = [];
        $paramsArray = [];
        $whereParts = [];
        $wherePartString = "";
        foreach ($newValuesArray as $key => $value)
        {
            $setParts []= "{$key} = :set{$key}";
            $paramsArray["set".$key] = $value;
        }
        $setPartString = implode(", ", $setParts);
        if(is_array($conditionList) && count($conditionList) > 0)
        {
            foreach ($conditionList as $key => $value)
            {
                $whereParts []= "{$key} = :{$key}";
                $paramsArray[$key] = $value;
            }
            $wherePartString = "WHERE ".implode(" AND ", $whereParts);
        }
        $stmt = $this->pdo->prepare("UPDATE {$tableName} SET {$setPartString} {$wherePartString}");
        $stmt->execute($paramsArray);
    }

    public function insert($tableName, $insertArray)
    {
        $fieldsArray = array_keys($insertArray);
        $fieldsListString = implode(", ", $fieldsArray);
        $valuesArray = [];
        foreach ($insertArray as $key => $value)
        {
            $valuesArray []= ":".$key;
        }
        $valuesListString = implode(", ", $valuesArray);
        $stmt = $this->pdo->prepare("INSERT INTO {$tableName} ({$fieldsListString}) VALUES ({$valuesListString})");
        $stmt->execute($insertArray);
        return $this->pdo->lastInsertId();
    }

    public function delete($tableName, $conditionList)
    {
        $whereParts = [];
        $wherePartString = "";
        if(is_array($conditionList) && count($conditionList) > 0)
        {
            foreach ($conditionList as $key => $value)
            {
                $whereParts []= "{$key} = :{$key}";
            }
            $wherePartString = "WHERE ".implode(" AND ", $whereParts);
        }
        $stmt = $this->pdo->prepare("DELETE FROM {$tableName} {$wherePartString}");
        $stmt->execute($conditionList);
    }

    public function count($tableName, $conditionList = null, $innerJoin = null)
    {
        $whereParts = [];
        $wherePartString = "";
        $innerJoinPartString = "";
        if (is_string($innerJoin))
        {
            $innerJoinPartString = $innerJoin;
        }
        if(is_array($conditionList) && count($conditionList) > 0)
        {
            $i = 0;
            foreach ($conditionList as $key => $value)
            {
                if ((Utils::isStringContains($key, ">") || Utils::isStringContains($key, "<")) && !Utils::isStringContains($key, "="))
                {
                    $key2 = mb_substr($key, 0, -2);
                    $whereParts []= "{$key} :{$key2}{$i}";
                    unset($conditionList[$key]);
                    $conditionList["$key2$i"] = $value;
                }
                else if (Utils::isStringContains($key, ">=") || Utils::isStringContains($key, "<="))
                {
                    $key2 = mb_substr($key, 0, -3);
                    $whereParts []= "{$key} :{$key2}{$i}";
                    unset($conditionList[$key]);
                    $conditionList["$key2$i"] = $value;
                }
                else
                {
                    $whereParts []= "{$key} = :{$key}";
                }
                $i++;
            }
            $wherePartString = " WHERE ".implode(" AND ", $whereParts);
        }
        $stmt = $this->pdo->prepare("SELECT COUNT(*) FROM {$tableName}{$innerJoinPartString}{$wherePartString}");
        $stmt->execute($conditionList);
        return $stmt->fetchColumn();
    }
}