<?php

namespace App\Entity;

//use App\Repository\DatosPersonaRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=DatosPersonaRepository::class)
 */
class DatosPersona
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $nombre;

    /**
     * @ORM\Column(type="string", length=20, nullable=false , unique=true)
     */
    private $dui;

    /**
     * @ORM\Column(type="string", length=17, nullable=true)
     */
    private $nit;

    /**
     * @ORM\Column(type="string", length=200, nullable=true)
     */
    private $direccion;

    /**
     * @ORM\Column(type="string", length=15, nullable=true)
     */
    private $telefono;

    /**
     * @ORM\Column(type="string", length=15, nullable=true)
     */
    private $celular;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $fechaNacimiento;

    /**
     * @ORM\Column(type="string", length=45, nullable=true)
     */
    private $correo1;

    /**
     * @ORM\Column(type="string", length=45, nullable=true)
     */
    private $correo2;

    /**
     * @ORM\Column(type="string", length=35, nullable=true)
     */
    private $apellido;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $estado;


    /**
     * @ORM\Column(type="string", length=60, nullable=true)
     */
    private $foto;

    /**
     * @ORM\Column(type="string", length=15, nullable=true)
     */
    private $pasaporte;

    /**
     * @ORM\Column(type="string", length=400, nullable=true)
     */
    private $giro;

    /**
     * @ORM\Column(type="string", length=15, nullable=true)
     */
    private $ncr;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $documentos;

    /**
     * @ORM\OneToOne(targetEntity=PersonaCliente::class, mappedBy="datos", cascade={"persist", "remove"})
     */
    private $personaCliente;

    /**
     * @ORM\Column(type="string", length=15, nullable=true)
     */
    private $registroIva;

    /**
     * @ORM\Column(type="string", length=35, nullable=true)
     */
    private $nombreIva;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $documentos2;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $documentos3;




   
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

    public function getDui(): ?string
    {
        return $this->dui;
    }

    public function setDui(string $dui): self
    {
        $this->dui = $dui;

        return $this;
    }

    public function getNit(): ?string
    {
        return $this->nit;
    }

    public function getCliente(): ?string
    {
        $datos="";
        if($this->getDui()==null ){
            $datos=$this->getNit()."-".$this->getNombre();
        }else{
            $datos=$this->getDui()."-".$this->getNombre();
        }
        return $datos;
    }

    public function setNit(?string $nit): self
    {
        $this->nit = $nit;

        return $this;
    }

    public function getDireccion(): ?string
    {
        return $this->direccion;
    }

    public function setDireccion(string $direccion): self
    {
        $this->direccion = $direccion;

        return $this;
    }

    public function getTelefono(): ?string
    {
        return $this->telefono;
    }

    public function setTelefono(?string $telefono): self
    {
        $this->telefono = $telefono;

        return $this;
    }

    public function getCelular(): ?string
    {
        return $this->celular;
    }

    public function setCelular(?string $celular): self
    {
        $this->celular = $celular;

        return $this;
    }

    public function getFechaNacimiento(): ?\DateTimeInterface
    {
        return $this->fechaNacimiento;
    }

    public function setFechaNacimiento(?\DateTimeInterface $fechaNacimiento): self
    {
        $this->fechaNacimiento = $fechaNacimiento;

        return $this;
    }

    public function getCorreo1(): ?string
    {
        return $this->correo1;
    }

    public function setCorreo1(?string $correo1): self
    {
        $this->correo1 = $correo1;

        return $this;
    }

    public function getCorreo2(): ?string
    {
        return $this->correo2;
    }

    public function setCorreo2(?string $correo2): self
    {
        $this->correo2 = $correo2;

        return $this;
    }

    public function getApellido(): ?string
    {
        return $this->apellido;
    }

    public function setApellido(?string $apellido): self
    {
        $this->apellido = $apellido;

        return $this;
    }

    public function getEstado(): ?int
    {
        return $this->estado;
    }

    public function setEstado(?int $estado): self
    {
        $this->estado = $estado;

        return $this;
    }

    public function getFoto(): ?string
    {
        return $this->foto;
    }

    public function setFoto(?string $foto): self
    {
        $this->foto = $foto;

        return $this;
    }

    public function getPasaporte(): ?string
    {
        return $this->pasaporte;
    }

    public function setPasaporte(?string $pasaporte): self
    {
        $this->pasaporte = $pasaporte;

        return $this;
    }

    public function getGiro(): ?string
    {
        return $this->giro;
    }

    public function setGiro(?string $giro): self
    {
        $this->giro = $giro;

        return $this;
    }

    public function getNcr(): ?string
    {
        return $this->ncr;
    }

    public function setNcr(?string $ncr): self
    {
        $this->ncr = $ncr;

        return $this;
    }

    public function getDocumentos(): ?string
    {
        return $this->documentos;
    }

    public function setDocumentos(?string $documentos): self
    {
        $this->documentos = $documentos;

        return $this;
    }

    public function getPersonaCliente(): ?PersonaCliente
    {
        return $this->personaCliente;
    }

    public function setPersonaCliente(PersonaCliente $personaCliente): self
    {
        $this->personaCliente = $personaCliente;

        // set the owning side of the relation if necessary
        if ($personaCliente->getDatos() !== $this) {
            $personaCliente->setDatos($this);
        }

        return $this;
    }

    public function getRegistroIva(): ?string
    {
        return $this->registroIva;
    }

    public function setRegistroIva(?string $registroIva): self
    {
        $this->registroIva = $registroIva;

        return $this;
    }

    public function getNombreIva(): ?string
    {
        return $this->nombreIva;
    }

    public function setNombreIva(?string $nombreIva): self
    {
        $this->nombreIva = $nombreIva;

        return $this;
    }

    public function getDocumentos2(): ?string
    {
        return $this->documentos2;
    }

    public function setDocumentos2(?string $documentos2): self
    {
        $this->documentos2 = $documentos2;

        return $this;
    }

    public function getDocumentos3(): ?string
    {
        return $this->documentos3;
    }

    public function setDocumentos3(string $documentos3): self
    {
        $this->documentos3 = $documentos3;

        return $this;
    }

}
