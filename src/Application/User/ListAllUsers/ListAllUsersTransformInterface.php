<?php
/**
 * Created by PhpStorm.
 * User: Fran Moraton
 * Date: 15/05/2018
 * Time: 17:24
 */

namespace App\Application\User\ListAllUsers;

interface ListAllUsersTransformInterface
{
    public function transform(array $users): array;
}
