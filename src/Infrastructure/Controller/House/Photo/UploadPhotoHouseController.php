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
    private $uploadPhotoFormatAndPersist;

    /**
     * UploadPhotoHouseController constructor.
     * @param UploadPhoto $handler
     * @param UploadPhotoFormatAndPersist $uploadPhotoFormatAndPersist
     */
    public function __construct(
        UploadPhoto $handler,
        UploadPhotoFormatAndPersist $uploadPhotoFormatAndPersist
    ) {
        $this->handler = $handler;
        $this->uploadPhotoFormatAndPersist = $uploadPhotoFormatAndPersist;
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
                $this->uploadPhotoFormatAndPersist->execute($file, $houseId)
            ));

        return new JsonResponse($list["data"], $list["code"]);
    }
}
