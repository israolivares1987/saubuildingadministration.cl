<?php

namespace App\Entity;

use App\Repository\RolRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=RolRepository::class)
 */
class Rol
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
     * @ORM\OneToMany(targetEntity=RolPermiso::class, mappedBy="rol")
     */
    private $rolPermisos;

    /**
     * @ORM\OneToMany(targetEntity=UsuarioRol::class, mappedBy="rol")
     */
    private $usuarioRols;

    public function __construct()
    {
        $this->rolPermisos = new ArrayCollection();
        $this->usuarioRols = new ArrayCollection();
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
     * @return Collection|RolPermiso[]
     */
    public function getRolPermisos(): Collection
    {
        return $this->rolPermisos;
    }

    public function addRolPermiso(RolPermiso $rolPermiso): self
    {
        if (!$this->rolPermisos->contains($rolPermiso)) {
            $this->rolPermisos[] = $rolPermiso;
            $rolPermiso->setRol($this);
        }

        return $this;
    }

    public function removeRolPermiso(RolPermiso $rolPermiso): self
    {
        if ($this->rolPermisos->removeElement($rolPermiso)) {
            // set the owning side to null (unless already changed)
            if ($rolPermiso->getRol() === $this) {
                $rolPermiso->setRol(null);
            }
        }

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
            $usuarioRol->setRol($this);
        }

        return $this;
    }

    public function removeUsuarioRol(UsuarioRol $usuarioRol): self
    {
        if ($this->usuarioRols->removeElement($usuarioRol)) {
            // set the owning side to null (unless already changed)
            if ($usuarioRol->getRol() === $this) {
                $usuarioRol->setRol(null);
            }
        }

        return $this;
    }
}
