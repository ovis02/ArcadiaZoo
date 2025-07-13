<?php

namespace App\Entity;

use App\Repository\AnimalRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AnimalRepository::class)]
class Animal
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $prenom = null;

    #[ORM\Column(length: 255)]
    private ?string $race = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $image = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $etat = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $nourritureProposee = null;

    #[ORM\Column(nullable: true)]
    private ?float $grammage = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $dateDernierPassage = null;

    #[ORM\ManyToOne(inversedBy: 'animals')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Habitat $habitat = null;

    /**
     * @var Collection<int, Repas>
     */
    #[ORM\OneToMany(targetEntity: Repas::class, mappedBy: 'animal')]
    private Collection $repas;

    /**
     * @var Collection<int, CompteRenduVeterinaire>
     */
    #[ORM\OneToMany(targetEntity: CompteRenduVeterinaire::class, mappedBy: 'animal')]
    private Collection $compteRenduVeterinaires;

    public function __construct()
    {
        $this->repas = new ArrayCollection();
        $this->compteRenduVeterinaires = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): static
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getRace(): ?string
    {
        return $this->race;
    }

    public function setRace(string $race): static
    {
        $this->race = $race;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): static
    {
        $this->image = $image;

        return $this;
    }

    public function getEtat(): ?string
    {
        return $this->etat;
    }

    public function setEtat(?string $etat): static
    {
        $this->etat = $etat;

        return $this;
    }

    public function getNourritureProposee(): ?string
    {
        return $this->nourritureProposee;
    }

    public function setNourritureProposee(?string $nourritureProposee): static
    {
        $this->nourritureProposee = $nourritureProposee;

        return $this;
    }

    public function getGrammage(): ?float
    {
        return $this->grammage;
    }

    public function setGrammage(?float $grammage): static
    {
        $this->grammage = $grammage;

        return $this;
    }

    public function getDateDernierPassage(): ?\DateTimeInterface
    {
        return $this->dateDernierPassage;
    }

    public function setDateDernierPassage(?\DateTimeInterface $dateDernierPassage): static
    {
        $this->dateDernierPassage = $dateDernierPassage;

        return $this;
    }

    public function getHabitat(): ?Habitat
    {
        return $this->habitat;
    }

    public function setHabitat(?Habitat $habitat): static
    {
        $this->habitat = $habitat;

        return $this;
    }

    /**
     * @return Collection<int, Repas>
     */
    public function getRepas(): Collection
    {
        return $this->repas;
    }

    public function addRepa(Repas $repa): static
    {
        if (!$this->repas->contains($repa)) {
            $this->repas->add($repa);
            $repa->setAnimal($this);
        }

        return $this;
    }

    public function removeRepa(Repas $repa): static
    {
        if ($this->repas->removeElement($repa)) {
            // set the owning side to null (unless already changed)
            if ($repa->getAnimal() === $this) {
                $repa->setAnimal(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, CompteRenduVeterinaire>
     */
    public function getCompteRenduVeterinaires(): Collection
    {
        return $this->compteRenduVeterinaires;
    }

    public function addCompteRenduVeterinaire(CompteRenduVeterinaire $compteRenduVeterinaire): static
    {
        if (!$this->compteRenduVeterinaires->contains($compteRenduVeterinaire)) {
            $this->compteRenduVeterinaires->add($compteRenduVeterinaire);
            $compteRenduVeterinaire->setAnimal($this);
        }

        return $this;
    }

    public function removeCompteRenduVeterinaire(CompteRenduVeterinaire $compteRenduVeterinaire): static
    {
        if ($this->compteRenduVeterinaires->removeElement($compteRenduVeterinaire)) {
            // set the owning side to null (unless already changed)
            if ($compteRenduVeterinaire->getAnimal() === $this) {
                $compteRenduVeterinaire->setAnimal(null);
            }
        }

        return $this;
    }
}
