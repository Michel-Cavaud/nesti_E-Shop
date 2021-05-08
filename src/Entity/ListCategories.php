<?php

namespace App\Entity;

use App\Repository\ListCategoriesRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ListCategoriesRepository::class)
 */
class ListCategories
{


    /**
     * @ORM\ManyToOne(targetEntity=Recettes::class, inversedBy="listCategories")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_recettes", referencedColumnName="id_recettes")
     * })
     * @ORM\Id
     */
    private $idRecettes;

    /**
     * @ORM\ManyToOne(targetEntity=Categories::class)
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_categories", referencedColumnName="id_categories")
     * })
     * @ORM\Id
     */
    private $idCategories;

    public function getIdRecettes(): ?Recettes
    {
        return $this->idRecettes;
    }

    public function setIdRecettes(?Recettes $idRecettes): self
    {
        $this->idRecettes = $idRecettes;

        return $this;
    }

    public function getIdCategories(): ?Categories
    {
        return $this->idCategories;
    }

    public function setIdCategories(?Categories $idCategories): self
    {
        $this->idCategories = $idCategories;

        return $this;
    }
}
