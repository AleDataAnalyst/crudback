<?php

namespace App\Entity;

use App\Repository\ContactoDonanteRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ContactoDonanteRepository::class)]
class ContactoDonante
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $direccion = null;

    #[ORM\Column(length: 5)]
    private ?string $codigoPostal = null;

    #[ORM\Column(length: 20)]
    private ?string $ciudad = null;

    #[ORM\Column(length: 50)]
    private ?string $pais = null;

    #[ORM\Column(length: 9)]
    private ?string $telefono = null;

    #[ORM\OneToOne(mappedBy: 'contactoDonante', cascade: ['persist', 'remove'])]
    private ?Donante $donante = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDireccion(): ?string
    {
        return $this->direccion;
    }

    public function setDireccion(string $direccion): static
    {
        $this->direccion = $direccion;

        return $this;
    }

    public function getCodigoPostal(): ?string
    {
        return $this->codigoPostal;
    }

    public function setCodigoPostal(string $codigoPostal): static
    {
        $this->codigoPostal = $codigoPostal;

        return $this;
    }

    public function getCiudad(): ?string
    {
        return $this->ciudad;
    }

    public function setCiudad(string $ciudad): static
    {
        $this->ciudad = $ciudad;

        return $this;
    }

    public function getPais(): ?string
    {
        return $this->pais;
    }

    public function setPais(string $pais): static
    {
        $this->pais = $pais;

        return $this;
    }

    public function getTelefono(): ?string
    {
        return $this->telefono;
    }

    public function setTelefono(string $telefono): static
    {
        $this->telefono = $telefono;

        return $this;
    }

    public function getDonante(): ?Donante
    {
        return $this->donante;
    }

    public function setDonante(Donante $donante): static
    {
        // set the owning side of the relation if necessary
        if ($donante->getContactoDonante() !== $this) {
            $donante->setContactoDonante($this);
        }

        $this->donante = $donante;

        return $this;
    }
}
