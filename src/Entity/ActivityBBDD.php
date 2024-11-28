<?php

namespace App\Entity;

use App\Repository\ActivityBBDDRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Table(name: '`activityBBDD`')]

#[ORM\Entity(repositoryClass: ActivityBBDDRepository::class)]
class ActivityBBDD
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;
    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\OneToMany(targetEntity: FinishedActivity::class, mappedBy: 'activityBBDD')]
    private Collection $finishedActivity;

    #[ORM\ManyToOne(targetEntity: Subcategory::class, inversedBy: 'activitiesBBDD')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Subcategory $subcategory = null; 

    #[ORM\ManyToMany(targetEntity: Provinces::class, inversedBy: 'activitiesBBDD')]
    #[ORM\JoinTable(name: 'activity_province')] // Tabla intermedia
    private Collection $provinces;

    public function __construct()
    {
        $this->finishedActivity = new ArrayCollection();
        $this->provinces = new ArrayCollection();
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

    public function getSubcategory(): ?Subcategory
    {
        return $this->subcategory;
    }

    public function setSubcategory(?Subcategory $subcategory): static
    {
        $this->subcategory = $subcategory;

        return $this;
    }

    /**
    * @return Collection<int, FinishedActivity>
    */
    public function getFinishedActivity(): Collection
    {
        return $this->finishedActivity;
    }

    public function addFinishedActivity(FinishedActivity $activity): static
    {
        if (!$this->finishedActivity->contains($activity)) {
            $this->finishedActivity->add($activity);
            $activity->setActivityBBDD($this);
        }

        return $this;
    }

    public function removeFinishedActivity(FinishedActivity $activity): static
    {
        if ($this->finishedActivity->removeElement($activity)) {
            if ($activity->getActivityBBDD() === $this) {
                $activity->setActivityBBDD(null);
            }
        }

        return $this;
    }

    public function getProvinces(): Collection
    {
        return $this->provinces;
    }

    public function addProvince(Provinces $province): static
    {
        if (!$this->provinces->contains($province)) {
            $this->provinces->add($province);
        }
        return $this;
    }

    public function removeProvince(Provinces $province): static
    {
        $this->provinces->removeElement($province);
        return $this;
    }
}
