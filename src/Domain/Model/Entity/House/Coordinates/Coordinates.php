<?php
/**
 * Created by PhpStorm.
 * User: Fran Moraton
 * Date: 12/05/2018
 * Time: 18:12
 */

namespace App\Domain\Model\Entity\House\Coordinates;

use App\Domain\Model\Entity\House\House;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(
 *     repositoryClass=
 *     "App\Infrastructure\Repository\House\Coordinates\CoordinatesRepository"
 * )
 * @ORM\Table(name="coordinates")
 */
class Coordinates
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="float")
     */
    private $latitude;

    /**
     * @ORM\Column(type="float")
     */
    private $longitude;

    /**
     * @ORM\OneToMany(targetEntity="App\Domain\Model\Entity\House\House", mappedBy="Coordinates")
     */
    private $houses;

    public function __construct()
    {
        $this->houses = new ArrayCollection();
    }

    public function getId()
    {
        return $this->id;
    }

    public function getLatitude(): ?float
    {
        return $this->latitude;
    }

    public function setLatitude(float $latitude): self
    {
        $this->latitude = $latitude;

        return $this;
    }

    public function getLongitude(): ?float
    {
        return $this->longitude;
    }

    public function setLongitude(float $longitude): self
    {
        $this->longitude = $longitude;

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
            $house->setCoordinates($this);
        }

        return $this;
    }

    public function removeHouse(House $house): self
    {
        if ($this->houses->contains($house)) {
            $this->houses->removeElement($house);
            // set the owning side to null (unless already changed)
            if ($house->getCoordinates() === $this) {
                $house->setCoordinates(null);
            }
        }

        return $this;
    }
}
