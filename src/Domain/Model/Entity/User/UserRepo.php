<?php
/**
 * Created by PhpStorm.
 * User: Fran Moraton
 * Date: 12/05/2018
 * Time: 23:09
 */

namespace App\Domain\Model\Entity\User;

interface UserRepo
{
    public function findAllUsers(): array;
    public function findUserByDni(string $dni): ?User;
}
