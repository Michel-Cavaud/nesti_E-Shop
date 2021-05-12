<?php

namespace App\Entity;

use App\Repository\ArticlesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ArticlesRepository::class)
 */
class Articles
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(name="id_externe", type="integer", nullable=false)
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $nomUsageArticles;

    /**
     * @ORM\Column(type="integer")
     */
    private $quantiteUniteArticles;

    /**
     * @ORM\Column(type="string", length=20)
     */
    private $etatArticles;

    /**
     * @ORM\Column(type="datetime")
     */
    private $dateCreationArticles;

    /**
     * @ORM\Column(type="datetime")
     */
    private $dateMiseJourArticles;

    /**
     * @ORM\OneToOne(targetEntity=Images::class, cascade={"persist", "remove"})
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_images", referencedColumnName="id_images")
     * })
     */
    private $idImages;

    /**
     * @ORM\ManyToOne(targetEntity=Produits::class)
     *  @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_produits", referencedColumnName="id_produits")
     * })
     */
    private $idProduits;

    /**
     * @ORM\ManyToOne(targetEntity=UnitesDeMesure::class)
     *  @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_unites_de_mesure", referencedColumnName="id_unites_de_mesure")
     * })
     */
    private $idUnitesDeMesure;

    /**
     * @ORM\OneToOne(targetEntity=PrixArticle::class, mappedBy="idExterne", cascade={"persist", "remove"})
     *  
     */
    private $prixArticle;

    /**
     * @ORM\OneToMany(targetEntity=LigneDeCommandes::class, mappedBy="idExterne")
     */
    private $ligneDeCommandes;

    /**
     * @ORM\OneToMany(targetEntity=Lots::class, mappedBy="idExterne")
     */
    private $lots;



    public function __construct()
    {
        $this->ligneDeCommandes = new ArrayCollection();
        $this->lots = new ArrayCollection();
    }

    public function getStock()
    {
        $totalCommande = 0;
        foreach ($this->ligneDeCommandes->toArray() as $item) {
            $totalCommande = $totalCommande + $item->getQuantiteCommandes();
        }

        $totalLivre = 0;
        foreach ($this->lots->toArray() as $item) {
            $totalLivre = $totalLivre + $item->getQuantiteAcheteLots();
        }
        return  $totalLivre - $totalCommande;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomUsageArticles(): ?string
    {
        return $this->nomUsageArticles;
    }

    public function setNomUsageArticles(?string $nomUsageArticles): self
    {
        $this->nomUsageArticles = $nomUsageArticles;

        return $this;
    }

    public function getQuantiteUniteArticles(): ?int
    {
        return $this->quantiteUniteArticles;
    }

    public function setQuantiteUniteArticles(int $quantiteUniteArticles): self
    {
        $this->quantiteUniteArticles = $quantiteUniteArticles;

        return $this;
    }

    public function getEtatArticles(): ?string
    {
        return $this->etatArticles;
    }

    public function setEtatArticles(string $etatArticles): self
    {
        $this->etatArticles = $etatArticles;

        return $this;
    }

    public function getDateCreationArticles(): ?\DateTimeInterface
    {
        return $this->dateCreationArticles;
    }

    public function setDateCreationArticles(\DateTimeInterface $dateCreationArticles): self
    {
        $this->dateCreationArticles = $dateCreationArticles;

        return $this;
    }

    public function getDateMiseJourArticles(): ?\DateTimeInterface
    {
        return $this->dateMiseJourArticles;
    }

    public function setDateMiseJourArticles(\DateTimeInterface $dateMiseJourArticles): self
    {
        $this->dateMiseJourArticles = $dateMiseJourArticles;

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

    public function getPrixArticle(): ?PrixArticle
    {
        if ($this->prixArticle == null) {
            $this->prixArticle = new PrixArticle();
            $this->prixArticle->setPrixPrixArticle(0);
        }
        return $this->prixArticle;
    }

    public function setPrixArticle(?PrixArticle $prixArticle): self
    {
        // unset the owning side of the relation if necessary
        if ($prixArticle === null && $this->prixArticle !== null) {
            $this->prixArticle->setIdExterne(null);
        }

        // set the owning side of the relation if necessary
        if ($prixArticle !== null && $prixArticle->getIdExterne() !== $this) {
            $prixArticle->setIdExterne($this);
        }

        $this->prixArticle = $prixArticle;

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
            $ligneDeCommande->setIdExterne($this);
        }

        return $this;
    }

    public function removeLigneDeCommande(LigneDeCommandes $ligneDeCommande): self
    {
        if ($this->ligneDeCommandes->removeElement($ligneDeCommande)) {
            // set the owning side to null (unless already changed)
            if ($ligneDeCommande->getIdExterne() === $this) {
                $ligneDeCommande->setIdExterne(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Lots[]
     */
    public function getLots(): Collection
    {
        return $this->lots;
    }

    public function addLot(Lots $lot): self
    {
        if (!$this->lots->contains($lot)) {
            $this->lots[] = $lot;
            $lot->setIdExterne($this);
        }

        return $this;
    }

    public function removeLot(Lots $lot): self
    {
        if ($this->lots->removeElement($lot)) {
            // set the owning side to null (unless already changed)
            if ($lot->getIdExterne() === $this) {
                $lot->setIdExterne(null);
            }
        }

        return $this;
    }
}
