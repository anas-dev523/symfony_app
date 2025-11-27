<?php

namespace App\Entity;

use App\Repository\RetourExperienceRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RetourExperienceRepository::class)]
class RetourExperience
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: 'text')]
    private string $contenu;

    #[ORM\Column(length: 10)]
    private string $emoji;

    #[ORM\Column(type: 'datetime_immutable')]
    private \DateTimeImmutable $dateRetour;

    #[ORM\ManyToOne(inversedBy: 'retoursExperience')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Utilisateur $utilisateur = null;

    #[ORM\ManyToOne(inversedBy: 'retoursExperience')]
    #[ORM\JoinColumn(nullable: false)]
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
