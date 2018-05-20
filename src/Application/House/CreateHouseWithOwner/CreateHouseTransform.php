<?php
/**
 * Created by PhpStorm.
 * User: Fran Moraton
 * Date: 20/05/2018
 * Time: 21:37
 */

namespace App\Application\House\CreateHouseWithOwner;

use App\Domain\Model\Entity\House\House;

class CreateHouseTransform implements CreateHouseTransformInterface
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
