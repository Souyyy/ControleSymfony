<?php

namespace App\Entity;

use App\Repository\MessagesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MessagesRepository::class)]
class Messages
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $titre = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $contenu = null;

    #[ORM\Column]
    private ?\DateTime $datetime = null;

    #[ORM\OneToOne(targetEntity: self::class, cascade: ['persist', 'remove'])]
    private ?self $repond_a = null;

    #[ORM\ManyToOne(inversedBy: 'messages')]
    private ?User $Emet = null;

    #[ORM\ManyToOne(inversedBy: 'messages')]
    private ?User $Recoit = null;

    /**
     * @var Collection<int, RendusActivites>
     */
    #[ORM\ManyToMany(targetEntity: RendusActivites::class, inversedBy: 'messages')]
    private Collection $Concerne;

    public function __construct()
    {
        $this->Concerne = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): static
    {
        $this->titre = $titre;

        return $this;
    }

    public function getContenu(): ?string
    {
        return $this->contenu;
    }

    public function setContenu(string $contenu): static
    {
        $this->contenu = $contenu;

        return $this;
    }

    public function getDatetime(): ?\DateTime
    {
        return $this->datetime;
    }

    public function setDatetime(\DateTime $datetime): static
    {
        $this->datetime = $datetime;

        return $this;
    }

    public function getRepondA(): ?self
    {
        return $this->repond_a;
    }

    public function setRepondA(?self $repond_a): static
    {
        $this->repond_a = $repond_a;

        return $this;
    }

    public function getEmet(): ?User
    {
        return $this->Emet;
    }

    public function setEmet(?User $Emet): static
    {
        $this->Emet = $Emet;

        return $this;
    }

    public function getRecoit(): ?User
    {
        return $this->Recoit;
    }

    public function setRecoit(?User $Recoit): static
    {
        $this->Recoit = $Recoit;

        return $this;
    }

    /**
     * @return Collection<int, RendusActivites>
     */
    public function getConcerne(): Collection
    {
        return $this->Concerne;
    }

    public function addConcerne(RendusActivites $concerne): static
    {
        if (!$this->Concerne->contains($concerne)) {
            $this->Concerne->add($concerne);
        }

        return $this;
    }

    public function removeConcerne(RendusActivites $concerne): static
    {
        $this->Concerne->removeElement($concerne);

        return $this;
    }
}
