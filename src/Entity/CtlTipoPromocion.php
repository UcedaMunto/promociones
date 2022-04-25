<?php

namespace App\Entity;

use App\Repository\CtlTipoPromocionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CtlTipoPromocionRepository::class)
 */
class CtlTipoPromocion
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
     * @ORM\OneToMany(targetEntity=PromoPromociones::class, mappedBy="idTipo")
     */
    private $promoPromociones;

    public function __construct()
    {
        $this->promoPromociones = new ArrayCollection();
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

    /**
     * @return Collection|PromoPromociones[]
     */
    public function getPromoPromociones(): Collection
    {
        return $this->promoPromociones;
    }

    public function addPromoPromocione(PromoPromociones $promoPromocione): self
    {
        if (!$this->promoPromociones->contains($promoPromocione)) {
            $this->promoPromociones[] = $promoPromocione;
            $promoPromocione->setIdTipo($this);
        }

        return $this;
    }

    public function removePromoPromocione(PromoPromociones $promoPromocione): self
    {
        if ($this->promoPromociones->removeElement($promoPromocione)) {
            // set the owning side to null (unless already changed)
            if ($promoPromocione->getIdTipo() === $this) {
                $promoPromocione->setIdTipo(null);
            }
        }

        return $this;
    }

    public function __toString(): ?string
    {
        return $this->nombre;
    }
}
