<?php

namespace App\Application\House\Photos\UploadPhotos;

use Assert\Assertion;

class UploadPhotoCommand
{
    private $houseId;
    private $imageUrl;

    /**
     * UploadPhotoCommand constructor.
     * @param $houseId
     * @param $imageUrl
     * @throws \Assert\AssertionFailedException
     */
    public function __construct($houseId, $imageUrl)
    {
        Assertion::numeric($houseId);
        $this->houseId = $houseId;
        $this->imageUrl = $imageUrl;
    }

    /**
     * @return mixed
     */
    public function getHouseId()
    {
        return $this->houseId;
    }

    /**
     * @return mixed
     */
    public function getImageUrl()
    {
        return $this->imageUrl;
    }


}
