<?php
/**
 * Created by PhpStorm.
 * User: Fran Moraton
 * Date: 20/05/2018
 * Time: 15:19
 */

namespace App\Application\House\ListHouseById;

use App\Domain\Model\HttpResponses\HttpResponses;
use App\Domain\Services\House\FindHouseById;
use App\Domain\Services\Util\ExceptionObserver\ListException;

class ListHouseById
{
    private $dataTransform;
    private $findHouseById;

    /**
     * ListHouseById constructor.
     * @param $dataTransform
     * @param $findHouseById
     */
    public function __construct(
        ListHouseByIdTransformInterface $dataTransform,
        FindHouseById $findHouseById
    ) {
        $this->dataTransform = $dataTransform;
        $this->findHouseById = $findHouseById;
        ListException::instance()->restartExceptions();
        ListException::instance()->attach($findHouseById);
    }

    public function handle(ListHouseByIdCommand $listHouseByIdCommand)
    {
        $list = $this->findHouseById->__invoke($listHouseByIdCommand->getId());
        if (ListException::instance()->checkForException()) {
            return ListException::instance()->firstException();
        }

        return [
            "data" => $this->dataTransform->transform($list),
            "code" => HttpResponses::OK
        ];
    }
}
