<?php

namespace App\Entity;

use App\Repository\DatosBancariosRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=DatosBancariosRepository::class)
 */
class DatosBancarios
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    //private $id;

    /**
     * @ORM\Id()
     * @ORM\OneToOne(targetEntity=Cliente::class, inversedBy="datosBancarios", cascade={"persist", "remove"})
     * @ORM\JoinColumn(referencedColumnName="id", name="cliente_id", nullable=false)
     */
    private $Cliente;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $IBAN;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $DireccionFacturacion;

    /**
     * @ORM\Column(type="string", length=10, nullable=true)
     */
    private $DNI;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCliente(): ?Cliente
    {
        return $this->Cliente;
    }

    public function setCliente(Cliente $Cliente): self
    {
        $this->Cliente = $Cliente;

        return $this;
    }

    public function getIBAN(): ?string
    {
        return $this->IBAN;
    }

    public function setIBAN(string $IBAN): self
    {
        $this->IBAN = $IBAN;

        return $this;
    }

    public function getDireccionFacturacion(): ?string
    {
        return $this->DireccionFacturacion;
    }

    public function setDireccionFacturacion(?string $DireccionFacturacion): self
    {
        $this->DireccionFacturacion = $DireccionFacturacion;

        return $this;
    }

    public function getDNI(): ?string
    {
        return $this->DNI;
    }

    public function setDNI(?string $DNI): self
    {
        $this->DNI = $DNI;

        return $this;
    }
}
