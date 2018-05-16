<?php
/**
 * Created by PhpStorm.
 * User: Fran Moraton
 * Date: 12/05/2018
 * Time: 23:09
 */

namespace App\Domain\Model\Entity\User;

use App\Domain\Model\Entity\Bid\Bid;
use App\Domain\Model\Entity\House\House;
use App\Domain\Model\Entity\User\Role\Role;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(
 *     repositoryClass=
            "App\Infrastructure\Repository\User\UserRepository"
 * )
 * @ORM\Table(name="User")
 */
class User
{
    public function __construct()
    {
        $this->houses = new ArrayCollection();
        $this->bids = new ArrayCollection();
    }

    public static function fromRegisterForm($DNI, $password, $birthDate, $Role): self
    {
        $user = new User;
        $user->DNI = $DNI;
        $user->password = $password;
        $user->userDisabled = 0;
        $user->registerDate = new \DateTime( date_create('now')->format('Y-m-d') );
        $user->birthDate = $birthDate;
        $user->Role = $Role;

        return $user;
    }
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=10)
     */
    private $DNI;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $photo;

    /**
     * @ORM\Column(type="string")
     */
    private $password;

    /**
     * @ORM\Column(type="boolean", options={"default"= 0})
     */
    private $userDisabled;


    /**
     * @return mixed
     */
    public function getUserDisabled()
    {
        return $this->userDisabled;
    }

    /**
     * @param mixed $userDisabled
     */
    public function setUserDisabled($userDisabled): void
    {
        $this->userDisabled = $userDisabled;
    }

    /**
     * @ORM\Column(type="date")
     */
    private $registerDate;

    /**
     * @ORM\Column(type="date")
     */
    private $birthDate;

    /**
     * @ORM\ManyToOne(targetEntity="App\Domain\Model\Entity\User\Role\Role", inversedBy="users")
     * @ORM\JoinColumn(nullable=false)
     */
    private $Role;

    /**
     * @ORM\OneToMany(targetEntity="App\Domain\Model\Entity\House\House", mappedBy="houseOwner")
     */
    private $houses;

    /**
     * @ORM\OneToMany(targetEntity="App\Domain\Model\Entity\Bid\Bid", mappedBy="userBidding")
     */
    private $bids;


    public function getId()
    {
        return $this->id;
    }

    public function getDNI(): ?string
    {
        return $this->DNI;
    }

    public function setDNI(string $DNI): self
    {
        $this->DNI = $DNI;

        return $this;
    }

    public function getPhoto(): ?string
    {
        return $this->photo;
    }

    public function setPhoto(?string $photo): self
    {
        $this->photo = $photo;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getRegisterDate(): ?\DateTimeInterface
    {
        return $this->registerDate;
    }

    public function setRegisterDate(\DateTimeInterface $registerDate): self
    {
        $this->registerDate = $registerDate;

        return $this;
    }

    public function getBirthDate(): ?\DateTimeInterface
    {
        return $this->birthDate;
    }

    public function setBirthDate(\DateTimeInterface $birthDate): self
    {
        $this->birthDate = $birthDate;

        return $this;
    }

    public function getRole(): ?Role
    {
        return $this->Role;
    }

    public function setRole(?Role $Role): self
    {
        $this->Role = $Role;

        return $this;
    }

    /**
     * @return Collection|House[]
     */
    public function getHouses(): Collection
    {
        return $this->houses;
    }

    public function addHouse(House $house): self
    {
        if (!$this->houses->contains($house)) {
            $this->houses[] = $house;
            $house->setHouseOwner($this);
        }

        return $this;
    }

    public function removeHouse(House $house): self
    {
        if ($this->houses->contains($house)) {
            $this->houses->removeElement($house);
            // set the owning side to null (unless already changed)
            if ($house->getHouseOwner() === $this) {
                $house->setHouseOwner(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Bid[]
     */
    public function getBids(): Collection
    {
        return $this->bids;
    }

    public function addBid(Bid $bid): self
    {
        if (!$this->bids->contains($bid)) {
            $this->bids[] = $bid;
            $bid->setUserBidding($this);
        }

        return $this;
    }

    public function removeBid(Bid $bid): self
    {
        if ($this->bids->contains($bid)) {
            $this->bids->removeElement($bid);
            // set the owning side to null (unless already changed)
            if ($bid->getUserBidding() === $this) {
                $bid->setUserBidding(null);
            }
        }

        return $this;
    }
}
