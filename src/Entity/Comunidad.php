<?php

namespace App\Entity;

use App\Repository\ComunidadRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ComunidadRepository::class)
 */
class Comunidad
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $codigo;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nombre;

    /**
     * @ORM\Column(type="boolean")
     */
    private $estado;

    /**
     * @ORM\OneToMany(targetEntity=UsuarioRol::class, mappedBy="comunidad")
     */
    private $usuarioRoles;

    /**
     * @ORM\OneToMany(targetEntity=Conjunto::class, mappedBy="comunidad")
     */
    private $conjuntos;

    /**
     * @ORM\OneToOne(targetEntity=ParametrosFinacierosComunidad::class, mappedBy="comunidad", cascade={"persist", "remove"})
     */
    private $parametrosFinacierosComunidad;

    public function __construct()
    {
        $this->usuarioRoles = new ArrayCollection();
        $this->conjuntos = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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
    public function getUsuarioRoles(): Collection
    {
        return $this->usuarioRoles;
    }

    public function addUsuarioRole(UsuarioRol $usuarioRole): self
    {
        if (!$this->usuarioRoles->contains($usuarioRole)) {
            $this->usuarioRoles[] = $usuarioRole;
            $usuarioRole->setComunidad($this);
        }

        return $this;
    }

    public function removeUsuarioRole(UsuarioRol $usuarioRole): self
    {
        if ($this->usuarioRoles->removeElement($usuarioRole)) {
            // set the owning side to null (unless already changed)
            if ($usuarioRole->getComunidad() === $this) {
                $usuarioRole->setComunidad(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Conjunto[]
     */
    public function getConjuntos(): Collection
    {
        return $this->conjuntos;
    }

    public function addConjunto(Conjunto $conjunto): self
    {
        if (!$this->conjuntos->contains($conjunto)) {
            $this->conjuntos[] = $conjunto;
            $conjunto->setComunidad($this);
        }

        return $this;
    }

    public function removeConjunto(Conjunto $conjunto): self
    {
        if ($this->conjuntos->removeElement($conjunto)) {
            // set the owning side to null (unless already changed)
            if ($conjunto->getComunidad() === $this) {
                $conjunto->setComunidad(null);
            }
        }

        return $this;
    }

    public function getParametrosFinacierosComunidad(): ?ParametrosFinacierosComunidad
    {
        return $this->parametrosFinacierosComunidad;
    }

    public function setParametrosFinacierosComunidad(?ParametrosFinacierosComunidad $parametrosFinacierosComunidad): self
    {
        // unset the owning side of the relation if necessary
        if ($parametrosFinacierosComunidad === null && $this->parametrosFinacierosComunidad !== null) {
            $this->parametrosFinacierosComunidad->setComunidad(null);
        }

        // set the owning side of the relation if necessary
        if ($parametrosFinacierosComunidad !== null && $parametrosFinacierosComunidad->getComunidad() !== $this) {
            $parametrosFinacierosComunidad->setComunidad($this);
        }

        $this->parametrosFinacierosComunidad = $parametrosFinacierosComunidad;

        return $this;
    }
}
