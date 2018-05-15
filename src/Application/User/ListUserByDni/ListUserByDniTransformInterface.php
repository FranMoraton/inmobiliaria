<?php
/**
 * Created by PhpStorm.
 * User: Fran Moraton
 * Date: 15/05/2018
 * Time: 18:32
 */

namespace App\Application\User\ListUserByDni;


use App\Domain\Model\Entity\User\User;

interface ListUserByDniTransformInterface
{
    public function transform(User $user): array;
}
