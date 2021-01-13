<?php

namespace App\Entity;

use App\Repository\TipoConjuntoRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TipoConjuntoRepository::class)
 */
class TipoConjunto
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
     * @ORM\OneToMany(targetEntity=Conjunto::class, mappedBy="tipoConjunto")
     */
    private $conjuntos;

    public function __construct()
    {
        $this->conjuntos = new ArrayCollection();
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
            $conjunto->setTipoConjunto($this);
        }

        return $this;
    }

    public function removeConjunto(Conjunto $conjunto): self
    {
        if ($this->conjuntos->removeElement($conjunto)) {
            // set the owning side to null (unless already changed)
            if ($conjunto->getTipoConjunto() === $this) {
                $conjunto->setTipoConjunto(null);
            }
        }

        return $this;
    }
}
