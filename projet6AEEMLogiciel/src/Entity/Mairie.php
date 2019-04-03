<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\MairieRepository")
 */
class Mairie
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     * @Assert\NotBlank
     */
    private $ville;

    /**
     * @ORM\Column(type="string", length=10)
     * @Assert\NotBlank
     * @Assert\Regex(pattern = "# [0-9]{5} #", message="Il semble y avoir un problème avec le code postal")
     */
    private $codePostal;

    /**
     * @ORM\Column(type="string", length=50)
     * @Assert\NotBlank    
     */
    private $zone;

    /**
     * @ORM\Column(type="string", length=100)
     * @Assert\Url
     */
    private $lienDossier;

    /**
     * @ORM\Column(type="string", length=50)
     * @Assert\Email
     */
    private $courriel;

    /**
     * @ORM\Column(type="string", length=20)
     * @Assert\NotBlank
     */
    private $telephone;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getVille(): ?string
    {
        return $this->ville;
    }

    public function setVille(string $ville): self
    {
        $this->ville = $ville;

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

    public function getZone(): ?string
    {
        return $this->zone;
    }

    public function setZone(string $zone): self
    {
        $this->zone = $zone;

        return $this;
    }

    public function getLienDossier(): ?string
    {
        return $this->lienDossier;
    }

    public function setLienDossier(string $lienDossier): self
    {
        $this->lienDossier = $lienDossier;

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

    public function getTelephone(): ?string
    {
        return $this->telephone;
    }

    public function setTelephone(string $telephone): self
    {
        $this->telephone = $telephone;

        return $this;
    }
}
