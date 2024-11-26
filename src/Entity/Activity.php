<?php

namespace App\Entity;

use App\Repository\ActivityRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\Subcategory;
use App\Entity\Category;
use App\Repository\ImagenActivityRepository;
use phpDocumentor\Reflection\Types\Nullable;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

#[ORM\Entity(repositoryClass: ActivityRepository::class)]
class Activity
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

  

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $date = null;

    #[ORM\ManyToOne(targetEntity: Category::class)]
    #[ORM\JoinColumn(name: "category_id", referencedColumnName: "id", nullable: false)]
    private ?Category $category = null;
  

    #[ORM\ManyToOne(inversedBy: 'Activity')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $user = null;

    #[ORM\ManyToOne(targetEntity: Subcategory::class)]
    #[ORM\JoinColumn(nullable: false)]
    private ?Subcategory $subcategory = null;

    #[ORM\ManyToOne(targetEntity: ActivityBBDD::class, inversedBy: 'Activity')]
    #[ORM\JoinColumn(nullable: false)]
    private ?ActivityBBDD $activityBBDD = null;

    /**
     * @var \Doctrine\Common\Collections\Collection<int, ImagenActivity>
     */
    #[ORM\OneToMany(targetEntity: ImagenActivity::class, mappedBy: 'activity', cascade: ['persist', 'remove'], orphanRemoval: true)]
    private Collection $imagenes;

    public function __construct()
    {
        $this->imagenes = new ArrayCollection();
    }

   

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
    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(?Category $category): self
    {
        $this->category = $category;

        return $this;
    }

    public function getSubcategory(): ?Subcategory
    {
        return $this->subcategory;
    }

    public function setSubcategory(?Subcategory $subcategory): self
    {
        $this->subcategory = $subcategory;

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

    public function getActivityBBDD(): ?ActivityBBDD
    {
        return $this->activityBBDD;
    }

    public function setActivityBBDD(?ActivityBBDD $activityBBDD)
    {
        $this->activityBBDD = $activityBBDD;

        return $this;
    }

    /**
     * @return \Doctrine\Common\Collections\Collection<int, ImagenActivity>
     */
    public function getImagenes(): \Doctrine\Common\Collections\Collection
    {
        return $this->imagenes;
    }
    public function setImagenes(?ImagenActivity $imagenActivity)
    {
        $this->imagenes = $imagenActivity;

        return $this;
    }

    public function addImagen(ImagenActivity $imagenActivity): static
    {
        if (!$this->imagenes->contains($imagenActivity)) {
            $this->imagenes->add($imagenActivity);
            $imagenActivity->setActivity($this);
        }

        return $this;
    }

    public function removeImagen(ImagenActivity $imagenActivity): static
    {
        if ($this->imagenes->removeElement($imagenActivity)) {
            // set the owning side to null (unless already changed)
            if ($imagenActivity->getActivity() === $this) {
                $imagenActivity->setActivity(null);
            }
        }

        return $this;
    }
    private ?string $brochureFilename = null;
    public function getBrochureFilename(): ?string
    {
        return $this->brochureFilename;
    }
    public function setBrochureFilename(string $brochureFilename): self
    {
        $this->brochureFilename = $brochureFilename;
        return $this;
    }


}
