<?php

namespace App\Entity;

//use App\Repository\PersonaEmpleadoRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PersonaEmpleadoRepository::class)
 * @ORM\HasLifecycleCallbacks()
 */
class PersonaEmpleado
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $salario;

    /**
     * @ORM\Column(type="datetime")
     */
    private $fechaCreacion;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $fechaUpdate;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $lastSesion;

    /**
     * @ORM\Column(type="integer")
     */
    private $activacion;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $color;

    /**
     * @ORM\Column(type="string", length=35, nullable=true)
     */
    private $isss;

    /**
     * @ORM\Column(type="string", length=35, nullable=true)
     */
    private $afp;

    /**
     * @ORM\OneToOne(targetEntity=DatosPersona::class, cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $datos;

    /**
     * @ORM\OneToOne(targetEntity=UsuarioEmpleado::class, mappedBy="empleado")
     */
    private $usuariosEmpleado;
    

    /**
     * Set fechaUpdate
     *
     * @param \DateTime $fechaUpdate
     * @ORM\PreUpdate
     * @return UsuarioCliente
     */
    public function setFechaUpdate()
    {
        if(!$this->fechaUpdate){
            $this->fechaUpdate = new \DateTime();
        }
        return $this;
    }

    /**
     * Set fechaCreacion
     *
     * @param \DateTime $fechaCreacion
     * @ORM\PrePersist
     * @return UsuarioCliente
     */
    public function setFechaCreacion()
    {
        if(!$this->fechaCreacion){
            $this->fechaCreacion = new \DateTime();
        }
        return $this;
    }

    public function __toString(): ?string
    {
        return $this->getDatos()->getNombre()."-".$this->getDatos()->getApellido();
    }
  

    public function __construct()
    {
        
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSalario(): ?float
    {
        return $this->salario;
    }

    public function setSalario(?float $salario): self
    {
        $this->salario = $salario;

        return $this;
    }
    public function getFechaCreacion(): ?\DateTimeInterface
    {
        return $this->fechaCreacion;
    }

    public function getFechaUpdate(): ?\DateTimeInterface
    {
        return $this->fechaUpdate;
    }


    public function getLastSesion(): ?\DateTimeInterface
    {
        return $this->lastSesion;
    }

    public function setLastSesion(?\DateTimeInterface $lastSesion): self
    {
        $this->lastSesion = $lastSesion;

        return $this;
    }

    public function getActivacion(): ?int
    {
        return $this->activacion;
    }

    public function setActivacion(int $activacion): self
    {
        $this->activacion = $activacion;

        return $this;
    }

    public function getColor(): ?string
    {
        return $this->color;
    }

    public function setColor(?string $color): self
    {
        $this->color = $color;

        return $this;
    }

    public function getIsss(): ?string
    {
        return $this->isss;
    }

    public function setIsss(?string $isss): self
    {
        $this->isss = $isss;

        return $this;
    }

    public function getAfp(): ?string
    {
        return $this->afp;
    }

    public function setAfp(?string $afp): self
    {
        $this->afp = $afp;

        return $this;
    }

    public function getDatos(): ?DatosPersona
    {
        return $this->datos;
    }

    public function setDatos(DatosPersona $datos): self
    {
        $this->datos = $datos;

        return $this;
    }

   
    public function getUsuarioEmpleado(): ?UsuarioEmpleado
    {
        return $this->usuariosEmpleado;
    }
    public function setUsuarioEmpleado(UsuarioEmpleado $usuarioEmp): self
    {
        $this->usuariosEmpleado= $usuarioEmp;
        return $this;
    }
    

    public function getUsuariosStr(): ?string
    {
        if($this->getUsuarioEmpleado()!=null)
        return $this->getUsuarioEmpleado()->getUsername();
        else return '';
    }
    

}
