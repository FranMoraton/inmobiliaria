<?php
/**
 * Created by PhpStorm.
 * User: Fran Moraton
 * Date: 13/05/2018
 * Time: 0:03
 */

namespace App\Domain\Model\Entity\Bid;

use App\Domain\Model\Entity\House\House;
use App\Domain\Model\Entity\User\User;

interface BidRepo
{
    public function findBidById(int $id): ?Bid;
    public function findAllBids(): array;
    public function persistAndFlush(Bid $bid): void;
    public function findBidsByOwner(User $user): array;
    public function findByUserAndHouse(User $user, House $house): ?Bid;
}
