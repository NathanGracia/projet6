<?php


namespace App\Service;


use App\Interfaces\IUploadable;
use Symfony\Component\String\Slugger\SluggerInterface;

class UploadService
{
    /**
     * @var SluggerInterface
     */
    private $slugger;
    /**
     * @var string
     */
    private $rootDir;

    public function __construct(SluggerInterface $slugger, string $rootDir)
    {
        $this->slugger = $slugger;
        $this->rootDir = $rootDir;
    }

    public function upload(IUploadable $uploadable): string
    {
        $uploadedFile = $uploadable->getFile();
        $originalFilename = pathinfo($uploadedFile->getClientOriginalName(), PATHINFO_FILENAME);

        $safeFilename = $this->slugger->slug($originalFilename);
        $newFilename = $safeFilename . '-' . uniqid() . '.' . $uploadedFile->guessExtension();

        $uploadedFile->move(
            $this->rootDir . $uploadable->getUploadDirectory(),
            $newFilename
        );

        return $newFilename;
    }

    public function remove(IUploadable $uploadable)
    {
        unlink(
            $this->rootDir . $uploadable->getUploadDirectory() . '/' . $uploadable->getFilename()
        );
    }
}