<?php

namespace App\Form;

use App\Entity\Cliente;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ClienteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('rut')
            ->add('nombres')
            ->add('apellidos')
            ->add('domicilio')
            ->add('telefono1')
            ->add('telefono2')
            ->add('celular')
            ->add('email1')
            ->add('email2')
            ->add('representante')
            ->add('relacion')
            ->add('razonSocial')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Cliente::class,
        ]);
    }
}
