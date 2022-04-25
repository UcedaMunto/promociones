<?php

namespace App\Entity;

use App\Repository\PromocionSucursalRepository;
use Doctrine\ORM\Mapping as ORM;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;


/**
 * @ORM\Entity(repositoryClass=PromocionSucursalRepository::class)
 */
class PromocionSucursal
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=PromoSucursal::class, inversedBy="promocionSucursals",cascade={"persist"})
     */
    private $idSucursal;

    /**
     * @ORM\ManyToOne(targetEntity=PromoPromociones::class, inversedBy="promocionSucursals",cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $idPromocion;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $activo;

    private $idSucursalTemp;

    public function __construct()
    {
        $this->idSucursalTemp = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdSucursal(): ?PromoSucursal
    {
        return $this->idSucursal;
    }

    public function setIdSucursal(?PromoSucursal $idSucursal): self
    {
        $this->idSucursal = $idSucursal;

        return $this;
    }

    public function getIdPromocion(): ?PromoPromociones
    {
        return $this->idPromocion;
    }

    public function setIdPromocion(?PromoPromociones $idPromocion): self
    {
        $this->idPromocion = $idPromocion;

        return $this;
    }

    public function getActivo(): ?bool
    {
        return $this->activo;
    }

    public function setActivo(?bool $activo): self
    {
        $this->activo = $activo;

        return $this;
    }

    /**
     * Get the value of idSucursalTemp
     */
    public function getIdSucursalTemp()
    {
        return $this->idSucursalTemp;
    }

    /**
     * Set the value of idSucursalTemp
     *
     * @return  self
     */
    public function setIdSucursalTemp($idSucursalTemp)
    {
        $this->idSucursalTemp = $idSucursalTemp;

        return $this;
    }
}
