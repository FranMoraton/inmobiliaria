<?php
/**
 * Created by PhpStorm.
 * User: Fran Moraton
 * Date: 13/05/2018
 * Time: 0:03
 */

namespace App\Domain\Model\Entity\Bid;

use App\Domain\Model\Entity\House\House;
use App\Domain\Model\Entity\User\User;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(
 *     repositoryClass=
 *     "App\Infrastructure\Repository\Bid\BidRepository"
 * )
 * @ORM\Table(name="Bid")
 */
class Bid
{
    private function __construct()
    {
    }

    public static function createdByApi(House $house, User $user, int $money): self
    {
        $bid = new self;
        $bid->setHouse($house);
        $bid->setUserBidding($user);
        $bid->setMoneyBidded($money);
        $bid->setRejected(false);
        $bid->setAccepted(false);
        $bid->setBiddingDate(new \DateTime( date_create('now')->format('Y-m-d') ));

        return $bid;
    }
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Domain\Model\Entity\User\User", inversedBy="bids")
     * @ORM\JoinColumn(nullable=false)
     */
    private $userBidding;

    /**
     * @ORM\ManyToOne(targetEntity="App\Domain\Model\Entity\House\House", inversedBy="bids")
     * @ORM\JoinColumn(nullable=false)
     */
    private $house;

    /**
     * @ORM\Column(type="integer")
     */
    private $moneyBidded;

    /**
     * @ORM\Column(type="boolean", options={"default"=false})
     */
    private $rejected;

    /**
     * @ORM\Column(type="boolean", options={"default"=false})
     */
    private $accepted;

    /**
     * @ORM\Column(type="date")
     */
    private $biddingDate;


    public function getId()
    {
        return $this->id;
    }

    public function getUserBidding(): ?User
    {
        return $this->userBidding;
    }

    public function setUserBidding(?User $userBidding): self
    {
        $this->userBidding = $userBidding;

        return $this;
    }

    public function getHouse(): ?House
    {
        return $this->house;
    }

    public function setHouse(?House $house): self
    {
        $this->house = $house;

        return $this;
    }

    public function getMoneyBidded(): ?int
    {
        return $this->moneyBidded;
    }

    public function setMoneyBidded(int $moneyBidded): self
    {
        $this->moneyBidded = $moneyBidded;

        return $this;
    }

    public function getRejected(): ?bool
    {
        return $this->rejected;
    }

    public function setRejected(bool $rejected): self
    {
        $this->rejected = $rejected;

        return $this;
    }

    public function getAccepted(): ?bool
    {
        return $this->accepted;
    }

    public function setAccepted(bool $accepted): self
    {
        $this->accepted = $accepted;

        return $this;
    }

    public function getBiddingDate(): ?\DateTimeInterface
    {
        return $this->biddingDate;
    }

    public function setBiddingDate(\DateTimeInterface $biddingDate): self
    {
        $this->biddingDate = $biddingDate;

        return $this;
    }
}
