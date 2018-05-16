<?php
/**
 * Created by PhpStorm.
 * User: Fran Moraton
 * Date: 16/05/2018
 * Time: 18:14
 */

namespace App\Application\User\UpdateUserByDni;


use App\Domain\Model\Entity\User\User;

class UpdateUserByDniTransform implements UpdateUserByDniTransformInterface
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
