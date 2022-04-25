<?php

namespace App\Entity;

//use App\Repository\UsuarioClienteRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=UsuarioClienteRepository::class)
 * @ORM\HasLifecycleCallbacks()
 */
class UsuarioCliente
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToOne(targetEntity=PersonaCliente::class, mappedBy="usuario", cascade={"persist", "remove"})
     */
    private $personaCliente;


    /**
     * @ORM\Column(type="string", length=60)
     */
    private $usuario;

    /**
     * @ORM\Column(type="string", length=200)
     */
    private $password;

    /**
     * @ORM\Column(type="date")
     */
    private $creacion;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $actualizacion;

    /**
     * Set actualizacion
     *
     * @param \DateTime $actualizacion
     * @ORM\PreUpdate
     * @return UsuarioCliente
     */
    public function setActualizacion()
    {

        if(!$this->actualizacion){
            $this->actualizacion = new \DateTime();
        }
        return $this;
    }

    /**
     * Set creacion
     *
     * @param \DateTime $creacion
     * @ORM\PrePersist
     * @return UsuarioCliente
     */
    public function setCreacion()
    {

        if(!$this->creacion){
            $this->creacion = new \DateTime();
        }
        return $this;
    }

    public function getUsuario(): ?string
    {
        return $this->usuario;
    }

    public function setUsuario(string $usuario): self
    {
        $this->usuario = $usuario;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPersonaCliente(): ?PersonaCliente
    {
        return $this->personaCliente;
    }

    public function setPersonaCliente(PersonaCliente $personaCliente): self
    {
        $this->personaCliente = $personaCliente;

        // set the owning side of the relation if necessary
        if ($personaCliente->getUsuario() !== $this) {
            $personaCliente->setUsuario($this);
        }

        return $this;
    }

    public function getCreacion(): ?\DateTimeInterface
    {
        return $this->creacion;
    }


    public function getActualizacion(): ?\DateTimeInterface
    {
        return $this->actualizacion;
    }
    
}
