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
use App\Domain\Services\User\FindUserByDni;
use App\Domain\Services\Util\ExceptionObserver\ListException;

class ListBidsByOwner
{
    private $findUserByDni;
    private $bidRepository;
    private $dataTransform;

    /**
     * ListBidsByOwner constructor.
     * @param FindUserByDni $findUserByDni
     * @param BidRepo $bidRepository
     * @param ListBidsByOwnerTransformInterface $dataTransform
     */
    public function __construct(
        FindUserByDni $findUserByDni,
        BidRepo $bidRepository,
        ListBidsByOwnerTransformInterface $dataTransform
    ) {
        $this->findUserByDni = $findUserByDni;
        $this->bidRepository = $bidRepository;
        $this->dataTransform = $dataTransform;
        ListException::instance()->restartExceptions();
        ListException::instance()->attach($findUserByDni);
    }

    public function handle(ListBidsByOwnerCommand $listBidsByOwnerCommand)
    {
        $user =$this->findUserByDni->__invoke($listBidsByOwnerCommand->getDni());

        if (ListException::instance()->checkForException()) {
            return ListException::instance()->firstException();
        }
        $list = $this->bidRepository->findBidsByOwner($user);

        $transformed = $this->dataTransform->transform($list);

        return  [
            "data" => $transformed,
            "code" => HttpResponses::OK
        ];
    }
}
