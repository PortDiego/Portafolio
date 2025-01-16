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
    private ?string $name = null;

    /**
     * @var Collection<int, Catalog>
     */
    #[ORM\OneToMany(targetEntity: Catalog::class, mappedBy: 'subcategory')]
    private Collection $activitiesBBDD;

    #[ORM\ManyToOne(targetEntity: Category::class, inversedBy: 'subcategories')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Category $category = null; // Relación con Category

    public function __construct()
    {
        $this->activitiesBBDD = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;
        return $this;
    }

    public function getCatalog(): Collection
    {
        return $this->activitiesBBDD;
    }

    public function addCatalog(Catalog $catalog): static
    {
        if (!$this->activitiesBBDD->contains($catalog)) {
            $this->activitiesBBDD->add($catalog);
            $catalog->setSubcategory($this);
        }

        return $this;
    }

    public function removeCatalogD(Catalog $catalog): static
    {
        if ($this->activitiesBBDD->removeElement($catalog)) {
            if ($catalog->getSubcategory() === $this) {
                $catalog->setSubcategory(null);
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
        return $this->name; 
    }
}
