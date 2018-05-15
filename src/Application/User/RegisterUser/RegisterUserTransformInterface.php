<?php
/**
 * Created by PhpStorm.
 * User: Fran Moraton
 * Date: 15/05/2018
 * Time: 22:58
 */

namespace App\Application\User\RegisterUser;


use App\Domain\Model\Entity\User\User;

interface RegisterUserTransformInterface
{
    public function transform(User $user): array;
}
