<?php

namespace App\Entity;

use App\Repository\ProyectosRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProyectosRepository::class)]
class Proyectos
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $nombre = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $descripcion = null;

    // #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    // private ?\DateTimeInterface $fechaInicio = null;

    // #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    // private ?\DateTimeInterface $fechaFin = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: 2)]
    private ?string $objetivoFinanciero = null;

    #[ORM\ManyToMany(targetEntity: Donaciones::class, mappedBy: 'donacionesProyectos')]
    private Collection $donaciones;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $fechaInicio = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $fechaFin = null;

    public function __construct()
    {
        $this->donaciones = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getDescripcion(): ?string
    {
        return $this->descripcion;
    }

    public function setDescripcion(string $descripcion): static
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    // public function getFechaInicio(): ?\DateTimeInterface
    // {
    //     return $this->fechaInicio;
    // }

    // public function setFechaInicio(\DateTimeInterface $fechaInicio): static
    // {
    //     $this->fechaInicio = $fechaInicio;

    //     return $this;
    // }

    // public function getFechaFin(): ?\DateTimeInterface
    // {
    //     return $this->fechaFin;
    // }

    // public function setFechaFin(\DateTimeInterface $fechaFin): static
    // {
    //     $this->fechaFin = $fechaFin;

    //     return $this;
    // }

    public function getObjetivoFinanciero(): ?string
    {
        return $this->objetivoFinanciero;
    }

    public function setObjetivoFinanciero(string $objetivoFinanciero): static
    {
        $this->objetivoFinanciero = $objetivoFinanciero;

        return $this;
    }

    /**
     * @return Collection<int, Donaciones>
     */
    public function getDonaciones(): Collection
    {
        return $this->donaciones;
    }

    public function addDonacione(Donaciones $donacione): static
    {
        if (!$this->donaciones->contains($donacione)) {
            $this->donaciones->add($donacione);
            $donacione->addDonacionesProyecto($this);
        }

        return $this;
    }

    public function removeDonacione(Donaciones $donacione): static
    {
        if ($this->donaciones->removeElement($donacione)) {
            $donacione->removeDonacionesProyecto($this);
        }

        return $this;
    }

    public function getFechaInicio(): ?\DateTimeInterface
    {
        return $this->fechaInicio;
    }

    public function setFechaInicio(\DateTimeInterface $fechaInicio): static
    {
        $this->fechaInicio = $fechaInicio;

        return $this;
    }

    public function getFechaFin(): ?\DateTimeInterface
    {
        return $this->fechaFin;
    }

    public function setFechaFin(\DateTimeInterface $fechaFin): static
    {
        $this->fechaFin = $fechaFin;

        return $this;
    }
}
