<?php

namespace App\Entity;

use App\Repository\ParametrosFinacierosComunidadRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ParametrosFinacierosComunidadRepository::class)
 */
class ParametrosFinacierosComunidad
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $costoAnual;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $porcFondoReserva;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $porcInteres;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $logicaInteres;

    /**
     * @ORM\OneToOne(targetEntity=Comunidad::class, inversedBy="parametrosFinacierosComunidad", cascade={"persist", "remove"})
     */
    private $comunidad;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCostoAnual(): ?float
    {
        return $this->costoAnual;
    }

    public function setCostoAnual(?float $costoAnual): self
    {
        $this->costoAnual = $costoAnual;

        return $this;
    }

    public function getPorcFondoReserva(): ?float
    {
        return $this->porcFondoReserva;
    }

    public function setPorcFondoReserva(?float $porcFondoReserva): self
    {
        $this->porcFondoReserva = $porcFondoReserva;

        return $this;
    }

    public function getPorcInteres(): ?float
    {
        return $this->porcInteres;
    }

    public function setPorcInteres(?float $porcInteres): self
    {
        $this->porcInteres = $porcInteres;

        return $this;
    }

    public function getLogicaInteres(): ?string
    {
        return $this->logicaInteres;
    }

    public function setLogicaInteres(?string $logicaInteres): self
    {
        $this->logicaInteres = $logicaInteres;

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
}
