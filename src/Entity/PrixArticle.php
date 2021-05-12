<?php

namespace App\Entity;

use App\Repository\PrixArticleRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PrixArticleRepository::class)
 */
class PrixArticle
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(name="id_prix_article", type="integer", nullable=false)
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     */
    private $dateCreationPrixArticle;

    /**
     * @ORM\Column(type="float")
     */
    private $prixPrixArticle;

    /**
     * @ORM\OneToOne(targetEntity=Articles::class, inversedBy="prixArticle", cascade={"persist", "remove"})
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_externe", referencedColumnName="id_externe", nullable=true)
     * })
     */
    private $idExterne;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateCreationPrixArticle(): ?\DateTimeInterface
    {
        return $this->dateCreationPrixArticle;
    }

    public function setDateCreationPrixArticle(\DateTimeInterface $dateCreationPrixArticle): self
    {
        $this->dateCreationPrixArticle = $dateCreationPrixArticle;

        return $this;
    }

    public function getPrixPrixArticle(): ?float
    {
        return $this->prixPrixArticle;
    }

    public function setPrixPrixArticle(float $prixPrixArticle): self
    {
        $this->prixPrixArticle = $prixPrixArticle;

        return $this;
    }

    public function getIdExterne(): ?Articles
    {
        return $this->idExterne;
    }

    public function setIdExterne(?Articles $idExterne): self
    {
        $this->idExterne = $idExterne;

        return $this;
    }
}
