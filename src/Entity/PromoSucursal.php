<?php

namespace App\Entity;

use App\Repository\PromoSucursalRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PromoSucursalRepository::class)
 */
class PromoSucursal
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=35)
     */
    private $nombre;

    /**
     * @ORM\ManyToOne(targetEntity=PromoEstablecimiento::class, inversedBy="promoSucursals")
     * @ORM\JoinColumn(nullable=false)
     */
    private $idEstablecimiento;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $activo;

    /**
     * @ORM\ManyToOne(targetEntity=Municipio::class, inversedBy="promoSucursals")
     * @ORM\JoinColumn(nullable=false)
     */
    private $idMunicipio;

    /**
     * @ORM\Column(type="string", length=150)
     */
    private $direccion;

    /**
     * @ORM\OneToMany(targetEntity=PromocionSucursal::class, mappedBy="idSucursal")
     */
    private $promocionSucursals;

    /**
     * @ORM\Column(type="string", length=60, nullable=false)
     */
    private $urlUbicacionMapa;

    /**
     * @ORM\OneToMany(targetEntity=PromoContactoSucursal::class, mappedBy="sucursal")
     */
    private $promoContactoSucursals;
    

    public function __construct()
    {
        $this->promocionSucursals = new ArrayCollection();
        $this->promoContactoSucursals = new ArrayCollection();
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

    public function getIdEstablecimiento(): ?PromoEstablecimiento
    {
        return $this->idEstablecimiento;
    }

    public function setIdEstablecimiento(?PromoEstablecimiento $idEstablecimiento): self
    {
        $this->idEstablecimiento = $idEstablecimiento;

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

    public function getIdMunicipio(): ?Municipio
    {
        return $this->idMunicipio;
    }

    public function setIdMunicipio(?Municipio $idMunicipio): self
    {
        $this->idMunicipio = $idMunicipio;

        return $this;
    }

    public function getDireccion(): ?string
    {
        return $this->direccion;
    }

    public function setDireccion(string $direccion): self
    {
        $this->direccion = $direccion;

        return $this;
    }

    /**
     * @return Collection|PromocionSucursal[]
     */
    public function getPromocionSucursals(): Collection
    {
        return $this->promocionSucursals;
    }

    public function addPromocionSucursal(PromocionSucursal $promocionSucursal): self
    {
        if (!$this->promocionSucursals->contains($promocionSucursal)) {
            $this->promocionSucursals[] = $promocionSucursal;
            $promocionSucursal->setIdSucursal($this);
        }

        return $this;
    }

    public function removePromocionSucursal(PromocionSucursal $promocionSucursal): self
    {
        if ($this->promocionSucursals->removeElement($promocionSucursal)) {
            // set the owning side to null (unless already changed)
            if ($promocionSucursal->getIdSucursal() === $this) {
                $promocionSucursal->setIdSucursal(null);
            }
        }

        return $this;
    }

    public function __toString(): ?string
    {
        return $this->nombre;
    }

    public function getUrlUbicacionMapa(): ?string
    {
        return $this->urlUbicacionMapa;
    }

    public function setUrlUbicacionMapa(string $urlUbicacionMapa): self
    {
        $this->urlUbicacionMapa = $urlUbicacionMapa;

        return $this;
    }

    /**
     * @return Collection|PromoContactoSucursal[]
     */
    public function getPromoContactoSucursals(): Collection
    {
        return $this->promoContactoSucursals;
    }

    public function addPromoContactoSucursal(PromoContactoSucursal $promoContactoSucursal): self
    {
        if (!$this->promoContactoSucursals->contains($promoContactoSucursal)) {
            $this->promoContactoSucursals[] = $promoContactoSucursal;
            $promoContactoSucursal->setSucursal($this);
        }

        return $this;
    }

    public function removePromoContactoSucursal(PromoContactoSucursal $promoContactoSucursal): self
    {
        if ($this->promoContactoSucursals->removeElement($promoContactoSucursal)) {
            // set the owning side to null (unless already changed)
            if ($promoContactoSucursal->getSucursal() === $this) {
                $promoContactoSucursal->setSucursal(null);
            }
        }

        return $this;
    }
}
