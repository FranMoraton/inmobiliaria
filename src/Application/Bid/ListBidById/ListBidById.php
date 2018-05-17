<?php
/**
 * Created by PhpStorm.
 * User: Fran Moraton
 * Date: 17/05/2018
 * Time: 22:10
 */

namespace App\Application\Bid\ListBidById;

use App\Domain\Model\HttpResponses\HttpResponses;
use App\Domain\Services\Bid\FindBidById;
use App\Domain\Services\Util\ExceptionObserver\ListException;

class ListBidById
{
    private $findBidById;
    private $dataTransform;

    /**
     * ListBidById constructor.
     * @param $findBidById
     * @param $dataTransform
     */
    public function __construct(
        FindBidById $findBidById,
        ListBidByIdTransformInterface $dataTransform
    ) {
        $this->findBidById = $findBidById;
        $this->dataTransform = $dataTransform;
        ListException::instance()->restartExceptions();
        ListException::instance()->attach($findBidById);
    }

    public function handle(ListBidByIdCommand $listBidByIdCommand)
    {
        $bid = $this->findBidById->__invoke($listBidByIdCommand->getId());

        if (ListException::instance()->checkForException()) {
            return ListException::instance()->firstException();
        }

        return [
            "data" => $this->dataTransform->transform($bid),
            "code" => HttpResponses::OK
        ];
    }
}
