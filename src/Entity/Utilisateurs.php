<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\UtilisateursRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UtilisateursRepository")
 */
class Utilisateurs implements UserInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     *@ORM\Column(name="id_utilisateurs", type="integer", nullable=false)
     * @Groups({"json_user"})
     */
    private $id;

    /**
     * 
     * @ORM\Column(name="pseudo_utilisateurs", type="string", length=255)
     * @Assert\Length(min=5, max=255, minMessage="Minimun 5 caractères pour votre identifiant", groups={"registration"})
     */
    private $username;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"json_user"})
     * @Assert\Length(min=2, max=255, minMessage="Minimun 2 caractères pour votre nom", groups={"registration"})
     */
    private $nomUtilisateurs;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"json_user"})
     * @Assert\Length(min=2, max=255, minMessage="Minimun 2 caractères pour votre prénom", groups={"registration"})
     */
    private $prenomUtilisateurs;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"json_user"})
     * 
     * @Assert\Email()
     */
    private $emailUtilisateurs;

    /**
     * @ORM\Column(name="mdp_utilisateurs", type="string", length=255)
     * @Assert\Length(min=8, minMessage="Mot de passe d'au moins 8 caractères", groups={"registration"})
     * @Assert\EqualTo(propertyPath="confirmPassword", message="Votre mot de passe doit être identique à la confirmation", groups={"registration"})
     */
    private $password;

    /**
     * @Assert\EqualTo(propertyPath="password", message="Vous n'avez pas confirmer le même mot de passe", groups={"registration"}) 
     */
    private $confirmPassword;

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
     * @Groups({"json_user"})
     * 
     * @Assert\Length(min=0, max=255, minMessage="Indiquer votre adresse", groups={"registration"})
     */
    private $adresse1Utilisateurs;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"json_user"})
     */
    private $adresse2Utilisateurs;

    /**
     * @ORM\Column(type="integer")
     * @Groups({"json_user"})
     * 
     * @Assert\Length(min=0, max=5, minMessage="Indiquer vun code postal valide et choisir la ville", maxMessage="Indiquer vun code postal valide et choisir la ville", groups={"registration"})
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

    /**
     * @ORM\OneToMany(targetEntity=Commandes::class, mappedBy="idUtilisateurs")
     */
    private $commandes;

    /**
     * @ORM\ManyToOne(targetEntity=Ville::class, cascade={"all"})
     *  @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_ville", referencedColumnName="id_ville")
     * })
     * @Groups({"json_user"})
     */
    private $idVille;


    //@Assert\Length(min=0, max=255, minMessage="Indiquer votre ville")
    /**
     * 
     */
    private $ville;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $civiliteUtilisateurs;



    public function __construct()
    {
        $this->commentaires = new ArrayCollection();
        $this->donneUneNotes = new ArrayCollection();
        $this->commandes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $pseudoUtilisateurs): self
    {
        $this->username = $pseudoUtilisateurs;

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

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassWord(string $mdpUtilisateurs): self
    {
        $this->password = $mdpUtilisateurs;

        return $this;
    }

    public function getConfirmPassword(): ?string
    {
        return $this->confirmPassword;
    }

    public function setConfirmPassWord(string $mdpUtilisateurs): self
    {
        $this->confirmPassword = $mdpUtilisateurs;

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

    public function eraseCredentials()
    {
    }
    public function getSalt()
    {
    }
    public function getRoles()
    {
        return ['ROLE_USER'];
    }

    /**
     * @return Collection|Commandes[]
     */
    public function getCommandes(): Collection
    {
        return $this->commandes;
    }

    public function addCommande(Commandes $commande): self
    {
        if (!$this->commandes->contains($commande)) {
            $this->commandes[] = $commande;
            $commande->setIdUtilisateurs($this);
        }

        return $this;
    }

    public function removeCommande(Commandes $commande): self
    {
        if ($this->commandes->removeElement($commande)) {
            // set the owning side to null (unless already changed)
            if ($commande->getIdUtilisateurs() === $this) {
                $commande->setIdUtilisateurs(null);
            }
        }

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

    public function getVille(): ?string
    {
        return $this->ville;
    }

    public function setVille(?string $ville): self
    {
        $this->ville = $ville;

        return $this;
    }

    public function getCiviliteUtilisateurs(): ?string
    {
        return $this->civiliteUtilisateurs;
    }

    public function setCiviliteUtilisateurs(string $civiliteUtilisateurs): self
    {
        $this->civiliteUtilisateurs = $civiliteUtilisateurs;

        return $this;
    }
}
