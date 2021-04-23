<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Paragraphes
 *
 * @ORM\Table(name="paragraphes", indexes={@ORM\Index(name="id_recettes", columns={"id_recettes"})})
 * @ORM\Entity(repositoryClass="App\Repository\ParagraphesRepository")
 */
class Paragraphes
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_paragraphes", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idParagraphes;

    /**
     * @var string|null
     *
     * @ORM\Column(name="contenu_paragraphes", type="string", length=255, nullable=true, options={"default"="NULL"})
     */
    private $contenuParagraphes = 'NULL';

    /**
     * @var bool|null
     *
     * @ORM\Column(name="ordre_paragraphes", type="boolean", nullable=true, options={"default"="NULL"})
     */
    private $ordreParagraphes = 'NULL';

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="date_creation_paragraphes", type="datetime", nullable=true, options={"default"="current_timestamp()"})
     */
    private $dateCreationParagraphes = 'current_timestamp()';

    /**
     * @var \Recettes
     *
     * @ORM\ManyToOne(targetEntity="Recettes")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_recettes", referencedColumnName="id_recettes")
     * })
     */
    private $idRecettes;

    public function getIdParagraphes(): ?int
    {
        return $this->idParagraphes;
    }

    public function getContenuParagraphes(): ?string
    {
        return $this->contenuParagraphes;
    }

    public function setContenuParagraphes(?string $contenuParagraphes): self
    {
        $this->contenuParagraphes = $contenuParagraphes;

        return $this;
    }

    public function getOrdreParagraphes(): ?bool
    {
        return $this->ordreParagraphes;
    }

    public function setOrdreParagraphes(?bool $ordreParagraphes): self
    {
        $this->ordreParagraphes = $ordreParagraphes;

        return $this;
    }

    public function getDateCreationParagraphes(): ?\DateTimeInterface
    {
        return $this->dateCreationParagraphes;
    }

    public function setDateCreationParagraphes(?\DateTimeInterface $dateCreationParagraphes): self
    {
        $this->dateCreationParagraphes = $dateCreationParagraphes;

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


}
