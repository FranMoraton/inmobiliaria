<?php

namespace App\Application\House\Photos\UploadPhotos;

use App\Domain\Model\Entity\House\Photo\Photo;
use App\Domain\Model\Entity\House\Photo\PhotoRepo;
use App\Domain\Model\HttpResponses\HttpResponses;
use App\Domain\Services\House\FindHouseById;
use App\Domain\Services\Util\ExceptionObserver\ListException;

class UploadPhoto
{
    private $findHouseById;
    private $photoRepo;

    /**
     * UploadPhoto constructor.
     * @param $findHouseById
     * @param $photoRepo
     */
    public function __construct(
        FindHouseById $findHouseById,
        PhotoRepo $photoRepo
    ) {
        $this->findHouseById = $findHouseById;
        $this->photoRepo = $photoRepo;
        ListException::instance()->restartExceptions();
        ListException::instance()->attach($findHouseById);
    }

    public function handle(UploadPhotoCommand $uploadPhotoCommand)
    {

        $house = $this->findHouseById->__invoke($uploadPhotoCommand->getHouseId());

        if (ListException::instance()->checkForException()) {
            return ListException::instance()->firstException();
        }
        $this->photoRepo->persistAndFlush(Photo::createFromApi($uploadPhotoCommand->getImageUrl(), $house));

        return [
            "data" => "ok",
            "code" => HttpResponses::OK
        ];
    }
}
