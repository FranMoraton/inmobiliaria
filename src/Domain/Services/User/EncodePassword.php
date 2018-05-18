<?php
/**
 * Created by PhpStorm.
 * User: Fran Moraton
 * Date: 15/05/2018
 * Time: 19:59
 */

namespace App\Domain\Services\User;

class EncodePassword
{
    public function execute(string $password): string
    {

        return password_hash($password, PASSWORD_DEFAULT);
    }
}
