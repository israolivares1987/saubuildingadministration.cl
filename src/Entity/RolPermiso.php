<?php

namespace App\Entity;

use App\Repository\RolPermisoRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=RolPermisoRepository::class)
 */
class RolPermiso
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Permiso::class, inversedBy="rolPermisos")
     * @ORM\JoinColumn(nullable=false)
     */
    private $permiso;

    /**
     * @ORM\ManyToOne(targetEntity=Rol::class, inversedBy="rolPermisos")
     * @ORM\JoinColumn(nullable=false)
     */
    private $rol;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPermiso(): ?Permiso
    {
        return $this->permiso;
    }

    public function setPermiso(?Permiso $permiso): self
    {
        $this->permiso = $permiso;

        return $this;
    }

    public function getRol(): ?Rol
    {
        return $this->rol;
    }

    public function setRol(?Rol $rol): self
    {
        $this->rol = $rol;

        return $this;
    }
}
