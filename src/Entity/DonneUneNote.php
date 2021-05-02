<?php

namespace App\Entity;

use App\Repository\DonneUneNoteRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=DonneUneNoteRepository::class)
 */
class DonneUneNote
{
    /**
     * @ORM\Column(type="integer")
     */
    private $noteSur5;

    /**
     * @ORM\ManyToOne(targetEntity=Recettes::class, inversedBy="donneUneNotes")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_recettes", referencedColumnName="id_recettes")
     * })
     * @ORM\Id
     */
    private $idRecettes;

    /**
     * @ORM\ManyToOne(targetEntity=Utilisateurs::class, inversedBy="donneUneNotes")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_utilisateurs", referencedColumnName="id_utilisateurs")
     * })
     * @ORM\Id
     */
    private $idUtilisateurs;

    public function getNoteSur5(): ?int
    {
        return $this->noteSur5;
    }

    public function setNoteSur5(int $noteSur5): self
    {
        $this->noteSur5 = $noteSur5;

        return $this;
    }

    public function getIdRecettes(): ?Recettes
    {
        return $this->idRecettes;
    }

    public function setIdRecettes(?Recettes $idRecettes): self
    {
        $this->idRecettes = $idRecettes;

        return $this;
    }

    public function getIdUtilisateurs(): ?Utilisateurs
    {
        return $this->idUtilisateurs;
    }

    public function setIdUtilisateurs(?Utilisateurs $idUtilisateurs): self
    {
        $this->idUtilisateurs = $idUtilisateurs;

        return $this;
    }
}
