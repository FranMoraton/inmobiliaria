<?php
/**
 * Created by PhpStorm.
 * User: Fran Moraton
 * Date: 17/05/2018
 * Time: 19:17
 */

namespace App\Application\Bid\ListBids;


interface ListBidsTransformInterface
{
    public function transform(array $bids): array;
}
