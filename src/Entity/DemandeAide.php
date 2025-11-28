<?php

namespace App\Entity;

use App\Repository\DemandeAideRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: DemandeAideRepository::class)]
class DemandeAide
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: 'text')]
    #[Assert\NotBlank(message: 'Merci de décrire votre besoin.')]
    #[Assert\Length(
        min: 10,
        minMessage: 'Votre message doit contenir au moins {{ limit }} caractères.'
    )]
    private string $contenu;

    #[ORM\Column(type: 'datetime_immutable')]
    private \DateTimeImmutable $dateDemande;

    #[ORM\Column(length: 50)]
    #[Assert\NotBlank]
    private string $statut;

    #[ORM\ManyToOne(inversedBy: 'demandesAide')]
    #[ORM\JoinColumn(nullable: false)]
    #[Assert\NotNull(message: 'Vous devez être connecté pour demander de l’aide.')]
    private ?Utilisateur $utilisateur = null;

    #[ORM\ManyToOne(inversedBy: 'demandesAide')]
    #[ORM\JoinColumn(nullable: false)]
    #[Assert\NotNull(message: 'Merci de préciser le défi concerné.')]
    private ?Defi $defi = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getContenu(): string
    {
        return $this->contenu;
    }

    public function setContenu(string $contenu): static
    {
        $this->contenu = $contenu;
        return $this;
    }

    public function getDateDemande(): \DateTimeImmutable
    {
        return $this->dateDemande;
    }

    public function setDateDemande(\DateTimeImmutable $dateDemande): static
    {
        $this->dateDemande = $dateDemande;
        return $this;
    }

    public function getStatut(): string
    {
        return $this->statut;
    }

    public function setStatut(string $statut): static
    {
        $this->statut = $statut;
        return $this;
    }

    public function getUtilisateur(): ?Utilisateur
    {
        return $this->utilisateur;
    }

    public function setUtilisateur(?Utilisateur $utilisateur): static
    {
        $this->utilisateur = $utilisateur;
        return $this;
    }

    public function getDefi(): ?Defi
    {
        return $this->defi;
    }

    public function setDefi(?Defi $defi): static
    {
        $this->defi = $defi;
        return $this;
    }
}