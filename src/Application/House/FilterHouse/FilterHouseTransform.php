<?php
/**
 * Created by PhpStorm.
 * User: Fran Moraton
 * Date: 23/05/2018
 * Time: 13:28
 */

namespace App\Application\House\FilterHouse;

class FilterHouseTransform implements FilterHouseTransformInterface
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
