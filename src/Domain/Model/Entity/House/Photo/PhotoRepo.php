<?php
/**
 * Created by PhpStorm.
 * User: Fran Moraton
 * Date: 12/05/2018
 * Time: 18:55
 */

namespace App\Domain\Model\Entity\House\Photo;

interface PhotoRepo
{
    public function persistAndFlush(Photo $photo): void;

    public function findAllPhotos();
}
