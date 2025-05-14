<?php

namespace App\Entity;

use App\Repository\RessourcesRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RessourcesRepository::class)]
class Ressources
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $intitule = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $presentation = null;

    #[ORM\Column(length: 255)]
    private ?string $url_du_document_physique = null;

    #[ORM\Column(type: Types::ARRAY)]
    private array $support = [];

    #[ORM\Column(type: Types::ARRAY)]
    private array $Nature = [];

    #[ORM\ManyToOne(inversedBy: 'ressources')]
    private ?Etapes $presente = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIntitule(): ?string
    {
        return $this->intitule;
    }

    public function setIntitule(string $intitule): static
    {
        $this->intitule = $intitule;

        return $this;
    }

    public function getPresentation(): ?string
    {
        return $this->presentation;
    }

    public function setPresentation(string $presentation): static
    {
        $this->presentation = $presentation;

        return $this;
    }

    public function getUrlDuDocumentPhysique(): ?string
    {
        return $this->url_du_document_physique;
    }

    public function setUrlDuDocumentPhysique(string $url_du_document_physique): static
    {
        $this->url_du_document_physique = $url_du_document_physique;

        return $this;
    }

    public function getSupport(): array
    {
        return $this->support;
    }

    public function setSupport(array $support): static
    {
        $this->support = $support;

        return $this;
    }

    public function getNature(): array
    {
        return $this->Nature;
    }

    public function setNature(array $Nature): static
    {
        $this->Nature = $Nature;

        return $this;
    }

    public function getPresente(): ?Etapes
    {
        return $this->presente;
    }

    public function setPresente(?Etapes $presente): static
    {
        $this->presente = $presente;

        return $this;
    }
}
