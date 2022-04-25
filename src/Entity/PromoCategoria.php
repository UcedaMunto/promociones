<?php

namespace App\Entity;

use App\Repository\PromoCategoriaRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PromoCategoriaRepository::class)
 */
class PromoCategoria
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
     * @ORM\Column(type="string", length=120, nullable=true)
     */
    private $descripcion;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $activo;

    /**
     * @ORM\OneToOne(targetEntity=Archivo::class, cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $archivoLogo;

    /**
     * @ORM\OneToOne(targetEntity=Archivo::class, cascade={"persist", "remove"})
     */
    private $archivoBanner;


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

    public function __toString(): ?string
    {
        return $this->nombre;
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

    public function setArchivoBanner(Archivo $archivoBanner): self
    {
        $this->archivoBanner = $archivoBanner;

        return $this;
    }



}
