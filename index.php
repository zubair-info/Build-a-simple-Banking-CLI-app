<?php

require_once 'vendor/autoload.php';

// use App\Classes\Bank;
// use App\Classes\Transaction;
// use App\Classes\User;
// use App\Classes\DataStore;

use App\Classes\CliApp;

$CliAPP = new CliApp();
$CliAPP->run();


// $data_store= new DataStore();

// while (true) {
//     echo "\nBuild a simple Banking CLI app\n";
//     echo "1. Login\n";
//     echo "2. Register\n";
//     $choice = readline("Enter your choice: ");
//     switch ($choice) {
//         case '1':
            // $email = readline("Enter your email: ");
            // $password = readline("Enter your password: ");
            // $users = $data_store->getUsers();

            // // Check if email and password match any user
            // $loggedInUser = null;
            // foreach ($users as $user) {
            //     if ($user['email'] === $email && $user['password'] === $password) {
            //         $loggedInUser = $user;
            //         echo "Login successful!\n";
            //         break;
            //     }
            // }
            // if ($loggedInUser !== null) {
            //     // Successful login
            //     echo "\nSelect for the following menu:\n";
            //     echo "1. Show my transaction\n";
            //     echo "2. Deposit money\n";
            //     echo "3. Withdrow money\n";
            //     echo "4. Show current balance \n";
            //     echo "4. Transfer money\n";
            //     $choice = readline("Enter your choice: ");
            //     switch ($choice) {
            //         case '1':
            //             echo "Show my transaction\n";
            //             break;
            //         case '2':
            //             echo "Deposit money\n";
            //             break;
            //         case '3':
            //             echo "Withdrow money\n";
            //             break;
            //         case '4':
            //             echo "how current balance\n";
            //             break;
            //         case '5':
            //             echo "Transfer money\n";
            //             break;
            //         default:
            //             echo "Invalid choice. Please select a valid option.\n";
            //             break;
            //     }
                
//             } else {
//                 // Login failed
//                 echo "Login failed. Invalid email or password.\n";
//             }

//             break;
//             echo "Login successfully.\n";
//             break;
//         case '2':
            // $name = readline("Enter your name: ");
            // $email = readline("Enter your email: ");
            // $password = readline("Enter your password: ");
            // $newCustomer = new User($name, $email, $password);
            // $data_store->addUser($newCustomer);
            // echo "Registration successful!\n";
//             break;
        
//         default:
//             echo "Invalid choice. Please select a valid option.\n";
//             break;
//     }
// }


?>