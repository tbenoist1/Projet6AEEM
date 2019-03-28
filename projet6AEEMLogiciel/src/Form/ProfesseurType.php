<?php

namespace App\Form;

use App\Entity\Professeur;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class ProfesseurType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom')
            ->add('prenom')
            ->add('adresse')
            ->add('codePostal')
            ->add('villeDomicile')
            ->add('courriel')
            ->add('telephoneO')
            ->add('telephoneS')
            ->add('situationActuelle')
            ->add('matieres')
            ->add('niveau', ChoiceType::class, ['choices' => ['Primaire' => 1,
                                                              'Collège' => 2,
                                                              'Lycée' => 3],
                                                'expanded' => false,
                                                'multiple' => false])
            ->add('zonesInterventions', ChoiceType::class, ['choices' => ['BAB' => 1,
                                                            'Pays Basque Intérieur' => 2,
                                                            'Sud Pays Basque' => 3,
                                                            'Sud Landes' => 4],
                                                'expanded' => true,
                                                'multiple' => true])
            ->add('lieuxInterventions', ChoiceType::class, ['choices' => ['Domicile' => 1,
                                                                      'Hôpital' => 2],
                                                'expanded' => true,
                                                'multiple' => true])
            ->add('toutesMaladies', ChoiceType::class, ['choices' => ['Oui' => 1,
                                                                      'Non' => 2],
                                                'expanded' => true,
                                                'multiple' => false])
            ->add('voiture', ChoiceType::class, ['choices' => ['Oui' => 1,
                                                               'Non' => 2],
                                                'expanded' => true,
                                                'multiple' => false])
            ->add('cv')
            ->add('cj')
            ->add('commentaires')

    ;        //->add('eleves')        
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Professeur::class,
        ]);
    }
}
