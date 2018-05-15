<?php
/**
 * Created by PhpStorm.
 * User: Fran Moraton
 * Date: 15/05/2018
 * Time: 17:24
 */

namespace App\Application\User\ListAllUsers;

use App\Domain\Model\Entity\User\User;

class ListAllUsersTransform implements ListAllUsersTransformInterface
{
    /**
     * @param array|User[] $users
     * @return array
     */
    public function transform(array $users): array
    {
        $transformed = [];
        foreach ($users as $item) {
            $transformed [] = [
                "id" => $item->getId(),
                "role" => $item->getRole()->getName(),
                "dni" => $item->getDNI(),
                "photo" => $item->getPhoto(),
                "registerDate" => $item->getRegisterDate(),
                "birthDate" => $item->getBirthDate(),
                "houses" => $item->getHouses(),
                "bids" => $item->getBids()
            ];
        }

        return $transformed;
    }
}
