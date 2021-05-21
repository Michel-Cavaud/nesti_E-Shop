<?php

namespace App\Entity;

use App\Entity\Utilisateurs;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\VilleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=VilleRepository::class)
 * @ORM\Table(name="ville",uniqueConstraints={@ORM\UniqueConstraint(name="id_ville", columns={"nom_ville"})})
 */

class Ville
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(name="id_ville", type="integer", nullable=false)
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"json_user"})
     */
    private $nomVille;


    /**
     * @ORM\OneToMany(targetEntity=Utilisateurs::class, cascade={"persist", "remove"}, mappedBy="idVille")
     */
    protected $utilisateurs;

    public function __construct()
    {
        $this->utilisateurs = new ArrayCollection();
    }

    public function getUtilisateurs()
    {
        return $this->utilisateurs;
    }

    public function addAnswer(Utilisateurs $utilisateur)
    {
        $this->utilisateurs->add($utilisateur);
        $utilisateur->setIdVille($this);
    }

    public function getId(): ?int
    {
        return $this->id;
    }
    public function setId(string $id): self
    {
        $this->id = $id;

        return $this;
    }

    public function getNomVille(): ?string
    {
        return $this->nomVille;
    }

    public function setNomVille(string $nomVille): self
    {
        $this->nomVille = $nomVille;

        return $this;
    }
}
