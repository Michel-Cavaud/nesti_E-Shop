<?php

namespace App\Entity;

use App\Repository\LogsUtilisateursRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=LogsUtilisateursRepository::class)
 */
class LogsUtilisateurs
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(name="id_logs_utilisateurs", type="integer", nullable=false)
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     */
    private $dateLogsUtilisateurs;

    /**
     *@ORM\Column(name="id_utilisateurs", type="integer", nullable=false)
     *
     */
    private $idUtilisateurs;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateLogsUtilisateurs(): ?\DateTimeInterface
    {
        return $this->dateLogsUtilisateurs;
    }

    public function setDateLogsUtilisateurs(\DateTimeInterface $dateLogsUtilisateurs): self
    {
        $this->dateLogsUtilisateurs = $dateLogsUtilisateurs;

        return $this;
    }

    public function getIdUtilisateurs()
    {
        return $this->idUtilisateurs;
    }

    public function setIdUtilisateurs($idUtilisateurs): self
    {
        $this->idUtilisateurs = $idUtilisateurs;

        return $this;
    }
}
