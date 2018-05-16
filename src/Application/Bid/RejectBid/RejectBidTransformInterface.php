<?php
/**
 * Created by PhpStorm.
 * User: Fran Moraton
 * Date: 16/05/2018
 * Time: 19:51
 */

namespace App\Application\Bid\RejectBid;

use App\Domain\Model\Entity\Bid\Bid;

interface RejectBidTransformInterface
{
    public function transform(Bid $bid): array;
}
