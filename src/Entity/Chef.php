<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Chef
 *
 * @ORM\Table(name="chef")
 * @ORM\Entity
 */
class Chef
{
    /**
     * @var \Utilisateurs
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\OneToOne(targetEntity="Utilisateurs")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_chef", referencedColumnName="id_utilisateurs")
     * })
     */
    private $idChef;

    public function getIdChef(): ?Utilisateurs
    {
        return $this->idChef;
    }

    public function setIdChef(?Utilisateurs $idChef): self
    {
        $this->idChef = $idChef;

        return $this;
    }


}
