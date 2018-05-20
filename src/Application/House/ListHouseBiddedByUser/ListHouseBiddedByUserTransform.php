<?php
/**
 * Created by PhpStorm.
 * User: Fran Moraton
 * Date: 20/05/2018
 * Time: 17:34
 */

namespace App\Application\House\ListHouseBiddedByUser;

class ListHouseBiddedByUserTransform implements ListHouseBiddedByUserTransformInterface
{
    public function transform(array $houses): array
    {
        $transformed = [];

        foreach ($houses as $house) {
            $arrayOfPhotos = [];
            foreach ($house->getPhotos()->toArray() as $value) {
                $arrayOfPhotos [] = $value->getUrlPhoto();
            };

            $transformed [] = [
                "id" => $house->getId(),
                "houseOwner" => $house->getHouseOwner()->getDNI(),
                "adress" => $house->getAdress(),
                "country" => $house->getCountry(),
                "city" => $house->getCity(),
                "sellingPrize" => $house->getSellingPrize(),
                "photos" => $arrayOfPhotos
            ];
        }
        return $transformed;
    }
}
