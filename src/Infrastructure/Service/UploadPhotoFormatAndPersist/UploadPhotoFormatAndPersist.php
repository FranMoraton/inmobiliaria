<?php
/**
 * Created by PhpStorm.
 * User: Fran Moraton
 * Date: 30/05/2018
 * Time: 19:08
 */

namespace App\Infrastructure\Service\UploadPhotoFormatAndPersist;


interface UploadPhotoFormatAndPersist
{
    public function execute($file, $id): string;
}
