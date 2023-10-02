<?php

declare(strict_types=1);
namespace App\Classes;
enum TransactionType
{
    case DEPOSIT;
    case WITHDRAW;
}
