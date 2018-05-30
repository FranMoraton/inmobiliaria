<?php
/**
 * Created by PhpStorm.
 * User: Fran Moraton
 * Date: 12/05/2018
 * Time: 18:44
 */

namespace App\Infrastructure\Repository\House\Photo;

use App\Domain\Model\Entity\House\Photo\Photo;
use App\Domain\Model\Entity\House\Photo\PhotoRepo;
use Doctrine\ORM\EntityRepository;

class PhotoRepository extends EntityRepository implements PhotoRepo
{
    /**
     * @param Photo $photo
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function persistAndFlush(Photo $photo): void
    {
        $this->getEntityManager()->persist($photo);
        $this->getEntityManager()->flush();
    }

    public function findAllPhotos()
    {
        return $this->findAll();
    }
}
