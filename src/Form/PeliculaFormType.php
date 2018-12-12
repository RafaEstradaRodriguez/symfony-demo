<?php

namespace App\Form;


use App\Entity\Pelicula;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PeliculaFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('titulo');
        $builder->add('descripcion',
            TextareaType::class,
            [
                'help' => 'Máximo de 500 caracteres'
            ]
        );
        $builder->add('imageUrl');
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(['data_class' => Pelicula::class]);
    }

}
