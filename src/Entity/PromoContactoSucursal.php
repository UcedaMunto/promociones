<?php

namespace App\Entity;

use App\Repository\PromoContactoSucursalRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PromoContactoSucursalRepository::class)
 */
class PromoContactoSucursal
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Contacto::class, inversedBy="promoContactoSucursals", cascade={"persist"})
     */
    private $idContacto;

    /**
     * @ORM\ManyToOne(targetEntity=PromoSucursal::class, inversedBy="promoContactoSucursals", cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $sucursal;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdContacto(): ?Contacto
    {
        return $this->idContacto;
    }

    public function setIdContacto(?Contacto $idContacto): self
    {
        $this->idContacto = $idContacto;

        return $this;
    }

    public function getSucursal(): ?PromoSucursal
    {
        return $this->sucursal;
    }

    public function setSucursal(?PromoSucursal $sucursal): self
    {
        $this->sucursal = $sucursal;

        return $this;
    }
}
