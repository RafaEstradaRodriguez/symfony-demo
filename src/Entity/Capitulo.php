<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CapituloRepository")
 */
class Capitulo
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $titulo;

    /**
     * @ORM\Column(type="float")
     */
    private $valoracion;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Serie", inversedBy="capitulos")
     * @ORM\JoinColumn(nullable=false)
     */
    private $serie;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitulo(): ?string
    {
        return $this->titulo;
    }

    public function setTitulo(string $titulo): self
    {
        $this->titulo = $titulo;

        return $this;
    }

    public function getValoracion(): ?float
    {
        return $this->valoracion;
    }

    public function setValoracion(float $valoracion): self
    {
        $this->valoracion = $valoracion;

        return $this;
    }

    public function getSerie(): ?Serie
    {
        return $this->serie;
    }

    public function setSerie(?Serie $serie): self
    {
        $this->serie = $serie;

        return $this;
    }
}
