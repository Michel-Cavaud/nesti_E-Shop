<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Articles
 *
 * @ORM\Table(name="articles", uniqueConstraints={@ORM\UniqueConstraint(name="id_images", columns={"id_images"})}, indexes={@ORM\Index(name="id_unites_de_mesure", columns={"id_unites_de_mesure"}), @ORM\Index(name="id_produits", columns={"id_produits"})})
 * @ORM\Entity(repositoryClass="App\Repository\ArticlesRepository")
 */
class Articles
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_externe", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idExterne;

    /**
     * @var string
     *
     * @ORM\Column(name="nom_usage_articles", type="string", length=100, nullable=false)
     */
    private $nomUsageArticles;

    /**
     * @var int|null
     *
     * @ORM\Column(name="quantite_unite_articles", type="smallint", nullable=true, options={"default"="NULL"})
     */
    private $quantiteUniteArticles = 'NULL';

    /**
     * @var string|null
     *
     * @ORM\Column(name="etat_articles", type="string", length=0, nullable=true, options={"default"="NULL"})
     */
    private $etatArticles = 'NULL';

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="date_creation_articles", type="datetime", nullable=true, options={"default"="NULL"})
     */
    private $dateCreationArticles = 'NULL';

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="date_mise_jour_articles", type="datetime", nullable=true, options={"default"="NULL"})
     */
    private $dateMiseJourArticles = 'NULL';

    /**
     * @var \Produits
     *
     * @ORM\ManyToOne(targetEntity="Produits")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_produits", referencedColumnName="id_produits")
     * })
     */
    private $idProduits;

    /**
     * @var \UnitesDeMesure
     *
     * @ORM\ManyToOne(targetEntity="UnitesDeMesure")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_unites_de_mesure", referencedColumnName="id_unites_de_mesure")
     * })
     */
    private $idUnitesDeMesure;

    /**
     * @var \Images
     *
     * @ORM\ManyToOne(targetEntity="Images")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_images", referencedColumnName="id_images")
     * })
     */
    private $idImages;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Commandes", inversedBy="idExterne")
     * @ORM\JoinTable(name="ligne_de_commandes",
     *   joinColumns={
     *     @ORM\JoinColumn(name="id_externe", referencedColumnName="id_externe")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="id_commandes", referencedColumnName="id_commandes")
     *   }
     * )
     */
    private $idCommandes;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->idCommandes = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function getIdExterne(): ?int
    {
        return $this->idExterne;
    }

    public function getNomUsageArticles(): ?string
    {
        return $this->nomUsageArticles;
    }

    public function setNomUsageArticles(string $nomUsageArticles): self
    {
        $this->nomUsageArticles = $nomUsageArticles;

        return $this;
    }

    public function getQuantiteUniteArticles(): ?int
    {
        return $this->quantiteUniteArticles;
    }

    public function setQuantiteUniteArticles(?int $quantiteUniteArticles): self
    {
        $this->quantiteUniteArticles = $quantiteUniteArticles;

        return $this;
    }

    public function getEtatArticles(): ?string
    {
        return $this->etatArticles;
    }

    public function setEtatArticles(?string $etatArticles): self
    {
        $this->etatArticles = $etatArticles;

        return $this;
    }

    public function getDateCreationArticles(): ?\DateTimeInterface
    {
        return $this->dateCreationArticles;
    }

    public function setDateCreationArticles(?\DateTimeInterface $dateCreationArticles): self
    {
        $this->dateCreationArticles = $dateCreationArticles;

        return $this;
    }

    public function getDateMiseJourArticles(): ?\DateTimeInterface
    {
        return $this->dateMiseJourArticles;
    }

    public function setDateMiseJourArticles(?\DateTimeInterface $dateMiseJourArticles): self
    {
        $this->dateMiseJourArticles = $dateMiseJourArticles;

        return $this;
    }

    public function getIdProduits(): ?Produits
    {
        return $this->idProduits;
    }

    public function setIdProduits(?Produits $idProduits): self
    {
        $this->idProduits = $idProduits;

        return $this;
    }

    public function getIdUnitesDeMesure(): ?UnitesDeMesure
    {
        return $this->idUnitesDeMesure;
    }

    public function setIdUnitesDeMesure(?UnitesDeMesure $idUnitesDeMesure): self
    {
        $this->idUnitesDeMesure = $idUnitesDeMesure;

        return $this;
    }

    public function getIdImages(): ?Images
    {
        return $this->idImages;
    }

    public function setIdImages(?Images $idImages): self
    {
        $this->idImages = $idImages;

        return $this;
    }

    /**
     * @return Collection|Commandes[]
     */
    public function getIdCommandes(): Collection
    {
        return $this->idCommandes;
    }

    public function addIdCommande(Commandes $idCommande): self
    {
        if (!$this->idCommandes->contains($idCommande)) {
            $this->idCommandes[] = $idCommande;
        }

        return $this;
    }

    public function removeIdCommande(Commandes $idCommande): self
    {
        $this->idCommandes->removeElement($idCommande);

        return $this;
    }

}
