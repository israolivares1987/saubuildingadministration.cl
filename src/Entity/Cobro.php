<?php

namespace App\Entity;

use App\Repository\CobroRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CobroRepository::class)
 */
class Cobro
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $factor;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $mensual;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $fondoReserva;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $adicional;

    /**
     * @ORM\OneToOne(targetEntity=Unidad::class, inversedBy="cobro", cascade={"persist", "remove"})
     */
    private $unidad;

    /**
     * @ORM\OneToOne(targetEntity=Unidad::class, inversedBy="cobro", cascade={"persist", "remove"})
     */
    private $unidadHija;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFactor(): ?float
    {
        return $this->factor;
    }

    public function setFactor(?float $factor): self
    {
        $this->factor = $factor;

        return $this;
    }

    public function getMensual(): ?float
    {
        return $this->mensual;
    }

    public function setMensual(?float $mensual): self
    {
        $this->mensual = $mensual;

        return $this;
    }

    public function getFondoReserva(): ?float
    {
        return $this->fondoReserva;
    }

    public function setFondoReserva(?float $fondoReserva): self
    {
        $this->fondoReserva = $fondoReserva;

        return $this;
    }

    public function getAdicional(): ?float
    {
        return $this->adicional;
    }

    public function setAdicional(?float $adicional): self
    {
        $this->adicional = $adicional;

        return $this;
    }

    public function getUnidad(): ?Unidad
    {
        return $this->unidad;
    }

    public function setUnidad(?Unidad $unidad): self
    {
        $this->unidad = $unidad;

        return $this;
    }

    public function getUnidadHija(): ?Unidad
    {
        return $this->unidadHija;
    }

    public function setUnidadHija(?Unidad $unidadHija): self
    {
        $this->unidadHija = $unidadHija;

        return $this;
    }
}
