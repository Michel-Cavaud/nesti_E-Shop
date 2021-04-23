<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Ingredients
 *
 * @ORM\Table(name="ingredients")
 * @ORM\Entity
 */
class Ingredients
{
    /**
     * @var \Produits
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\OneToOne(targetEntity="Produits")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_produits", referencedColumnName="id_produits")
     * })
     */
    private $idProduits;

    public function getIdProduits(): ?Produits
    {
        return $this->idProduits;
    }

    public function setIdProduits(?Produits $idProduits): self
    {
        $this->idProduits = $idProduits;

        return $this;
    }


}
