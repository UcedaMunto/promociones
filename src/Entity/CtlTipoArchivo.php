<?php

namespace App\Entity;

use App\Repository\CtlTipoArchivoRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CtlTipoArchivoRepository::class)
 */
class CtlTipoArchivo
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=35, nullable=false)
     */
    private $nombre;

    /**
     * @ORM\OneToMany(targetEntity=Archivo::class, mappedBy="idTipoArchivo")
     */
    private $archivos;

    public function __construct()
    {
        $this->archivos = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNombre(): ?string
    {
        return $this->nombre;
    }

    public function setNombre(?string $nombre): self
    {
        $this->nombre = $nombre;

        return $this;
    }

    public function __toString(): ?string
    {
        return $this->nombre;
    }

    /**
     * @return Collection|Archivo[]
     */
    public function getArchivos(): Collection
    {
        return $this->archivos;
    }

    public function addArchivo(Archivo $archivo): self
    {
        if (!$this->archivos->contains($archivo)) {
            $this->archivos[] = $archivo;
            $archivo->setIdTipoArchivo($this);
        }

        return $this;
    }

    public function removeArchivo(Archivo $archivo): self
    {
        if ($this->archivos->removeElement($archivo)) {
            // set the owning side to null (unless already changed)
            if ($archivo->getIdTipoArchivo() === $this) {
                $archivo->setIdTipoArchivo(null);
            }
        }

        return $this;
    }

}
