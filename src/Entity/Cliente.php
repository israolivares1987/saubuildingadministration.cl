<?php

namespace App\Entity;

use App\Repository\ClienteRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ClienteRepository::class)
 */
class Cliente
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $rut;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $nombres;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $apellidos;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $domicilio;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $telefono1;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $telefono2;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $celular;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $email1;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $email2;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $representante;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $relacion;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $razonSocial;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $fechaInicio;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $rol;

    /**
     * @ORM\OneToMany(targetEntity=Propietario::class, mappedBy="cliente")
     */
    private $propietarios;

    /**
     * @ORM\OneToMany(targetEntity=Arrendatario::class, mappedBy="cliente")
     */
    private $arrendatarios;

    /**
     * @ORM\OneToMany(targetEntity=Corredora::class, mappedBy="cliente")
     */
    private $corredoras;

    public function __construct()
    {
        $this->propietarios = new ArrayCollection();
        $this->arrendatarios = new ArrayCollection();
        $this->corredoras = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRut(): ?string
    {
        return $this->rut;
    }

    public function setRut(?string $rut): self
    {
        $this->rut = $rut;

        return $this;
    }

    public function getNombres(): ?string
    {
        return $this->nombres;
    }

    public function setNombres(?string $nombres): self
    {
        $this->nombres = $nombres;

        return $this;
    }

    public function getApellidos(): ?string
    {
        return $this->apellidos;
    }

    public function setApellidos(?string $apellidos): self
    {
        $this->apellidos = $apellidos;

        return $this;
    }

    public function getDomicilio(): ?string
    {
        return $this->domicilio;
    }

    public function setDomicilio(?string $domicilio): self
    {
        $this->domicilio = $domicilio;

        return $this;
    }

    public function getTelefono1(): ?string
    {
        return $this->telefono1;
    }

    public function setTelefono1(?string $telefono1): self
    {
        $this->telefono1 = $telefono1;

        return $this;
    }

    public function getTelefono2(): ?string
    {
        return $this->telefono2;
    }

    public function setTelefono2(?string $telefono2): self
    {
        $this->telefono2 = $telefono2;

        return $this;
    }

    public function getCelular(): ?string
    {
        return $this->celular;
    }

    public function setCelular(?string $celular): self
    {
        $this->celular = $celular;

        return $this;
    }

    public function getEmail1(): ?string
    {
        return $this->email1;
    }

    public function setEmail1(?string $email1): self
    {
        $this->email1 = $email1;

        return $this;
    }

    public function getEmail2(): ?string
    {
        return $this->email2;
    }

    public function setEmail2(?string $email2): self
    {
        $this->email2 = $email2;

        return $this;
    }

    public function getRepresentante(): ?string
    {
        return $this->representante;
    }

    public function setRepresentante(?string $representante): self
    {
        $this->representante = $representante;

        return $this;
    }

    public function getRelacion(): ?string
    {
        return $this->relacion;
    }

    public function setRelacion(?string $relacion): self
    {
        $this->relacion = $relacion;

        return $this;
    }

    public function getRazonSocial(): ?string
    {
        return $this->razonSocial;
    }

    public function setRazonSocial(?string $razonSocial): self
    {
        $this->razonSocial = $razonSocial;

        return $this;
    }

    public function getFechaInicio(): ?\DateTimeInterface
    {
        return $this->fechaInicio;
    }

    public function setFechaInicio(?\DateTimeInterface $fechaInicio): self
    {
        $this->fechaInicio = $fechaInicio;

        return $this;
    }

    public function getRol(): ?string
    {
        return $this->rol;
    }

    public function setRol(?string $rol): self
    {
        $this->rol = $rol;

        return $this;
    }

    /**
     * @return Collection|Propietario[]
     */
    public function getPropietarios(): Collection
    {
        return $this->propietarios;
    }

    public function addPropietario(Propietario $propietario): self
    {
        if (!$this->propietarios->contains($propietario)) {
            $this->propietarios[] = $propietario;
            $propietario->setCliente($this);
        }

        return $this;
    }

    public function removePropietario(Propietario $propietario): self
    {
        if ($this->propietarios->removeElement($propietario)) {
            // set the owning side to null (unless already changed)
            if ($propietario->getCliente() === $this) {
                $propietario->setCliente(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Arrendatario[]
     */
    public function getArrendatarios(): Collection
    {
        return $this->arrendatarios;
    }

    public function addArrendatario(Arrendatario $arrendatario): self
    {
        if (!$this->arrendatarios->contains($arrendatario)) {
            $this->arrendatarios[] = $arrendatario;
            $arrendatario->setCliente($this);
        }

        return $this;
    }

    public function removeArrendatario(Arrendatario $arrendatario): self
    {
        if ($this->arrendatarios->removeElement($arrendatario)) {
            // set the owning side to null (unless already changed)
            if ($arrendatario->getCliente() === $this) {
                $arrendatario->setCliente(null);
            }
        }

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
            $corredora->setCliente($this);
        }

        return $this;
    }

    public function removeCorredora(Corredora $corredora): self
    {
        if ($this->corredoras->removeElement($corredora)) {
            // set the owning side to null (unless already changed)
            if ($corredora->getCliente() === $this) {
                $corredora->setCliente(null);
            }
        }

        return $this;
    }
}
