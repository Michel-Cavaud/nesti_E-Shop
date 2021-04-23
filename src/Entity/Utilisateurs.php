<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Utilisateurs
 *
 * @ORM\Table(name="utilisateurs", uniqueConstraints={@ORM\UniqueConstraint(name="pseudo_utilisateurs", columns={"pseudo_utilisateurs"})}, indexes={@ORM\Index(name="id_ville", columns={"id_ville"})})
 * @ORM\Entity(repositoryClass="App\Repository\UtilisateursRepository")
 */
class Utilisateurs
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_utilisateurs", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idUtilisateurs;

    /**
     * @var string|null
     *
     * @ORM\Column(name="pseudo_utilisateurs", type="string", length=50, nullable=true, options={"default"="NULL"})
     */
    private $pseudoUtilisateurs = 'NULL';

    /**
     * @var string|null
     *
     * @ORM\Column(name="nom_utilisateurs", type="string", length=50, nullable=true, options={"default"="NULL"})
     */
    private $nomUtilisateurs = 'NULL';

    /**
     * @var string|null
     *
     * @ORM\Column(name="prenom_utilisateurs", type="string", length=50, nullable=true, options={"default"="NULL"})
     */
    private $prenomUtilisateurs = 'NULL';

    /**
     * @var string|null
     *
     * @ORM\Column(name="email_utilisateurs", type="string", length=200, nullable=true, options={"default"="NULL"})
     */
    private $emailUtilisateurs = 'NULL';

    /**
     * @var string|null
     *
     * @ORM\Column(name="mdp_utilisateurs", type="string", length=200, nullable=true, options={"default"="NULL"})
     */
    private $mdpUtilisateurs = 'NULL';

    /**
     * @var string|null
     *
     * @ORM\Column(name="etat_utilisateurs", type="string", length=0, nullable=true, options={"default"="NULL"})
     */
    private $etatUtilisateurs = 'NULL';

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="date_creation_utilisateurs", type="datetime", nullable=true, options={"default"="current_timestamp()"})
     */
    private $dateCreationUtilisateurs = 'current_timestamp()';

    /**
     * @var string|null
     *
     * @ORM\Column(name="adresse_1_utilisateurs", type="string", length=50, nullable=true, options={"default"="NULL"})
     */
    private $adresse1Utilisateurs = 'NULL';

    /**
     * @var string|null
     *
     * @ORM\Column(name="adresse_2_utilisateurs", type="string", length=50, nullable=true, options={"default"="NULL"})
     */
    private $adresse2Utilisateurs = 'NULL';

    /**
     * @var int|null
     *
     * @ORM\Column(name="code_postal_utilisateurs", type="integer", nullable=true, options={"default"="NULL"})
     */
    private $codePostalUtilisateurs = NULL;

    /**
     * @var \Ville
     *
     * @ORM\ManyToOne(targetEntity="Ville")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_ville", referencedColumnName="id_ville")
     * })
     */
    private $idVille;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Recettes", mappedBy="idUtilisateurs")
     */
    private $idRecettes;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->idRecettes = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function getIdUtilisateurs(): ?int
    {
        return $this->idUtilisateurs;
    }

    public function getPseudoUtilisateurs(): ?string
    {
        return $this->pseudoUtilisateurs;
    }

    public function setPseudoUtilisateurs(?string $pseudoUtilisateurs): self
    {
        $this->pseudoUtilisateurs = $pseudoUtilisateurs;

        return $this;
    }

    public function getNomUtilisateurs(): ?string
    {
        return $this->nomUtilisateurs;
    }

    public function setNomUtilisateurs(?string $nomUtilisateurs): self
    {
        $this->nomUtilisateurs = $nomUtilisateurs;

        return $this;
    }

    public function getPrenomUtilisateurs(): ?string
    {
        return $this->prenomUtilisateurs;
    }

    public function setPrenomUtilisateurs(?string $prenomUtilisateurs): self
    {
        $this->prenomUtilisateurs = $prenomUtilisateurs;

        return $this;
    }

    public function getEmailUtilisateurs(): ?string
    {
        return $this->emailUtilisateurs;
    }

    public function setEmailUtilisateurs(?string $emailUtilisateurs): self
    {
        $this->emailUtilisateurs = $emailUtilisateurs;

        return $this;
    }

    public function getMdpUtilisateurs(): ?string
    {
        return $this->mdpUtilisateurs;
    }

    public function setMdpUtilisateurs(?string $mdpUtilisateurs): self
    {
        $this->mdpUtilisateurs = $mdpUtilisateurs;

        return $this;
    }

    public function getEtatUtilisateurs(): ?string
    {
        return $this->etatUtilisateurs;
    }

    public function setEtatUtilisateurs(?string $etatUtilisateurs): self
    {
        $this->etatUtilisateurs = $etatUtilisateurs;

        return $this;
    }

    public function getDateCreationUtilisateurs(): ?\DateTimeInterface
    {
        return $this->dateCreationUtilisateurs;
    }

    public function setDateCreationUtilisateurs(?\DateTimeInterface $dateCreationUtilisateurs): self
    {
        $this->dateCreationUtilisateurs = $dateCreationUtilisateurs;

        return $this;
    }

    public function getAdresse1Utilisateurs(): ?string
    {
        return $this->adresse1Utilisateurs;
    }

    public function setAdresse1Utilisateurs(?string $adresse1Utilisateurs): self
    {
        $this->adresse1Utilisateurs = $adresse1Utilisateurs;

        return $this;
    }

    public function getAdresse2Utilisateurs(): ?string
    {
        return $this->adresse2Utilisateurs;
    }

    public function setAdresse2Utilisateurs(?string $adresse2Utilisateurs): self
    {
        $this->adresse2Utilisateurs = $adresse2Utilisateurs;

        return $this;
    }

    public function getCodePostalUtilisateurs(): ?int
    {
        return $this->codePostalUtilisateurs;
    }

    public function setCodePostalUtilisateurs(?int $codePostalUtilisateurs): self
    {
        $this->codePostalUtilisateurs = $codePostalUtilisateurs;

        return $this;
    }

    public function getIdVille(): ?Ville
    {
        return $this->idVille;
    }

    public function setIdVille(?Ville $idVille): self
    {
        $this->idVille = $idVille;

        return $this;
    }

    /**
     * @return Collection|Recettes[]
     */
    public function getIdRecettes(): Collection
    {
        return $this->idRecettes;
    }

    public function addIdRecette(Recettes $idRecette): self
    {
        if (!$this->idRecettes->contains($idRecette)) {
            $this->idRecettes[] = $idRecette;
            $idRecette->addIdUtilisateur($this);
        }

        return $this;
    }

    public function removeIdRecette(Recettes $idRecette): self
    {
        if ($this->idRecettes->removeElement($idRecette)) {
            $idRecette->removeIdUtilisateur($this);
        }

        return $this;
    }

}
