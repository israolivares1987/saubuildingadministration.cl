<?php

namespace App\Entity;

use App\Repository\PermisoRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PermisoRepository::class)
 */
class Permiso
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
     * @ORM\OneToMany(targetEntity=RolPermiso::class, mappedBy="permiso")
     */
    private $rolPermisos;

    public function __construct()
    {
        $this->rolPermisos = new ArrayCollection();
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
            $rolPermiso->setPermiso($this);
        }

        return $this;
    }

    public function removeRolPermiso(RolPermiso $rolPermiso): self
    {
        if ($this->rolPermisos->removeElement($rolPermiso)) {
            // set the owning side to null (unless already changed)
            if ($rolPermiso->getPermiso() === $this) {
                $rolPermiso->setPermiso(null);
            }
        }

        return $this;
    }
}
