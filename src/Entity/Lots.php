<?php

namespace App\Entity;

use App\Repository\LotsRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=LotsRepository::class)
 */
class Lots
{

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     */
    private $refCommandesLots;

    /**
     * @ORM\Column(type="float")
     */
    private $coutUnitaireLots;

    /**
     * @ORM\Column(type="integer")
     */
    private $quantiteAcheteLots;

    /**
     * @ORM\Column(type="datetime")
     */
    private $dateCreationLots;

    /**
     *  @ORM\Id
     * @ORM\ManyToOne(targetEntity=Articles::class, inversedBy="lots")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_externe", referencedColumnName="id_externe")
     * })
     */
    private $idExterne;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRefCommandesLots(): ?int
    {
        return $this->refCommandesLots;
    }

    public function setRefCommandesLots(int $refCommandesLots): self
    {
        $this->refCommandesLots = $refCommandesLots;

        return $this;
    }

    public function getCoutUnitaireLots(): ?float
    {
        return $this->coutUnitaireLots;
    }

    public function setCoutUnitaireLots(float $coutUnitaireLots): self
    {
        $this->coutUnitaireLots = $coutUnitaireLots;

        return $this;
    }

    public function getQuantiteAcheteLots(): ?int
    {
        return $this->quantiteAcheteLots;
    }

    public function setQuantiteAcheteLots(int $quantiteAcheteLots): self
    {
        $this->quantiteAcheteLots = $quantiteAcheteLots;

        return $this;
    }

    public function getDateCreationLots(): ?\DateTimeInterface
    {
        return $this->dateCreationLots;
    }

    public function setDateCreationLots(\DateTimeInterface $dateCreationLots): self
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
}
