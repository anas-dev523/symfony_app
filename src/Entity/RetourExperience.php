<?php

namespace App\Entity;

use App\Repository\RetourExperienceRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: RetourExperienceRepository::class)]
class RetourExperience
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: 'text')]
    #[Assert\NotBlank(message: 'Le contenu du retour est obligatoire.')]
    #[Assert\Length(
        min: 10,
        minMessage: 'Le retour doit contenir au moins {{ limit }} caractères.'
    )]
    private string $contenu;

    #[ORM\Column(length: 10)]
    #[Assert\NotBlank(message: 'Merci de choisir un emoji.')]
    #[Assert\Length(max: 10, maxMessage: 'L’emoji ne doit pas dépasser {{ limit }} caractères.')]
    private string $emoji;

    #[ORM\Column(type: 'datetime_immutable')]
    private \DateTimeImmutable $dateRetour;

    #[ORM\ManyToOne(inversedBy: 'retoursExperience')]
    #[ORM\JoinColumn(nullable: false)]
    #[Assert\NotNull(message: 'Un utilisateur est requis pour créer un retour.')]
    private ?Utilisateur $utilisateur = null;

    #[ORM\ManyToOne(inversedBy: 'retoursExperience')]
    #[ORM\JoinColumn(nullable: false)]
    #[Assert\NotNull(message: 'Le défi associé est obligatoire.')]
    private ?Defi $defi = null;

    public function getId(): ?int { return $this->id; }

    public function getContenu(): string { return $this->contenu; }
    public function setContenu(string $contenu): static { $this->contenu = $contenu; return $this; }

    public function getEmoji(): string { return $this->emoji; }
    public function setEmoji(string $emoji): static { $this->emoji = $emoji; return $this; }

    public function getDateRetour(): \DateTimeImmutable { return $this->dateRetour; }
    public function setDateRetour(\DateTimeImmutable $dateRetour): static
    {
        $this->dateRetour = $dateRetour;
        return $this;
    }

    public function getUtilisateur(): ?Utilisateur { return $this->utilisateur; }
    public function setUtilisateur(?Utilisateur $utilisateur): static
    {
        $this->utilisateur = $utilisateur;
        return $this;
    }

    public function getDefi(): ?Defi { return $this->defi; }
    public function setDefi(?Defi $defi): static
    {
        $this->defi = $defi;
        return $this;
    }
}
