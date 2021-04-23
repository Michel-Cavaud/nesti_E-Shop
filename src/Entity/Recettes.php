<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Recettes
 *
 * @ORM\Table(name="recettes", uniqueConstraints={@ORM\UniqueConstraint(name="id_images", columns={"id_images"})}, indexes={@ORM\Index(name="id_chef", columns={"id_chef"})})
 * @ORM\Entity(repositoryClass="App\Repository\RecettesRepository")
 */
class Recettes
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_recettes", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idRecettes;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="date_creation_recettes", type="datetime", nullable=true, options={"default"="current_timestamp()"})
     */
    private $dateCreationRecettes = 'current_timestamp()';

    /**
     * @var string|null
     *
     * @ORM\Column(name="nom_recettes", type="string", length=120, nullable=true, options={"default"="NULL"})
     */
    private $nomRecettes = 'NULL';

    /**
     * @var bool|null
     *
     * @ORM\Column(name="difficulte_recettes", type="boolean", nullable=true, options={"default"="NULL"})
     */
    private $difficulteRecettes = 'NULL';

    /**
     * @var bool|null
     *
     * @ORM\Column(name="nombre_personne_recettes", type="boolean", nullable=true, options={"default"="NULL"})
     */
    private $nombrePersonneRecettes = 'NULL';

    /**
     * @var string|null
     *
     * @ORM\Column(name="etat_recettes", type="string", length=0, nullable=true, options={"default"="NULL"})
     */
    private $etatRecettes = 'NULL';

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="temps_recettes", type="time", nullable=true, options={"default"="NULL"})
     */
    private $tempsRecettes = 'NULL';

    /**
     * @var \Chef
     *
     * @ORM\ManyToOne(targetEntity="Chef")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_chef", referencedColumnName="id_chef")
     * })
     */
    private $idChef;

    /**
     * @var \Images
     *
     * @ORM\ManyToOne(targetEntity="Images")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_images", referencedColumnName="id_images")
     * })
     */
    private $idImages;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Utilisateurs", inversedBy="idRecettes")
     * @ORM\JoinTable(name="donne_une_note",
     *   joinColumns={
     *     @ORM\JoinColumn(name="id_recettes", referencedColumnName="id_recettes")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="id_utilisateurs", referencedColumnName="id_utilisateurs")
     *   }
     * )
     */
    private $idUtilisateurs;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Categories", inversedBy="idRecettes")
     * @ORM\JoinTable(name="list_categories",
     *   joinColumns={
     *     @ORM\JoinColumn(name="id_recettes", referencedColumnName="id_recettes")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="id_categories", referencedColumnName="id_categories")
     *   }
     * )
     */
    private $idCategories;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->idUtilisateurs = new \Doctrine\Common\Collections\ArrayCollection();
        $this->idCategories = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function getIdRecettes(): ?int
    {
        return $this->idRecettes;
    }

    public function getDateCreationRecettes(): ?\DateTimeInterface
    {
        return $this->dateCreationRecettes;
    }

    public function setDateCreationRecettes(?\DateTimeInterface $dateCreationRecettes): self
    {
        $this->dateCreationRecettes = $dateCreationRecettes;

        return $this;
    }

    public function getNomRecettes(): ?string
    {
        return $this->nomRecettes;
    }

    public function setNomRecettes(?string $nomRecettes): self
    {
        $this->nomRecettes = $nomRecettes;

        return $this;
    }

    public function getDifficulteRecettes(): ?bool
    {
        return $this->difficulteRecettes;
    }

    public function setDifficulteRecettes(?bool $difficulteRecettes): self
    {
        $this->difficulteRecettes = $difficulteRecettes;

        return $this;
    }

    public function getNombrePersonneRecettes(): ?bool
    {
        return $this->nombrePersonneRecettes;
    }

    public function setNombrePersonneRecettes(?bool $nombrePersonneRecettes): self
    {
        $this->nombrePersonneRecettes = $nombrePersonneRecettes;

        return $this;
    }

    public function getEtatRecettes(): ?string
    {
        return $this->etatRecettes;
    }

    public function setEtatRecettes(?string $etatRecettes): self
    {
        $this->etatRecettes = $etatRecettes;

        return $this;
    }

    public function getTempsRecettes(): ?\DateTimeInterface
    {
        return $this->tempsRecettes;
    }

    public function setTempsRecettes(?\DateTimeInterface $tempsRecettes): self
    {
        $this->tempsRecettes = $tempsRecettes;

        return $this;
    }

    public function getIdChef(): ?Chef
    {
        return $this->idChef;
    }

    public function setIdChef(?Chef $idChef): self
    {
        $this->idChef = $idChef;

        return $this;
    }

    public function getIdImages(): ?Images
    {
        return $this->idImages;
    }

    public function setIdImages(?Images $idImages): self
    {
        $this->idImages = $idImages;

        return $this;
    }

    /**
     * @return Collection|Utilisateurs[]
     */
    public function getIdUtilisateurs(): Collection
    {
        return $this->idUtilisateurs;
    }

    public function addIdUtilisateur(Utilisateurs $idUtilisateur): self
    {
        if (!$this->idUtilisateurs->contains($idUtilisateur)) {
            $this->idUtilisateurs[] = $idUtilisateur;
        }

        return $this;
    }

    public function removeIdUtilisateur(Utilisateurs $idUtilisateur): self
    {
        $this->idUtilisateurs->removeElement($idUtilisateur);

        return $this;
    }

    /**
     * @return Collection|Categories[]
     */
    public function getIdCategories(): Collection
    {
        return $this->idCategories;
    }

    public function addIdCategory(Categories $idCategory): self
    {
        if (!$this->idCategories->contains($idCategory)) {
            $this->idCategories[] = $idCategory;
        }

        return $this;
    }

    public function removeIdCategory(Categories $idCategory): self
    {
        $this->idCategories->removeElement($idCategory);

        return $this;
    }

}
