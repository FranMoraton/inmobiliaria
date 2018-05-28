<?php
/**
 * Created by PhpStorm.
 * User: Fran Moraton
 * Date: 28/05/2018
 * Time: 9:42
 */

namespace App\Application\Bid\ListBidsByHouse;

interface ListBidsByHouseTransformInterface
{
    public function transform(array $bids): array;
}
