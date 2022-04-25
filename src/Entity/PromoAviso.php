<?php

namespace App\Entity;

use App\Repository\PromoAvisoRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PromoAvisoRepository::class)
 */
class PromoAviso
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=60)
     */
    private $nombre;

    /**
     * @ORM\Column(type="string", length=200, nullable=true)
     */
    private $descripcion;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $activo;

    /**
     * @ORM\ManyToOne(targetEntity=CtlTipoAviso::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $idTipoAviso;

    /**
     * @ORM\OneToOne(targetEntity=Archivo::class, inversedBy="promoAviso", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $archivoLogo;
    private $archivoLogoTemp;

    public function __construct()
    {
       
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

    public function getDescripcion(): ?string
    {
        return $this->descripcion;
    }

    public function setDescripcion(?string $descripcion): self
    {
        $this->descripcion = $descripcion;

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

    public function getIdTipoAviso(): ?CtlTipoAviso
    {
        return $this->idTipoAviso;
    }

    public function setIdTipoAviso(?CtlTipoAviso $idTipoAviso): self
    {
        $this->idTipoAviso = $idTipoAviso;

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
}
