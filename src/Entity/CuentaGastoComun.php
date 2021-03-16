<?php

namespace App\Entity;

use App\Repository\CuentaGastoComunRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CuentaGastoComunRepository::class)
 */
class CuentaGastoComun
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
    private $mensualBase;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $fondoReserva;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $adicional;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $deuda;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $interes;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $anoGasto;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $mesGasto;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $montoCobro;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $fechaCobro;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $montoPago;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $fechaPago;

    /**
     * @ORM\ManyToOne(targetEntity=Unidad::class, inversedBy="cuentasGastoComun")
     */
    private $unidad;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $saldo;

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

    public function getMensualBase(): ?float
    {
        return $this->mensualBase;
    }

    public function setMensualBase(?float $mensualBase): self
    {
        $this->mensualBase = $mensualBase;

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

    public function getDeuda(): ?float
    {
        return $this->deuda;
    }

    public function setDeuda(?float $deuda): self
    {
        $this->deuda = $deuda;

        return $this;
    }

    public function getInteres(): ?float
    {
        return $this->interes;
    }

    public function setInteres(?float $interes): self
    {
        $this->interes = $interes;

        return $this;
    }

    public function getAnoGasto(): ?int
    {
        return $this->anoGasto;
    }

    public function setAnoGasto(?int $anoGasto): self
    {
        $this->anoGasto = $anoGasto;

        return $this;
    }

    public function getMesGasto(): ?int
    {
        return $this->mesGasto;
    }

    public function setMesGasto(?int $mesGasto): self
    {
        $this->mesGasto = $mesGasto;

        return $this;
    }

    public function getMontoCobro(): ?float
    {
        return $this->montoCobro;
    }

    public function setMontoCobro(?float $montoCobro): self
    {
        $this->montoCobro = $montoCobro;

        return $this;
    }

    public function getFechaCobro(): ?\DateTimeInterface
    {
        return $this->fechaCobro;
    }

    public function setFechaCobro(?\DateTimeInterface $fechaCobro): self
    {
        $this->fechaCobro = $fechaCobro;

        return $this;
    }

    public function getMontoPago(): ?float
    {
        return $this->montoPago;
    }

    public function setMontoPago(?float $montoPago): self
    {
        $this->montoPago = $montoPago;

        return $this;
    }

    public function getFechaPago(): ?\DateTimeInterface
    {
        return $this->fechaPago;
    }

    public function setFechaPago(?\DateTimeInterface $fechaPago): self
    {
        $this->fechaPago = $fechaPago;

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

    public function getSaldo(): ?float
    {
        return $this->saldo;
    }

    public function setSaldo(?float $saldo): self
    {
        $this->saldo = $saldo;

        return $this;
    }
}
