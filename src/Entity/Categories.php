<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Categories
 *
 * @ORM\Table(name="categories")
 * @ORM\Entity(repositoryClass="App\Repository\CategoriesRepository")
 */
class Categories
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_categories", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idCategories;

    /**
     * @var string|null
     *
     * @ORM\Column(name="nom_categories", type="string", length=50, nullable=true, options={"default"="NULL"})
     */
    private $nomCategories = 'NULL';

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Recettes", mappedBy="idCategories")
     */
    private $idRecettes;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->idRecettes = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function getIdCategories(): ?int
    {
        return $this->idCategories;
    }

    public function getNomCategories(): ?string
    {
        return $this->nomCategories;
    }

    public function setNomCategories(?string $nomCategories): self
    {
        $this->nomCategories = $nomCategories;

        return $this;
    }

    /**
     * @return Collection|Recettes[]
     */
    public function getIdRecettes(): Collection
    {
        return $this->idRecettes;
    }

    public function addIdRecette(Recettes $idRecette): self
    {
        if (!$this->idRecettes->contains($idRecette)) {
            $this->idRecettes[] = $idRecette;
            $idRecette->addIdCategory($this);
        }

        return $this;
    }

    public function removeIdRecette(Recettes $idRecette): self
    {
        if ($this->idRecettes->removeElement($idRecette)) {
            $idRecette->removeIdCategory($this);
        }

        return $this;
    }

}
