<?php

// declare(strict_types=1);

namespace App\Classes;

use App\Classes\BankingManager;
use App\Classes\Customer;
use App\Classes\DataStore;

class CliApp
{
    private const LOGIN = 1;
    private const REGISTRATION = 2;

    private DataStore $data_store;

    private array $options = [
        self::LOGIN => 'Login',
        self::REGISTRATION => 'Registration',
    ];

    private const TRANSACTION = 1;
    private const DEPOSIT = 2;
    private const WITHDROW = 3;
    private const BALANCE = 4;
    private const TRANSFER = 5;
        
    private array $options_customer = [
        self::TRANSACTION => 'TRANSACTION',
        self::DEPOSIT => 'DEPOSIT',
        self::WITHDROW => 'WITHDROW',
        self::BALANCE => 'BALANCE',
        self::TRANSFER => 'TRANSFER',
    ];

    public function __construct()
    {
        $this->data_store= new DataStore();
    }

    public function run():void
    {
        printf("Choose Option \n");
        foreach ($this->options as $key => $value) {
            printf("%d. %s \n", $key, $value);
        }

        $user_input = readline('Select option: ');

        switch ($user_input) {
            case self::LOGIN:
            
                $email = readline("Enter your email: ");
                $password = readline("Enter your password: ");
                $users =  $this->data_store->getUsers();

                // Check if email and password match any user
                $loggedInUser = null;
                foreach ($users as $user) {
                    if ($user['email'] === $email && $user['password'] === $password) {
                        $loggedInUser = $user;
                        echo "Login successful!\n";
                        break;
                    }
                }
                if ($loggedInUser !== null) {
                    // Successful login

                    foreach ($this->options_customer as $key => $value) {
                        printf("%d. %s \n", $key, $value);
                    }
                    $choice = readline("Enter your choice: ");
                    switch ($choice) {
                        case self::TRANSACTION:
                            echo "Show my transaction\n";
                            break;
                        case self::DEPOSIT:
                            echo "Deposit money\n";
                            break;
                        case self::WITHDROW:
                            echo "Withdrow money\n";
                            break;
                        case self::BALANCE:
                            echo "how current balance\n";
                            break;
                        case self::TRANSFER:
                            echo "Transfer money\n";
                            break;
                        default:
                            echo "Invalid choice. Please select a valid option.\n";
                            break;
                    }
                }
                break;
            case self::REGISTRATION:
                $name = readline("Enter your name: ");
                $email = readline("Enter your email: ");
                $password = readline("Enter your password: ");
                $newCustomer = new User($name, $email, $password);
                $this->data_store->addUser($newCustomer);
                echo "Registration successful!\n";
                break;
            default:
                printf("invalid");
                break;
        }
    }
}