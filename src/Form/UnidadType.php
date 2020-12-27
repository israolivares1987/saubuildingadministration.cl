<?php

namespace App\Form;

use App\Entity\Unidad;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UnidadType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('edificio', TextType::class, ['help' => 'Por favor Introduzca valor'])
            ->add('piso', IntegerType::class, ['help' => 'Por favor Introduzca valor'])
            ->add('unidad', TextType::class, ['help' => 'Por favor Introduzca valor'])
            ->add('tipoUnidad')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Unidad::class,
            'attr' => [
                'novalidate' => 'novalidate', // comment me to reactivate the html5 validation!  🚥
            ]
        ]);
    }
}
