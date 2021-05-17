<?php

namespace App\Entity;

use App\Repository\CommandesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CommandesRepository::class)
 */
class Commandes
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(name="id_commandes", type="integer", nullable=false)
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=20)
     */
    private $etatCommandes;

    /**
     * @ORM\Column(type="datetime")
     */
    private $dateCreationCommandes;

    /**
     * @ORM\ManyToOne(targetEntity=Utilisateurs::class, inversedBy="commandes", cascade={"persist"})
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_utilisateurs", referencedColumnName="id_utilisateurs")
     * })
     */
    private $idUtilisateurs;

    /**
     * @ORM\OneToMany(targetEntity=LigneDeCommandes::class, mappedBy="idCommandes")
     */
    private $ligneDeCommandes;

    public function __construct()
    {
        $this->ligneDeCommandes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEtatCommandes(): ?string
    {
        return $this->etatCommandes;
    }

    public function setEtatCommandes(string $etatCommandes): self
    {
        $this->etatCommandes = $etatCommandes;

        return $this;
    }

    public function getDateCreationCommandes(): ?\DateTimeInterface
    {
        return $this->dateCreationCommandes;
    }

    public function setDateCreationCommandes(\DateTimeInterface $dateCreationCommandes): self
    {
        $this->dateCreationCommandes = $dateCreationCommandes;

        return $this;
    }

    public function getIdUtilisateurs(): ?Utilisateurs
    {
        return $this->idUtilisateurs;
    }

    public function setIdUtilisateurs(?Utilisateurs $idUtilisateurs): self
    {
        $this->idUtilisateurs = $idUtilisateurs;

        return $this;
    }

    /**
     * @return Collection|LigneDeCommandes[]
     */
    public function getLigneDeCommandes(): Collection
    {
        return $this->ligneDeCommandes;
    }

    public function addLigneDeCommande(LigneDeCommandes $ligneDeCommande): self
    {
        if (!$this->ligneDeCommandes->contains($ligneDeCommande)) {
            $this->ligneDeCommandes[] = $ligneDeCommande;
            $ligneDeCommande->setIdCommandes($this);
        }

        return $this;
    }

    public function removeLigneDeCommande(LigneDeCommandes $ligneDeCommande): self
    {
        if ($this->ligneDeCommandes->removeElement($ligneDeCommande)) {
            // set the owning side to null (unless already changed)
            if ($ligneDeCommande->getIdCommandes() === $this) {
                $ligneDeCommande->setIdCommandes(null);
            }
        }

        return $this;
    }
}
