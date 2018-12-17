<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Gedmo\Mapping\Annotation as Gedmo;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Context\ExecutionContextInterface;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PeliculaRepository")
 */
class Pelicula
{
    use TimestampableEntity;
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @Assert\NotBlank(message="El titulo es obligatorio")
     * @ORM\Column(type="string", length=100)
     * @Groups("main")
     */
    private $titulo;

    /**
     * @Assert\Length(max="500", maxMessage="Has superado la longitud máxima permitida")
     * @ORM\Column(type="string", length=500)
     * @Groups("main")
     */
    private $descripcion;

    /**
     * @ORM\Column(type="string", length=100)
     * @Gedmo\Slug(fields={"titulo"})
     */
    private $slug;

    /**
     * @Assert\Url(message="La url introducida no es válida")
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $imageUrl;

    /**
     * * @ORM\Column(type="integer")
     */
    private $visitas = 0;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Tag", mappedBy="peliculas")
     */
    private $tags;

    public function __construct()
    {
        $this->tags = new ArrayCollection();
    }

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

    public function getId(): ?int
    {
        return $this->id;
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

    /**
     * @return Collection|Tag[]
     */
    public function getTags(): Collection
    {
        return $this->tags;
    }

    public function addTag(Tag $tag): self
    {
        if (!$this->tags->contains($tag)) {
            $this->tags[] = $tag;
            $tag->addPelicula($this);
        }

        return $this;
    }

    public function removeTag(Tag $tag): self
    {
        if ($this->tags->contains($tag)) {
            $this->tags->removeElement($tag);
            $tag->removePelicula($this);
        }

        return $this;
    }
}
