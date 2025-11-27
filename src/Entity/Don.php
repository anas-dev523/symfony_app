<?php

namespace App\Entity;

use App\Repository\DonRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DonRepository::class)]
class Don
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private int $montant;

    #[ORM\Column]
    private bool $estPublic = true;

    #[ORM\Column(type: 'datetime_immutable')]
    private \DateTimeImmutable $dateDon;

    #[ORM\ManyToOne(inversedBy: 'dons')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Utilisateur $utilisateur = null;

    public function getId(): ?int { return $this->id; }

    public function getMontant(): int { return $this->montant; }
    public function setMontant(int $montant): static { $this->montant = $montant; return $this; }

    public function isEstPublic(): bool { return $this->estPublic; }
    public function setEstPublic(bool $estPublic): static { $this->estPublic = $estPublic; return $this; }

    public function getDateDon(): \DateTimeImmutable { return $this->dateDon; }
    public function setDateDon(\DateTimeImmutable $dateDon): static
    {
        $this->dateDon = $dateDon;
        return $this;
    }

    public function getUtilisateur(): ?Utilisateur { return $this->utilisateur; }
    public function setUtilisateur(?Utilisateur $utilisateur): static
    {
        $this->utilisateur = $utilisateur;
        return $this;
    }
}
