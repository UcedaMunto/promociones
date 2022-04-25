<?php

namespace App\Entity;

use App\Repository\PromoContactoEstablecimientoRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PromoContactoEstablecimientoRepository::class)
 */
class PromoContactoEstablecimiento
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Contacto::class, inversedBy="promoContactoEstablecimientos", cascade={"persist"})
     */
    private $contacto;

    /**
     * @ORM\ManyToOne(targetEntity=PromoEstablecimiento::class, inversedBy="promoContactoEstablecimientos")
     * @ORM\JoinColumn(nullable=false)
     */
    private $establecimiento;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getContacto(): ?Contacto
    {
        return $this->contacto;
    }

    public function setContacto(?Contacto $contacto): self
    {
        $this->contacto = $contacto;

        return $this;
    }

    public function getEstablecimiento(): ?PromoEstablecimiento
    {
        return $this->establecimiento;
    }

    public function setEstablecimiento(?PromoEstablecimiento $establecimiento): self
    {
        $this->establecimiento = $establecimiento;

        return $this;
    }
}
