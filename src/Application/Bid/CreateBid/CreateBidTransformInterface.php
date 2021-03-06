<?php
/**
 * Created by PhpStorm.
 * User: Fran Moraton
 * Date: 17/05/2018
 * Time: 22:45
 */

namespace App\Application\Bid\CreateBid;

use App\Domain\Model\Entity\Bid\Bid;

interface CreateBidTransformInterface
{
    public function transform(Bid $bid): array;
}
