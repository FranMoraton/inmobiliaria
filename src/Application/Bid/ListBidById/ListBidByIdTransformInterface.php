<?php
/**
 * Created by PhpStorm.
 * User: Fran Moraton
 * Date: 17/05/2018
 * Time: 22:09
 */

namespace App\Application\Bid\ListBidById;

use App\Domain\Model\Entity\Bid\Bid;

interface ListBidByIdTransformInterface
{
    public function transform(Bid $bid): array;
}
