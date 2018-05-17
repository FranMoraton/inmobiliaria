<?php
/**
 * Created by PhpStorm.
 * User: Fran Moraton
 * Date: 13/05/2018
 * Time: 0:04
 */

namespace App\Infrastructure\Repository\Bid;

use App\Domain\Model\Entity\Bid\Bid;
use App\Domain\Model\Entity\Bid\BidRepo;
use App\Domain\Model\Entity\User\User;
use Doctrine\ORM\EntityRepository;

class BidRepository extends EntityRepository implements BidRepo
{

    public function persistAndFlush(Bid $bid): void
    {
        $this->getEntityManager()->persist($bid);
        $this->getEntityManager()->flush();
    }

    public function findAllBids(): array
    {
        return $this->findAll();
    }

    public function findBidById(int $id): ?Bid
    {
        return $this->findOneBy([ "id" => $id ]);
    }

    public function findBidsByOwner(User $user): array
    {
        return $this->findBy([ "userBidding" => $user ]);
    }
}
