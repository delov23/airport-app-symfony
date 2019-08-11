<?php


namespace AppBundle\Service;


use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

abstract class AbstractService
{
    const PLOVDIV_AIRPORT = 'Plovdiv Airport';

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

    protected function update(object $entity)
    {
        $this->em->merge($entity);
        $this->em->flush();
    }
}