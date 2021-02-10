<?php

namespace App\Entity;

use App\Repository\UnidadRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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

    /**
     * @ORM\OneToOne(targetEntity=Propietario::class, mappedBy="unidad", cascade={"persist", "remove"})
     */
    private $propietario;

    /**
     * @ORM\OneToOne(targetEntity=Arrendatario::class, mappedBy="unidad", cascade={"persist", "remove"})
     */
    private $arrendatario;

    /**
     * @ORM\OneToMany(targetEntity=Corredora::class, mappedBy="unidad")
     */
    private $corredoras;

    /**
     * @ORM\ManyToOne(targetEntity=Conjunto::class, inversedBy="unidades")
     * @Assert\Type(type="App\Entity\Conjunto")
     * @Assert\NotBlank(message = "No puede ser vacio.")
     */
    private $conjunto;

    /**
     * @ORM\OneToOne(targetEntity=Cobro::class, mappedBy="unidad", cascade={"persist", "remove"})
     */
    private $cobro;

    public function __construct()
    {
        $this->estado = true;
        $this->corredoras = new ArrayCollection();        
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getPropietario(): ?Propietario
    {
        return $this->propietario;
    }

    public function setPropietario(?Propietario $propietario): self
    {
        // unset the owning side of the relation if necessary
        if ($propietario === null && $this->propietario !== null) {
            $this->propietario->setUnidad(null);
        }

        // set the owning side of the relation if necessary
        if ($propietario !== null && $propietario->getUnidad() !== $this) {
            $propietario->setUnidad($this);
        }

        $this->propietario = $propietario;

        return $this;
    }

    public function getArrendatario(): ?Arrendatario
    {
        return $this->arrendatario;
    }

    public function setArrendatario(?Arrendatario $arrendatario): self
    {
        // unset the owning side of the relation if necessary
        if ($arrendatario === null && $this->arrendatario !== null) {
            $this->arrendatario->setUnidad(null);
        }

        // set the owning side of the relation if necessary
        if ($arrendatario !== null && $arrendatario->getUnidad() !== $this) {
            $arrendatario->setUnidad($this);
        }

        $this->arrendatario = $arrendatario;

        return $this;
    }

    /**
     * @return Collection|Corredora[]
     */
    public function getCorredoras(): Collection
    {
        return $this->corredoras;
    }

    public function addCorredora(Corredora $corredora): self
    {
        if (!$this->corredoras->contains($corredora)) {
            $this->corredoras[] = $corredora;
            $corredora->setUnidad($this);
        }

        return $this;
    }

    public function removeCorredora(Corredora $corredora): self
    {
        if ($this->corredoras->removeElement($corredora)) {
            // set the owning side to null (unless already changed)
            if ($corredora->getUnidad() === $this) {
                $corredora->setUnidad(null);
            }
        }

        return $this;
    }

    public function getConjunto(): ?Conjunto
    {
        return $this->conjunto;
    }

    public function setConjunto(?Conjunto $conjunto): self
    {
        $this->conjunto = $conjunto;

        return $this;
    }

    public function getCobro(): ?Cobro
    {
        return $this->cobro;
    }

    public function setCobro(?Cobro $cobro): self
    {
        // unset the owning side of the relation if necessary
        if ($cobro === null && $this->cobro !== null) {
            $this->cobro->setUnidad(null);
        }

        // set the owning side of the relation if necessary
        if ($cobro !== null && $cobro->getUnidad() !== $this) {
            $cobro->setUnidad($this);
        }

        $this->cobro = $cobro;

        return $this;
    }
}
