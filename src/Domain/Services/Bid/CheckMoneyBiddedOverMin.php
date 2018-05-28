<?php
/**
 * Created by PhpStorm.
 * User: Fran Moraton
 * Date: 18/05/2018
 * Time: 9:52
 */

namespace App\Domain\Services\Bid;

use App\Domain\Model\Entity\Bid\BidUnderTheMin;
use App\Domain\Services\Util\ExceptionObserver\ListException;
use App\Domain\Services\Util\ExceptionObserver\Observer;

class CheckMoneyBiddedOverMin implements Observer
{

    private $stateException;
    public function __construct()
    {
        $this->stateException = false;
    }

    public function __invoke($money, $housePrize)
    {
        if ($money < $housePrize) {
            $this->stateException = true;
            ListException::instance()->notify();
        }
    }

    /**
     * @throws BidUnderTheMin
     */
    public function update()
    {
        if ($this->stateException) {
            throw new BidUnderTheMin();
        }
    }
}
