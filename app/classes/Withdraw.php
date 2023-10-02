<?php

declare(strict_types=1);
namespace App\Classes;
use App\Classes\TransactionType;
class Withdraw extends Transaction
{
    // protected $type;
    public function __construct()
    {
        $this->type = TransactionType::WITHDRAW;
    }
}