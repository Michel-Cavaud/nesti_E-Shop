<?php

namespace App\Entity;

use App\Repository\ProduitsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ProduitsRepository::class)
 */
class Produits
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(name="id_produits", type="integer", nullable=false)
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nomProduits;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomProduits(): ?string
    {
        return $this->nomProduits;
    }

    public function setNomProduits(string $nomProduits): self
    {
        $this->nomProduits = $nomProduits;

        return $this;
    }
}
