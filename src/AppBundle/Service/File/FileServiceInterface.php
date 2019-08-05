<?php


namespace AppBundle\Service\File;


use Aws\Result;

interface FileServiceInterface
{
    public function getFile(string $path, string $name): ?Result;
}