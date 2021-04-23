<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Moderateurs
 *
 * @ORM\Table(name="moderateurs")
 * @ORM\Entity
 */
class Moderateurs
{
    /**
     * @var \Utilisateurs
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\OneToOne(targetEntity="Utilisateurs")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_moderateurs", referencedColumnName="id_utilisateurs")
     * })
     */
    private $idModerateurs;

    public function getIdModerateurs(): ?Utilisateurs
    {
        return $this->idModerateurs;
    }

    public function setIdModerateurs(?Utilisateurs $idModerateurs): self
    {
        $this->idModerateurs = $idModerateurs;

        return $this;
    }


}
