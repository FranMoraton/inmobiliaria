<?php
/**
 * Created by PhpStorm.
 * User: Fran Moraton
 * Date: 15/05/2018
 * Time: 20:18
 */

namespace App\Application\User\LogInUser;

use App\Domain\Model\Entity\User\User;

class LogInUserTransform implements LogInUserTransformInterface
{
    /**
     * @param User $user
     * @return array
     */
    public function transform(User $user): array
    {

        $transformed [] = [
            "id" => $user->getId(),
            "role" => $user->getRole()->getName(),
            "dni" => $user->getDNI(),
            "photo" => $user->getPhoto(),
            "registerDate" => $user->getRegisterDate(),
            "birthDate" => $user->getBirthDate(),
            "houses" => $user->getHouses(),
            "bids" => $user->getBids()
        ];

        return $transformed;
    }
}
