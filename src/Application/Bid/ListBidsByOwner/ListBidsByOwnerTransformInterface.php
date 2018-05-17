<?php
/**
 * Created by PhpStorm.
 * User: Fran Moraton
 * Date: 17/05/2018
 * Time: 19:41
 */

namespace App\Application\Bid\ListBidsByOwner;

interface ListBidsByOwnerTransformInterface
{
    public function transform(array $bids): array;
}
