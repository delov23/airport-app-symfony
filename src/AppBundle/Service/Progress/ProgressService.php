<?php


namespace AppBundle\Service\Progress;


use AppBundle\Entity\Progress;
use AppBundle\Repository\ProgressRepository;
use AppBundle\Service\AbstractService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class ProgressService extends AbstractService implements ProgressServiceInterface
{
    /**
     * @var ProgressRepository
     */
    private $progressRepository;


    public function __construct(UserPasswordEncoderInterface $encoder, EntityManagerInterface $em, ProgressRepository $progressRepository)
    {
        parent::__construct($encoder, $em);
        $this->progressRepository = $progressRepository;
    }

    public function getById($id): Progress
    {
        /** @var Progress $progress */
        $progress = $this->progressRepository->find($id);
        return $progress;
    }
}