<?php
/**
 * Created by PhpStorm.
 * User: Fran Moraton
 * Date: 20/05/2018
 * Time: 11:17
 */

namespace App\Domain\Services\House\Specification;

use App\Domain\Model\Entity\House\House;

interface Specification
{
    public function isSatisfiedBy(House $house): bool;
}
