<?php

namespace App\Entity;

use App\Repository\IngredientsRecettesRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=IngredientsRecettesRepository::class)
 */
class IngredientsRecettes
{


    /**
     * @ORM\Column(type="integer")
     */
    private $quantiteIngredientsRecette;

    /**
     * @ORM\Column(type="integer")
     */
    private $ordreIngredientsRecette;

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     */
    private $idProduits;

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     */
    private $idRecettes;


    /**
     * @ORM\ManyToOne(targetEntity=UnitesDeMesure::class, cascade={"persist", "remove"})
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_unites_de_mesure", referencedColumnName="id_unites_de_mesure")
     * })
     * 
     */
    private $idUnitesDeMesure;


    public function getQuantiteIngredientsRecette(): ?int
    {
        return $this->quantiteIngredientsRecette;
    }

    public function setQuantiteIngredientsRecette(int $quantiteIngredientsRecette): self
    {
        $this->quantiteIngredientsRecette = $quantiteIngredientsRecette;

        return $this;
    }

    public function getOrdreIngredientsRecette(): ?int
    {
        return $this->ordreIngredientsRecette;
    }

    public function setOrdreIngredientsRecette(int $ordreIngredientsRecette): self
    {
        $this->ordreIngredientsRecette = $ordreIngredientsRecette;

        return $this;
    }

    public function getIdProduits(): ?int
    {
        return $this->idProduits;
    }

    public function setIdProduits(int $idProduits): self
    {
        $this->idProduits = $idProduits;

        return $this;
    }

    public function getIdRecettes(): ?int
    {
        return $this->idRecettes;
    }

    public function setIdRecettes(int $idRecettes): self
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
