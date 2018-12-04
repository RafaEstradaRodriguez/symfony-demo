<?php

namespace App\Entity;

use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Context\ExecutionContextInterface;

class Pelicula
{
    /**
     * @Assert\NotBlank(message="El titulo es obligatorio")
     */
    private $titulo;
    /**
     * @Assert\Length(max="500", maxMessage="Has superado la longitud máxima permitida")
     */
    private $descripcion;
    private $slug;
    /**
     * @Assert\Url(message="La url introducida no es válida")
     */
    private $imageUrl;

    private $visitas = 0;

    public static function withValues(string $titulo, string $slug, string $imageUrl, string $descripcion, $visitas)
    {
        $pelicula = new self();
        $pelicula->titulo = $titulo;
        $pelicula->descripcion = $descripcion;
        $pelicula->slug = $slug;
        $pelicula->imageUrl = $imageUrl;
        $pelicula->visitas = $visitas;

        return $pelicula;
    }

    /**
     * @param mixed $titulo
     */
    public function setTitulo($titulo): void
    {
        $this->titulo = $titulo;
    }

    /**
     * @param mixed $descripcion
     */
    public function setDescripcion($descripcion): void
    {
        $this->descripcion = $descripcion;
    }

    /**
     * @param mixed $slug
     */
    public function setSlug($slug): void
    {
        $this->slug = $slug;
    }

    /**
     * @param mixed $imageUrl
     */
    public function setImageUrl($imageUrl): void
    {
        $this->imageUrl = $imageUrl;
    }

    /**
     * @param int $visitas
     */
    public function setVisitas(int $visitas): void
    {
        $this->visitas = $visitas;
    }
    

    public function incVisitas()
    {
        $this->visitas ++;
    }

    public function decVisitas()
    {
        $this->visitas --;
    }

    public function getVisitas()
    {
        return $this->visitas;
    }

    public function getTitulo()
    {
        return $this->titulo;
    }

    public function getSlug()
    {
        return $this->slug;
    }

    public function getImageUrl()
    {
        return $this->imageUrl;
    }

    public function getDescripcion()
    {
        return $this->descripcion;
    }

    public function toArray()
    {
        return [
            $this->titulo,
            $this->slug,
            $this->imageUrl,
            $this->descripcion,
            $this->visitas
        ];
    }

    /**
     * @Assert\Callback()
     */
    public function validateSlug(ExecutionContextInterface $context, $payload) {
        if (stripos($this->slug, ' ') !== false) {
            $context->buildViolation('No puede contener espacios')
                ->atPath('slug')
                ->addViolation();
        }
    }
}
