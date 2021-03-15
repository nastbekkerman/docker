<?php

namespace App\Entity;

use App\Repository\RoomRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=RoomRepository::class)
 */
class Room
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;



    /**
     * @ORM\Column(type="boolean")
     */
    private $seaview;

    /**
     * @ORM\Column(type="integer")
     */
    private $number_of_guests;



    /**
     * @ORM\Column(type="integer")
     */
    private $price;

    /**
     * @ORM\ManyToOne(targetEntity=Otel::class, inversedBy="rooms")
     */
    private $otel;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $typer;



    public function __construct()
    {
        $this->Type = new ArrayCollection();
    }




    public function getId(): ?int
    {
        return $this->id;
    }


    public function getSeaview(): ?bool
    {
        return $this->seaview;
    }

    public function setSeaview(bool $seaview): self
    {
        $this->seaview = $seaview;

        return $this;
    }

    public function getNumberOfGuests(): ?int
    {
        return $this->number_of_guests;
    }

    public function setNumberOfGuests(int $number_of_guests): self
    {
        $this->number_of_guests = $number_of_guests;

        return $this;
    }



    public function getPrice(): ?int
    {
        return $this->price;
    }

    public function setPrice(int $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getOtel(): ?Otel
    {
        return $this->otel;
    }

    public function setOtel(?Otel $otel): self
    {
        $this->otel = $otel;

        return $this;
    }

    public function getTyper(): ?string
    {
        return $this->typer;
    }

    public function setTyper(string $typer): self
    {
        $this->typer = $typer;

        return $this;
    }




}
