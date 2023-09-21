<?php

require_once 'vendor/autoload.php';

use App\Classes\Bank;
use App\Classes\Transaction;
use App\Classes\User;



// $transaction= new Transaction();
// $user= new User();
// echo $user->getEmail();
// $bank= new Bank();

while (true) {
    echo "\nBuild a simple Banking CLI app\n";
    echo "1. Admin\n";
    echo "2. Customer\n";
    $choice = readline("Enter your choice: ");
    switch ($choice) {
        case '1':
            echo "1. Login\n";
            $choice = readline("Enter your choice: ");
            echo "Login successfully.\n";
            break;
        case '2':
            echo "1. Login\n";
            echo "2. Register\n";
            $choice = readline("Enter your choice: ");
            echo "Login successfully.\n";
            break;
        default:
            echo "Invalid choice. Please select a valid option.\n";
    }
}


?>