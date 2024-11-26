<?php

namespace App\Entity;

use App\Repository\PhotoRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PhotoRepository::class)]
class Photo
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;
    #[ORM\Column(length: 255)]
    private ?string $name_photo = null;

    #[ORM\ManyToOne(targetEntity: FinishedActivity::class, inversedBy: 'photos')]
    #[ORM\JoinColumn(nullable: false)]
    private ?FinishedActivity $finishedActivity = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNamePhoto(): ?string
    {
        return $this->name_photo;
    }

    public function setNamePhoto(string $name_photo): static
    {
        $this->name_photo = $name_photo;

        return $this;
    }

    /* Relacion con FinishedActivity */
    public function getFinishedActivity(): ?FinishedActivity
    {
        return $this->finishedActivity;
    }

    public function setFinishedActivity(?FinishedActivity $finishedActivity): static
    {
        $this->finishedActivity = $finishedActivity;

        return $this;
    }
}
