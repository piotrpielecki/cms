<?php

namespace App\Entity;

use App\Repository\EngineRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=EngineRepository::class)
 */
class Engine
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
    private $capacity;

    /**
     * @ORM\Column(type="integer")
     */
    private $horsepower;

    /**
     * @ORM\Column(type="integer")
     */
    private $torque;

    /**
     * @ORM\OneToMany(targetEntity=Car::class, mappedBy="engine")
     */
    private $cars;

    /**
     * @ORM\Column(type="integer")
     */
    private $rpm;

    public function __construct()
    {
        $this->cars = new ArrayCollection();
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

    public function getCapacity(): ?int
    {
        return $this->capacity;
    }

    public function setCapacity(int $capacity): self
    {
        $this->capacity = $capacity;

        return $this;
    }

    public function getHorsepower(): ?int
    {
        return $this->horsepower;
    }

    public function setHorsepower(int $horsepower): self
    {
        $this->horsepower = $horsepower;

        return $this;
    }

    public function getTorque(): ?int
    {
        return $this->torque;
    }

    public function setTorque(int $torque): self
    {
        $this->torque = $torque;

        return $this;
    }

    /**
     * @return Collection|Car[]
     */
    public function getCars(): Collection
    {
        return $this->cars;
    }

    public function addCar(Car $car): self
    {
        if (!$this->cars->contains($car)) {
            $this->cars[] = $car;
            $car->setEngine($this);
        }

        return $this;
    }

    public function removeCar(Car $car): self
    {
        if ($this->cars->removeElement($car)) {
            // set the owning side to null (unless already changed)
            if ($car->getEngine() === $this) {
                $car->setEngine(null);
            }
        }

        return $this;
    }

    public function getRpm(): ?int
    {
        return $this->rpm;
    }

    public function setRpm(int $rpm): self
    {
        $this->rpm = $rpm;

        return $this;
    }
}
