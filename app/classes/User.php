<?php
namespace App\Classes;
use App\Classes\Storage;

abstract class User {
    protected $storage;
    protected array $users;

    public function __construct(Storage $storage) {
        $this->storage = $storage;
    }

    public abstract function register($username, $password);
    public abstract function login($username, $password);
}