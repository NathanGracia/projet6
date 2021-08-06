<?php

namespace App\Entity;

use App\Repository\VideoRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=VideoRepository::class)
 */
class Video
{
    const YOUTUBE = 1;
    const YOUTUBE_REGEX = '/(?:https?:\/\/)?(?:www.)?youtu.?be(?:.com)?\/(?:watch?.v=)?([\w-]*)/';

    const DAILYMOTION = 2;
    const DAILYMOTION_REGEX = '/(?:https?:\/\/)?(?:www.)?dai.?ly(?:motion)?(?:.com)?\/(?:video)?\/?([\w]*)\??/';

    const VIMEO = 3;
    const VIMEO_REGEX = '/(?:https?:\/\/)?(?:www.)?vimeo(?:.com)?\/?([\a-z]*)/';
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $plateform;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $plateformId;

    /**
     * @ORM\ManyToOne(targetEntity=Trick::class, inversedBy="Video", cascade={"persist"})
     */
    private $trick;

    /**
     * @Assert\Regex(pattern=Video::YOUTUBE_REGEX)
     * @Assert\Regex(pattern=Video::DAILYMOTION_REGEX)
     * @Assert\Regex(pattern=Video::VIMEO_REGEX)
     */
    private $url;



    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPlatform(): ?string
    {
        return $this->plateform;
    }

    public function setPlatform(string $plateform): self
    {
        $this->plateform = $plateform;

        return $this;
    }

    public function getPlatformId(): ?string
    {
        return $this->plateformId;
    }

    public function setPlatformId(string $plateformId): self
    {
        $this->plateformId = $plateformId;

        return $this;
    }

    public function getTrick(): ?Trick
    {
        return $this->trick;
    }

    public function setTrick(?Trick $trick): self
    {
        $this->trick = $trick;

        return $this;
    }

    public function getUrl(): ?string
    {
        return $this->url;
    }

    public function setUrl(?string $url): self
    {
        $this->url = $url;

        return $this;
    }
}
