<?php

namespace App\Entity;

use App\Repository\DefiRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: DefiRepository::class)]
class Defi
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message: 'Le titre est obligatoire.')]
    #[Assert\Length(
        max: 255,
        maxMessage: 'Le titre ne doit pas dépasser {{ limit }} caractères.'
    )]
    private string $titre;

    #[ORM\Column(type: 'text')]
    #[Assert\NotBlank(message: 'La description est obligatoire.')]
    private string $description;

    #[ORM\Column(length: 50)]
    #[Assert\NotBlank(message: 'La difficulté est obligatoire.')]
    private string $difficulte;

    #[ORM\Column]
    #[Assert\NotBlank(message: 'La durée est obligatoire.')]
    #[Assert\Positive(message: 'La durée doit être un entier positif.')]
    private int $duree;

    #[ORM\Column(type: 'datetime_immutable', nullable: true)]
    private ?\DateTimeImmutable $datePublication = null;

    #[ORM\Column(length: 50, nullable: true)]
    private ?string $statutModeration = null;

    #[ORM\OneToMany(mappedBy: 'defi', targetEntity: PasserDefi::class, orphanRemoval: true)]
    private Collection $participations;

    #[ORM\OneToMany(mappedBy: 'defi', targetEntity: DemandeAide::class, orphanRemoval: true)]
    private Collection $demandesAide;

    #[ORM\OneToMany(mappedBy: 'defi', targetEntity: RetourExperience::class, orphanRemoval: true)]
    private Collection $retoursExperience;

    public function __construct()
    {
        $this->participations = new ArrayCollection();
        $this->demandesAide = new ArrayCollection();
        $this->retoursExperience = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): static
    {
        $this->titre = $titre;
        return $this;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;
        return $this;
    }

    public function getDifficulte(): string
    {
        return $this->difficulte;
    }

    public function setDifficulte(string $difficulte): static
    {
        $this->difficulte = $difficulte;
        return $this;
    }

    public function getDuree(): int
    {
        return $this->duree;
    }

    public function setDuree(int $duree): static
    {
        $this->duree = $duree;
        return $this;
    }

    public function getDatePublication(): ?\DateTimeImmutable
    {
        return $this->datePublication;
    }

    public function setDatePublication(?\DateTimeImmutable $datePublication): static
    {
        $this->datePublication = $datePublication;
        return $this;
    }

    public function getStatutModeration(): ?string
    {
        return $this->statutModeration;
    }

    public function setStatutModeration(?string $statutModeration): static
    {
        $this->statutModeration = $statutModeration;
        return $this;
    }

    /** @return Collection<int, PasserDefi> */
    public function getParticipations(): Collection
    {
        return $this->participations;
    }

    /** @return Collection<int, DemandeAide> */
    public function getDemandesAide(): Collection
    {
        return $this->demandesAide;
    }

    /** @return Collection<int, RetourExperience> */
    public function getRetoursExperience(): Collection
    {
        return $this->retoursExperience;
    }
}
