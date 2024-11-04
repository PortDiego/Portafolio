<?php

namespace App\Entity;

use App\Repository\CategoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CategoryRepository::class)]
class Category
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    /**
     * @var Collection<int, Subcategory>
     */
    #[ORM\OneToMany(targetEntity: Subcategory::class, mappedBy: 'category')]
    private Collection $Subcategory;

    #[ORM\Column(length: 255)]
    private ?string $nombre_cat = null;

    public function __construct()
    {
        $this->Subcategory = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection<int, Subcategory>
     */
    public function getSubcategory(): Collection
    {
        return $this->Subcategory;
    }

    public function addSubcategory(Subcategory $subcategory): static
    {
        if (!$this->Subcategory->contains($subcategory)) {
            $this->Subcategory->add($subcategory);
            $subcategory->setCategory($this);
        }

        return $this;
    }

    public function removeSubcategory(Subcategory $subcategory): static
    {
        if ($this->Subcategory->removeElement($subcategory)) {
            // set the owning side to null (unless already changed)
            if ($subcategory->getCategory() === $this) {
                $subcategory->setCategory(null);
            }
        }

        return $this;
    }

    public function getNombreCat(): ?string
    {
        return $this->nombre_cat;
    }

    public function setNombreCat(string $nombre_cat): static
    {
        $this->nombre_cat = $nombre_cat;

        return $this;
    }
}
