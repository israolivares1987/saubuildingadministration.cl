<?php

namespace App\Entity;

use App\Repository\UnidadRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

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
     * @Assert\NotBlank(message = "No puede ser vacio.")
     */
    private $edificio;

    /**
     * @ORM\Column(type="string", length=10, nullable=true)
     * @Assert\NotBlank(message = "No puede ser vacio.")
     * @Assert\NotEqualTo(value = 0, message = "No puede ser {{ compared_value }}"
     * )
     */
    private $piso;

    /**
     * @ORM\Column(type="string", length=10)
     * @Assert\NotBlank(message = "No puede ser vacio.")
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

    /**
     * @ORM\OneToOne(targetEntity=DatosUnidad::class, mappedBy="unidad", cascade={"persist", "remove"})
     * @Assert\Type(type="App\Entity\DatosUnidad")
     * @Assert\Valid
     */
    private $datosUnidad;

    public function __construct()
    {
        $this->estado = true;        
    }

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

    public function getDatosUnidad(): ?DatosUnidad
    {
        return $this->datosUnidad;
    }

    public function setDatosUnidad(DatosUnidad $datosUnidad): self
    {
        // set the owning side of the relation if necessary
        if ($datosUnidad->getUnidad() !== $this) {
            $datosUnidad->setUnidad($this);
        }

        $this->datosUnidad = $datosUnidad;

        return $this;
    }
}
