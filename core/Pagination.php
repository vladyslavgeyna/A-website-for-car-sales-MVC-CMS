<?php

namespace core;

class Pagination
{
    public int $countPages = 1;
    public int $currentPage = 1;
    public string $uriParams = "";
    public int $midSize = 2;
    public int $allPages = 5;
    public int $total = 1;
    public int $perPage = 1;
    public int $page = 1;
    public string $additionalPrefixUrl = "";

    public function __construct(int $page = 1, int $per_page = 1, int $total = 1, string $additionalPrefixUrl = "")
    {
        $this->page = $page;
        $this->perPage = $per_page;
        $this->total = $total;
        $this->additionalPrefixUrl = $additionalPrefixUrl;
        $this->countPages = $this->getCountPages();
        $this->currentPage = $this->getCurrentPage();
        $this->uriParams = $this->getParams();
        $this->midSize = $this->getMidSize();
    }

    public function getMidSize(): int
    {
        return $this->countPages <= $this->allPages ? $this->countPages : $this->midSize;
    }

    public function getStart(): int
    {
        return ($this->currentPage - 1) * $this->perPage;
    }

    public function getCountPages(): int
    {
        return ceil($this->total / $this->perPage) ?: 1;
    }

    public function getCurrentPage(): int
    {
        if ($this->page < 1)
        {
            $this->page = 1;
        }
        if ($this->page > $this->countPages)
        {
            $this->page = $this->countPages;
        }
        return $this->page;
    }

    public function getParams(): string
    {
        $url = $_SERVER['REQUEST_URI'];
        $url = explode('?', $url);
        $uri = "";
        if (isset($url[1]) && $url[1] != '')
        {
            $uri .= "?";
            $params = explode('&', $url[1]);
            foreach ($params as $param)
            {
                $uri .= "{$param}";
            }
        }
        return $uri;
    }



    public function getHTML(): string
    {
        $back = "";
        $forward = "";
        $start_page = "";
        $end_page = "";
        $pages_left = "";
        $pages_right = "";

        if ($this->currentPage > 1)
        {
            $back = "<li class='page-item'><a class='page-link' href='" . $this->getLink($this->currentPage - 1) . "'>&lt;</a></li>";
        }

        if ($this->currentPage < $this->countPages)
        {
            $forward = "<li class='page-item'><a class='page-link' href='" . $this->getLink($this->currentPage + 1) . "'>&gt;</a></li>";
        }

        if ($this->currentPage > $this->midSize + 1)

        {
            $start_page = "<li class='page-item'><a class='page-link' href='" . $this->getLink(1) . "'>&laquo;</a></li>";
        }

        if ($this->currentPage < ($this->countPages - $this->midSize))
        {
            $end_page = "<li class='page-item'><a class='page-link' href='" . $this->getLink($this->countPages) . "'>&raquo;</a></li>";
        }

        for ($i = $this->midSize; $i > 0; $i--)
        {
            if ($this->currentPage - $i > 0)
            {
                $pages_left .= "<li class='page-item'><a class='page-link' href='" . $this->getLink($this->currentPage - $i) . "'>" . ($this->currentPage - $i) . "</a></li>";
            }
        }

        for ($i = 1; $i <= $this->midSize; $i++)
        {
            if ($this->currentPage + $i <= $this->countPages)
            {
                $pages_right .= "<li class='page-item'><a class='page-link' href='" . $this->getLink($this->currentPage + $i) . "'>" . ($this->currentPage + $i) . "</a></li>";
            }
        }

        return '<nav aria-label="Page navigation example"><ul class="pagination">' . $start_page . $back . $pages_left . '<li class="page-item active"><a class="page-link">' . $this->currentPage . '</a></li>' . $pages_right . $forward . $end_page . '</ul></nav>';

    }

    public function getLink($page): string
    {
        if ($page == 1)
        {
            return "/".$this->uriParams;
        }
        else
        {
            return $this->additionalPrefixUrl."/{$page}".$this->uriParams;
        }
    }

    public function __toString(): string
    {
        return $this->getHTML();
    }
}