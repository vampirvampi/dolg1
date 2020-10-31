<?php

namespace App\Entity;

use App\Repository\PenaltyRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PenaltyRepository::class)
 */
class Penalty
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $amount;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $cause;

    /**
     * @ORM\ManyToOne(targetEntity=NumCar::class, inversedBy="penalty")
     * @ORM\JoinColumn(nullable=false)
     */
    private $numCar;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAmount(): ?int
    {
        return $this->amount;
    }

    public function setAmount(int $amount): self
    {
        $this->amount = $amount;

        return $this;
    }

    public function getCause(): ?string
    {
        return $this->cause;
    }

    public function setCause(?string $cause): self
    {
        $this->cause = $cause;

        return $this;
    }

    public function getNumCar(): ?NumCar
    {
        return $this->numCar;
    }

    public function setNumCar(?NumCar $numCar): self
    {
        $this->numCar = $numCar;

        return $this;
    }
}
