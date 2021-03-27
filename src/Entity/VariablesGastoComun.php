<?php

namespace App\Entity;

use App\Repository\VariablesGastoComunRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=VariablesGastoComunRepository::class)
 */
class VariablesGastoComun
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
    private $adicional;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $deudaHistorica;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $fechaDeudaHistorica;

    /**
     * @ORM\OneToOne(targetEntity=Unidad::class, inversedBy="variablesGastoComun", cascade={"persist", "remove"})
     */
    private $unidad;

    /**
     * @ORM\OneToOne(targetEntity=Unidad::class, inversedBy="unidadHijaVariablesGastoComun", cascade={"persist", "remove"})
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

    public function getAdicional(): ?float
    {
        return $this->adicional;
    }

    public function setAdicional(?float $adicional): self
    {
        $this->adicional = $adicional;

        return $this;
    }

    public function getDeudaHistorica(): ?float
    {
        return $this->deudaHistorica;
    }

    public function setDeudaHistorica(?float $deudaHistorica): self
    {
        $this->deudaHistorica = $deudaHistorica;

        return $this;
    }

    public function getFechaDeudaHistorica(): ?\DateTimeInterface
    {
        return $this->fechaDeudaHistorica;
    }

    public function setFechaDeudaHistorica(?\DateTimeInterface $fechaDeudaHistorica): self
    {
        $this->fechaDeudaHistorica = $fechaDeudaHistorica;

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
