<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Images
 *
 * @ORM\Table(name="images")
 * @ORM\Entity(repositoryClass="App\Repository\ImagesRepository")
 */
class Images
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_images", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idImages;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="date_creation_images", type="datetime", nullable=true, options={"default"="current_timestamp()"})
     */
    private $dateCreationImages = 'current_timestamp()';

    /**
     * @var string|null
     *
     * @ORM\Column(name="nom_images", type="string", length=50, nullable=true, options={"default"="NULL"})
     */
    private $nomImages = 'NULL';

    /**
     * @var string|null
     *
     * @ORM\Column(name="extension_images", type="string", length=0, nullable=true, options={"default"="NULL"})
     */
    private $extensionImages = 'NULL';

    public function getIdImages(): ?int
    {
        return $this->idImages;
    }

    public function getDateCreationImages(): ?\DateTimeInterface
    {
        return $this->dateCreationImages;
    }

    public function setDateCreationImages(?\DateTimeInterface $dateCreationImages): self
    {
        $this->dateCreationImages = $dateCreationImages;

        return $this;
    }

    public function getNomImages(): ?string
    {
        return $this->nomImages;
    }

    public function setNomImages(?string $nomImages): self
    {
        $this->nomImages = $nomImages;

        return $this;
    }

    public function getExtensionImages(): ?string
    {
        return $this->extensionImages;
    }

    public function setExtensionImages(?string $extensionImages): self
    {
        $this->extensionImages = $extensionImages;

        return $this;
    }


}
