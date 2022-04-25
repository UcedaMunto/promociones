<?php

namespace App\Entity;

use App\Repository\TipoEmpleadoRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TipoEmpleadoRepository::class)
 */
class TipoEmpleado
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nombre;

    /**
     * @ORM\Column(type="string", length=25, nullable=true)
     */
    private $rol;

    /**
     * @ORM\Column(type="string", length=250, nullable=true)
     */
    private $descripcion;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNombre(): ?string
    {
        return $this->nombre;
    }

    public function __tostring(): ?string
    {
        return $this->nombre;
    }

    public function setNombre(string $nombre): self
    {
        $this->nombre = $nombre;

        return $this;
    }

    public function getRol(): ?string
    {
        return $this->rol;
    }

    public function setRol(?string $rol): self
    {
        $this->rol = $rol;

        return $this;
    }

    public function getDescripcion(): ?string
    {
        return $this->descripcion;
    }

    public function setDescripcion(?string $descripcion): self
    {
        $this->descripcion = $descripcion;

        return $this;
    }

}
