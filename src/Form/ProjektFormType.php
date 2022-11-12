<?php

namespace App\Form;

use App\Entity\Projekt;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class ProjektFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('pro_bez',TextType::class,[
                'attr' => array(
                    'class' => 'bg-transparent block border-b-2 w-full h-20 text-6xl outline-none',
                    'placeholder' => 'Projektname eingeben...',
                ),
                'label' => false,
            ])

            ->add('erst_datum',DateType::class,[
                'attr' => array(
                    'class' => 'bg-transparent block border-b-2 w-full h-20 text-6xl outline-none',
                    'placeholder' => 'Startdatum eingeben',
                ),
                'label' => false,
            ] )

           /*} ->add('bild_path',FileType::class,[
                'attr' => array(
                    'class' => 'py-10'
                ),
                'label' => false,
            ])
            */

            ->add('pro_beschreibung',TextareaType::class,[
                'attr' => array(
                    'class' => 'bg-transparent block border-b-2 w-full h-60 text-6xl outline-none',
                    'placeholder' => 'Projektbeschreibung eingeben...',
                ),
                'label' => false,
            ])

            //->add('benutzer')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Projekt::class,
        ]);
    }
}
