<?php

namespace App\Entity;

use App\Repository\UnitesDeMesureRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=UnitesDeMesureRepository::class)
 */
class UnitesDeMesure
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(name="id_unites_de_mesure", type="integer", nullable=false)
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nomUnitesDeMesure;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomUnitesDeMesure(): ?string
    {
        return $this->nomUnitesDeMesure;
    }

    public function setNomUnitesDeMesure(string $nomUnitesDeMesure): self
    {
        $this->nomUnitesDeMesure = $nomUnitesDeMesure;

        return $this;
    }
}
