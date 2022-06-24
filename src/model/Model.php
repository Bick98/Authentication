<?php

namespace model;
use PDO;

class Model
{
    private $login;
    private $pass;
    private $salt = "sflpr9fhi2";
    private $link;

    public function __construct()
    {
        $this->link = new PDO('mysql:host=localhost;dbname=SIT', 'root', '1201');
    }

    public function userRegister()
    {
        $result = $this->searchByLogin();
        if ($result === 0)
        {
            $command = "insert into AuthTable(login,pass) values('$this->login','$this->pass')";
            $sql = $this->link->prepare($command);
            $sql->execute();
            return true;
        }
        else
        {
            echo "Пользователь с таким логином уже существует</p>";
        }
        return false;
    }
    
    public function searchByLogin()
    {
        $command = "select * from AuthTable where login ='$this->login'";
        $sql = $this->link->prepare($command);
        $sql->execute();
        $result = count($sql->fetchAll());
        return $result;
    }
    public function searchByLogPass()
    {
        $command = "select * from AuthTable where pass = '$this->pass' and login='$this->login'";
        $sql = $this->link->prepare($command);
        $sql->execute();
        $result = count($sql->fetchAll());

        return $result;
    }

    public function getHash($l)
    {
        return  md5($l . $this->salt);
    }
    public function getLogin()
    {
        return $this->login;
    }
    public function setLogin($login)
    {
        $this->login = $login;
    }
    public function getPass()
    {
        $command = "select pass from AuthTable where login ='$this->login'";
        $sql = $this->link->prepare($command);
        $sql->execute();
        $result = $sql->fetchAll()[0];

        return $result[0];
    }
    public function setPass($pass)
    {
        $this->pass = $this->getHash($pass);
    }
}