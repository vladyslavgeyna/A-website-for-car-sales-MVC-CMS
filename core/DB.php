<?php

namespace core;

class DB
{
    protected \PDO $pdo;

    public function __construct($hostname, $login, $password, $database)
    {
        $this->pdo = new \PDO("mysql: host={$hostname};dbname={$database}", $login, $password);
    }

    public function select($tableName, $fieldsList = "*", $conditionList = null)
    {
        $fieldsPartString = "";
        $wherePartString = "";
        if (is_string($fieldsList))
        {
            $fieldsPartString = $fieldsList;
        }
        else if(is_array($fieldsList))
        {
            $fieldsPartString = implode(", ", $fieldsList);
        }
        if(is_array($conditionList) && count($conditionList) > 0)
        {
            $parts = [];
            foreach ($conditionList as $key => $value)
            {
                $parts []= "{$key} = :{$key}";
            }
            $wherePartString = "WHERE ".implode(" AND ", $parts);
        }
        $stmt = $this->pdo->prepare("SELECT {$fieldsPartString} FROM {$tableName} {$wherePartString}");
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
}