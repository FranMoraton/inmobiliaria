<?php
/**
 * Created by PhpStorm.
 * User: Fran Moraton
 * Date: 20/05/2018
 * Time: 16:30
 */

namespace App\Application\House\ListHouseByOwner;

class ListHouseByOwnerTransform implements ListHouseByOwnerTransformInterface
{
    /**
     * @param array $houses
     * @return array
     */
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
