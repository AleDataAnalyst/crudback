<?php

namespace App\Entity;

use App\Repository\DonacionesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DonacionesRepository::class)]
class Donaciones
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: 2)]
    private ?string $cantidad = null;

    // #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    // private ?\DateTimeInterface $fecha = null;

    #[Column(type: 'string', length: 255)]
    #[Choice(choices: Donaciones::METODOS_PAGO)]
    private $metodoPago;

    const METODOS_PAGO = [
        'transfer',
        'card',
        'bizum',
        'efectivo',
        'other',
    ];

    #[ORM\Column(length: 10)]
    private ?string $moneda = null;

    #[ORM\Column]
    private ?bool $esAnonima = null;

    #[ORM\ManyToOne(inversedBy: 'donacion')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Donante $donante = null;

    #[ORM\ManyToMany(targetEntity: Proyectos::class, inversedBy: 'donaciones')]
    private Collection $donacionesProyectos;

    public function __construct()
    {
        $this->donacionesProyectos = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCantidad(): ?string
    {
        return $this->cantidad;
    }

    public function setCantidad(string $cantidad): static
    {
        $this->cantidad = $cantidad;

        return $this;
    }

    // public function getFecha(): ?\DateTimeInterface
    // {
    //     return $this->fecha;
    // }

    // public function setFecha(\DateTimeInterface $fecha): static
    // {
    //     $this->fecha = $fecha;

    //     return $this;
    // }

    public function getMetodoPago(): ?string
    {
        return $this->metodoPago;
    }

    public function setMetodoPago(string $metodoPago): static
    {
        $this->metodoPago = $metodoPago;

        return $this;
    }

    public function getMoneda(): ?string
    {
        return $this->moneda;
    }

    public function setMoneda(string $moneda): static
    {
        $this->moneda = $moneda;

        return $this;
    }

    public function isEsAnonima(): ?bool
    {
        return $this->esAnonima;
    }

    public function setEsAnonima(bool $esAnonima): static
    {
        $this->esAnonima = $esAnonima;

        return $this;
    }

    public function getDonante(): ?Donante
    {
        return $this->donante;
    }

    public function setDonante(?Donante $donante): static
    {
        $this->donante = $donante;

        return $this;
    }

    /**
     * @return Collection<int, Proyectos>
     */
    public function getDonacionesProyectos(): Collection
    {
        return $this->donacionesProyectos;
    }

    public function addDonacionesProyecto(Proyectos $donacionesProyecto): static
    {
        if (!$this->donacionesProyectos->contains($donacionesProyecto)) {
            $this->donacionesProyectos->add($donacionesProyecto);
        }

        return $this;
    }

    public function removeDonacionesProyecto(Proyectos $donacionesProyecto): static
    {
        $this->donacionesProyectos->removeElement($donacionesProyecto);

        return $this;
    }
}
