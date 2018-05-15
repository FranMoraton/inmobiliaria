<?php
/**
 * Created by PhpStorm.
 * User: Fran Moraton
 * Date: 12/05/2018
 * Time: 19:01
 */

namespace App\Domain\Model\Entity\House;

use App\Domain\Model\Entity\Bid\Bid;
use App\Domain\Model\Entity\House\Coordinates\Coordinates;
use App\Domain\Model\Entity\House\Photo\Photo;
use App\Domain\Model\Entity\User\User;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(
 *     repositoryClass=
 *     "App\Infrastructure\Repository\House\HouseRepository"
 * )
 * @ORM\Table(name="House")
 */
class House
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Domain\Model\Entity\House\Coordinates\Coordinates", inversedBy="houses")
     * @ORM\JoinColumn(nullable=false)
     */
    private $Coordinates;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $adress;

    /**
     * @ORM\Column(type="string", length=20)
     */
    private $city;

    /**
     * @ORM\Column(type="string", length=20)
     */
    private $country;

    /**
     * @ORM\Column(type="integer")
     */
    private $sellingPrize;

    /**
     * @ORM\Column(type="boolean")
     */
    private $houseDisabled;

    /**
     * @ORM\ManyToOne(targetEntity="App\Domain\Model\Entity\User\User", inversedBy="houses")
     * @ORM\JoinColumn(nullable=false)
     */
    private $houseOwner;

    /**
     * @ORM\OneToMany(targetEntity="App\Domain\Model\Entity\House\Photo\Photo", mappedBy="house")
     */
    private $photos;

    /**
     * @ORM\OneToMany(targetEntity="App\Domain\Model\Entity\Bid\Bid", mappedBy="house")
     */
    private $bids;

    public function __construct()
    {
        $this->photos = new ArrayCollection();
        $this->bids = new ArrayCollection();
    }

    public function getId()
    {
        return $this->id;
    }

    public function getCoordinates(): ?Coordinates
    {
        return $this->Coordinates;
    }

    public function setCoordinates(?Coordinates $Coordinates): self
    {
        $this->Coordinates = $Coordinates;

        return $this;
    }

    public function getAdress(): ?string
    {
        return $this->adress;
    }

    public function setAdress(string $adress): self
    {
        $this->adress = $adress;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(string $city): self
    {
        $this->city = $city;

        return $this;
    }

    public function getCountry(): ?string
    {
        return $this->country;
    }

    public function setCountry(string $country): self
    {
        $this->country = $country;

        return $this;
    }

    public function getSellingPrize(): ?int
    {
        return $this->sellingPrize;
    }

    public function setSellingPrize(int $sellingPrize): self
    {
        $this->sellingPrize = $sellingPrize;

        return $this;
    }

    public function getHouseDisabled(): ?bool
    {
        return $this->houseDisabled;
    }

    public function setHouseDisabled(bool $houseDisabled): self
    {
        $this->houseDisabled = $houseDisabled;

        return $this;
    }

    public function getHouseOwner(): ?User
    {
        return $this->houseOwner;
    }

    public function setHouseOwner(?User $houseOwner): self
    {
        $this->houseOwner = $houseOwner;

        return $this;
    }

    /**
     * @return Collection|Photo[]
     */
    public function getPhotos(): Collection
    {
        return $this->photos;
    }

    public function addPhoto(Photo $photo): self
    {
        if (!$this->photos->contains($photo)) {
            $this->photos[] = $photo;
            $photo->setHouse($this);
        }

        return $this;
    }

    public function removePhoto(Photo $photo): self
    {
        if ($this->photos->contains($photo)) {
            $this->photos->removeElement($photo);
            // set the owning side to null (unless already changed)
            if ($photo->getHouse() === $this) {
                $photo->setHouse(null);
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
            $bid->setHouse($this);
        }

        return $this;
    }

    public function removeBid(Bid $bid): self
    {
        if ($this->bids->contains($bid)) {
            $this->bids->removeElement($bid);
            // set the owning side to null (unless already changed)
            if ($bid->getHouse() === $this) {
                $bid->setHouse(null);
            }
        }

        return $this;
    }
}
