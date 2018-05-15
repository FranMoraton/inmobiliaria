<?php
/**
 * Created by PhpStorm.
 * User: Fran Moraton
 * Date: 15/05/2018
 * Time: 22:58
 */

namespace App\Application\User\RegisterUser;


use App\Domain\Model\Entity\User\User;

class RegisterUserTransform implements RegisterUserTransformInterface
{

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
