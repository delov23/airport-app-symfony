<?php

namespace AppBundle\Repository;

use AppBundle\Entity\Progress;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Mapping\ClassMetadata;

/**
 * ProgressRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ProgressRepository extends EntityRepository
{
    public function __construct(EntityManagerInterface $em)
    {
        $md = new ClassMetadata(Progress::class);
        parent::__construct($em, $md);
    }
}
