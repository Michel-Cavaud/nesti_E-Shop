<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\RecettesRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=RecettesRepository::class)
 */
class Recettes
{
    /**
     * @ORM\Column(name="id_recettes", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue
     * @Groups({"json_recette"})
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     */
    private $dateCreationRecettes;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"json_recette"})
     */
    private $nomRecettes;

    /**
     * @ORM\Column(type="integer")
     * @Groups({"json_recette"})
     *
     */
    private $difficulteRecettes;



    /**
     * @ORM\Column(type="string", length=20)
     */
    private $etatRecettes;

    /**
     * @ORM\Column(type="time")
     * @Groups({"json_recette"})
     */
    private $tempsRecettes;

    /**
     * 
     */
    private $tempsMn;

    /**
     * @ORM\Column(type="integer")
     */
    private $nombrePersonneRecettes;

    /**
     * @ORM\OneToOne(targetEntity=Images::class, cascade={"persist", "remove"})
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_images", referencedColumnName="id_images")
     * })
     * @Groups({"json_recette"})
     */
    private $images;

    /**
     *
     */
    private $idIngredientsRecette;

    /**
     *
     * @Groups({"json_recette"})
     */
    private $idProduitsRecette;

    /**
     * @ORM\OneToMany(targetEntity=Paragraphes::class, mappedBy="idRecettes")
     */
    private $paragraphes;

    /**
     * @ORM\OneToMany(targetEntity=Commentaires::class, mappedBy="idRecettes")
     */
    private $commentaires;

    /**
     * @ORM\OneToMany(targetEntity=DonneUneNote::class, mappedBy="idRecettes")
     */
    private $donneUneNotes;




    public function __construct()
    {
        $this->paragraphes = new ArrayCollection();
        $this->commentaires = new ArrayCollection();
        $this->donneUneNotes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }
    public function setId($id)
    {
        $this->id = $id;
    }

    public function getDateCreationRecettes(): ?\DateTimeInterface
    {
        return $this->dateCreationRecettes;
    }

    public function setDateCreationRecettes(\DateTimeInterface $dateCreationRecettes): self
    {
        $this->dateCreationRecettes = $dateCreationRecettes;

        return $this;
    }

    public function getNomRecettes(): ?string
    {
        return $this->nomRecettes;
    }

    public function setNomRecettes(string $nomRecettes): self
    {
        $this->nomRecettes = $nomRecettes;

        return $this;
    }

    public function getDifficulteRecettes(): ?int
    {
        return $this->difficulteRecettes;
    }

    public function setDifficulteRecettes(int $difficulteRecettes): self
    {
        $this->difficulteRecettes = $difficulteRecettes;

        return $this;
    }



    public function getEtatRecettes(): ?string
    {
        return $this->etatRecettes;
    }

    public function setEtatRecettes(string $etatRecettes): self
    {
        $this->etatRecettes = $etatRecettes;

        return $this;
    }

    public function getTempsRecettes(): ?\DateTimeInterface
    {
        return $this->tempsRecettes;
    }

    public function setTempsRecettes(\DateTimeInterface $tempsRecettes): self
    {
        $this->tempsRecettes = $tempsRecettes;

        return $this;
    }

    public function getTempsMn()
    {
        return $this->tempsMn;
    }

    public function setTempsMn($tempsMn)
    {
        $this->tempsMn = $tempsMn;

        return $this;
    }

    public function getNombrePersonneRecettes(): ?int
    {
        return $this->nombrePersonneRecettes;
    }

    public function setNombrePersonneRecettes(int $nombrePersonneRecettes): self
    {
        $this->nombrePersonneRecettes = $nombrePersonneRecettes;

        return $this;
    }

    public function getImages(): ?Images
    {
        return $this->images;
    }

    public function setImages(?Images $images): self
    {
        $this->images = $images;

        return $this;
    }

    /**
     * 
     */
    public function getIdIngredientsRecette()
    {
        return $this->idIngredientsRecette;
    }

    public function addIdIngredientsRecette($ingredientsRecette): self
    {

        $this->idIngredientsRecette[] = $ingredientsRecette;


        return $this;
    }

    /**
     * 
     */
    public function getIdProduitsRecette()
    {
        return $this->idProduitsRecette;
    }

    public function addIdProduitsRecette($produitsRecette): self
    {
        $this->idProduitsRecette[] = strtolower($produitsRecette);

        return $this;
    }

    /**
     * @return Collection|Paragraphes[]
     */
    public function getParagraphes(): Collection
    {
        return $this->paragraphes;
    }

    public function addParagraphe(Paragraphes $paragraphe): self
    {
        if (!$this->paragraphes->contains($paragraphe)) {
            $this->paragraphes[] = $paragraphe;
            $paragraphe->setIdRecettes($this);
        }

        return $this;
    }

    public function removeParagraphe(Paragraphes $paragraphe): self
    {
        if ($this->paragraphes->removeElement($paragraphe)) {
            // set the owning side to null (unless already changed)
            if ($paragraphe->getIdRecettes() === $this) {
                $paragraphe->setIdRecettes(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Commentaires[]
     */
    public function getCommentaires(): Collection
    {
        return $this->commentaires;
    }

    public function addCommentaire(Commentaires $commentaire): self
    {
        if (!$this->commentaires->contains($commentaire)) {
            $this->commentaires[] = $commentaire;
            $commentaire->setIdRecettes($this);
        }

        return $this;
    }

    public function removeCommentaire(Commentaires $commentaire): self
    {
        if ($this->commentaires->removeElement($commentaire)) {
            // set the owning side to null (unless already changed)
            if ($commentaire->getIdRecettes() === $this) {
                $commentaire->setIdRecettes(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|DonneUneNote[]
     */
    public function getDonneUneNotes(): Collection
    {
        return $this->donneUneNotes;
    }

    public function addDonneUneNote(DonneUneNote $donneUneNote): self
    {
        if (!$this->donneUneNotes->contains($donneUneNote)) {
            $this->donneUneNotes[] = $donneUneNote;
            $donneUneNote->addIdRecette($this);
        }

        return $this;
    }

    public function removeDonneUneNote(DonneUneNote $donneUneNote): self
    {
        if ($this->donneUneNotes->removeElement($donneUneNote)) {
            $donneUneNote->removeIdRecette($this);
        }

        return $this;
    }
}
