<?php

namespace App\Form;

use App\Entity\Eleve;
use App\Entity\Etablissement;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class EleveType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('anneeSuivie')
            ->add('nom')
            ->add('prenom')
            ->add('sexe' ,ChoiceType::class, ['choices' => ['H' => 'Homme',
                                                            'F' => 'Femme'],
                                              'expanded' => true,
                                              'multiple' => false])
            ->add('dateNaissance' ,DateType::class ,['widget' => 'single_text'])
            ->add('adresse')
            ->add('codePostal')
            ->add('villeDomicile')
            ->add('courriel')
            ->add('telephoneO')
            ->add('telephoneS')
            ->add('niveau', ChoiceType::class, ['choices' => ['Primaire' => 'Primaire',
                                                              'Collège' => 'Collège',
                                                              'Lycée' => 'Lycée'],
                                                'expanded' => false,
                                                'multiple' => false])
            ->add('classe')
            ->add('dureeIntervention')
            ->add('lieuIntervention')
            ->add('contact')
            ->add('contactNum')
            ->add('dateDebut' ,DateType::class ,['widget' => 'single_text'])
            ->add('dateFin' ,DateType::class ,['widget' => 'single_text'])
            ->add('certificatMedical')
            ->add('ri')
            ->add('enveloppes')
            ->add('cheques')
            ->add('professeurs')
            ->add('etablissement' ,EntityType::class, array('class' => Etablissement::class, 'choice_label' => 'nom', 'multiple' => false, 'expanded' => false))
            ->add('couleur',ChoiceType::class, ['choices' => ['Bleu' => 'Bleu',
                                                              'Rouge' => 'Rouge',
                                                              'Vert' => 'Vert'],
                                                'expanded' => false,
                                                'multiple' => false])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Eleve::class,
        ]);
    }
}
