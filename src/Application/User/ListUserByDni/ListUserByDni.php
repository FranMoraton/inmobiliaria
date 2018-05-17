<?php
/**
 * Created by PhpStorm.
 * User: Fran Moraton
 * Date: 15/05/2018
 * Time: 18:31
 */

namespace App\Application\User\ListUserByDni;



use App\Domain\Model\HttpResponses\HttpResponses;
use App\Domain\Services\User\FindUserByDni;
use App\Domain\Services\Util\ExceptionObserver\ListException;

class ListUserByDni
{
    private $dataTransform;
    private $findUserByDni;



    public function __construct(
        ListUserByDniTransformInterface $dataTransform,
        FindUserByDni $findUserByDni
    ) {
        $this->dataTransform = $dataTransform;
        $this->findUserByDni = $findUserByDni;
        ListException::instance()->restartExceptions();
        ListException::instance()->attach($findUserByDni);
    }



    public function handle(ListUserByDniCommand $listUserByDniCommand)
    {
        $list = $this->findUserByDni->__invoke($listUserByDniCommand->getDni());

        if (ListException::instance()->checkForException()) {
            return ListException::instance()->firstException();
        }

        return [
            "data" => $this->dataTransform->transform($list),
            "code" => HttpResponses::OK
            ];
    }
}
