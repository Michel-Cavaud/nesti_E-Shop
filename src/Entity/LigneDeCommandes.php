<?php

namespace App\Entity;

use App\Repository\LigneDeCommandesRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=LigneDeCommandesRepository::class)
 */
class LigneDeCommandes
{

    /**
     * 
     * @ORM\Column(type="integer")
     */
    private $quantiteCommandes;

    /**
     *  @ORM\Id
     * @ORM\ManyToOne(targetEntity=Articles::class, inversedBy="ligneDeCommandes")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_externe", referencedColumnName="id_externe")
     * })
     */
    private $idExterne;

    /**
     *  @ORM\Id
     * @ORM\ManyToOne(targetEntity=Commandes::class, inversedBy="ligneDeCommandes")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_commandes", referencedColumnName="id_commandes")
     * })
     */
    private $idCommandes;

    public function getQuantiteCommandes(): ?int
    {
        return $this->quantiteCommandes;
    }

    public function setQuantiteCommandes(int $quantiteCommandes): self
    {
        $this->quantiteCommandes = $quantiteCommandes;

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

    public function getIdCommandes(): ?Commandes
    {
        return $this->idCommandes;
    }

    public function setIdCommandes(?Commandes $idCommandes): self
    {
        $this->idCommandes = $idCommandes;

        return $this;
    }
}
