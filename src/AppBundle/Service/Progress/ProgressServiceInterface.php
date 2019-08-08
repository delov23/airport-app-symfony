<?php


namespace AppBundle\Service\Progress;


use AppBundle\Entity\Progress;

interface ProgressServiceInterface
{
    public function getById($id): Progress;
}