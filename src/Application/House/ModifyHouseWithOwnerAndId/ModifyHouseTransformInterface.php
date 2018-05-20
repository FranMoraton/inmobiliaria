<?php
/**
 * Created by PhpStorm.
 * User: Fran Moraton
 * Date: 20/05/2018
 * Time: 19:16
 */

namespace App\Application\House\ModifyHouseWithOwnerAndId;

use App\Domain\Model\Entity\House\House;

interface ModifyHouseTransformInterface
{
    public function transform(House $house): array;
}
