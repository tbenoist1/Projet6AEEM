<?php

namespace App\Form;

use App\Entity\Etablissement;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class EtablissementType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom')
            ->add('type', ChoiceType::class, ['choices' => ['Primaire' => 'Primaire',
                                                            'Collège' => 'Collège',
                                                            'Lycée' => 'Lycée'],
                                              'expanded' => false,
                                              'multiple' => false])
            ->add('adresse')
            ->add('codePostal')
            ->add('ville')
            ->add('courriel')
            ->add('telephone')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Etablissement::class,
        ]);
    }
}
