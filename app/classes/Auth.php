<?php

declare(strict_types=1);
namespace App\Classes;
interface Auth
{
    public function register($username, $password);

    public function login($username, $password);

}