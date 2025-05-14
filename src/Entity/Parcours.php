<?php

namespace App\Entity;

use App\Repository\ParcoursRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ParcoursRepository::class)]
class Parcours
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $objet = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    /**
     * @var Collection<int, User>
     */
    #[ORM\OneToMany(targetEntity: User::class, mappedBy: 'Choisit')]
    private Collection $users;

    /**
     * @var Collection<int, Etapes>
     */
    #[ORM\OneToMany(targetEntity: Etapes::class, mappedBy: 'parcours')]
    private Collection $est_compose;

    /**
     * @var Collection<int, Tapes>
     */
    #[ORM\OneToMany(targetEntity: Tapes::class, mappedBy: 'est_compose')]
    private Collection $tapes;

    public function __construct()
    {
        $this->users = new ArrayCollection();
        $this->est_compose = new ArrayCollection();
        $this->tapes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getObjet(): ?string
    {
        return $this->objet;
    }

    public function setObjet(string $objet): static
    {
        $this->objet = $objet;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return Collection<int, User>
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

    public function addUser(User $user): static
    {
        if (!$this->users->contains($user)) {
            $this->users->add($user);
            $user->setChoisit($this);
        }

        return $this;
    }

    public function removeUser(User $user): static
    {
        if ($this->users->removeElement($user)) {
            // set the owning side to null (unless already changed)
            if ($user->getChoisit() === $this) {
                $user->setChoisit(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Etapes>
     */
    public function getEstCompose(): Collection
    {
        return $this->est_compose;
    }

    public function addEstCompose(Etapes $estCompose): static
    {
        if (!$this->est_compose->contains($estCompose)) {
            $this->est_compose->add($estCompose);
            $estCompose->setParcours($this);
        }

        return $this;
    }

    public function removeEstCompose(Etapes $estCompose): static
    {
        if ($this->est_compose->removeElement($estCompose)) {
            // set the owning side to null (unless already changed)
            if ($estCompose->getParcours() === $this) {
                $estCompose->setParcours(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Tapes>
     */
    public function getTapes(): Collection
    {
        return $this->tapes;
    }

    public function addTape(Tapes $tape): static
    {
        if (!$this->tapes->contains($tape)) {
            $this->tapes->add($tape);
            $tape->setEstCompose($this);
        }

        return $this;
    }

    public function removeTape(Tapes $tape): static
    {
        if ($this->tapes->removeElement($tape)) {
            // set the owning side to null (unless already changed)
            if ($tape->getEstCompose() === $this) {
                $tape->setEstCompose(null);
            }
        }

        return $this;
    }
}
