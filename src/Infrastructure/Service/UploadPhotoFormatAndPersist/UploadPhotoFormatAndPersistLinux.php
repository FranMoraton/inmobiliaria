<?php

namespace App\Infrastructure\Service\UploadPhotoFormatAndPersist;

class UploadPhotoFormatAndPersistLinux implements UploadPhotoFormatAndPersist
{
    public function execute($file, $id): string
    {
        $date = date('Y-m-d h:i:s');


        $urlUpload = "./Uploads/House/".$id."_".$date."image.jpg";
        $urlDb = "/Uploads/House/".$id."_".$date."image.jpg";


//        $urlUpload = __DIR__ . '\\..\\..\\..\\..\\..\\public\\Uploads\\House'.$id."_".$date."image.jpg";
//        $urlDb = __DIR__ . '/../../../../../public/Uploads/House'.$id."_".$date."image.jpg";
        $fp = fopen($urlUpload, 'w');
        fwrite($fp, $file);

        return  $urlDb;
    }
}
