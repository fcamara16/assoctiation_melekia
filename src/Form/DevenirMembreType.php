<?php

namespace App\Form;

use App\Entity\DevenirMembre;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class DevenirMembreType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom', TextType::class, [
                'label' => 'nom',
            ])
            ->add('prenom', TextType::class, [

                'label' => 'prenom',
            ])
            ->add('email', EmailType::class, [
                'label' => 'email',
            ])
            ->add('telephone', NumberType::class, [
                'label' => 'telephone',

            ])
            ->add('presentation', TextareaType::class, [
                'label' => 'Présentez-vous',

            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => DevenirMembre::class,
        ]);
    }
}
