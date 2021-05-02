<?php

namespace App\Entity;

use App\Repository\UtilisateursRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=UtilisateursRepository::class)
 */
class Utilisateurs
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     *@ORM\Column(name="id_utilisateurs", type="integer", nullable=false)
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $pseudoUtilisateurs;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nomUtilisateurs;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $prenomUtilisateurs;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $emailUtilisateurs;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $mdpUtilisateurs;

    /**
     * @ORM\Column(type="string", length=10)
     */
    private $etatUtilisateurs;

    /**
     * @ORM\Column(type="datetime")
     */
    private $dateCreationUtilisateurs;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $adresse1Utilisateurs;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $adresse2Utilisateurs;

    /**
     * @ORM\Column(type="integer")
     */
    private $codePostalUtilisateurs;

    /**
     * @ORM\OneToMany(targetEntity=Commentaires::class, mappedBy="idUtilisateurs")
     */
    private $commentaires;

    /**
     * @ORM\OneToMany(targetEntity=DonneUneNote::class, mappedBy="idUtilisateurs")
     */
    private $donneUneNotes;



    public function __construct()
    {
        $this->commentaires = new ArrayCollection();
        $this->donneUneNotes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPseudoUtilisateurs(): ?string
    {
        return $this->pseudoUtilisateurs;
    }

    public function setPseudoUtilisateurs(string $pseudoUtilisateurs): self
    {
        $this->pseudoUtilisateurs = $pseudoUtilisateurs;

        return $this;
    }

    public function getNomUtilisateurs(): ?string
    {
        return $this->nomUtilisateurs;
    }

    public function setNomUtilisateurs(string $nomUtilisateurs): self
    {
        $this->nomUtilisateurs = $nomUtilisateurs;

        return $this;
    }

    public function getPrenomUtilisateurs(): ?string
    {
        return $this->prenomUtilisateurs;
    }

    public function setPrenomUtilisateurs(string $prenomUtilisateurs): self
    {
        $this->prenomUtilisateurs = $prenomUtilisateurs;

        return $this;
    }

    public function getEmailUtilisateurs(): ?string
    {
        return $this->emailUtilisateurs;
    }

    public function setEmailUtilisateurs(string $emailUtilisateurs): self
    {
        $this->emailUtilisateurs = $emailUtilisateurs;

        return $this;
    }

    public function getMdpUtilisateurs(): ?string
    {
        return $this->mdpUtilisateurs;
    }

    public function setMdpUtilisateurs(string $mdpUtilisateurs): self
    {
        $this->mdpUtilisateurs = $mdpUtilisateurs;

        return $this;
    }

    public function getEtatUtilisateurs(): ?string
    {
        return $this->etatUtilisateurs;
    }

    public function setEtatUtilisateurs(string $etatUtilisateurs): self
    {
        $this->etatUtilisateurs = $etatUtilisateurs;

        return $this;
    }

    public function getDateCreationUtilisateurs(): ?\DateTimeInterface
    {
        return $this->dateCreationUtilisateurs;
    }

    public function setDateCreationUtilisateurs(\DateTimeInterface $dateCreationUtilisateurs): self
    {
        $this->dateCreationUtilisateurs = $dateCreationUtilisateurs;

        return $this;
    }

    public function getAdresse1Utilisateurs(): ?string
    {
        return $this->adresse1Utilisateurs;
    }

    public function setAdresse1Utilisateurs(string $adresse1Utilisateurs): self
    {
        $this->adresse1Utilisateurs = $adresse1Utilisateurs;

        return $this;
    }

    public function getAdresse2Utilisateurs(): ?string
    {
        return $this->adresse2Utilisateurs;
    }

    public function setAdresse2Utilisateurs(string $adresse2Utilisateurs): self
    {
        $this->adresse2Utilisateurs = $adresse2Utilisateurs;

        return $this;
    }

    public function getCodePostalUtilisateurs(): ?int
    {
        return $this->codePostalUtilisateurs;
    }

    public function setCodePostalUtilisateurs(int $codePostalUtilisateurs): self
    {
        $this->codePostalUtilisateurs = $codePostalUtilisateurs;

        return $this;
    }

    /**
     * @return Collection|Commentaires[]
     */
    public function getCommentaires(): Collection
    {
        return $this->commentaires;
    }

    public function addCommentaire(Commentaires $commentaire): self
    {
        if (!$this->commentaires->contains($commentaire)) {
            $this->commentaires[] = $commentaire;
            $commentaire->setIdUtilisateurs($this);
        }

        return $this;
    }

    public function removeCommentaire(Commentaires $commentaire): self
    {
        if ($this->commentaires->removeElement($commentaire)) {
            // set the owning side to null (unless already changed)
            if ($commentaire->getIdUtilisateurs() === $this) {
                $commentaire->setIdUtilisateurs(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|DonneUneNote[]
     */
    public function getDonneUneNotes(): Collection
    {
        return $this->donneUneNotes;
    }

    public function addDonneUneNote(DonneUneNote $donneUneNote): self
    {
        if (!$this->donneUneNotes->contains($donneUneNote)) {
            $this->donneUneNotes[] = $donneUneNote;
            $donneUneNote->addIdUtilisateur($this);
        }

        return $this;
    }

    public function removeDonneUneNote(DonneUneNote $donneUneNote): self
    {
        if ($this->donneUneNotes->removeElement($donneUneNote)) {
            $donneUneNote->removeIdUtilisateur($this);
        }

        return $this;
    }
}
