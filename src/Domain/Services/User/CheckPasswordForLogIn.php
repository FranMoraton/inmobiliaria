<?php
/**
 * Created by PhpStorm.
 * User: Fran Moraton
 * Date: 15/05/2018
 * Time: 19:58
 */

namespace App\Domain\Services\User;

use App\Domain\Model\Entity\User\PasswordDoNotMatch;

class CheckPasswordForLogIn
{
    /**
     * @param string $findUserPassword
     * @param string $passwordRequest
     * @throws PasswordDoNotMatch
     */
    public function __invoke(string $findUserPassword, string $passwordRequest)
    {
        if (false === password_verify($passwordRequest, $findUserPassword)) {
            throw new PasswordDoNotMatch();
        }
    }
}
