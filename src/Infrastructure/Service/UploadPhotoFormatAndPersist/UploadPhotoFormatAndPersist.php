<?php

namespace App\Infrastructure\Service\UploadPhotoFormatAndPersist;

class UploadPhotoFormatAndPersist
{
    public function execute($file, $id)
    {
        $date = date('Y-m-d h:i:s');

//LINUX
//        $output = "./Uploads/House/".$id."_".$date."image.jpg";
//        $urlDb = "/Uploads/House/".$id."_".$date."image.jpg";
//        //unlink($output);

        $urlUpload = __DIR__ . '/../../../../../public/Uploads/House'.$id."_".$date."image.jpg";
        $urlDb = __DIR__ . '/../../../../../public/Uploads/House'.$id."_".$date."image.jpg";
        $fp = fopen($urlUpload, 'w+b');
        fwrite($fp, $file);

        return  $urlDb;
    }
}
