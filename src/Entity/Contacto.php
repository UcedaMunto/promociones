<?php

namespace App\Entity;

use App\Repository\ContactoRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ContactoRepository::class)
 */
class Contacto
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;


    /**
     * @ORM\ManyToOne(targetEntity=CtlTipoContacto::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $idTipoContacto;

    /**
     * @ORM\Column(type="string", length=35)
     */
    private $nombre;

    /**
     * @ORM\OneToMany(targetEntity=PromoContactoEstablecimiento::class, mappedBy="contacto")
     */
    private $promoContactoEstablecimientos;

    /**
     * @ORM\Column(type="string", length=10, nullable=true)
     */
    private $telefono;

    /**
     * @ORM\OneToMany(targetEntity=PromoContactoSucursal::class, mappedBy="idContacto")
     */
    private $promoContactoSucursals;

    public function __construct()
    {
        $this->promoContactoEstablecimientos = new ArrayCollection();
        $this->promoContactoSucursals = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdTipoContacto(): ?CtlTipoContacto
    {
        return $this->idTipoContacto;
    }

    public function setIdTipoContacto(?CtlTipoContacto $idTipoContacto): self
    {
        $this->idTipoContacto = $idTipoContacto;

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

    /**
     * @return Collection|PromoContactoEstablecimiento[]
     */
    public function getPromoContactoEstablecimientos(): Collection
    {
        return $this->promoContactoEstablecimientos;
    }

    public function addPromoContactoEstablecimiento(PromoContactoEstablecimiento $promoContactoEstablecimiento): self
    {
        if (!$this->promoContactoEstablecimientos->contains($promoContactoEstablecimiento)) {
            $this->promoContactoEstablecimientos[] = $promoContactoEstablecimiento;
            $promoContactoEstablecimiento->setContacto($this);
        }

        return $this;
    }

    public function removePromoContactoEstablecimiento(PromoContactoEstablecimiento $promoContactoEstablecimiento): self
    {
        if ($this->promoContactoEstablecimientos->removeElement($promoContactoEstablecimiento)) {
            // set the owning side to null (unless already changed)
            if ($promoContactoEstablecimiento->getContacto() === $this) {
                $promoContactoEstablecimiento->setContacto(null);
            }
        }

        return $this;
    }

    public function getTelefono(): ?string
    {
        return $this->telefono;
    }

    public function setTelefono(?string $telefono): self
    {
        $this->telefono = $telefono;

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
            $promoContactoSucursal->setIdContacto($this);
        }

        return $this;
    }

    public function removePromoContactoSucursal(PromoContactoSucursal $promoContactoSucursal): self
    {
        if ($this->promoContactoSucursals->removeElement($promoContactoSucursal)) {
            // set the owning side to null (unless already changed)
            if ($promoContactoSucursal->getIdContacto() === $this) {
                $promoContactoSucursal->setIdContacto(null);
            }
        }

        return $this;
    }
}
