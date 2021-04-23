<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * IngredientsRecettes
 *
 * @ORM\Table(name="ingredients_recettes", indexes={@ORM\Index(name="id_unites_de_mesure", columns={"id_unites_de_mesure"}), @ORM\Index(name="id_recettes", columns={"id_recettes"}), @ORM\Index(name="IDX_9A9BE965EEF63319", columns={"id_produits"})})
 * @ORM\Entity(repositoryClass="App\Repository\IngredientsRecettesRepository")
 */
class IngredientsRecettes
{
    /**
     * @var int|null
     *
     * @ORM\Column(name="quantite_ingredients_recette", type="integer", nullable=true, options={"default"="NULL"})
     */
    private $quantiteIngredientsRecette = NULL;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="ordre_ingredients_recette", type="boolean", nullable=true, options={"default"="NULL"})
     */
    private $ordreIngredientsRecette = 'NULL';

    /**
     * @var \Ingredients
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\OneToOne(targetEntity="Ingredients")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_produits", referencedColumnName="id_produits")
     * })
     */
    private $idProduits;

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
     * @var \UnitesDeMesure
     *
     * @ORM\ManyToOne(targetEntity="UnitesDeMesure")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_unites_de_mesure", referencedColumnName="id_unites_de_mesure")
     * })
     */
    private $idUnitesDeMesure;

    public function getQuantiteIngredientsRecette(): ?int
    {
        return $this->quantiteIngredientsRecette;
    }

    public function setQuantiteIngredientsRecette(?int $quantiteIngredientsRecette): self
    {
        $this->quantiteIngredientsRecette = $quantiteIngredientsRecette;

        return $this;
    }

    public function getOrdreIngredientsRecette(): ?bool
    {
        return $this->ordreIngredientsRecette;
    }

    public function setOrdreIngredientsRecette(?bool $ordreIngredientsRecette): self
    {
        $this->ordreIngredientsRecette = $ordreIngredientsRecette;

        return $this;
    }

    public function getIdProduits(): ?Ingredients
    {
        return $this->idProduits;
    }

    public function setIdProduits(?Ingredients $idProduits): self
    {
        $this->idProduits = $idProduits;

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

    public function getIdUnitesDeMesure(): ?UnitesDeMesure
    {
        return $this->idUnitesDeMesure;
    }

    public function setIdUnitesDeMesure(?UnitesDeMesure $idUnitesDeMesure): self
    {
        $this->idUnitesDeMesure = $idUnitesDeMesure;

        return $this;
    }


}
