<?php

namespace App\Entity;

use App\Repository\SubcategoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SubcategoryRepository::class)]
class Subcategory
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name_sub = null;

    /**
     * @var Collection<int, ActivityBBDD>
     */
    #[ORM\OneToMany(targetEntity: ActivityBBDD::class, mappedBy: 'subcategory')]
    private Collection $activitiesBBDD;

    #[ORM\ManyToOne(targetEntity: Category::class, inversedBy: 'subcategories')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Category $category = null; 

    public function __construct()
    {
        $this->activitiesBBDD = new ArrayCollection(); 
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNameSub(): ?string
    {
        return $this->name_sub;
    }

    public function setNameSub(string $name_sub): static
    {
        $this->name_sub = $name_sub;
        return $this;
    }

    public function getActivityBBDD(): Collection
    {
        return $this->activitiesBBDD;
    }

    public function addActivityBBDD(ActivityBBDD $activityBBDD): static
    {
        if (!$this->activitiesBBDD->contains($activityBBDD)) {
            $this->activitiesBBDD->add($activityBBDD);
            $activityBBDD->setSubcategory($this);
        }

        return $this;
    }

    public function removeActivityBBDDD(ActivityBBDD $activityBBDD): static
    {
        if ($this->activitiesBBDD->removeElement($activityBBDD)) {
            if ($activityBBDD->getSubcategory() === $this) {
                $activityBBDD->setSubcategory(null);
            }
        }

        return $this;
    }

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(?Category $category): static
    {
        $this->category = $category;
        return $this;
    }

    public function __toString(): string
    {
        return $this->name_sub; 
    }
}