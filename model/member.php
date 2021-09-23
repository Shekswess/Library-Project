<?php
class Member
{
    public $name;
    public $email;
    public $username;
    public $password;
    public $balance;

    public function __construct($name, $email, $username, $password, $balance)
    {
        $this->name = $name;
        $this->email = $email;
        $this->username = $username;
        $this->password = $password;
        $this->balance = $balance;
    }

    public function get_name()
    {
        return $this->name;
    }
    public function get_email()
    {
        return $this->email;
    }
    public function get_username()
    {
        return $this->username;
    }
    public function get_password()
    {
        return $this->password;
    }
    public function get_balance()
    {
        return $this->balance;
    }
}
