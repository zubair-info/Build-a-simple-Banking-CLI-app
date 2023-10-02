<?php
namespace App\Classes;
use App\Classes\Auth;
use App\Classes\Storage;
use App\Classes\Customer;

class CustomerManager extends User implements Auth {

    protected $storage;
    protected array $users;

    public function __construct(Storage $storage) {
        $this->storage = $storage;
        $this->users = $this->storage->load(Customer::getModelName());
    }

    public function register($username, $password) {
        foreach ($this->users as $user) {
            if ($user->getUsername() == $username) {
                return false;
            }
        }
        // $users_save = [];
        $this->users[] = new Customer($username,$password);
        $this->storage->save(Customer::getModelName(),$this->users);

        return true; // Registration successful
    }

    public function login($username, $password) {

        foreach ($this->users as $user) {
            if ($user->getUsername() == $username && $user->getPassword() == $password) {
                return $user;
            }
        }
        return false;
    }
    // private function getUsers(string $username, string $password)
    // {
    //     foreach ($this->users as $user) {
    //         if ($user->getUsername() == $username && $user->getPassword() === $password) {
    //             return $user;
    //         }
    //     }
    //     return null;
    // }

}
