<?php


namespace App\Listener\Doctrine;


use App\Entity\Video;
use App\Service\VideoService;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Event\PreUpdateEventArgs;

class VideoListener
{
    /**
     * @var VideoService
     */
    private $videoService;

    public function __construct(VideoService $videoService)
    {
        $this->videoService = $videoService;
    }

    public function prePersist(LifecycleEventArgs $eventArgs)
    {
        $entity = $eventArgs->getEntity();

        if (!$entity instanceof Video) {
            return;
        }

        if (!$this->videoService->parseUrl($entity)) {
            throw new \Exception('Should not be reached');
        }
    }
}