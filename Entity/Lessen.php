<?php

namespace App\Entity;

use App\Repository\LessenRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LessenRepository::class)]
class Lessen
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $time = null;

    #[ORM\Column(length: 255)]
    private ?string $date = null;

    #[ORM\Column(length: 255)]
    private ?string $location = null;

    #[ORM\ManyToOne(inversedBy: 'lessens')]
    private ?training $training = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTime(): ?string
    {
        return $this->time;
    }

    public function setTime(string $time): static
    {
        $this->time = $time;

        return $this;
    }

    public function getDate(): ?string
    {
        return $this->date;
    }

    public function setDate(string $date): static
    {
        $this->date = $date;

        return $this;
    }

    public function getLocation(): ?string
    {
        return $this->location;
    }

    public function setLocation(string $location): static
    {
        $this->location = $location;

        return $this;
    }

    public function getTraining(): ?training
    {
        return $this->training;
    }

    public function setTraining(?training $training): static
    {
        $this->training = $training;

        return $this;
    }
}
