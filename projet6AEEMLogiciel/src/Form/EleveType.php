<?php

namespace App\Form;

use App\Entity\Eleve;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EleveType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom')
            ->add('prenom')
            ->add('sexe')
            ->add('dateNaissance')
            ->add('anneeSuivie')
            ->add('adresse')
            ->add('codePostal')
            ->add('villeDomicile')
            ->add('courriel')
            ->add('telephoneO')
            ->add('telephoneS')
            ->add('niveau')
            ->add('classe')
            ->add('dureeIntervention')
            ->add('lieuIntervention')
            ->add('contact')
            ->add('contactNum')
            ->add('dateDebut')
            ->add('dateFin')
            ->add('certificatMedical')
            ->add('ri')
            ->add('enveloppes')
            ->add('cheques')
            //->add('professeurs')
            //->add('etablissement')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Eleve::class,
        ]);
    }
}
