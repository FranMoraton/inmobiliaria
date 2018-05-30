<?php
/**
 * Created by PhpStorm.
 * User: Fran Moraton
 * Date: 12/05/2018
 * Time: 18:55
 */

namespace App\Domain\Model\Entity\House\Photo;

use App\Domain\Model\Entity\House\House;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(
 *     repositoryClass=
 *     "App\Infrastructure\Repository\House\Photo\PhotoRepository"
 * )
 * @ORM\Table(name="photo")
 */
class Photo
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $urlPhoto;

    /**
     * @ORM\ManyToOne(targetEntity="App\Domain\Model\Entity\House\House", inversedBy="photos")
     * @ORM\JoinColumn(nullable=false)
     */
    private $house;

    public function __construct($urlPhoto, $house)
    {
        $this->house = $house;
        $this->urlPhoto = $urlPhoto;
    }
    public static function createFromApi($urlPhoto, $house): self
    {
        return new self($urlPhoto, $house);
    }

    public function getId()
    {
        return $this->id;
    }

    public function getUrlPhoto(): ?string
    {
        return $this->urlPhoto;
    }

    public function setUrlPhoto(string $urlPhoto): self
    {
        $this->urlPhoto = $urlPhoto;

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
}
