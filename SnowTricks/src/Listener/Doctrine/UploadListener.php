<?php


namespace App\Listener\Doctrine;


use App\Interfaces\IUploadable;
use App\Service\UploadService;
use Doctrine\ORM\Event\LifecycleEventArgs;

class UploadListener
{
    /**
     * @var UploadService
     */
    private $uploadService;

    public function __construct(UploadService $uploadService)
    {
        $this->uploadService = $uploadService;
    }

    public function prePersist(LifecycleEventArgs $eventArgs)
    {
        $entity = $eventArgs->getEntity();

        if (!$entity instanceof IUploadable) {
            return;
        }

        $entity->setFilename(
            $this->uploadService->upload(
                $entity
            )
        );
    }

    public function postRemove(LifecycleEventArgs $eventArgs)
    {
        $entity = $eventArgs->getEntity();

        if (!$entity instanceof IUploadable) {
            return;
        }

        @$this->uploadService->remove($entity);
    }
}