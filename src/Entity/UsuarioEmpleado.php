<?php

namespace App\Entity;

//use App\Repository\UsuarioEmpleadoRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass=UsuarioEmpleadoRepository::class)
 * @ORM\HasLifecycleCallbacks()
*/
class UsuarioEmpleado implements UserInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=200)
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=20)
     */
    private $usuario;

    /**
     * @ORM\Column(type="date")
     */
    private $creacion;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $actualizacion;



    /**
     * @ORM\OneToOne(targetEntity=PersonaEmpleado::class, inversedBy="usuariosEmpleado")
     * @ORM\JoinColumn(nullable=true)
     */
    private $empleado;

    /**
     * @ORM\ManyToMany(targetEntity=TipoEmpleado::class)
     */
    private $rolesEmpleado;

    public function __toString(){
        return $this->getUsuario();
    }
    
    public function __construct()
    {
        $this->rolesEmpleado = new ArrayColection();
    }


    /**
     * @see UserInterface
    */
    public function getRoles(): array
    {
        $roles = array();
        $temps= $this->getRolesEmpleado();
        foreach( $temps as $temp){
            array_push ($roles , $temp->getRol() );
        }
    
        return array_unique($roles);
    }
    /**
     * @see UserInterface
    */
    public function getUsername(): ?string
    {
        return $this->usuario;
    }
    /**
     * @see UserInterface
     */
    public function getSalt()
    {
        // not needed for apps that do not check user passwords
    }
    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getUsuario(): ?string
    {
        return $this->usuario;
    }

    public function setUsuario(string $usuario): self
    {
        $this->usuario = $usuario;

        return $this;
    }

    public function getCreacion(): ?\DateTimeInterface
    {
        return $this->creacion;
    }

    /**
     * Set creacion
     *
     * @param \DateTime $creacion
     * @ORM\PrePersist
     * @return UsuarioEmpleado
     */
    public function setCreacion()
    {
        if(!$this->creacion){
            $this->creacion = new \DateTime();
        }
        return $this;
    }

    /**
     * Set actualizacion
     *
     * @param \DateTime $actualizacion
     * @ORM\PreUpdate
     * @return UsuarioEmpleado
     */
    public function setFechaUpdate()
    {
        if(!$this->actualizacion){
            $this->actualizacion = new \DateTime();
        }
        return $this;
    }

    public function getActualizacion(): ?\DateTimeInterface
    {
        return $this->actualizacion;
    }

    public function setActualizacion(?\DateTimeInterface $actualizacion): self
    {
        $this->actualizacion = $actualizacion;

        return $this;
    }

    public function getEmpleado(): ?PersonaEmpleado
    {
        return $this->empleado;
    }

    public function setEmpleado(?PersonaEmpleado $empleado): self
    {
        $this->empleado = $empleado;

        return $this;
    }

    /**
     * @return Collection|TipoEmpleado[]
     */
    public function getRolesEmpleado(): Collection
    {
        return $this->rolesEmpleado;
    }

    public function addRolesEmpleado(TipoEmpleado $rolesEmpleado): self
    {
        //dump($rolesEmpleado); die;
        if (!$this->rolesEmpleado->contains($rolesEmpleado)) {
            $this->rolesEmpleado[] = $rolesEmpleado;
        }

        return $this;
    }


    public function removeRolesEmpleado(TipoEmpleado $rolesEmpleado): self
    {
        $this->rolesEmpleado->removeElement($rolesEmpleado);

        return $this;
    }


    /**
     * @return Collection|ActivoFijo[]
     */
    public function getActivo(): Collection
    {
        return $this->activo;
    }

    public function addActivo(Activo $activo): self
    {
        if (!$this->activo->contains($activo)) {
            $this->activo[] = $activo;
            $activo->setResponsable($this);
        }

        return $this;
    }

    public function removeActivoFijo(Activo $activo): self
    {
        if ($this->activo->removeElement($activo)) {
            // set the owning side to null (unless already changed)
            if ($activo->getResponsable() === $this) {
                $activo->setResponsable(null);
            }
        }

        return $this;
    }



}
