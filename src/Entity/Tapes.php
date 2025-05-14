<?php

namespace App\Entity;

use App\Repository\TapesRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TapesRepository::class)]
class Tapes
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'tapes')]
    private ?Parcours $est_compose = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEstCompose(): ?Parcours
    {
        return $this->est_compose;
    }

    public function setEstCompose(?Parcours $est_compose): static
    {
        $this->est_compose = $est_compose;

        return $this;
    }
}
