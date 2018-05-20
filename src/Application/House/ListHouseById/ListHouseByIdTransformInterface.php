<?php
/**
 * Created by PhpStorm.
 * User: Fran Moraton
 * Date: 20/05/2018
 * Time: 15:15
 */

namespace App\Application\House\ListHouseById;

use App\Domain\Model\Entity\House\House;

interface ListHouseByIdTransformInterface
{
    public function transform(House $house): array;
}
