<?php

namespace App\Entity;

use App\Repository\UtilisateurRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UtilisateurRepository::class)]
class Utilisateur
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private string $nom;

    #[ORM\Column(length: 255)]
    private string $prenom;

    #[ORM\Column(length: 255, unique: true)]
    private string $email;

    #[ORM\Column]
    private bool $affichagePublic = true;

    #[ORM\OneToMany(mappedBy: 'utilisateur', targetEntity: Don::class, orphanRemoval: true)]
    private Collection $dons;

    #[ORM\OneToMany(mappedBy: 'utilisateur', targetEntity: RetourExperience::class, orphanRemoval: true)]
    private Collection $retoursExperience;

    #[ORM\OneToMany(mappedBy: 'utilisateur', targetEntity: DemandeAide::class, orphanRemoval: true)]
    private Collection $demandesAide;

    #[ORM\OneToMany(mappedBy: 'utilisateur', targetEntity: PasserDefi::class, orphanRemoval: true)]
    private Collection $defisPasses;

    #[ORM\OneToMany(mappedBy: 'utilisateur', targetEntity: ConsultationCitation::class, orphanRemoval: true)]
    private Collection $citationsConsultees;

    public function __construct()
    {
        $this->dons = new ArrayCollection();
        $this->retoursExperience = new ArrayCollection();
        $this->demandesAide = new ArrayCollection();
        $this->defisPasses = new ArrayCollection();
        $this->citationsConsultees = new ArrayCollection();
    }

    public function getId(): ?int { return $this->id; }

    public function getNom(): string { return $this->nom; }
    public function setNom(string $nom): static { $this->nom = $nom; return $this; }

    public function getPrenom(): string { return $this->prenom; }
    public function setPrenom(string $prenom): static { $this->prenom = $prenom; return $this; }

    public function getEmail(): string { return $this->email; }
    public function setEmail(string $email): static { $this->email = $email; return $this; }

    public function isAffichagePublic(): bool { return $this->affichagePublic; }
    public function setAffichagePublic(bool $affichagePublic): static
    {
        $this->affichagePublic = $affichagePublic;
        return $this;
    }

    /** @return Collection<int, Don> */
    public function getDons(): Collection { return $this->dons; }

    public function addDon(Don $don): static
    {
        if (!$this->dons->contains($don)) {
            $this->dons->add($don);
            $don->setUtilisateur($this);
        }
        return $this;
    }

    public function removeDon(Don $don): static
    {
        if ($this->dons->removeElement($don) && $don->getUtilisateur() === $this) {
            $don->setUtilisateur(null);
        }
        return $this;
    }

    /** @return Collection<int, RetourExperience> */
    public function getRetoursExperience(): Collection { return $this->retoursExperience; }

    public function addRetoursExperience(RetourExperience $retour): static
    {
        if (!$this->retoursExperience->contains($retour)) {
            $this->retoursExperience->add($retour);
            $retour->setUtilisateur($this);
        }
        return $this;
    }

    public function removeRetoursExperience(RetourExperience $retour): static
    {
        if ($this->retoursExperience->removeElement($retour) && $retour->getUtilisateur() === $this) {
            $retour->setUtilisateur(null);
        }
        return $this;
    }

    /** @return Collection<int, DemandeAide> */
    public function getDemandesAide(): Collection { return $this->demandesAide; }

    public function addDemandeAide(DemandeAide $demande): static
    {
        if (!$this->demandesAide->contains($demande)) {
            $this->demandesAide->add($demande);
            $demande->setUtilisateur($this);
        }
        return $this;
    }

    public function removeDemandeAide(DemandeAide $demande): static
    {
        if ($this->demandesAide->removeElement($demande) && $demande->getUtilisateur() === $this) {
            $demande->setUtilisateur(null);
        }
        return $this;
    }

    /** @return Collection<int, PasserDefi> */
    public function getDefisPasses(): Collection { return $this->defisPasses; }

    public function addDefisPasse(PasserDefi $passerDefi): static
    {
        if (!$this->defisPasses->contains($passerDefi)) {
            $this->defisPasses->add($passerDefi);
            $passerDefi->setUtilisateur($this);
        }
        return $this;
    }

    public function removeDefisPasse(PasserDefi $passerDefi): static
    {
        if ($this->defisPasses->removeElement($passerDefi) && $passerDefi->getUtilisateur() === $this) {
            $passerDefi->setUtilisateur(null);
        }
        return $this;
    }

    /** @return Collection<int, ConsultationCitation> */
    public function getCitationsConsultees(): Collection { return $this->citationsConsultees; }

    public function addCitationsConsultee(ConsultationCitation $consultation): static
    {
        if (!$this->citationsConsultees->contains($consultation)) {
            $this->citationsConsultees->add($consultation);
            $consultation->setUtilisateur($this);
        }
        return $this;
    }

    public function removeCitationsConsultee(ConsultationCitation $consultation): static
    {
        if ($this->citationsConsultees->removeElement($consultation) && $consultation->getUtilisateur() === $this) {
            $consultation->setUtilisateur(null);
        }
        return $this;
    }
}
