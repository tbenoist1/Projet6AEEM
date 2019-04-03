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
            ->add('situationActuelle', ChoiceType::class, ['choices'  => ['Actif' => 'Actif',
                                                                          'Retraité' => 'Retraité'],
                                                            'expanded' => true,
                                                            'multiple' => false])
<<<<<<< HEAD
            //->add('matieres')
=======
>>>>>>> 48ceb4b8036da3e2a4f909d6d757bdb1839a9c39
            ->add('niveau', ChoiceType::class, ['choices' => ['Primaire' => 'Primaire',
                                                              'Collège' => 'Collège',
                                                              'Lycée' => 'Lycée'],
                                                'expanded' => false,
                                                'multiple' => false])
            ->add('zonesInterventions', ChoiceType::class, ['choices'  => ['BAB' => 'BAB',
                                                                           'Pays Basque Intérieur' => 'Pays Basque Intérieur',
                                                                           'Sud Pays Basque' => 'Sud Pays Basque',
                                                                           'Sud Landes' => 'Sud Landes'],
                                                            'expanded' => true,
                                                            'multiple' => true])
            ->add('lieuxInterventions', ChoiceType::class, ['choices'  => ['Domicile' => 'Domicile',
                                                                           'Hôpital' => 'Hôpital'],
                                                            'expanded' => true,
                                                            'multiple' => true])
            ->add('toutesMaladies', ChoiceType::class, ['choices'  => ['Oui' => true,
                                                                       'Non' => false],
                                                            'expanded' => true,
                                                            'multiple' => false])
            ->add('voiture', ChoiceType::class, ['choices'  => ['Oui' => true,
                                                                'Non' => false],
                                                            'expanded' => true,
                                                            'multiple' => false])
            ->add('cv')
            ->add('cj')
            ->add('commentaires')
            ->add('matiere1')
            ->add('matiere2')
            //->add('eleves')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Professeur::class,
        ]);
    }
}
