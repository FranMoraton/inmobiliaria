<?php
/**
 * Created by PhpStorm.
 * User: Fran Moraton
 * Date: 20/05/2018
 * Time: 17:34
 */

namespace App\Application\House\ListHouseBiddedByUser;

interface ListHouseBiddedByUserTransformInterface
{
    public function transform(array $houses): array;
}
