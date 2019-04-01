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
<<<<<<< HEAD
=======
//ttttttt
>>>>>>> 3b848b66abf22f29de2546f56f6fd485a9ed3064
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
<<<<<<< HEAD
            ->add('voiture')
            ->add('cv')
            ->add('cj')
            ->add('commentaires')
            //->add('eleves')
            ;
=======
            ->add('voiture')        
            ->add('cv')
            ->add('cj')
            ->add('commentaires')       
            //->add('eleves') 
            ;        
>>>>>>> 3b848b66abf22f29de2546f56f6fd485a9ed3064
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Professeur::class,
        ]);
    }
}
