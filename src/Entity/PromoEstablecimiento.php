<?php

namespace App\Entity;

use App\Repository\PromoEstablecimientoRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

//use Symfony\Component\HttpFoundation\File\UploadedFile;
/**
 * @ORM\Entity(repositoryClass=PromoEstablecimientoRepository::class)
 */
class PromoEstablecimiento
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
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $activo;

    /**
     * @ORM\OneToOne(targetEntity=Archivo::class, cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $archivoLogo;
    private $archivoLogoTemp;

    /**
     * @ORM\OneToOne(targetEntity=Archivo::class, cascade={"persist", "remove"})
     */
    private $archivoBanner;
    private $archivoBannerTemp;

    /**
     * @ORM\ManyToMany(targetEntity=PromoCategoria::class)
     */
    private $categorias;

    /**
     * @ORM\OneToMany(targetEntity=PromoContactoEstablecimiento::class, mappedBy="establecimiento")
     */
    private $promoContactoEstablecimientos;

    /**
     * @ORM\OneToMany(targetEntity=PromoSucursal::class, mappedBy="idEstablecimiento")
     */
    private $promoSucursals;

    /**
     * @ORM\Column(type="string", length=15, nullable=false)
     */
    private $telefono;

    /**
     * @ORM\Column(type="string", length=500, nullable=false)
     */
    private $direccion;

    public function __construct()
    {
        $this->contactos = new ArrayCollection();
        $this->categorias = new ArrayCollection();
        $this->promoContactoEstablecimientos = new ArrayCollection();
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

    public function getActivo(): ?bool
    {
        return $this->activo;
    }

    public function setActivo(?bool $activo): self
    {
        $this->activo = $activo;

        return $this;
    }

    public function __toString(): ?string
    {
        return $this->nombre;
    }

    /**
     * @return Collection|Contacto[]
     */
    public function getContactos(): Collection
    {
        return $this->contactos;
    }

    public function addContacto(Contacto $contacto): self
    {
        if (!$this->contactos->contains($contacto)) {
            $this->contactos[] = $contacto;
            $contacto->setIdEstablecimiento($this);
        }

        return $this;
    }

    public function removeContacto(Contacto $contacto): self
    {
        if ($this->contactos->removeElement($contacto)) {
            // set the owning side to null (unless already changed)
            if ($contacto->getIdEstablecimiento() === $this) {
                $contacto->setIdEstablecimiento(null);
            }
        }

        return $this;
    }

    public function getArchivoLogo(): ?Archivo
    {
        return $this->archivoLogo;
    }

    public function setArchivoLogo(Archivo $archivoLogo): self
    {
        $this->archivoLogo = $archivoLogo;

        return $this;
    }

    public function getArchivoBanner(): ?Archivo
    {
        return $this->archivoBanner;
    }

    public function setArchivoBanner(?Archivo $archivoBanner): self
    {
        $this->archivoBanner = $archivoBanner;

        return $this;
    }

    /**
     * @return Collection|PromoCategoria[]
     */
    public function getCategorias(): Collection
    {
        return $this->categorias;
    }

    public function addCategoria(PromoCategoria $categoria): self
    {
        if (!$this->categorias->contains($categoria)) {
            $this->categorias[] = $categoria;
        }

        return $this;
    }

    public function removeCategoria(PromoCategoria $categoria): self
    {
        $this->categorias->removeElement($categoria);

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
            $promoContactoEstablecimiento->setEstablecimiento($this);
        }

        return $this;
    }

    public function removePromoContactoEstablecimiento(PromoContactoEstablecimiento $promoContactoEstablecimiento): self
    {
        if ($this->promoContactoEstablecimientos->removeElement($promoContactoEstablecimiento)) {
            // set the owning side to null (unless already changed)
            if ($promoContactoEstablecimiento->getEstablecimiento() === $this) {
                $promoContactoEstablecimiento->setEstablecimiento(null);
            }
        }

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
            $promoSucursal->setIdEstablecimiento($this);
        }

        return $this;
    }

    public function removePromoSucursal(PromoSucursal $promoSucursal): self
    {
        if ($this->promoSucursals->removeElement($promoSucursal)) {
            // set the owning side to null (unless already changed)
            if ($promoSucursal->getIdEstablecimiento() === $this) {
                $promoSucursal->setIdEstablecimiento(null);
            }
        }

        return $this;
    }

   

    /**
     * Get the value of archivoLogoTemp
     */
    public function getArchivoLogoTemp()
    {
        return $this->archivoLogoTemp;
    }

    /**
     * Set the value of archivoLogoTemp
     *
     * @return  self
     */
    public function setArchivoLogoTemp($archivoLogoTemp)
    {
        $this->archivoLogoTemp = $archivoLogoTemp;

        return $this;
    }

    /**
     * Get the value of archivoBannerTemp
     */
    public function getArchivoBannerTemp()
    {
        return $this->archivoBannerTemp;
    }

    /**
     * Set the value of archivoBannerTemp
     *
     * @return  self
     */
    public function setArchivoBannerTemp($archivoBannerTemp)
    {
        $this->archivoBannerTemp = $archivoBannerTemp;

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

    public function getDireccion(): ?string
    {
        return $this->direccion;
    }

    public function setDireccion(?string $direccion): self
    {
        $this->direccion = $direccion;

        return $this;
    }
}
