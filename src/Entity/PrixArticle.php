<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PrixArticle
 *
 * @ORM\Table(name="prix_article", indexes={@ORM\Index(name="id_externe", columns={"id_externe"})})
 * @ORM\Entity(repositoryClass="App\Repository\PrixArticleRepository")
 */
class PrixArticle
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_prix_article", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idPrixArticle;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="date_creation_prix_article", type="datetime", nullable=true, options={"default"="NULL"})
     */
    private $dateCreationPrixArticle = 'NULL';

    /**
     * @var string|null
     *
     * @ORM\Column(name="prix_prix_article", type="decimal", precision=19, scale=4, nullable=true, options={"default"="NULL"})
     */
    private $prixPrixArticle = 'NULL';

    /**
     * @var \Articles
     *
     * @ORM\ManyToOne(targetEntity="Articles")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_externe", referencedColumnName="id_externe")
     * })
     */
    private $idExterne;

    public function getIdPrixArticle(): ?int
    {
        return $this->idPrixArticle;
    }

    public function getDateCreationPrixArticle(): ?\DateTimeInterface
    {
        return $this->dateCreationPrixArticle;
    }

    public function setDateCreationPrixArticle(?\DateTimeInterface $dateCreationPrixArticle): self
    {
        $this->dateCreationPrixArticle = $dateCreationPrixArticle;

        return $this;
    }

    public function getPrixPrixArticle(): ?string
    {
        return $this->prixPrixArticle;
    }

    public function setPrixPrixArticle(?string $prixPrixArticle): self
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
