<?php

namespace App\Entity;

use App\Repository\BookingRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=BookingRepository::class)
 */
class Booking
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="date")
     */
    private $date_in;

    /**
     * @ORM\Column(type="date")
     */
    private $date_out;


    /**
     * @ORM\Column(type="integer")
     */
    private $guests_num;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="bookings")
     */
    private $user;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $surname;

    /**
     * @ORM\Column(type="string")
     */
    private $phone;

    /**
     * @ORM\ManyToOne(targetEntity=Otel::class, inversedBy="bookings")
     * @ORM\JoinColumn(nullable=false)
     */
    private $otel;

    /**
     * @ORM\ManyToOne(targetEntity=Room::class, inversedBy="bookings")
     */
    private $room;

    /**
     * @ORM\Column(type="integer")
     */
    private $final_price;

    /**
     * @ORM\ManyToMany(targetEntity=User::class, inversedBy="guests_bookings")
     */
    private $guests;

    public function __construct()
    {
        $this->guests = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateIn(): ?\DateTimeInterface
    {
        return $this->date_in;
    }

    public function setDateIn(\DateTimeInterface $date_in): self
    {
        $this->date_in = $date_in;

        return $this;
    }

    public function getDateOut(): ?\DateTimeInterface
    {
        return $this->date_out;
    }

    public function setDateOut(\DateTimeInterface $date_out): self
    {
        $this->date_out = $date_out;

        return $this;
    }

    public function getGuestsNum(): ?int
    {
        return $this->guests_num;
    }

    public function setGuestsNum(int $guests_num): self
    {
        $this->guests_num = $guests_num;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
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

    public function getSurname(): ?string
    {
        return $this->surname;
    }

    public function setSurname(string $surname): self
    {
        $this->surname = $surname;

        return $this;
    }

    public function getPhone(): ?int
    {
        return $this->phone;
    }

    public function setPhone(int $phone): self
    {
        $this->phone = $phone;

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

    public function getRoom(): ?Room
    {
        return $this->room;
    }

    public function setRoom(?Room $room): self
    {
        $this->room = $room;

        return $this;
    }

    public function getFinalPrice(): ?int
    {
        return $this->final_price;
    }

    public function setFinalPrice(int $final_price): self
    {
        $this->final_price = $final_price;

        return $this;
    }

    /**
     * @return Collection|User[]
     */
    public function getGuests(): Collection
    {
        return $this->guests;
    }

    public function addGuest(User $guest): self
    {
        if (!$this->guests->contains($guest)) {
            $this->guests[] = $guest;
        }

        return $this;
    }

    public function removeGuest(User $guest): self
    {
        if ($this->guests->contains($guest)) {
            $this->guests->removeElement($guest);
        }

        return $this;
    }
}
