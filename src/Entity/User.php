<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\UniqueConstraint(name: 'UNIQ_IDENTIFIER_EMAIL', fields: ['email'])]
#[UniqueEntity(fields: ['email'], message: 'There is already an account with this email')]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 180)]
    private ?string $email = null;

    /**
     * @var list<string> The user roles
     */
    #[ORM\Column]
    private array $roles = [];

    /**
     * @var string The hashed password
     */
    #[ORM\Column]
    private ?string $password = null;

    /**
     * @var Collection<int, RendezVous>
     */
    #[ORM\OneToMany(targetEntity: RendezVous::class, mappedBy: 'propose')]
    private Collection $rendezVouses;

    #[ORM\ManyToOne(targetEntity: self::class, inversedBy: 'users')]
    private ?self $accompagne = null;

    /**
     * @var Collection<int, self>
     */
    #[ORM\OneToMany(targetEntity: self::class, mappedBy: 'accompagne')]
    private Collection $users;

    #[ORM\ManyToOne(targetEntity: Parcours::class, inversedBy: 'users')]
    private ?Parcours $Choisit = null;

    /**
     * @var Collection<int, Messages>
     */
    #[ORM\OneToMany(targetEntity: Messages::class, mappedBy: 'Emet')]
    private Collection $messages;

    /**
     * @var Collection<int, RendusActivites>
     */
    #[ORM\OneToMany(targetEntity: RendusActivites::class, mappedBy: 'depose')]
    private Collection $rendusActivites;

    public function __construct()
    {
        $this->rendezVouses = new ArrayCollection();
        $this->users = new ArrayCollection();
        $this->messages = new ArrayCollection();
        $this->rendusActivites = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_CANDIDAT'; // rôle minimal par défaut

        return array_unique($roles);
    }

    /**
     * @param list<string> $roles
     */
    public function setRoles(array $roles): static
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials(): void
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    /**
     * @return Collection<int, RendezVous>
     */
    public function getRendezVouses(): Collection
    {
        return $this->rendezVouses;
    }

    public function addRendezVouse(RendezVous $rendezVouse): static
    {
        if (!$this->rendezVouses->contains($rendezVouse)) {
            $this->rendezVouses->add($rendezVouse);
            $rendezVouse->setPropose($this);
        }

        return $this;
    }

    public function removeRendezVouse(RendezVous $rendezVouse): static
    {
        if ($this->rendezVouses->removeElement($rendezVouse)) {
            // set the owning side to null (unless already changed)
            if ($rendezVouse->getPropose() === $this) {
                $rendezVouse->setPropose(null);
            }
        }

        return $this;
    }

    public function getAccompagne(): ?self
    {
        return $this->accompagne;
    }

    public function setAccompagne(?self $accompagne): static
    {
        $this->accompagne = $accompagne;

        return $this;
    }

    /**
     * @return Collection<int, self>
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

    public function addUser(self $user): static
    {
        if (!$this->users->contains($user)) {
            $this->users->add($user);
            $user->setAccompagne($this);
        }

        return $this;
    }

    public function removeUser(self $user): static
    {
        if ($this->users->removeElement($user)) {
            // set the owning side to null (unless already changed)
            if ($user->getAccompagne() === $this) {
                $user->setAccompagne(null);
            }
        }

        return $this;
    }

    public function getChoisit(): ?Parcours
    {
        return $this->Choisit;
    }

    public function setChoisit(?Parcours $Choisit): static
    {
        $this->Choisit = $Choisit;

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
            $message->setEmet($this);
        }

        return $this;
    }

    public function removeMessage(Messages $message): static
    {
        if ($this->messages->removeElement($message)) {
            // set the owning side to null (unless already changed)
            if ($message->getEmet() === $this) {
                $message->setEmet(null);
            }
        }

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
            $rendusActivite->setDepose($this);
        }

        return $this;
    }

    public function removeRendusActivite(RendusActivites $rendusActivite): static
    {
        if ($this->rendusActivites->removeElement($rendusActivite)) {
            // set the owning side to null (unless already changed)
            if ($rendusActivite->getDepose() === $this) {
                $rendusActivite->setDepose(null);
            }
        }

        return $this;
    }
}
