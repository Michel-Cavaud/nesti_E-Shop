<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\ImagesRepository;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=ImagesRepository::class)
 */
class Images
{
    /**
     * @ORM\Column(name="id_images", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     */
    private $dateCreationImages;

    /**
     * @ORM\Column(type="string", length=50)
     * @Groups({"json_recette"})
     */
    private $nomImages;

    /**
     * @ORM\Column(type="string", length=20)
     * @Groups({"json_recette"})
     */
    private $extensionImages;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateCreationImages(): ?\DateTimeInterface
    {
        return $this->dateCreationImages;
    }

    public function setDateCreationImages(\DateTimeInterface $dateCreationImages): self
    {
        $this->dateCreationImages = $dateCreationImages;

        return $this;
    }

    public function getNomImages(): ?string
    {
        return $this->nomImages;
    }

    public function setNomImages(string $nomImages): self
    {
        $this->nomImages = $nomImages;

        return $this;
    }

    public function getExtensionImages(): ?string
    {
        return $this->extensionImages;
    }

    public function setExtensionImages(string $extensionImages): self
    {
        $this->extensionImages = $extensionImages;

        return $this;
    }
}
