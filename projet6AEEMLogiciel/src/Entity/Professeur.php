<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ProfesseurRepository")
 */
class Professeur
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     * @Assert\NotBlank
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=50)
     * @Assert\NotBlank
     */
    private $prenom;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank
     */
    private $adresse;

    /**
     * @ORM\Column(type="string", length=10)
     * @Assert\NotBlank     
     * @Assert\Regex(pattern = "#[0-9]{5}#", message="Il semble y avoir un problème avec le code postal")
     */
    private $codePostal;

    /**
     * @ORM\Column(type="string", length=100)
     * @Assert\NotBlank
     */
    private $villeDomicile;

    /**
     * @ORM\Column(type="string", length=50)
     * @Assert\Email
     */
    private $courriel;

    /**
     * @ORM\Column(type="string", length=20)
     * @Assert\NotBlank
     */
    private $telephoneO;

    /**
     * @ORM\Column(type="string", length=20, nullable=true)
     */
    private $telephoneS;

    /**
     * @ORM\Column(type="string", length=15)
     * @Assert\NotBlank
     */
    private $situationActuelle;

    /**
     * @ORM\Column(type="string", length=30)
     * @Assert\NotBlank
     */
    private $niveau;

    /**
     * @ORM\Column(type="simple_array")
     * @Assert\NotBlank
     */
    private $zonesInterventions = [];

    /**
     * @ORM\Column(type="simple_array")
     * @Assert\NotBlank
     */
    private $lieuxInterventions = [];

    /**
     * @ORM\Column(type="boolean")
     * @Assert\NotNull
     */
    private $toutesMaladies;

    /**
     * @ORM\Column(type="boolean")
     * @Assert\NotNull
     */
    private $voiture;

    /**
     * @ORM\Column(type="boolean")
     */
    private $cv;

    /**
     * @ORM\Column(type="boolean")
     */
    private $cj;

    /**
     * @ORM\Column(type="text", nullable=true)
     * @Assert\NotBlank
     */
    private $commentaires;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Eleve", mappedBy="professeurs")
     */
    private $eleves;

    /**
     * @ORM\Column(type="string", length=50)
     * @Assert\NotBlank
     */
    private $matiere1;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $matiere2;

    public function __construct()
    {
        $this->eleves = new ArrayCollection();
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

    public function getSituationActuelle(): ?string
    {
        return $this->situationActuelle;
    }

    public function setSituationActuelle(string $situationActuelle): self
    {
        $this->situationActuelle = $situationActuelle;

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

    public function getZonesInterventions(): ?array
    {
        return $this->zonesInterventions;
    }

    public function setZonesInterventions(array $zonesInterventions): self
    {
        $this->zonesInterventions = $zonesInterventions;

        return $this;
    }

    public function getLieuxInterventions(): ?array
    {
        return $this->lieuxInterventions;
    }

    public function setLieuxInterventions(array $lieuxInterventions): self
    {
        $this->lieuxInterventions = $lieuxInterventions;

        return $this;
    }

    public function getToutesMaladies(): ?bool
    {
        return $this->toutesMaladies;
    }

    public function setToutesMaladies(bool $toutesMaladies): self
    {
        $this->toutesMaladies = $toutesMaladies;

        return $this;
    }

    public function getVoiture(): ?bool
    {
        return $this->voiture;
    }

    public function setVoiture(bool $voiture): self
    {
        $this->voiture = $voiture;

        return $this;
    }

    public function getCv(): ?bool
    {
        return $this->cv;
    }

    public function setCv(bool $cv): self
    {
        $this->cv = $cv;

        return $this;
    }

    public function getCj(): ?bool
    {
        return $this->cj;
    }

    public function setCj(bool $cj): self
    {
        $this->cj = $cj;

        return $this;
    }

    public function getCommentaires(): ?string
    {
        return $this->commentaires;
    }

    public function setCommentaires(?string $commentaires): self
    {
        $this->commentaires = $commentaires;

        return $this;
    }

    public function getMatiere1(): ?string
    {
        return $this->matiere1;
    }

    public function setMatiere1(?string $matiere1): self
    {
        $this->matiere1 = $matiere1;
        return $this;
    }

    public function getMatiere2(): ?string
    {
        return $this->matiere2;
    }

    public function setMatiere2(?string $matiere2): self
    {
        $this->matiere2 = $matiere2;
        return $this;
    }

    /**
     * @return Collection|Eleve[]
     */
    public function getEleves(): Collection
    {
        return $this->eleves;
    }

    public function addElefe(Eleve $elefe): self
    {
        if (!$this->eleves->contains($elefe)) {
            $this->eleves[] = $elefe;
            $elefe->addProfesseur($this);
        }

        return $this;
    }

    public function removeElefe(Eleve $elefe): self
    {
        if ($this->eleves->contains($elefe)) {
            $this->eleves->removeElement($elefe);
            $elefe->removeProfesseur($this);
        }

        return $this;
    }

    public function __toString(){
        return $this->getNom();
    }
}
