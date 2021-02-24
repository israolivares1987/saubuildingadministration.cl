<?php

namespace App\Form;

use App\Entity\Conjunto;
use App\Entity\Unidad;
use App\Form\DatosUnidadType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
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
            ->add('conjunto', EntityType::class, [
                'class' => Conjunto::class,
                'choice_label' => 'nombre',
                'placeholder' => 'Seleccione...',
                'label' => 'Conjunto o Edificio',
                'help' => 'Seleccione una opción'
            ])
            ->add('piso', IntegerType::class, ['help' => 'Por favor Introduzca valor'])
            ->add('unidad', TextType::class, ['help' => 'Por favor Introduzca valor'])
            ->add('tipoUnidad', null, ['help' => 'Seleccione una opción'])
            ->add('estado', null, [
                'label' => 'Activo / Inactivo',
                'help' => 'Seleccionado = Activo'
            ])
            ->add('datosUnidad', DatosUnidadType::class)
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
