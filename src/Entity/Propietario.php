<?php

namespace App\Entity;

use App\Repository\PropietarioRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PropietarioRepository::class)
 */
class Propietario
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Cliente::class, inversedBy="propietarios")
     */
    private $cliente;

    /**
     * @ORM\OneToOne(targetEntity=Unidad::class, inversedBy="propietario", cascade={"persist", "remove"})
     */
    private $unidad;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCliente(): ?Cliente
    {
        return $this->cliente;
    }

    public function setCliente(?Cliente $cliente): self
    {
        $this->cliente = $cliente;

        return $this;
    }

    public function getUnidad(): ?Unidad
    {
        return $this->unidad;
    }

    public function setUnidad(?Unidad $unidad): self
    {
        $this->unidad = $unidad;

        return $this;
    }

    public function __toString() {
        return $this->getCliente()->getNombres();
    }
}
