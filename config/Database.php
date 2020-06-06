<?php

class Database
{
    protected $host = 'localhost';
    protected $dbname = 'php_crud';
    protected $user = 'admin';
    protected $password = 'admin4321';

    public function openDbConnection()
    {
        $link = new PDO("mysql:host=$this->host;dbname=$this->dbname", $this->user, $this->password);
        return $link;
    }

    public function closeDbConnection(&$link)
    {
        $link = null;
    }
}