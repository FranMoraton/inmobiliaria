<?php
/**
 * Created by PhpStorm.
 * User: Fran Moraton
 * Date: 20/05/2018
 * Time: 16:29
 */

namespace App\Application\House\ListHouseByOwner;

interface ListHouseByOwnerTransformInterface
{
    public function transform(array $houses): array;
}
