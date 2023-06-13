<?php

abstract class Acore
{
    protected $dbh;
    public function __construct()
    {
        $dsn = 'mysql:dbname=' . DB . ';host=' . HOST;
        $user = USER;
        $password = PASS;
        try {
            $this->dbh = new PDO($dsn, $user, $password);
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }
    protected function get_header()
    {
        include "header.php";
    }
    protected function get_footer()
    {
        include "footer.php";
    }
    public function get_body()
    {
        if($_POST) {
            $this->obr();
        }
        $this->get_header();
        $this->get_content();
        $this->get_footer();
    }
    abstract function get_content();
}