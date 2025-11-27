<?php

namespace App\Entity;

use App\Repository\CitationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CitationRepository::class)]
class Citation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: 'text')]
    private string $contenu;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $auteur = null;

    #[ORM\Column(type: 'datetime_immutable', nullable: true)]
    private ?\DateTimeImmutable $dateAjout = null;

    #[ORM\OneToMany(mappedBy: 'citation', targetEntity: ConsultationCitation::class, orphanRemoval: true)]
    private Collection $consultations;

    public function __construct()
    {
        $this->consultations = new ArrayCollection();
    }

    public function getId(): ?int { return $this->id; }

    public function getContenu(): string { return $this->contenu; }
    public function setContenu(string $contenu): static { $this->contenu = $contenu; return $this; }

    public function getAuteur(): ?string { return $this->auteur; }
    public function setAuteur(?string $auteur): static { $this->auteur = $auteur; return $this; }

    public function getDateAjout(): ?\DateTimeImmutable { return $this->dateAjout; }
    public function setDateAjout(?\DateTimeImmutable $dateAjout): static
    {
        $this->dateAjout = $dateAjout;
        return $this;
    }

    /** @return Collection<int, ConsultationCitation> */
    public function getConsultations(): Collection { return $this->consultations; }
}
