<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\EventsRepository")
 * @ApiResource
 */
class Events
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups("events:read")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255,unique=true)
     * @Groups("events:read")
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups("events:read")
     */
    private $photo;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups("events:read")
     */
    private $lieu;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $descreption;

    /**
     * @ORM\Column(type="date",unique=true)
     * @Groups("events:read")
     */
    private $date_debut;

    /**
     * @ORM\Column(type="date")
     * @Groups("events:read")
     */
    private $date_fin;

    /**
     * @ORM\Column(type="time")
     * @Groups("events:read")
     */
    private $temps_debut;

    /**
     * @ORM\Column(type="time", nullable=true)
     * @Groups("events:read")
     */
    private $temps_fin;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Comment", mappedBy="events", orphanRemoval=true)
     */
    private $comments;

    public function __construct()
    {
        $this->comments = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPhoto(): ?string
    {
        return $this->photo;
    }

    public function setPhoto(?string $photo): self
    {
        $this->photo = $photo;

        return $this;
    }

    public function getLieu(): ?string
    {
        return $this->lieu;
    }

    public function setLieu(?string $lieu): self
    {
        $this->lieu = $lieu;

        return $this;
    }

    public function getDescreption(): ?string
    {
        return $this->descreption;
    }

    public function setDescreption(?string $descreption): self
    {
        $this->descreption = $descreption;

        return $this;
    }

    public function getDateDebut(): ?\DateTimeInterface
    {
        return $this->date_debut;
    }

    public function setDateDebut(\DateTimeInterface $date_debut): self
    {
        $this->date_debut = $date_debut;

        return $this;
    }

    public function getDateFin(): ?\DateTimeInterface
    {
        return $this->date_fin;
    }

    public function setDateFin(\DateTimeInterface $date_fin): self
    {
        $this->date_fin = $date_fin;

        return $this;
    }

    public function getTempsDebut(): ?\DateTimeInterface
    {
        return $this->temps_debut;
    }

    public function setTempsDebut(\DateTimeInterface $temps_debut): self
    {
        $this->temps_debut = $temps_debut;

        return $this;
    }

    public function getTempsFin(): ?\DateTimeInterface
    {
        return $this->temps_fin;
    }

    public function setTempsFin(?\DateTimeInterface $temps_fin): self
    {
        $this->temps_fin = $temps_fin;

        return $this;
    }

    /**
     * @return Collection|Comment[]
     */
    public function getComments(): Collection
    {
        return $this->comments;
    }

    public function addComment(Comment $comment): self
    {
        if (!$this->comments->contains($comment)) {
            $this->comments[] = $comment;
            $comment->setEvents($this);
        }

        return $this;
    }

    public function removeComment(Comment $comment): self
    {
        if ($this->comments->contains($comment)) {
            $this->comments->removeElement($comment);
            // set the owning side to null (unless already changed)
            if ($comment->getEvents() === $this) {
                $comment->setEvents(null);
            }
        }

        return $this;
    }
}
