<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Alumno
 *
 * @ORM\Table(name="alumno", indexes={@ORM\Index(name="id_usuario", columns={"id_usuario"})})
 * @ORM\Entity
 */
class Alumno
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="codigo", type="string", length=9, nullable=false)
     */
    private $codigo;

    /**
     * @var int
     *
     * @ORM\Column(name="id_carrera", type="integer", nullable=false)
     */
    private $idCarrera;

    /**
     * @var \User
     *
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_usuario", referencedColumnName="id")
     * })
     */
    private $idUsuario;

    public function getId(): ?int
    {
        return $this->id;
    }


    public function getCodigo(): ?string
    {
        return $this->codigo;
    }

    public function setCodigo(string $codigo): self
    {
        $this->codigo = $codigo;

        return $this;
    }



    public function getIdCarrera(): ?int
    {
        return $this->idCarrera;
    }

    public function setIdCarrera(int $idCarrera): self
    {
        $this->idCarrera = $idCarrera;

        return $this;
    }

    public function getIdUsuario(): ?User
    {
        return $this->idUsuario;
    }

    public function setIdUsuario(?User $idUsuario): self
    {
        $this->idUsuario = $idUsuario;

        return $this;
    }


}
