<?php

namespace App\Entity;

use App\Repository\EmpresaRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=EmpresaRepository::class)
 */
class Empresa
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nombre;

    /**
     * @ORM\Column(type="boolean")
     */
    private $estado;

    /**
     * @ORM\OneToMany(targetEntity=UsuarioRol::class, mappedBy="empresa")
     */
    private $usuarioRols;

    /**
     * @ORM\OneToMany(targetEntity=Unidad::class, mappedBy="empresa")
     */
    private $unidades;

    /**
     * @ORM\Column(type="integer")
     */
    private $codigo;

    public function __construct()
    {
        $this->usuarioRols = new ArrayCollection();
        $this->unidades = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNombre(): ?string
    {
        return $this->nombre;
    }

    public function setNombre(string $nombre): self
    {
        $this->nombre = $nombre;

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

    /**
     * @return Collection|UsuarioRol[]
     */
    public function getUsuarioRols(): Collection
    {
        return $this->usuarioRols;
    }

    public function addUsuarioRol(UsuarioRol $usuarioRol): self
    {
        if (!$this->usuarioRols->contains($usuarioRol)) {
            $this->usuarioRols[] = $usuarioRol;
            $usuarioRol->setEmpresa($this);
        }

        return $this;
    }

    public function removeUsuarioRol(UsuarioRol $usuarioRol): self
    {
        if ($this->usuarioRols->removeElement($usuarioRol)) {
            // set the owning side to null (unless already changed)
            if ($usuarioRol->getEmpresa() === $this) {
                $usuarioRol->setEmpresa(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Unidad[]
     */
    public function getUnidades(): Collection
    {
        return $this->unidades;
    }

    public function addUnidade(Unidad $unidade): self
    {
        if (!$this->unidades->contains($unidade)) {
            $this->unidades[] = $unidade;
            $unidade->setEmpresa($this);
        }

        return $this;
    }

    public function removeUnidade(Unidad $unidade): self
    {
        if ($this->unidades->removeElement($unidade)) {
            // set the owning side to null (unless already changed)
            if ($unidade->getEmpresa() === $this) {
                $unidade->setEmpresa(null);
            }
        }

        return $this;
    }

    public function getCodigo(): ?int
    {
        return $this->codigo;
    }

    public function setCodigo(int $codigo): self
    {
        $this->codigo = $codigo;

        return $this;
    }

    public function __toString() {
        return $this->nombre;
    }
}
