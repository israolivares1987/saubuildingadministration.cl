<?php

namespace App\Entity;

use App\Repository\TipoUnidadRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TipoUnidadRepository::class)
 */
class TipoUnidad
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
     * @ORM\Column(type="string", length=255)
     */
    private $datosVisibles;

    /**
     * @ORM\OneToMany(targetEntity=Unidad::class, mappedBy="tipoUnidad")
     */
    private $unidades;

    public function __construct()
    {
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
            $unidade->setTipoUnidad($this);
        }

        return $this;
    }

    public function removeUnidade(Unidad $unidade): self
    {
        if ($this->unidades->removeElement($unidade)) {
            // set the owning side to null (unless already changed)
            if ($unidade->getTipoUnidad() === $this) {
                $unidade->setTipoUnidad(null);
            }
        }

        return $this;
    }

    public function __toString() {
        return $this->nombre;
    }

    public function getDatosVisibles(): ?string
    {
        return $this->datosVisibles;
    }

    public function setDatosVisibles(string $datosVisibles): self
    {
        $this->datosVisibles = $datosVisibles;

        return $this;
    }
}
