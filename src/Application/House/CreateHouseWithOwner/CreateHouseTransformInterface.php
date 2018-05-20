<?php
/**
 * Created by PhpStorm.
 * User: Fran Moraton
 * Date: 20/05/2018
 * Time: 21:37
 */

namespace App\Application\House\CreateHouseWithOwner;

interface CreateHouseTransformInterface
{
    public function transform(House $house): array;
}
