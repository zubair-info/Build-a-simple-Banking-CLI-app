<?php

declare(strict_types=1);
namespace App\Classes;
class CLIApp
{
    private FinanceManager $financeManager;
    private CustomerManager $customerManager;

    private const LOGIN = 1;
    private const REGISTER = 2;

    private const TRANSACTION = 1;
    private const DEPOSIT = 2;
    private const WITHDROW = 3;
    private const TRANSFER_MONEY = 4;
    private const BALANCE = 5;
    private const EXIT_APP = 6;

    private array $auth_options = [
        self::LOGIN => 'Login',
        self::REGISTER => 'Register',
    ];
    private array $options = [
        self::TRANSACTION => 'See all of their transactions',
        self::DEPOSIT => 'Deposit money to their account',
        self::WITHDROW => 'Withdraw money from their account',
        self::TRANSFER_MONEY => 'Transfer money to another customer account',
        self::BALANCE => 'Balance',
        self::EXIT_APP => 'Exit'
    ];

    public function __construct()
    {
        $this->financeManager = new FinanceManager(new FileStorage());
        $this->customerManager = new CustomerManager(new FileStorage());
    }

    public function run(): void
    {
        // while (true) {
            foreach ($this->auth_options as $option => $label) {
                printf("%d. %s\n", $option, $label);
            }
            $choice = intval(readline("Enter your option: "));

                switch ($choice) {
                    case self::LOGIN:
                        $username = readline("Enter username: ");
                        $password = readline("Enter password: ");
                        $loginStatus = $this->customerManager->login($username, $password);
                        if ($loginStatus!=false) {
                            echo "Login successful!\n";
                            foreach ($this->options as $option => $label) {
                                printf("%d. %s\n", $option, $label);
                            }
            
                            $choice = intval(readline("Enter your option: "));
            
                            switch ($choice) {
                                case self::TRANSACTION:
                                    $this->financeManager->showTransaction($loginStatus->getUsername());
                                    $this->run();
                                    break;
                                case self::DEPOSIT:
                                    $amount = (float)trim(readline("Enter  amount: "));
                                    $username = trim(readline("Enter username: "));
                                    $depositedAmount = $this->financeManager->deposit($username, $amount);
                                    // if ($depositedAmount > 0) {
                                    //     echo "Deposited $depositedAmount.\n";
                                    // } else {
                                    //     echo "Deposit failed.\n";
                                    // }
                                    $this->run();
                                    break;
                                case self::WITHDROW:
                                    $amount = (float)trim(readline("Enter  amount: "));
                                    $username = trim(readline("Enter username: "));
                                    $this->financeManager->withdraw($username, $amount);
                                    $this->run();
                                    break;
                                case self::TRANSFER_MONEY:
                                    $amount = (float)trim(readline("Enter  amount: "));
                                    $otherUserName = trim(readline("Enter username: "));
                                    $userName=$loginStatus->getUsername();
                                    $this->financeManager->transferBlanceOther($userName,$amount,$otherUserName);
                                    $this->run();
                                    break;
                                case self::BALANCE:
                                    $this->financeManager->checkBalance($loginStatus->getUsername());
                                    $this->run();
                                    break;
                                case self::EXIT_APP:
                                    return;
                                default:
                                    echo "Invalid option.\n";
                            }
                        } else {
                            echo "Login failed. Invalid credentials.\n";
                        }
                        break;
                    case self::REGISTER:
                        $username = readline("Enter username: ");
                        $password = readline("Enter password: ");
                        if ($this->customerManager->register($username, $password)) {
                            echo "Registration successful!\n";
                        } else {
                            echo "Registration failed. Username already exists.\n";
                        }
                        break;
                    case self::EXIT_APP:
                        return;
                    default:
                        echo "Invalid option.\n";
                }
                
        // }
    }
}