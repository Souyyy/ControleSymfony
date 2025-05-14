<?php

namespace App\Entity;

use App\Repository\RendezVousRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RendezVousRepository::class)]
class RendezVous
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?\DateTime $DateHeure = null;

    #[ORM\Column]
    private ?bool $effectuer = null;

    #[ORM\Column(length: 255)]
    private ?string $modalite = null;

    #[ORM\ManyToOne(inversedBy: 'rendezVouses')]
    private ?User $propose = null;

    #[ORM\ManyToOne(inversedBy: 'rendezVouses')]
    private ?User $accepte = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateHeure(): ?\DateTime
    {
        return $this->DateHeure;
    }

    public function setDateHeure(\DateTime $DateHeure): static
    {
        $this->DateHeure = $DateHeure;

        return $this;
    }

    public function isEffectuer(): ?bool
    {
        return $this->effectuer;
    }

    public function setEffectuer(bool $effectuer): static
    {
        $this->effectuer = $effectuer;

        return $this;
    }

    public function getModalite(): ?string
    {
        return $this->modalite;
    }

    public function setModalite(string $modalite): static
    {
        $this->modalite = $modalite;

        return $this;
    }

    public function getPropose(): ?User
    {
        return $this->propose;
    }

    public function setPropose(?User $propose): static
    {
        $this->propose = $propose;

        return $this;
    }

    public function getAccepte(): ?User
    {
        return $this->accepte;
    }

    public function setAccepte(?User $accepte): static
    {
        $this->accepte = $accepte;

        return $this;
    }
}
