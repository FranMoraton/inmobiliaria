<?php
/**
 * Created by PhpStorm.
 * User: Fran Moraton
 * Date: 23/05/2018
 * Time: 13:28
 */

namespace App\Application\House\FilterHouse;

interface FilterHouseTransformInterface
{
    public function transform(array $houses): array;
}
