<?php

namespace App\Entity;

use App\Repository\MunicipioRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=MunicipioRepository::class)
 */
class Municipio
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=25)
     */
    private $nombre;

    /**
     * @ORM\ManyToOne(targetEntity=Departamento::class, inversedBy="municipios")
     * @ORM\JoinColumn(nullable=false)
     */
    private $idDepartamento;

    /**
     * @ORM\OneToMany(targetEntity=PromoSucursal::class, mappedBy="idMunicipio")
     */
    private $promoSucursals;

    public function __construct()
    {
        $this->promoSucursals = new ArrayCollection();
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

    public function getIdDepartamento(): ?Departamento
    {
        return $this->idDepartamento;
    }

    public function setIdDepartamento(?Departamento $idDepartamento): self
    {
        $this->idDepartamento = $idDepartamento;

        return $this;
    }

    /**
     * @return Collection|PromoSucursal[]
     */
    public function getPromoSucursals(): Collection
    {
        return $this->promoSucursals;
    }

    public function addPromoSucursal(PromoSucursal $promoSucursal): self
    {
        if (!$this->promoSucursals->contains($promoSucursal)) {
            $this->promoSucursals[] = $promoSucursal;
            $promoSucursal->setIdMunicipio($this);
        }

        return $this;
    }

    public function removePromoSucursal(PromoSucursal $promoSucursal): self
    {
        if ($this->promoSucursals->removeElement($promoSucursal)) {
            // set the owning side to null (unless already changed)
            if ($promoSucursal->getIdMunicipio() === $this) {
                $promoSucursal->setIdMunicipio(null);
            }
        }

        return $this;
    }
    public function __toString(): ?string
    {
        return $this->nombre;
    }
}
