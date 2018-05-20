<?php
/**
 * Created by PhpStorm.
 * User: Fran Moraton
 * Date: 17/05/2018
 * Time: 19:42
 */

namespace App\Application\Bid\ListBidsByOwner;

use App\Domain\Model\Entity\Bid\BidRepo;
use App\Domain\Model\HttpResponses\HttpResponses;
use App\Domain\Services\Bid\FindIfUserHasBids;
use App\Domain\Services\User\FindUserByDni;
use App\Domain\Services\Util\ExceptionObserver\ListException;

class ListBidsByOwner
{
    private $findUserByDni;
    private $findIfUserHasBids;
    private $dataTransform;

    /**
     * ListBidsByOwner constructor.
     * @param FindUserByDni $findUserByDni
     * @param FindIfUserHasBids $findIfUserHasBids
     * @param ListBidsByOwnerTransformInterface $dataTransform
     */
    public function __construct(
        FindUserByDni $findUserByDni,
        FindIfUserHasBids $findIfUserHasBids,
        ListBidsByOwnerTransformInterface $dataTransform
    ) {
        $this->findUserByDni = $findUserByDni;
        $this->findIfUserHasBids = $findIfUserHasBids;
        $this->dataTransform = $dataTransform;
        ListException::instance()->restartExceptions();
        ListException::instance()->attach($findUserByDni);
        ListException::instance()->attach($findIfUserHasBids);
    }

    public function handle(ListBidsByOwnerCommand $listBidsByOwnerCommand)
    {
        $user =$this->findUserByDni->__invoke($listBidsByOwnerCommand->getDni());

        if (ListException::instance()->checkForException()) {
            return ListException::instance()->firstException();
        }
        $list = $this->findIfUserHasBids->__invoke($user);

        if (ListException::instance()->checkForException()) {
            return ListException::instance()->firstException();
        }
        $transformed = $this->dataTransform->transform($list);

        return  [
            "data" => $transformed,
            "code" => HttpResponses::OK
        ];
    }
}
