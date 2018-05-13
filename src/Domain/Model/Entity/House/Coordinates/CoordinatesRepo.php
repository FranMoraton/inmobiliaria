<?php
/**
 * Created by PhpStorm.
 * User: Fran Moraton
 * Date: 12/05/2018
 * Time: 18:38
 */

namespace App\Domain\Model\Entity\House\Coordinates;


interface CoordinatesRepo
{
    public function persistAndFlush(): void;
    public function findAllSize(): array;
}
