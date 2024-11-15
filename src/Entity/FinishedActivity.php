<?php

namespace App\Entity;

use App\Repository\FinishedActivityRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FinishedActivityRepository::class)]
class FinishedActivity
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $date = null;

    /* #[ORM\ManyToOne(targetEntity: Subcategory::class, inversedBy: 'activities')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Subcategory $subcategory = null; */

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'Activity')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $user = null;

    #[ORM\ManyToOne(targetEntity: ActivityBBDD::class, inversedBy: 'finishedActivity')]
    #[ORM\JoinColumn(nullable: false)]
    private ?ActivityBBDD $activityBBDD = null;

    /* #[ORM\ManyToOne(targetEntity: Category::class)]
    #[ORM\JoinColumn(nullable: false)]
    private ?Category $category = null;   */

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): static
    {
        $this->date = $date;

        return $this;
    }

   /*  public function getSubcategory(): ?Subcategory
    {
        return $this->subcategory;
    }

    public function setSubcategory(?Subcategory $subcategory): static
    {
        $this->subcategory = $subcategory;

        return $this;
    } */

    /* public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(?Category $category): static
    {
        $this->category = $category;

        return $this;
    } */

    public function getActivityBBDD(): ?ActivityBBDD
    {
        return $this->activityBBDD;
    }

    public function setActivityBBDD(?ActivityBBDD $activityBBDD): static
    {
        $this->activityBBDD = $activityBBDD;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): static
    {
        $this->user = $user;

        return $this;
    }
}

