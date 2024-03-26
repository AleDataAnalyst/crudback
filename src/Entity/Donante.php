<?php

namespace App\Entity;

use App\Repository\DonanteRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: DonanteRepository::class)]
#[UniqueEntity(fields: ['email'], message: 'There is already an account with this email')]
class Donante implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 180, unique: true)]
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

    #[ORM\Column(length: 20)]
    private ?string $nombre = null;

    #[ORM\Column(length: 60)]
    private ?string $apellido = null;

    // #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    // private ?\DateTimeInterface $fechaRegistro = null;

    #[ORM\OneToOne(inversedBy: 'donante', cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?ContactoDonante $contactoDonante = null;

    #[ORM\OneToMany(targetEntity: Donaciones::class, mappedBy: 'donante')]
    private Collection $donacion;

    public function __construct()
    {
        $this->donacion = new ArrayCollection();
    }

    // getters y setters

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
     *
     * @return list<string>
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

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
    public function getPassword(): string
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

    public function getNombre(): ?string
    {
        return $this->nombre;
    }

    public function setNombre(string $nombre): static
    {
        $this->nombre = $nombre;

        return $this;
    }

    public function getApellido(): ?string
    {
        return $this->apellido;
    }

    public function setApellido(string $apellido): static
    {
        $this->apellido = $apellido;

        return $this;
    }

    // public function getFechaRegistro(): ?\DateTimeInterface
    // {
    //     return $this->fechaRegistro;
    // }

    // public function setFechaRegistro(\DateTimeInterface $fechaRegistro): static
    // {
    //     $this->fechaRegistro = $fechaRegistro;

    //     return $this;
    // }

    public function getContactoDonante(): ?ContactoDonante
    {
        return $this->contacto;
    }

    public function setContactoDonante(ContactoDonante $contactoDonante): static
    {
        $this->contactoDonante = $contactoDonante;

        return $this;
    }

    /**
     * @return Collection<int, Donaciones>
     */
    public function getDonacion(): Collection
    {
        return $this->donacion;
    }

    public function addDonacion(Donaciones $donacion): static
    {
        if (!$this->donacion->contains($donacion)) {
            $this->donacion->add($donacion);
            $donacion->setDonante($this);
        }

        return $this;
    }

    public function removeDonacion(Donaciones $donacion): static
    {
        if ($this->donacion->removeElement($donacion) && $donacion->getDonante() === $this) {
            $donacion->setDonante(null);
        }

        return $this;
    }
}
