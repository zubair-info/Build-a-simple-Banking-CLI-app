<?php

declare(strict_types=1);
namespace App\Classes;
use App\Classes\Customer;
use App\Classes\Model;
use App\Classes\TransactionType;
class Transaction implements Model
{
    protected TransactionType $type;
    protected float $amount;
    protected Customer $user;

    public static function getModelName(): string
    {
        return 'transactions';
    }

    public function setAmount(float $amount): void
    {
        $this->amount = $amount;
    }

    public function getAmount(): float
    {
        return $this->amount;
    }

    public function setCustomer(Customer $user): void
    {
        // $this->user = $user;
        $this->user = $user;
    }

    public function getCustomer()
    {
        return $this->user;
    }
    public function getType(): TransactionType
    {
        return $this->type;
    }

    public function setType(TransactionType $type): void
    {
        $this->type = $type;
    }

}

