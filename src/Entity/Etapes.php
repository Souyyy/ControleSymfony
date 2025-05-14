<?php

namespace App\Entity;

use App\Repository\EtapesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EtapesRepository::class)]
class Etapes
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $descriptif = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $consignes = null;

    #[ORM\Column(length: 255)]
    private ?string $position_dans_le_parcours = null;

    /**
     * @var Collection<int, RendusActivites>
     */
    #[ORM\ManyToMany(targetEntity: RendusActivites::class, mappedBy: 'valide')]
    private Collection $rendusActivites;

    /**
     * @var Collection<int, Ressources>
     */
    #[ORM\OneToMany(targetEntity: Ressources::class, mappedBy: 'presente')]
    private Collection $ressources;

    #[ORM\ManyToOne(inversedBy: 'est_compose')]
    private ?Parcours $parcours = null;

    public function __construct()
    {
        $this->rendusActivites = new ArrayCollection();
        $this->ressources = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDescriptif(): ?string
    {
        return $this->descriptif;
    }

    public function setDescriptif(string $descriptif): static
    {
        $this->descriptif = $descriptif;

        return $this;
    }

    public function getConsignes(): ?string
    {
        return $this->consignes;
    }

    public function setConsignes(string $consignes): static
    {
        $this->consignes = $consignes;

        return $this;
    }

    public function getPositionDansLeParcours(): ?string
    {
        return $this->position_dans_le_parcours;
    }

    public function setPositionDansLeParcours(string $position_dans_le_parcours): static
    {
        $this->position_dans_le_parcours = $position_dans_le_parcours;

        return $this;
    }

    /**
     * @return Collection<int, RendusActivites>
     */
    public function getRendusActivites(): Collection
    {
        return $this->rendusActivites;
    }

    public function addRendusActivite(RendusActivites $rendusActivite): static
    {
        if (!$this->rendusActivites->contains($rendusActivite)) {
            $this->rendusActivites->add($rendusActivite);
            $rendusActivite->addValide($this);
        }

        return $this;
    }

    public function removeRendusActivite(RendusActivites $rendusActivite): static
    {
        if ($this->rendusActivites->removeElement($rendusActivite)) {
            $rendusActivite->removeValide($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, Ressources>
     */
    public function getRessources(): Collection
    {
        return $this->ressources;
    }

    public function addRessource(Ressources $ressource): static
    {
        if (!$this->ressources->contains($ressource)) {
            $this->ressources->add($ressource);
            $ressource->setPresente($this);
        }

        return $this;
    }

    public function removeRessource(Ressources $ressource): static
    {
        if ($this->ressources->removeElement($ressource)) {
            // set the owning side to null (unless already changed)
            if ($ressource->getPresente() === $this) {
                $ressource->setPresente(null);
            }
        }

        return $this;
    }

    public function getParcours(): ?Parcours
    {
        return $this->parcours;
    }

    public function setParcours(?Parcours $parcours): static
    {
        $this->parcours = $parcours;

        return $this;
    }
}
