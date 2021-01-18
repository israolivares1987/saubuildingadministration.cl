<?php

namespace App\Entity;

use App\Repository\ConjuntoRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ConjuntoRepository::class)
 */
class Conjunto
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
     * @ORM\ManyToOne(targetEntity=TipoConjunto::class, inversedBy="conjuntos")
     */
    private $tipoConjunto;

    /**
     * @ORM\ManyToOne(targetEntity=Comunidad::class, inversedBy="conjuntos")
     */
    private $comunidad;

    /**
     * @ORM\OneToMany(targetEntity=Unidad::class, mappedBy="conjunto")
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

    public function getEstado(): ?bool
    {
        return $this->estado;
    }

    public function setEstado(bool $estado): self
    {
        $this->estado = $estado;

        return $this;
    }

    public function getTipoConjunto(): ?TipoConjunto
    {
        return $this->tipoConjunto;
    }

    public function setTipoConjunto(?TipoConjunto $tipoConjunto): self
    {
        $this->tipoConjunto = $tipoConjunto;

        return $this;
    }

    public function getComunidad(): ?Comunidad
    {
        return $this->comunidad;
    }

    public function setComunidad(?Comunidad $comunidad): self
    {
        $this->comunidad = $comunidad;

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
            $unidade->setConjunto($this);
        }

        return $this;
    }

    public function removeUnidade(Unidad $unidade): self
    {
        if ($this->unidades->removeElement($unidade)) {
            // set the owning side to null (unless already changed)
            if ($unidade->getConjunto() === $this) {
                $unidade->setConjunto(null);
            }
        }

        return $this;
    }

    public function __toString() {
        return $this->nombre;
    }
}
