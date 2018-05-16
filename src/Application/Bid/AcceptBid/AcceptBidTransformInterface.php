<?php
/**
 * Created by PhpStorm.
 * User: Fran Moraton
 * Date: 16/05/2018
 * Time: 19:50
 */

namespace App\Application\Bid\AcceptBid;

use App\Domain\Model\Entity\Bid\Bid;

interface AcceptBidTransformInterface
{
    public function transform(Bid $bid): array;
}