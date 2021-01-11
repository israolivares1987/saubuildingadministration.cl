<?php

namespace App\Entity;

use App\Repository\CorredoraRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CorredoraRepository::class)
 */
class Corredora
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Cliente::class, inversedBy="corredoras")
     */
    private $cliente;

    /**
     * @ORM\ManyToOne(targetEntity=Unidad::class, inversedBy="corredoras")
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
}
