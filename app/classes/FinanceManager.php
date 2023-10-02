<?php

// declare(strict_types=1);
namespace App\Classes;
use App\Classes\Transaction;
use App\Classes\Storage;
use App\Classes\Customer;
use App\Classes\Deposit;
use App\Classes\TransactionType;

class FinanceManager
{
    private array $transactions;
    private Storage $storage;
    private array $users;
    private Customer $customer;

    public function __construct(Storage $storage)
    {
        $this->storage = $storage;
        $this->users = $this->storage->load(Customer::getModelName());
        $this->transactions = $this->storage->load(Transaction::getModelName());

    }

    public function deposit(string $username, float $depositAmount) {
        $customer = $this->getUsers($username);

        if(!$customer){
            return "Invaild customer";
        }
        $deposit = new Deposit();
        $deposit->setAmount($depositAmount);
        $deposit->setCustomer($customer);
        $deposit->setType(TransactionType::DEPOSIT);
        $this->transactions[] = $deposit;
        $this->saveTransactions();        
        printf("Deposit successfully!\n");
        return $depositAmount;
    }
    public function withdraw(string $username, float $depositAmount) {
        $customer = $this->getUsers($username);

        if(!$customer){
            return "Invaild customer";
        }
        $withdraw = new Withdraw();
        $withdraw->setAmount($depositAmount);
        $withdraw->setCustomer($customer);
        $withdraw->setType(TransactionType::WITHDRAW);
        $this->transactions[] = $withdraw;
        $this->saveTransactions();        
        printf("Withdraw successfully!\n");
        return $depositAmount;
    }

    private function getUsers(string $username):?Customer
    {
        foreach ($this->users as $user) {
            if ($user->getUsername() == $username) {
                return $user;
            }
        }
        return null;
    }
    public function showTransaction(string $userName): void
    {
        printf("============== Transaction (%s) ================== \n", $userName);
        printf("Account | Amount  | Type \n");
        foreach ($this->transactions as $transaction) {
            if ($transaction->getCustomer()->getUsername()==$userName) {
                $depsitAmount=$transaction->getAmount().'-'.$transaction->getType()->name;
                // echo "Amount:".$depsitAmount."\n";
                printf(" %s     | %s | %.2f \n", $userName, $transaction->getType()->name, $depsitAmount);
            }
        }
        printf("===================================================\n\n"); 
    }

    public function checkBalance(string $userName)
    {
        (float) $balance = 0;

        foreach ($this->transactions as $key => $value) {
        if ($value->getCustomer()->getUsername()==$userName && $value->getType() === TransactionType::DEPOSIT) {
            $balance += $value->getAmount();
        } else if ($value->getCustomer()->getUsername()==$userName && $value->getType() === TransactionType::WITHDRAW) {
            $balance -= $value->getAmount();
        }
        }
        printf("Your Current Blanace is : %.2f \n", $balance);
    }

    public function transferBlanceOther(string $userName, float $amount,string $otherUserName)
    {
  
        foreach ($this->users as $key => $customer) {
            if ($customer->getUsername() === $otherUserName) {
                $this->deposit($customer->getUsername(), $amount);
                $this->withdraw($userName, $amount);
                return;
            }
        }
        printf("Sorry, Email not found!");
    }

    public function saveTransactions(): void
    {
        $this->storage->save(Transaction::getModelName(), $this->transactions);
    }

}