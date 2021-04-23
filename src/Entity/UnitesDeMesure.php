<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * UnitesDeMesure
 *
 * @ORM\Table(name="unites_de_mesure")
 * @ORM\Entity(repositoryClass="App\Repository\UnitesDeMesuresRepository")
 */
class UnitesDeMesure
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_unites_de_mesure", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idUnitesDeMesure;

    /**
     * @var string|null
     *
     * @ORM\Column(name="nom_unites_de_mesure", type="string", length=50, nullable=true, options={"default"="NULL"})
     */
    private $nomUnitesDeMesure = 'NULL';

    public function getIdUnitesDeMesure(): ?int
    {
        return $this->idUnitesDeMesure;
    }

    public function getNomUnitesDeMesure(): ?string
    {
        return $this->nomUnitesDeMesure;
    }

    public function setNomUnitesDeMesure(?string $nomUnitesDeMesure): self
    {
        $this->nomUnitesDeMesure = $nomUnitesDeMesure;

        return $this;
    }


}
