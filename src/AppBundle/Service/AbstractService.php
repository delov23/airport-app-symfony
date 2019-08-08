<?php


namespace AppBundle\Service;


use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

abstract class AbstractService
{
    const PLOVDIV_AIRPORT = 'PDV';

    protected $em;

    protected $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder, EntityManagerInterface $em)
    {
        $this->em = $em;
        $this->encoder = $encoder;
    }

    protected function save(object $entity)
    {
        $this->em->persist($entity);
        $this->em->flush();
    }
}