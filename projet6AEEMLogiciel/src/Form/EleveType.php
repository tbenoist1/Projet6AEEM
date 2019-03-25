<?php

namespace App\Form;

use App\Entity\Eleve;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;

class EleveType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom')
            ->add('prenom')
            ->add('sexe' ,ChoiceType::class, ['choices' => ['G' => 1,
                                                            'F' => 2],
                                                'expanded' => true,
                                                'multiple' => false])
            ->add('dateNaissance' ,DateType::class ,['widget' => 'single_text'])
            ->add('anneeSuivie')
            ->add('adresse')
            ->add('codePostal')
            ->add('villeDomicile')
            ->add('courriel')
            ->add('telephoneO')
            ->add('telephoneS')
            ->add('niveau', ChoiceType::class, ['choices' => ['primaire' => 1,
                                                                'collège' => 2,
                                                                'lycée' => 3],
                                                'expanded' => false,
                                                'multiple' => false])
            ->add('classe')
            ->add('dureeIntervention')
            ->add('lieuIntervention')
            ->add('contact')
            ->add('contactNum')
            ->add('dateDebut' ,DateType::class ,['widget' => 'single_text'])
            ->add('dateFin' ,DateType::class ,['widget' => 'single_text'])
            ->add('certificatMedical', CheckboxType::class, ['choices' => ['certificatMedical' => 1,
                                                                        'ri' => 2,
                                                                        'enveloppes' => 3,
                                                                        'chèques' => 4],
                                                            'label' => ' ',
                                                            'expanded' => true,
                                                            'multiple' => true])
            //->add('professeurs')
            //->add('etablissement' ,EntityType::class, array('class' => Etablissement::class, 'choice_label' => 'nom', 'multiple' => false, 'expanded' => false))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Eleve::class,
        ]);
    }
}
