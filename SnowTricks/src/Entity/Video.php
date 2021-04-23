<?php

namespace App\Entity;

use App\Repository\VideoRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=VideoRepository::class)
 */
class Video
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $plateform;

    /**
     * @ORM\Column(type="integer")
     */
    private $plateformId;

    /**
     * @ORM\ManyToOne(targetEntity=Trick::class, inversedBy="Video")
     */
    private $trick;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPlateform(): ?string
    {
        return $this->plateform;
    }

    public function setPlateform(string $plateform): self
    {
        $this->plateform = $plateform;

        return $this;
    }

    public function getPlateformId(): ?int
    {
        return $this->plateformId;
    }

    public function setPlateformId(int $plateformId): self
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
}
