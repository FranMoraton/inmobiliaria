<?php
/**
 * Created by PhpStorm.
 * User: Fran Moraton
 * Date: 20/05/2018
 * Time: 19:06
 */

namespace App\Infrastructure\Controller\House;

use App\Application\House\ModifyHouseWithOwnerAndId\ModifyHouse;
use App\Application\House\ModifyHouseWithOwnerAndId\ModifyHouseCommand;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class ModifyHouseWithOwnerAndIdController
{
    private $handler;

    /**
     * ListHouseByIdController constructor.
     * @param $handler
     */
    public function __construct(ModifyHouse $handler)
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
        $dni = $request->request->get('dni');
        $id = $request->request->get('id');
        $adress = $request->request->get('adress');
        $sellingPrize = $request->request->get('sellingPrize');
        $city = $request->request->get('city');
        $country = $request->request->get('country');
        $disableHouse = $request->request->get('disableHouse');

        $list = $this->handler
            ->handle(new ModifyHouseCommand($dni, $id, $adress, $sellingPrize, $city, $country, $disableHouse));

        return new JsonResponse($list["data"], $list["code"]);
    }
}
