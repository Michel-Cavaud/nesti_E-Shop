<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Produits
 *
 * @ORM\Table(name="produits")
 * @ORM\Entity(repositoryClass="App\Repository\ProduitsRepository")
 */
class Produits
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_produits", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idProduits;

    /**
     * @var string|null
     *
     * @ORM\Column(name="nom_produits", type="string", length=50, nullable=true, options={"default"="NULL"})
     */
    private $nomProduits = 'NULL';

    public function getIdProduits(): ?int
    {
        return $this->idProduits;
    }

    public function getNomProduits(): ?string
    {
        return $this->nomProduits;
    }

    public function setNomProduits(?string $nomProduits): self
    {
        $this->nomProduits = $nomProduits;

        return $this;
    }


}
