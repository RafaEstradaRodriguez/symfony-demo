<?php

namespace App\Form;

use App\Entity\Articulo;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ArticuloFormType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('titulo', null, ['required' => true]);
        $builder->add('descripcion',
            TextareaType::class,
            [
                'help' => 'Longitud máxima 500 caracteres',
                'label' => 'Descripción'
            ]
        );
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(['data_class' => Articulo::class]);
    }
}
