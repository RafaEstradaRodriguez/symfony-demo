<?php

namespace App\Entity;

use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Context\ExecutionContextInterface;

class Pelicula
{
    /**
     * @Assert\NotBlank(message="El titulo es obligatorio")
     */
    public $titulo;
    /**
     * @Assert\Length(max="500", maxMessage="Has superado la longitud máxima permitida")
     */
    public $descripcion;
    public $slug;
    /**
     * @Assert\Url(message="La url introducida no es válida")
     */
    public $imageUrl;
    public $visitas = 0;

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

    public static function getFakePeliculas()
    {
        return [
            new Pelicula('Alien', 'alien', 'https://images-na.ssl-images-amazon.com/images/I/615Jt--UndL._SY606_.jpg', 'Tras acudir a una llamada de ayuda, la tripulación (Tom Skerritt, Sigourney Weaver, John Hurt) encuentra una voraz y horrible criatura abordo de una nave espacial.'),
            new Pelicula('Amelie', 'amelie', 'https://faros.hsjdbcn.org/sites/default/files/styles/ficha-contenido/public/amelie1.png?itok=IKMOBstp', 'El hallazgo de un tesoro olvidado pone a una camarera parisina a cuestionar, y alterar la vida de quienes la rodean.'),
            new Pelicula('Los Vengadores', 'los-vengadores', 'https://is2-ssl.mzstatic.com/image/thumb/Video118/v4/04/6a/b4/046ab45e-6099-3e1a-ccef-7b3f8b07f057/contsched.sumsaanu.lsr/268x0w.jpg', 'Cuando el hermano de Thor, Loki, logra acceder al poder ilimitado del Cubo Cósmico, Nick Fury, director de la agencia para mantener la paz internacional, inicia el reclutamiento de unos superhéroes para vencer una amenaza sin precedente contra la Tierra.'),
            new Pelicula('El Gran lebowski', 'el-gran-lebowski', 'https://mlstaticquic-a.akamaihd.net/S_515611-MLU20594068225_022016-O.jpg', 'Un desempleado es confundido por unos matones con el millonario Jeff Lebowski, quien se llama igual que él y a cuya esposa han secuestrado. Cuando acude a casa del millonario para quejarse, éste decide contratarlo para rescatar a su esposa a cambio de una recompensa.'),
            new Pelicula('Interstellar', 'interstellar', 'https://musicimage.xboxlive.com/catalog/video.movie.8D6KGX014R0F/image?locale=en-us&mode=crop&purposes=BoxArt&q=90&h=300&w=200&format=jpg', 'Un grupo de exploradores hacen uso de un orificio recién descubierto para superar las limitaciones de los viajes espaciales humanos y conquistar las vastas distancias relacionadas con los viajes interestelares.')
        ];
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
