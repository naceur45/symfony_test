<?php

namespace App\Entity;

use App\Repository\NACEURRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: NACEURRepository::class)]
class NACEUR
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $cin = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCin(): ?int
    {
        return $this->cin;
    }

    public function setCin(int $cin): static
    {
        $this->cin = $cin;

        return $this;
    }
}
