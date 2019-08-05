<?php


namespace AppBundle\Service\File;


use Aws\Result;
use Aws\S3\Exception\S3Exception;
use Aws\S3\S3Client;

class FileService implements FileServiceInterface
{
    /**
     * @var S3Client
     */
    private $s3Client;

    /**
     * @var string
     */
    private $bucketName;


    public function __construct(S3Client $s3Client)
    {
        $this->s3Client = $s3Client;
        $this->bucketName = 'airport.symfony';
    }

    /**
     * Retrieve file from the S3 cloud.
     *
     * @param string $path The S3 path to the file - ex. users/images
     * @param string $name The file name - ex. j88dd-dpp3dj9vvad.jpg
     * @return Result|null
     */
    public function getFile(string $path, string $name): ?Result
    {
        try {
            return $this->s3Client->getObject([
                'Bucket'    => $this->bucketName,
                'Key'       => "$path/$name"
            ]);
        } catch (S3Exception $exception) {
            return null;
        }
    }
}