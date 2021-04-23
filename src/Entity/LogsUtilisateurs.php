<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * LogsUtilisateurs
 *
 * @ORM\Table(name="logs_utilisateurs", indexes={@ORM\Index(name="id_utilisateurs", columns={"id_utilisateurs"})})
 * @ORM\Entity
 */
class LogsUtilisateurs
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_logs_utilisateurs", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idLogsUtilisateurs;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="date_logs_utilisateurs", type="datetime", nullable=true, options={"default"="current_timestamp()"})
     */
    private $dateLogsUtilisateurs = 'current_timestamp()';

    /**
     * @var \Utilisateurs
     *
     * @ORM\ManyToOne(targetEntity="Utilisateurs")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_utilisateurs", referencedColumnName="id_utilisateurs")
     * })
     */
    private $idUtilisateurs;

    public function getIdLogsUtilisateurs(): ?int
    {
        return $this->idLogsUtilisateurs;
    }

    public function getDateLogsUtilisateurs(): ?\DateTimeInterface
    {
        return $this->dateLogsUtilisateurs;
    }

    public function setDateLogsUtilisateurs(?\DateTimeInterface $dateLogsUtilisateurs): self
    {
        $this->dateLogsUtilisateurs = $dateLogsUtilisateurs;

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
