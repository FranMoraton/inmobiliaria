<?php
/**
 * Created by PhpStorm.
 * User: Fran Moraton
 * Date: 15/05/2018
 * Time: 20:18
 */

namespace App\Application\User\LogInUser;

use App\Domain\Model\Entity\User\User;

interface LogInUserTransformInterface
{
    public function transform(User $user): array;
}
