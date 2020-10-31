<?php

namespace App\Entity;

use App\Repository\DriverRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=DriverRepository::class)
 */
class Driver
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
     * @ORM\Column(type="integer")
     */
    private $numVU;

    /**
     * @ORM\OneToMany(targetEntity=NumCar::class, mappedBy="Driver")
     */
    private $numCars;

    public function __construct()
    {
        $this->numCars = new ArrayCollection();
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

    public function getNumVU(): ?int
    {
        return $this->numVU;
    }

    public function setNumVU(int $numVU): self
    {
        $this->numVU = $numVU;

        return $this;
    }

    /**
     * @return Collection|NumCar[]
     */
    public function getNumCars(): Collection
    {
        return $this->numCars;
    }

    public function addNumCar(NumCar $numCar): self
    {
        if (!$this->numCars->contains($numCar)) {
            $this->numCars[] = $numCar;
            $numCar->setDriver($this);
        }

        return $this;
    }

    public function removeNumCar(NumCar $numCar): self
    {
        if ($this->numCars->removeElement($numCar)) {
            // set the owning side to null (unless already changed)
            if ($numCar->getDriver() === $this) {
                $numCar->setDriver(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        // TODO: Implement __toString() method.
        /*foreach ($this->getNumCars() as $numCar){
            $CARS=$numCar." ;\n";
        }*/
        return $this->getName()." NumVU - ".$this->getNumVU();//." CARS -".$CARS;
        //return "work";
    }
}
