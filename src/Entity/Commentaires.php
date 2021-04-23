<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Commentaires
 *
 * @ORM\Table(name="commentaires", indexes={@ORM\Index(name="id_recettes", columns={"id_recettes"}), @ORM\Index(name="id_moderateurs", columns={"id_moderateurs"}), @ORM\Index(name="IDX_D9BEC0C46ABA442C", columns={"id_utilisateurs"})})
 * @ORM\Entity(repositoryClass="App\Repository\CommentairesRepository")
 */
class Commentaires
{
    /**
     * @var string|null
     *
     * @ORM\Column(name="titre_commentaires", type="string", length=50, nullable=true, options={"default"="NULL"})
     */
    private $titreCommentaires = 'NULL';

    /**
     * @var string|null
     *
     * @ORM\Column(name="contenu_commentaires", type="string", length=255, nullable=true, options={"default"="NULL"})
     */
    private $contenuCommentaires = 'NULL';

    /**
     * @var string|null
     *
     * @ORM\Column(name="etat_commentaires", type="string", length=0, nullable=true, options={"default"="NULL"})
     */
    private $etatCommentaires = 'NULL';

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="date_creation_commentaires", type="datetime", nullable=true, options={"default"="NULL"})
     */
    private $dateCreationCommentaires = 'NULL';

    /**
     * @var \Utilisateurs
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\OneToOne(targetEntity="Utilisateurs")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_utilisateurs", referencedColumnName="id_utilisateurs")
     * })
     */
    private $idUtilisateurs;

    /**
     * @var \Recettes
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\OneToOne(targetEntity="Recettes")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_recettes", referencedColumnName="id_recettes")
     * })
     */
    private $idRecettes;

    /**
     * @var \Moderateurs
     *
     * @ORM\ManyToOne(targetEntity="Moderateurs")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_moderateurs", referencedColumnName="id_moderateurs")
     * })
     */
    private $idModerateurs;

    public function getTitreCommentaires(): ?string
    {
        return $this->titreCommentaires;
    }

    public function setTitreCommentaires(?string $titreCommentaires): self
    {
        $this->titreCommentaires = $titreCommentaires;

        return $this;
    }

    public function getContenuCommentaires(): ?string
    {
        return $this->contenuCommentaires;
    }

    public function setContenuCommentaires(?string $contenuCommentaires): self
    {
        $this->contenuCommentaires = $contenuCommentaires;

        return $this;
    }

    public function getEtatCommentaires(): ?string
    {
        return $this->etatCommentaires;
    }

    public function setEtatCommentaires(?string $etatCommentaires): self
    {
        $this->etatCommentaires = $etatCommentaires;

        return $this;
    }

    public function getDateCreationCommentaires(): ?\DateTimeInterface
    {
        return $this->dateCreationCommentaires;
    }

    public function setDateCreationCommentaires(?\DateTimeInterface $dateCreationCommentaires): self
    {
        $this->dateCreationCommentaires = $dateCreationCommentaires;

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

    public function getIdRecettes(): ?Recettes
    {
        return $this->idRecettes;
    }

    public function setIdRecettes(?Recettes $idRecettes): self
    {
        $this->idRecettes = $idRecettes;

        return $this;
    }

    public function getIdModerateurs(): ?Moderateurs
    {
        return $this->idModerateurs;
    }

    public function setIdModerateurs(?Moderateurs $idModerateurs): self
    {
        $this->idModerateurs = $idModerateurs;

        return $this;
    }


}
