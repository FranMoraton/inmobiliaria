<?php
/**
 * Created by PhpStorm.
 * User: Fran Moraton
 * Date: 16/05/2018
 * Time: 20:15
 */

namespace App\Domain\Services\User;


use App\Domain\Model\Entity\User\User;
use App\Domain\Model\Entity\User\UsersDoNotMatches;

class CheckUsersAreEquals
{
    /**
     * @param User $user
     * @param User $user2
     * @throws UsersDoNotMatches
     */
    public function __invoke(User $user, User $user2)
    {
        if ($user !== $user) {
            throw new UsersDoNotMatches();
        }
    }
}
