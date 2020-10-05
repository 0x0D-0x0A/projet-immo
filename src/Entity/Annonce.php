<?php

namespace App\Entity;

use App\Repository\AnnonceRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=AnnonceRepository::class)
 * @ORM\HasLifecycleCallbacks()
 * @UniqueEntity("titre")
 */
class Annonce
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="id")
     */
    private $proprietaire;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $titre;

    /**
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @ORM\Column(type="integer")
     */
    private $prix;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $photo;

    /**
     * @ORM\Column(type="string", length=10)
     */
    private $categorie;

    /**
     * @ORM\Column(type="string", length=12)
     */
    private $type;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $updatedAt;

    const CATEGORIE_VENTE = 'vente';
    const CATEGORIE_LOCATION = 'location';
    const TYPE_MAISON = 'maison';
    const TYPE_APPARTEMENT = 'appartement';

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): self
    {
        $this->titre = $titre;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getPrix(): ?int
    {
        return $this->prix;
    }

    public function setPrix(int $prix): self
    {
        $this->prix = $prix;

        return $this;
    }

    public function getPhoto(): ?string
    {
        return $this->photo;
    }

    public function setPhoto(string $photo): self
    {
        $this->photo = $photo;

        return $this;
    }

    // /**
     // * @ORM\Column(name="categorie", type="string", columnDefinition="enum('vente', 'location')")
     // */
    public function getCategorie(): ?string
    {
        return $this->categorie;
    }

    public function setCategorie($categorie)
    {
        if (!in_array($categorie, array(self::CATEGORIE_VENTE, self::CATEGORIE_LOCATION))) {
            throw new \InvalidArgumentException("Catégorie invalide");
        }
        $this->categorie = $categorie;
    }

    // public function setCategorie(string $categorie): self
    // {
    //     $this->categorie = $categorie;

    //     return $this;
    // }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType($type)
    {
        if (!in_array($type, array(self::TYPE_MAISON, self::TYPE_APPARTEMENT))) {
            throw new \InvalidArgumentException("Type invalide");
        }
        $this->type = $type;
    }

    // public function setType(string $type): self
    // {
    //     $this->type = $type;

    //     return $this;
    // }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    /**
    * @ORM\PrePersist
    */
    public function setCreatedAt(): self
    {
        $this->createdAt = new \DateTime('now', new \DateTimeZone('Europe/Paris'));

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }

    /**
    * @ORM\PreUpdate
    */
    public function setUpdatedAt(): self
    {
        $this->updatedAt = new \DateTime('now', new \DateTimeZone('Europe/Paris'));

        return $this;
    }

}
