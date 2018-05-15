<?php
/**
 * Created by PhpStorm.
 * User: Fran Moraton
 * Date: 12/05/2018
 * Time: 21:18
 */

namespace App\Domain\Model\Entity\User\Role;

interface RoleRepo
{
    public function returnRole(int $const): ?Role;
    public function persistAndFlush(Role $role): void;
}
