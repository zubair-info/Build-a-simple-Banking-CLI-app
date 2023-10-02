<?php
namespace App\Classes;

class Customer implements Model{
    protected $username;
    protected $password;

    public function __construct($username, $password) {
        $this->username = $username;
        $this->password = $password;
    }

    public function getUsername() {
        return $this->username;
    }

    public function getPassword() {
        return $this->password;
    }
    public static function getModelName(): string
    {
        return 'customer';
    }
}