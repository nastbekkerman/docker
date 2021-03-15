<?php

namespace App\Entity;

use App\Repository\CityRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CityRepository::class)
 */
class City
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
    private $name;

    /**
     * @ORM\OneToMany(targetEntity=Otel::class, mappedBy="city")
     */
    private $otel;



    public function __construct()
    {
        $this->otel = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection|Otel[]
     */
    public function getOtel(): Collection
    {
        return $this->otel;
    }

    public function addOtel(Otel $otel): self
    {
        if (!$this->otel->contains($otel)) {
            $this->otel[] = $otel;
            $otel->setCity($this);
        }

        return $this;
    }

    public function removeOtel(Otel $otel): self
    {
        if ($this->otel->contains($otel)) {
            $this->otel->removeElement($otel);
            // set the owning side to null (unless already changed)
            if ($otel->getCity() === $this) {
                $otel->setCity(null);
            }
        }

        return $this;
    }
    public function __toString()
    {
        return $this->name;
        // TODO: Implement __toString() method.
    }
   
}
