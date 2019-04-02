<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\EleveRepository")
 */
class Eleve
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $prenom;

    /**
     * @ORM\Column(type="string", length=15)
     */
    private $sexe;

    /**
     * @ORM\Column(type="datetime")
     */
    private $dateNaissance;

    /**
     * @ORM\Column(type="string", length=10)
     */
    private $anneeSuivie;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $adresse;

    /**
     * @ORM\Column(type="string", length=10)
     */
    private $codePostal;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $villeDomicile;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $courriel;

    /**
     * @ORM\Column(type="string", length=20)
     */
    private $telephoneO;

    /**
     * @ORM\Column(type="string", length=20, nullable=true)
     */
    private $telephoneS;

    /**
     * @ORM\Column(type="string", length=20)
     */
    private $niveau;

    /**
     * @ORM\Column(type="string", length=20)
     */
    private $classe;

    /**
     * @ORM\Column(type="string", length=30)
     */
    private $dureeIntervention;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $lieuIntervention;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $contact;

    /**
     * @ORM\Column(type="string", length=20)
     */
    private $contactNum;

    /**
     * @ORM\Column(type="datetime")
     */
    private $dateDebut;

    /**
     * @ORM\Column(type="datetime")
     */
    private $dateFin;

    /**
     * @ORM\Column(type="boolean")
     */
    private $certificatMedical;

    /**
     * @ORM\Column(type="boolean")
     */
    private $ri;

    /**
     * @ORM\Column(type="boolean")
     */
    private $enveloppes;

    /**
     * @ORM\Column(type="boolean")
     */
    private $cheques;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Professeur", inversedBy="eleves")
     */
    private $professeurs;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Etablissement", inversedBy="eleves")
     * @ORM\JoinColumn(nullable=false)
     */
    private $etablissement;

    /**
     * @ORM\Column(type="string", length=10)
     */
    private $couleur;

    public function __construct()
    {
        $this->professeurs = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getSexe(): ?string
    {
        return $this->sexe;
    }

    public function setSexe(string $sexe): self
    {
        $this->sexe = $sexe;

        return $this;
    }

    public function getDateNaissance(): ?\DateTimeInterface
    {
        return $this->dateNaissance;
    }

    public function setDateNaissance(\DateTimeInterface $dateNaissance): self
    {
        $this->dateNaissance = $dateNaissance;

        return $this;
    }

    public function getAnneeSuivie(): ?string
    {
        return $this->anneeSuivie;
    }

    public function setAnneeSuivie(string $anneeSuivie): self
    {
        $this->anneeSuivie = $anneeSuivie;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(string $adresse): self
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getCodePostal(): ?string
    {
        return $this->codePostal;
    }

    public function setCodePostal(string $codePostal): self
    {
        $this->codePostal = $codePostal;

        return $this;
    }

    public function getVilleDomicile(): ?string
    {
        return $this->villeDomicile;
    }

    public function setVilleDomicile(string $villeDomicile): self
    {
        $this->villeDomicile = $villeDomicile;

        return $this;
    }

    public function getCourriel(): ?string
    {
        return $this->courriel;
    }

    public function setCourriel(string $courriel): self
    {
        $this->courriel = $courriel;

        return $this;
    }

    public function getTelephoneO(): ?string
    {
        return $this->telephoneO;
    }

    public function setTelephoneO(string $telephoneO): self
    {
        $this->telephoneO = $telephoneO;

        return $this;
    }

    public function getTelephoneS(): ?string
    {
        return $this->telephoneS;
    }

    public function setTelephoneS(?string $telephoneS): self
    {
        $this->telephoneS = $telephoneS;

        return $this;
    }

    public function getNiveau(): ?string
    {
        return $this->niveau;
    }

    public function setNiveau(string $niveau): self
    {
        $this->niveau = $niveau;

        return $this;
    }

    public function getClasse(): ?string
    {
        return $this->classe;
    }

    public function setClasse(string $classe): self
    {
        $this->classe = $classe;

        return $this;
    }

    public function getDureeIntervention(): ?string
    {
        return $this->dureeIntervention;
    }

    public function setDureeIntervention(string $dureeIntervention): self
    {
        $this->dureeIntervention = $dureeIntervention;

        return $this;
    }

    public function getLieuIntervention(): ?string
    {
        return $this->lieuIntervention;
    }

    public function setLieuIntervention(string $lieuIntervention): self
    {
        $this->lieuIntervention = $lieuIntervention;

        return $this;
    }

    public function getContact(): ?string
    {
        return $this->contact;
    }

    public function setContact(string $contact): self
    {
        $this->contact = $contact;

        return $this;
    }

    public function getContactNum(): ?string
    {
        return $this->contactNum;
    }

    public function setContactNum(string $contactNum): self
    {
        $this->contactNum = $contactNum;

        return $this;
    }

    public function getDateDebut(): ?\DateTimeInterface
    {
        return $this->dateDebut;
    }

    public function setDateDebut(\DateTimeInterface $dateDebut): self
    {
        $this->dateDebut = $dateDebut;

        return $this;
    }

    public function getDateFin(): ?\DateTimeInterface
    {
        return $this->dateFin;
    }

    public function setDateFin(\DateTimeInterface $dateFin): self
    {
        $this->dateFin = $dateFin;

        return $this;
    }

    public function getCertificatMedical(): ?bool
    {
        return $this->certificatMedical;
    }

    public function setCertificatMedical(bool $certificatMedical): self
    {
        $this->certificatMedical = $certificatMedical;

        return $this;
    }

    public function getRi(): ?bool
    {
        return $this->ri;
    }

    public function setRi(bool $ri): self
    {
        $this->ri = $ri;

        return $this;
    }

    public function getEnveloppes(): ?bool
    {
        return $this->enveloppes;
    }

    public function setEnveloppes(bool $enveloppes): self
    {
        $this->enveloppes = $enveloppes;

        return $this;
    }

    public function getCheques(): ?bool
    {
        return $this->cheques;
    }

    public function setCheques(bool $cheques): self
    {
        $this->cheques = $cheques;

        return $this;
    }

    /**
     * @return Collection|Professeur[]
     */
    public function getProfesseurs(): Collection
    {
        return $this->professeurs;
    }

    public function addProfesseur(Professeur $professeur): self
    {
        if (!$this->professeurs->contains($professeur)) {
            $this->professeurs[] = $professeur;
        }

        return $this;
    }

    public function removeProfesseur(Professeur $professeur): self
    {
        if ($this->professeurs->contains($professeur)) {
            $this->professeurs->removeElement($professeur);
        }

        return $this;
    }

    public function getEtablissement(): ?Etablissement
    {
        return $this->etablissement;
    }

    public function setEtablissement(?Etablissement $etablissement): self
    {
        $this->etablissement = $etablissement;

        return $this;
    }

    public function __toString(){
        return $this->getNom();
    }

<<<<<<< HEAD
    public function getCouleur(): ?string
    {
        return $this->couleur;
    }

    public function setCouleur(string $couleur): self
    {
        $this->couleur = $couleur;

        return $this;
    }   
=======
>>>>>>> 1e66edeea8066a93928115773b881a064a6c439a
}
