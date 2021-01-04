<?php

namespace App\Form;

use App\Entity\DatosUnidad;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DatosUnidadType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('metros2', IntegerType::class, ['help' => 'Por favor Introduzca valor numerico', 'label' => 'Metros Cuadrados'])
            ->add('dormitorios', IntegerType::class, ['help' => 'Por favor Introduzca valor numerico', 'label' => 'Dormitorios'])
            ->add('banios', IntegerType::class, ['help' => 'Por favor Introduzca valor numerico', 'label' => 'Baños'])
            ->add('direccion', TextType::class)
            ->add('detalle', TextareaType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => DatosUnidad::class,
            'attr' => [
                'novalidate' => 'novalidate', // comment me to reactivate the html5 validation!  🚥
            ]
        ]);
    }
}
