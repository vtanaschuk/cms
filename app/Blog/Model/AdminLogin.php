<?php

namespace Blog\Model;

use Blog\Service\DataBase;

class AdminLogin
{
    private \Medoo\Medoo $dbConnect;

    public function __construct()
    {
        if (!isset($_SESSION)) {
            session_start();
        }
        $this->dbConnect = DataBase::getInstance();
    }

    public function login($login, $password): bool
    {

        $result = $this->dbConnect->select(
            'user', ['login','isAdmin'],

            [
                "AND" => [
                    'login' => $login,
                    'password' => $password
                ]
            ]
        );
        if (!empty($result)) {
            $_SESSION['user'] = $result[0]['login'];

            if ($result[0]['isAdmin'] == "0"){
                $_SESSION['isAdmin'] = false;
                $result[0]['isAdmin'] = false;
            }else{
                $_SESSION['isAdmin'] = true;
                $result[0]['isAdmin'] = true;
            }
            return true;
        } else {
            return false;
        }
    }

    public function validateAdmin(): bool
    {
        return !empty($_SESSION['user']);
    }
    public function validateIsAdmin(): bool
    {
        return !empty($_SESSION['isAdmin']);
    }

    public function logout()
    {
        session_destroy();
    }
}
