<?php

namespace App\Entity;

use App\Repository\PromoPromocionesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PromoPromocionesRepository::class)
 */
class PromoPromociones
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=CtlTipoPromocion::class, inversedBy="promoPromociones")
     * @ORM\JoinColumn(nullable=false)
     */
    private $idTipo;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $fechaInicio;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $fechaFin;

    /**
     * @ORM\Column(type="string", length=20, nullable=true)
     */
    private $codigo;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $activo;

    /**
     * @ORM\Column(type="string", length=35)
     */
    private $nombre;

    /**
     * @ORM\Column(type="string", length=200)
     */
    private $descripcion;

    /**
     * @ORM\OneToMany(targetEntity=PromocionSucursal::class, mappedBy="idPromocion")
     */
    private $promocionSucursals;

    public function __construct()
    {
        $this->promocionSucursals = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdTipo(): ?CtlTipoPromocion
    {
        return $this->idTipo;
    }

    public function setIdTipo(?CtlTipoPromocion $idTipo): self
    {
        $this->idTipo = $idTipo;

        return $this;
    }

    public function getFechaInicio(): ?\DateTimeInterface
    {
        return $this->fechaInicio;
    }

    public function setFechaInicio(?\DateTimeInterface $fechaInicio): self
    {
        $this->fechaInicio = $fechaInicio;

        return $this;
    }

    public function getFechaFin(): ?\DateTimeInterface
    {
        return $this->fechaFin;
    }

    public function setFechaFin(?\DateTimeInterface $fechaFin): self
    {
        $this->fechaFin = $fechaFin;

        return $this;
    }

    public function getCodigo(): ?string
    {
        return $this->codigo;
    }

    public function setCodigo(?string $codigo): self
    {
        $this->codigo = $codigo;

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

    public function getNombre(): ?string
    {
        return $this->nombre;
    }

    public function setNombre(string $nombre): self
    {
        $this->nombre = $nombre;

        return $this;
    }

    public function getDescripcion(): ?string
    {
        return $this->descripcion;
    }

    public function setDescripcion(string $descripcion): self
    {
        $this->descripcion = $descripcion;

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
            $promocionSucursal->setIdPromocion($this);
        }

        return $this;
    }

    public function removePromocionSucursal(PromocionSucursal $promocionSucursal): self
    {
        if ($this->promocionSucursals->removeElement($promocionSucursal)) {
            // set the owning side to null (unless already changed)
            if ($promocionSucursal->getIdPromocion() === $this) {
                $promocionSucursal->setIdPromocion(null);
            }
        }

        return $this;
    }
}
