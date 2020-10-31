<?php

namespace App\Entity;

use App\Repository\CarRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CarRepository::class)
 */
class Car
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
    private $mark;

    /**
     * @ORM\Column(type="smallint")
     */
    private $year;

    /**
     * @ORM\OneToOne(targetEntity=NumCar::class, mappedBy="Car", cascade={"persist", "remove"})
     */
    private $numCar;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMark(): ?string
    {
        return $this->mark;
    }

    public function setMark(string $mark): self
    {
        $this->mark = $mark;

        return $this;
    }

    public function getYear(): ?int
    {
        return $this->year;
    }

    public function setYear(int $year): self
    {
        $this->year = $year;

        return $this;
    }

    public function getNumCar(): ?NumCar
    {
        return $this->numCar;
    }

    public function setNumCar(?NumCar $numCar): self
    {
        $this->numCar = $numCar;

        // set (or unset) the owning side of the relation if necessary
        $newCar = null === $numCar ? null : $this;
        if ($numCar->getCar() !== $newCar) {
            $numCar->setCar($newCar);
        }

        return $this;
    }

    public function __toString()
    {
        // TODO: Implement __toString() method.
        return $this->getMark().":".$this->getYear();
    }
}
