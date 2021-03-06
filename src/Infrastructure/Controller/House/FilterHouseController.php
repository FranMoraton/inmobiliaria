<?php
/**
 * Created by PhpStorm.
 * User: Fran Moraton
 * Date: 23/05/2018
 * Time: 19:38
 */

namespace App\Infrastructure\Controller\House;

use App\Application\House\FilterHouse\FilterHouse;
use App\Application\House\FilterHouse\FilterHouseCommand;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class FilterHouseController
{
    private $handler;

    /**
     * FilterHouseController constructor.
     * @param $handler
     */
    public function __construct(FilterHouse $handler)
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
        $page = $content->page;
        $maxPrize = $content->maxPrize;
        $minPrize = $content->minPrize;
        $city = $content->city;
        $country = $content->country;

        $houses = $this->handler->handle(new FilterHouseCommand($page, $maxPrize, $minPrize, $city, $country));

        return new JsonResponse($houses["data"], $houses["code"]);
    }
}
