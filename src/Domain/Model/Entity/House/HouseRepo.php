<?php
/**
 * Created by PhpStorm.
 * User: Fran Moraton
 * Date: 12/05/2018
 * Time: 19:02
 */

namespace App\Domain\Model\Entity\House;

use App\Domain\Model\Entity\User\User;
use App\Domain\Services\House\Specification\Specification;

interface HouseRepo
{
    public function persistAndFlush(House $house): void;

    public function findAllHouses(): array;

    public function findHouseById($id): ?House;

    public function findHouseByOwner(User $user): array;

}
