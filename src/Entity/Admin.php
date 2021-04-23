<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Admin
 *
 * @ORM\Table(name="admin")
 * @ORM\Entity
 */
class Admin
{
    /**
     * @var \Utilisateurs
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\OneToOne(targetEntity="Utilisateurs")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_admin", referencedColumnName="id_utilisateurs")
     * })
     */
    private $idAdmin;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Lots", mappedBy="idAdmin")
     */
    private $idExterne;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->idExterne = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function getIdAdmin(): ?Utilisateurs
    {
        return $this->idAdmin;
    }

    public function setIdAdmin(?Utilisateurs $idAdmin): self
    {
        $this->idAdmin = $idAdmin;

        return $this;
    }

    /**
     * @return Collection|Lots[]
     */
    public function getIdExterne(): Collection
    {
        return $this->idExterne;
    }

    public function addIdExterne(Lots $idExterne): self
    {
        if (!$this->idExterne->contains($idExterne)) {
            $this->idExterne[] = $idExterne;
            $idExterne->addIdAdmin($this);
        }

        return $this;
    }

    public function removeIdExterne(Lots $idExterne): self
    {
        if ($this->idExterne->removeElement($idExterne)) {
            $idExterne->removeIdAdmin($this);
        }

        return $this;
    }

}
