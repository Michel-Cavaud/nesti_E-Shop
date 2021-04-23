<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Commandes
 *
 * @ORM\Table(name="commandes", indexes={@ORM\Index(name="id_utilisateurs", columns={"id_utilisateurs"})})
 * @ORM\Entity
 */
class Commandes
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_commandes", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idCommandes;

    /**
     * @var string|null
     *
     * @ORM\Column(name="etat_commandes", type="string", length=0, nullable=true, options={"default"="NULL"})
     */
    private $etatCommandes = 'NULL';

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="date_creation_commandes", type="datetime", nullable=true, options={"default"="NULL"})
     */
    private $dateCreationCommandes = 'NULL';

    /**
     * @var \Utilisateurs
     *
     * @ORM\ManyToOne(targetEntity="Utilisateurs")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_utilisateurs", referencedColumnName="id_utilisateurs")
     * })
     */
    private $idUtilisateurs;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Articles", mappedBy="idCommandes")
     */
    private $idExterne;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->idExterne = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function getIdCommandes(): ?int
    {
        return $this->idCommandes;
    }

    public function getEtatCommandes(): ?string
    {
        return $this->etatCommandes;
    }

    public function setEtatCommandes(?string $etatCommandes): self
    {
        $this->etatCommandes = $etatCommandes;

        return $this;
    }

    public function getDateCreationCommandes(): ?\DateTimeInterface
    {
        return $this->dateCreationCommandes;
    }

    public function setDateCreationCommandes(?\DateTimeInterface $dateCreationCommandes): self
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
     * @return Collection|Articles[]
     */
    public function getIdExterne(): Collection
    {
        return $this->idExterne;
    }

    public function addIdExterne(Articles $idExterne): self
    {
        if (!$this->idExterne->contains($idExterne)) {
            $this->idExterne[] = $idExterne;
            $idExterne->addIdCommande($this);
        }

        return $this;
    }

    public function removeIdExterne(Articles $idExterne): self
    {
        if ($this->idExterne->removeElement($idExterne)) {
            $idExterne->removeIdCommande($this);
        }

        return $this;
    }

}
