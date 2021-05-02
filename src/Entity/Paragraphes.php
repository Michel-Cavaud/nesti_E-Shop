<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\ParagraphesRepository;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Serializer\Annotation\Ignore;

/**
 * @ORM\Entity(repositoryClass=ParagraphesRepository::class)
 */
class Paragraphes
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(name="id_paragraphes", type="integer", nullable=false)
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"json_recette"})
     */
    private $contenuParagraphes;

    /**
     * @ORM\Column(type="integer")
     * @Groups({"json_recette"})
     */
    private $ordreParagraphes;

    /**
     * @ORM\Column(type="datetime")
     */
    private $dateCreationParagraphes;

    /**
     * @ORM\ManyToOne(targetEntity=Recettes::class, inversedBy="paragraphes")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_recettes", referencedColumnName="id_recettes")
     * })
     * @Ignore()
     */
    private $idRecettes;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getContenuParagraphes(): ?string
    {
        return $this->contenuParagraphes;
    }

    public function setContenuParagraphes(string $contenuParagraphes): self
    {
        $this->contenuParagraphes = $contenuParagraphes;

        return $this;
    }

    public function getOrdreParagraphes(): ?int
    {
        return $this->ordreParagraphes;
    }

    public function setOrdreParagraphes(int $ordreParagraphes): self
    {
        $this->ordreParagraphes = $ordreParagraphes;

        return $this;
    }

    public function getDateCreationParagraphes(): ?\DateTimeInterface
    {
        return $this->dateCreationParagraphes;
    }

    public function setDateCreationParagraphes(\DateTimeInterface $dateCreationParagraphes): self
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
