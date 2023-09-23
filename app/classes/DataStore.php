<?php
namespace App\Classes;
class DataStore {

    private $usersFile='user_data.txt';

    public function getUsers() {
       
        if (file_exists($this->usersFile)) {
            $serializedData = file_get_contents($this->usersFile);
        }
        $usersData = unserialize($serializedData);
        $users = [];
        foreach ((array) $usersData as $userData) {
            // $user = new User($userData['name'], $userData['email'], $userData['password']);
            $user = [
                'name' => $userData['name'],
                'email' => $userData['email'], 
                'password' => $userData['password'], 
            ];
            $users[] = $user;
        }
        return $users;
    }
    public function addUser($user) {
        $users = $this->getUsers();
        $users[] = [
            'name' => $user->getName(),
            'email' => $user->getEmail(),
            'password' => $user->getPassword(),
        ];
        $serializedData = serialize($users);
        file_put_contents($this->usersFile, $serializedData);
    }
}
