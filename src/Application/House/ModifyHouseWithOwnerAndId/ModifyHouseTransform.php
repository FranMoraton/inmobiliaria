<?php
/**
 * Created by PhpStorm.
 * User: Fran Moraton
 * Date: 20/05/2018
 * Time: 19:16
 */

namespace App\Application\House\ModifyHouseWithOwnerAndId;

use App\Domain\Model\Entity\House\House;

class ModifyHouseTransform implements ModifyHouseTransformInterface
{
    /**
     * @param House $house
     * @return array
     */
    public function transform(House $house): array
    {
        $arrayOfPhotos = [];
        foreach ($house->getPhotos()->toArray() as $value) {
            $arrayOfPhotos [] = $value->getUrlPhoto();
        };

        return [
            "id" => $house->getId(),
            "houseOwner" => $house->getHouseOwner()->getDNI(),
            "adress" => $house->getAdress(),
            "country" => $house->getCountry(),
            "city" => $house->getCity(),
            "sellingPrize" => $house->getSellingPrize(),
            "photos" => $arrayOfPhotos
        ];
    }
}
