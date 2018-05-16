<?php
/**
 * Created by PhpStorm.
 * User: Fran Moraton
 * Date: 16/05/2018
 * Time: 18:14
 */

namespace App\Application\User\UpdateUserByDni;


use App\Domain\Model\Entity\User\User;

interface UpdateUserByDniTransformInterface
{
    public function transform(User $user): array;
}
