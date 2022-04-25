<?php

namespace App\Entity;

use App\Repository\PersonaClienteRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use phpDocumentor\Reflection\Types\Boolean;

/**
 * @ORM\Entity(repositoryClass=PersonaClienteRepository::class)
 * @ORM\HasLifecycleCallbacks()
 */
class PersonaCliente
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToOne(targetEntity=DatosPersona::class, inversedBy="personaCliente", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $datos;

    /**
     * @ORM\OneToOne(targetEntity=UsuarioCliente::class, inversedBy="personaCliente", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=true)
     */
    private $usuario;
    /**
     * @ORM\Column(type="string", length=40, nullable=true)
     */
    private $tokenRegistro;
    
    /**
     * Set tokenRegistro
     *
     * @param \String $tokenRegistro
     * @ORM\PrePersist
     * @return PersonaCliente
     */
    public function setTokenRegistro()
    {
        if(!$this->tokenRegistro){
            $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $this->tokenRegistro = substr(str_shuffle($permitted_chars), 0, 8);
        }
        return $this;
    }

    public function __toString(): ?string
    {
        $data= $this->getDatos()->getNombre()." - ";
        
        return $data;
    }

    public function getCliente(): ?string
    {
        $data= $this->getDatos()->getCliente();
        return $data;
    }

    public function __construct()
    {
       
    }

    public function getId(): ?int
    {
        return $this->id;
    }
    
    public function getDatos(): ?DatosPersona
    {
        return $this->datos;
    }
    public function getNombre(): ?string
    {
        return $this->datos->getNombre();
    }

    public function setDatos(DatosPersona $datos): self
    {
        $this->datos = $datos;

        return $this;
    }


    public function getUsuario(): ?UsuarioCliente
    {
        return $this->usuario;
    }

    public function setUsuario(UsuarioCliente $usuario): self
    {
        $this->usuario = $usuario;

        return $this;
    }


    public function getTokenRegistro(): ?string
    {
        return $this->tokenRegistro;
    }

}
