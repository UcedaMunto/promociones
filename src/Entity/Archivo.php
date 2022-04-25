<?php

namespace App\Entity;

use App\Repository\ArchivoRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ArchivoRepository::class)
 */
class Archivo
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=CtlTipoArchivo::class, inversedBy="archivos")
     * @ORM\JoinColumn(nullable=true)
     */
    private $idTipoArchivo;

    /**
     * @ORM\Column(type="string", length=40)
     */
    private $ruta;
    private $rutaTemp;

    /**
     * @ORM\OneToOne(targetEntity=PromoAviso::class, mappedBy="archivoLogo", cascade={"persist", "remove"})
     */
    private $promoAviso;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdTipoArchivo(): ?CtlTipoArchivo
    {
        return $this->idTipoArchivo;
    }

    public function setIdTipoArchivo(?CtlTipoArchivo $idTipoArchivo): self
    {
        $this->idTipoArchivo = $idTipoArchivo;

        return $this;
    }

    public function getRuta(): ?string
    {
        return $this->ruta;
    }

    public function setRuta(string $ruta): self
    {
        $this->ruta = $ruta;

        return $this;
    }

    public function getPromoAviso(): ?PromoAviso
    {
        return $this->promoAviso;
    }

    public function setPromoAviso(PromoAviso $promoAviso): self
    {
        // set the owning side of the relation if necessary
        if ($promoAviso->getArchivoLogo() !== $this) {
            $promoAviso->setArchivoLogo($this);
        }

        $this->promoAviso = $promoAviso;

        return $this;
    }

    public function getArchivoBanner(): ?PromoEstablecimiento
    {
        return $this->archivoBanner;
    }

    public function setArchivoBanner(PromoEstablecimiento $archivoBanner): self
    {
        // set the owning side of the relation if necessary
        if ($archivoBanner->getArchivoLogo() !== $this) {
            $archivoBanner->setArchivoLogo($this);
        }

        $this->archivoBanner = $archivoBanner;

        return $this;
    }

    /**
     * Get the value of rutaTemp
     */
    public function getRutaTemp()
    {
        return $this->rutaTemp;
    }

    /**
     * Set the value of rutaTemp
     *
     * @return  self
     */
    public function setRutaTemp($rutaTemp)
    {
        $this->rutaTemp = $rutaTemp;

        return $this;
    }
}
