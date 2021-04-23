<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Lots
 *
 * @ORM\Table(name="lots", indexes={@ORM\Index(name="IDX_916087CEEC77B41E", columns={"id_externe"})})
 * @ORM\Entity
 */
class Lots
{
    /**
     * @var int
     *
     * @ORM\Column(name="ref_commandes_lots", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $refCommandesLots;

    /**
     * @var string|null
     *
     * @ORM\Column(name="cout_unitaire_lots", type="decimal", precision=10, scale=2, nullable=true, options={"default"="NULL"})
     */
    private $coutUnitaireLots = 'NULL';

    /**
     * @var int|null
     *
     * @ORM\Column(name="quantite_achete_lots", type="integer", nullable=true, options={"default"="NULL"})
     */
    private $quantiteAcheteLots = NULL;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="date_creation_lots", type="datetime", nullable=true, options={"default"="NULL"})
     */
    private $dateCreationLots = 'NULL';

    /**
     * @var \Articles
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\OneToOne(targetEntity="Articles")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_externe", referencedColumnName="id_externe")
     * })
     */
    private $idExterne;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Admin", inversedBy="idExterne")
     * @ORM\JoinTable(name="importations",
     *   joinColumns={
     *     @ORM\JoinColumn(name="id_externe", referencedColumnName="id_externe"),
     *     @ORM\JoinColumn(name="ref_commandes_lots", referencedColumnName="ref_commandes_lots")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="id_admin", referencedColumnName="id_admin")
     *   }
     * )
     */
    private $idAdmin;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->idAdmin = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function getRefCommandesLots(): ?int
    {
        return $this->refCommandesLots;
    }

    public function getCoutUnitaireLots(): ?string
    {
        return $this->coutUnitaireLots;
    }

    public function setCoutUnitaireLots(?string $coutUnitaireLots): self
    {
        $this->coutUnitaireLots = $coutUnitaireLots;

        return $this;
    }

    public function getQuantiteAcheteLots(): ?int
    {
        return $this->quantiteAcheteLots;
    }

    public function setQuantiteAcheteLots(?int $quantiteAcheteLots): self
    {
        $this->quantiteAcheteLots = $quantiteAcheteLots;

        return $this;
    }

    public function getDateCreationLots(): ?\DateTimeInterface
    {
        return $this->dateCreationLots;
    }

    public function setDateCreationLots(?\DateTimeInterface $dateCreationLots): self
    {
        $this->dateCreationLots = $dateCreationLots;

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

    /**
     * @return Collection|Admin[]
     */
    public function getIdAdmin(): Collection
    {
        return $this->idAdmin;
    }

    public function addIdAdmin(Admin $idAdmin): self
    {
        if (!$this->idAdmin->contains($idAdmin)) {
            $this->idAdmin[] = $idAdmin;
        }

        return $this;
    }

    public function removeIdAdmin(Admin $idAdmin): self
    {
        $this->idAdmin->removeElement($idAdmin);

        return $this;
    }

}
