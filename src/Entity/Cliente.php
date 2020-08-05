<?php

namespace App\Entity;

use App\Repository\ClienteRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ClienteRepository::class)
 */
class Cliente
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $Nombre;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $Apellidos;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Email;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Telefono;

    /**
     * @ORM\OneToOne(targetEntity=DatosBancarios::class, mappedBy="Cliente", cascade={"persist", "remove"})
     */
    private $datosBancarios;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNombre(): ?string
    {
        return $this->Nombre;
    }

    public function setNombre(string $Nombre): self
    {
        $this->Nombre = $Nombre;

        return $this;
    }

    public function getApellidos(): ?string
    {
        return $this->Apellidos;
    }

    public function setApellidos(string $Apellidos): self
    {
        $this->Apellidos = $Apellidos;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->Email;
    }

    public function setEmail(string $Email): self
    {
        $this->Email = $Email;

        return $this;
    }

    public function getTelefono(): ?string
    {
        return $this->Telefono;
    }

    public function setTelefono(string $Telefono): self
    {
        $this->Telefono = $Telefono;

        return $this;
    }

    public function getDatosBancarios(): ?DatosBancarios
    {
        return $this->datosBancarios;
    }

    public function setDatosBancarios(DatosBancarios $datosBancarios): self
    {
        $this->datosBancarios = $datosBancarios;

        // set the owning side of the relation if necessary
        if ($datosBancarios->getCliente() !== $this) {
            $datosBancarios->setCliente($this);
        }

        return $this;
    }
}
