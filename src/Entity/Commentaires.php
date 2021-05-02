<?php

namespace App\Entity;

use App\Repository\CommentairesRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CommentairesRepository::class)
 */
class Commentaires
{
    /**
     * @ORM\Column(type="string", length=255)
     */
    private $titreCommentaires;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $contenuCommentaires;

    /**
     * @ORM\Column(type="string", length=10)
     */
    private $etatCommentaires;

    /**
     * @ORM\Column(type="datetime")
     */
    private $dateCreationCommentaires;

    /**
     * @ORM\ManyToOne(targetEntity=Recettes::class, inversedBy="commentaires")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_recettes", referencedColumnName="id_recettes")
     * })
     * @ORM\Id
     */
    private $idRecettes;

    /**
     * @ORM\ManyToOne(targetEntity=Utilisateurs::class)
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_utilisateurs", referencedColumnName="id_utilisateurs")
     * })
     * @ORM\Id
     */
    private $idUtilisateurs;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitreCommentaires(): ?string
    {
        return $this->titreCommentaires;
    }

    public function setTitreCommentaires(string $titreCommentaires): self
    {
        $this->titreCommentaires = $titreCommentaires;

        return $this;
    }

    public function getContenuCommentaires(): ?string
    {
        return $this->contenuCommentaires;
    }

    public function setContenuCommentaires(string $contenuCommentaires): self
    {
        $this->contenuCommentaires = $contenuCommentaires;

        return $this;
    }

    public function getEtatCommentaires(): ?string
    {
        return $this->etatCommentaires;
    }

    public function setEtatCommentaires(string $etatCommentaires): self
    {
        $this->etatCommentaires = $etatCommentaires;

        return $this;
    }

    public function getDateCreationCommentaires(): ?\DateTimeInterface
    {
        return $this->dateCreationCommentaires;
    }

    public function setDateCreationCommentaires(\DateTimeInterface $dateCreationCommentaires): self
    {
        $this->dateCreationCommentaires = $dateCreationCommentaires;

        return $this;
    }

    public function getIdRecettes(): ?Recettes
    {
        return $this->idRecettes;
    }

    public function setIdRecettes(?Recettes $idRecettes): self
    {
        $this->idRecettes = $idRecettes;

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
}
