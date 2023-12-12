<?php

namespace Blog\Model;

use Blog\Service\DataBase;

class Pagination
{
    public $currentPage;
    public $perpage;
    public $total;
    public $countPages;
    public $uri;

    public function __toString()
    {
        // TODO: Implement __toString() method.
        return $this->getHtml();
    }
    public function getHtml(){
        $back = null;
        $forward = null;
        $startpage = null;
        $endpage = null;
        $page2left = null;
        $page1left = null;
        $page1right = null;
        $page2right = null;

        if($this->currentPage>1){
            $back = "<a class = 'nav-link' href = '?{$this->uri}page=".($this->currentPage-1)."'>&lt;</a>";
        }
        if($this->currentPage < $this->countPages){
            $forward = "<a class = 'nav-link' href = '?{$this->uri}page=".($this->currentPage+1)."'>&gt;</a>";
        }
        if($this->currentPage > 3){
            $startpage = "<a class = 'nav-link' href = '?{$this->uri}page=1'>&laquo;</a>";
        }
        if($this->currentPage < ($this->countPages - 2)){
            $endpage = "<a class = 'nav-link' href =  '?{$this->uri}page=".($this->countPages)."'>&raquo;</a>";
        }
        if($this->currentPage - 2 > 0){
            $page2left = "<a class = 'nav-link' href = '?{$this->uri}page=".($this->currentPage-2)."'>".($this->currentPage-2)."</a>";
        }
        if($this->currentPage - 1 > 0){
            $page1left = "<a class = 'nav-link' href = '?{$this->uri}page=".($this->currentPage-1)."'>".($this->currentPage-1)."</a>";
        }
        if($this->currentPage + 1 <= $this->countPages){
            $page1right = "<a class = 'nav-link page1right' href = '?{$this->uri}page=".($this->currentPage+1)."'>".($this->currentPage+1)."</a>";
        }
        if($this->currentPage + 2 <= $this->countPages){
            $page2right = "<a class = 'nav-link page2right' href = '?{$this->uri}page=".($this->currentPage+2)."'>".($this->currentPage+2)."</a>";
        }

        return '<div class="pagination">'.$startpage.$back.$page2left.$page1left.'<a class ="active">'.$this->currentPage.'</a>'.$page1right.$page2right.$forward.$endpage.'</div></div>';
    }

    public function __construct($page, $perpage, $total)
    {
        $this -> perpage = $perpage;
        $this -> total = $total;
        $this -> countPages = $this -> getCountPages();
        $this -> currentPage = $this -> getCurrentPage($page);
        $this -> uri = $this -> getParams();
    }
    public function getCountPages(){
        return ceil($this->total / $this->perpage) ? : 1;
    }
    public function getCurrentPage($page){
        if(!$page || $page < 1) $page =  1;
        if($page > $this->countPages) $page = $this->countPages;
        return $page;
    }
    public function getStart(){
        return($this->currentPage-1) * $this->perpage;
    }
    public function getParams(): string
    {
        $uri='';
        $url = $_SERVER['REQUEST_URI'];
        $url = explode('?', $url);
        $url = $url[0];
        if(isset($url[1]) && $url[1] != '' ){
            $params = explode('&', $url[1]);
            foreach ($params as $param){
                if(!preg_match('#page-#', $param)) $uri .="{$param}&amp";
            }
        }
        return $uri;
    }
}
