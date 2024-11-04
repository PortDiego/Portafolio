<?php

namespace App\Entity;

use App\Repository\ActivityRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\ArrayCollection;
use App\Entity\Collection;
use App\Entity\Subcategory;
use phpDocumentor\Reflection\Types\Nullable;

#[ORM\Entity(repositoryClass: ActivityRepository::class)]
class Activity
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

  

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $fecha = null;

  

    #[ORM\ManyToOne(inversedBy: 'Activity')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $user = null;

    #[ORM\ManyToOne(targetEntity: Subcategory::class)]
    #[ORM\JoinColumn(nullable: false)]
    private ?Subcategory $subcategory = null;

    /**
     * @var \Doctrine\Common\Collections\Collection<int, ImagenActivity>
     */
    #[ORM\OneToMany(targetEntity: ImagenActivity::class, mappedBy: 'activity')]
    private \Doctrine\Common\Collections\Collection $ImagenActivity;

    #[ORM\Column(length: 255 )]
    private ?string $url = null;

    public function __construct()
    {
        $this->ImagenActivity = new \Doctrine\Common\Collections\ArrayCollection();
    }  

   

    public function getId(): ?int
    {
        return $this->id;
    }

   

    public function getFecha(): ?\DateTimeInterface
    {
        return $this->fecha;
    }

    public function setFecha(\DateTimeInterface $fecha): static
    {
        $this->fecha = $fecha;

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

    /**
     * @return \Doctrine\Common\Collections\Collection<int, ImagenActivity>
     */
    public function getImagenActivity(): \Doctrine\Common\Collections\Collection
    {
        return $this->ImagenActivity;
    }

    public function addImagenActivity(ImagenActivity $imagenActivity): static
    {
        if (!$this->ImagenActivity->contains($imagenActivity)) {
            $this->ImagenActivity->add($imagenActivity);
            $imagenActivity->setActivity($this);
        }

        return $this;
    }

    public function removeImagenActivity(ImagenActivity $imagenActivity): static
    {
        if ($this->ImagenActivity->removeElement($imagenActivity)) {
            // set the owning side to null (unless already changed)
            if ($imagenActivity->getActivity() === $this) {
                $imagenActivity->setActivity(null);
            }
        }

        return $this;
    }

    public function getUrl(): ?string
    {
        return $this->url;
    }

    public function setUrl(string $url): static
    {
        $this->url = $url;

        return $this;
    }
}
