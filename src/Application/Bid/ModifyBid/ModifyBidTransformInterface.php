<?php
/**
 * Created by PhpStorm.
 * User: Fran Moraton
 * Date: 18/05/2018
 * Time: 10:16
 */

namespace App\Application\Bid\ModifyBid;

use App\Domain\Model\Entity\Bid\Bid;

interface ModifyBidTransformInterface
{
    public function transform(Bid $bid): array;
}
