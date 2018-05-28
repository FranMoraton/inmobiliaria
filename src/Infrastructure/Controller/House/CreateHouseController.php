<?php
/**
 * Created by PhpStorm.
 * User: Fran Moraton
 * Date: 20/05/2018
 * Time: 21:47
 */

namespace App\Infrastructure\Controller\House;

use App\Application\House\CreateHouseWithOwner\CreateHouse;
use App\Application\House\CreateHouseWithOwner\CreateHouseCommand;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class CreateHouseController
{

    private $handler;

    /**
     * ListHouseByIdController constructor.
     * @param $handler
     */
    public function __construct(CreateHouse $handler)
    {
        $this->handler = $handler;
    }

    /**
     * @param Request $request
     * @return JsonResponse
     * @throws \Assert\AssertionFailedException
     */
    public function __invoke(Request $request)
    {
        $content = json_decode($request->getContent());
        $dni = $content->dni;
        $adress = $content->adress;
        $sellingPrize = $content->sellingPrize;
        $city = $content->city;
        $country = $content->country;

        $list = $this->handler
            ->handle(new CreateHouseCommand($dni, $adress, $sellingPrize, $city, $country));

        return new JsonResponse($list["data"], $list["code"]);
    }
}
