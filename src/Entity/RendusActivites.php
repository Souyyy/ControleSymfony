<?php

namespace App\Entity;

use App\Repository\RendusActivitesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RendusActivitesRepository::class)]
class RendusActivites
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $url_du_document_plysique = null;

    #[ORM\Column]
    private ?\DateTime $dateHeure = null;

    /**
     * @var Collection<int, Messages>
     */
    #[ORM\ManyToMany(targetEntity: Messages::class, mappedBy: 'Concerne')]
    private Collection $messages;

    #[ORM\ManyToOne(inversedBy: 'rendusActivites')]
    private ?User $depose = null;

    /**
     * @var Collection<int, Etapes>
     */
    #[ORM\ManyToMany(targetEntity: Etapes::class, inversedBy: 'rendusActivites')]
    private Collection $valide;

    public function __construct()
    {
        $this->messages = new ArrayCollection();
        $this->valide = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUrlDuDocumentPlysique(): ?string
    {
        return $this->url_du_document_plysique;
    }

    public function setUrlDuDocumentPlysique(string $url_du_document_plysique): static
    {
        $this->url_du_document_plysique = $url_du_document_plysique;

        return $this;
    }

    public function getDateHeure(): ?\DateTime
    {
        return $this->dateHeure;
    }

    public function setDateHeure(\DateTime $dateHeure): static
    {
        $this->dateHeure = $dateHeure;

        return $this;
    }

    /**
     * @return Collection<int, Messages>
     */
    public function getMessages(): Collection
    {
        return $this->messages;
    }

    public function addMessage(Messages $message): static
    {
        if (!$this->messages->contains($message)) {
            $this->messages->add($message);
            $message->addConcerne($this);
        }

        return $this;
    }

    public function removeMessage(Messages $message): static
    {
        if ($this->messages->removeElement($message)) {
            $message->removeConcerne($this);
        }

        return $this;
    }

    public function getDepose(): ?User
    {
        return $this->depose;
    }

    public function setDepose(?User $depose): static
    {
        $this->depose = $depose;

        return $this;
    }

    /**
     * @return Collection<int, Etapes>
     */
    public function getValide(): Collection
    {
        return $this->valide;
    }

    public function addValide(Etapes $valide): static
    {
        if (!$this->valide->contains($valide)) {
            $this->valide->add($valide);
        }

        return $this;
    }

    public function removeValide(Etapes $valide): static
    {
        $this->valide->removeElement($valide);

        return $this;
    }
}
