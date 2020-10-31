<?php

namespace App\Entity;

use App\Repository\NumCarRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=NumCarRepository::class)
 */
class NumCar
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=6)
     */
    private $number;

    /**
     * @ORM\Column(type="smallint")
     */
    private $region;

    /**
     * @ORM\ManyToOne(targetEntity=Driver::class, inversedBy="numCars")
     */
    private $Driver;

    /**
     * @ORM\OneToOne(targetEntity=Car::class, inversedBy="numCar", cascade={"persist", "remove"})
     */
    private $Car;

    /**
     * @ORM\OneToMany(targetEntity=Penalty::class, mappedBy="numCar")
     */
    private $penalty;

    public function __construct()
    {
        $this->penalty = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumber(): ?string
    {
        return $this->number;
    }

    public function setNumber(string $number): self
    {
        $this->number = $number;

        return $this;
    }

    public function getRegion(): ?int
    {
        return $this->region;
    }

    public function setRegion(int $region): self
    {
        $this->region = $region;

        return $this;
    }

    public function getDriver(): ?Driver
    {
        return $this->Driver;
    }

    public function setDriver(?Driver $Driver): self
    {
        $this->Driver = $Driver;

        return $this;
    }

    public function getCar(): ?Car
    {
        return $this->Car;
    }

    public function setCar(?Car $Car): self
    {
        $this->Car = $Car;

        return $this;
    }

    /**
     * @return Collection|Penalty[]
     */
    public function getPenalty(): Collection
    {
        return $this->penalty;
    }

    public function addPenalty(Penalty $penalty): self
    {
        if (!$this->penalty->contains($penalty)) {
            $this->penalty[] = $penalty;
            $penalty->setNumCar($this);
        }

        return $this;
    }

    public function removePenalty(Penalty $penalty): self
    {
        if ($this->penalty->removeElement($penalty)) {
            // set the owning side to null (unless already changed)
            if ($penalty->getNumCar() === $this) {
                $penalty->setNumCar(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        // TODO: Implement __toString() method.
    return $this->getNumber();
    }
}
