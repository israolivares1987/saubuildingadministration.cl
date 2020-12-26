<?php

namespace App\Entity;

use App\Repository\UnidadRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=UnidadRepository::class)
 */
class Unidad
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=10, nullable=true)
     */
    private $edificio;

    /**
     * @ORM\Column(type="string", length=10, nullable=true)
     */
    private $piso;

    /**
     * @ORM\Column(type="string", length=10)
     */
    private $unidad;

    /**
     * @ORM\Column(type="boolean")
     */
    private $estado;

    /**
     * @ORM\ManyToOne(targetEntity=Empresa::class, inversedBy="unidades")
     */
    private $empresa;

    /**
     * @ORM\ManyToOne(targetEntity=TipoUnidad::class, inversedBy="unidades")
     * @ORM\JoinColumn(nullable=false)
     */
    private $tipoUnidad;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEdificio(): ?string
    {
        return $this->edificio;
    }

    public function setEdificio(?string $edificio): self
    {
        $this->edificio = $edificio;

        return $this;
    }

    public function getPiso(): ?string
    {
        return $this->piso;
    }

    public function setPiso(?string $piso): self
    {
        $this->piso = $piso;

        return $this;
    }

    public function getUnidad(): ?string
    {
        return $this->unidad;
    }

    public function setUnidad(string $unidad): self
    {
        $this->unidad = $unidad;

        return $this;
    }

    public function getEstado(): ?bool
    {
        return $this->estado;
    }

    public function setEstado(bool $estado): self
    {
        $this->estado = $estado;

        return $this;
    }

    public function getEmpresa(): ?Empresa
    {
        return $this->empresa;
    }

    public function setEmpresa(?Empresa $empresa): self
    {
        $this->empresa = $empresa;

        return $this;
    }

    public function getTipoUnidad(): ?TipoUnidad
    {
        return $this->tipoUnidad;
    }

    public function setTipoUnidad(?TipoUnidad $tipoUnidad): self
    {
        $this->tipoUnidad = $tipoUnidad;

        return $this;
    }
}
