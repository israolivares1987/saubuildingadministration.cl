<?php

namespace App\Entity;

use App\Repository\DatosUnidadRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=DatosUnidadRepository::class)
 */
class DatosUnidad
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="float", nullable=true)
     * @Assert\PositiveOrZero(message = "Debe ser un valor positivo o 0.")
     */
    private $metros2;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @Assert\PositiveOrZero(message = "Debe ser un valor positivo o 0.")
     */
    private $dormitorios;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @Assert\PositiveOrZero(message = "Debe ser un valor positivo o 0.")
     */
    private $banios;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $direccion;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $detalle;

    /**
     * @ORM\OneToOne(targetEntity=Unidad::class, inversedBy="datosUnidad", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $unidad;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMetros2(): ?float
    {
        return $this->metros2;
    }

    public function setMetros2(?float $metros2): self
    {
        $this->metros2 = $metros2;

        return $this;
    }

    public function getDormitorios(): ?int
    {
        return $this->dormitorios;
    }

    public function setDormitorios(?int $dormitorios): self
    {
        $this->dormitorios = $dormitorios;

        return $this;
    }

    public function getBanios(): ?int
    {
        return $this->banios;
    }

    public function setBanios(?int $banios): self
    {
        $this->banios = $banios;

        return $this;
    }

    public function getDireccion(): ?string
    {
        return $this->direccion;
    }

    public function setDireccion(?string $direccion): self
    {
        $this->direccion = $direccion;

        return $this;
    }

    public function getDetalle(): ?string
    {
        return $this->detalle;
    }

    public function setDetalle(?string $detalle): self
    {
        $this->detalle = $detalle;

        return $this;
    }

    public function getUnidad(): ?Unidad
    {
        return $this->unidad;
    }

    public function setUnidad(Unidad $unidad): self
    {
        $this->unidad = $unidad;

        return $this;
    }
}
