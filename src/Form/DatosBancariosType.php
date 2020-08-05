<?php

namespace App\Form;

use App\Entity\DatosBancarios;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DatosBancariosType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('IBAN')
            ->add('DireccionFacturacion', TextType::class, ["required" => false])
            ->add('DNI',TextType::class, ["required" => false])
            ->add('save', SubmitType::class, ["label" => "Guardar Cambios"])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => DatosBancarios::class,
        ]);
    }
}
