<?php

namespace App\Infrastructure\Controller\House\Photo;

use App\Application\House\Photos\UploadPhotos\UploadPhoto;
use App\Application\House\Photos\UploadPhotos\UploadPhotoCommand;
use App\Infrastructure\Service\UploadPhotoFormatAndPersist\UploadPhotoFormatAndPersist;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class UploadPhotoHouseController
{
    private $handler;
    private $uploadPhotoFormatAndPersistLinux;

    /**
     * UploadPhotoHouseController constructor.
     * @param UploadPhoto $handler
     * @param UploadPhotoFormatAndPersist $uploadPhotoFormatAndPersistLinux
     */
    public function __construct(
        UploadPhoto $handler,
        UploadPhotoFormatAndPersist $uploadPhotoFormatAndPersistLinux
    ) {
        $this->handler = $handler;
        $this->uploadPhotoFormatAndPersistLinux = $uploadPhotoFormatAndPersistLinux;
    }


    /**
     * @param $houseId
     * @param Request $request
     * @return JsonResponse
     * @throws \Assert\AssertionFailedException
     */
    public function __invoke($houseId, Request $request)
    {
        $file = $request->getContent();


        $list = $this->handler
            ->handle(new UploadPhotoCommand(
                $houseId,
                $this->uploadPhotoFormatAndPersistLinux->execute($file, $houseId)
            ));

        return new JsonResponse($list["data"], $list["code"]);
    }
}
