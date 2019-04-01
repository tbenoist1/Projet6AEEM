<?php

namespace App\Form;

use App\Entity\Mairie;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class MairieType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('ville')
            ->add('codePostal')
            ->add('zone', ChoiceType::class, ['choices' => ['BAB' => 'BAB',
                                                            'Pays Basque Intérieur' => 'Pays Basque Intérieur',
                                                            'Sud Pays Basque' => 'Sud Pays Basque',
<<<<<<< HEAD
                                                            'Sud Landes' => 'Sud Landes'],
                                              'expanded' => false,
                                              'multiple' => false])
=======
                                                            'Sud Landes' => 'Sud Landes']])
>>>>>>> 3b848b66abf22f29de2546f56f6fd485a9ed3064
            ->add('lienDossier')
            ->add('courriel')
            ->add('telephone')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Mairie::class,
        ]);
    }
}
