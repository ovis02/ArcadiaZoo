<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UserRepository::class)]
class User
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $email = null;

    #[ORM\Column(length: 255)]
    private ?string $password = null;

    #[ORM\Column]
    private array $roles = [];

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $prenom = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $nom = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $dateCreation = null;

    /**
     * @var Collection<int, Avis>
     */
    #[ORM\OneToMany(targetEntity: Avis::class, mappedBy: 'validePar')]
    private Collection $avis;

    /**
     * @var Collection<int, Repas>
     */
    #[ORM\OneToMany(targetEntity: Repas::class, mappedBy: 'ajoutePar')]
    private Collection $repasAjoutes;

    /**
     * @var Collection<int, CompteRenduVeterinaire>
     */
    #[ORM\OneToMany(targetEntity: CompteRenduVeterinaire::class, mappedBy: 'veterinaire')]
    private Collection $compteRenduVeterinaires;

    /**
     * @var Collection<int, Contact>
     */
    #[ORM\OneToMany(targetEntity: Contact::class, mappedBy: 'traitePar')]
    private Collection $contacts;

    public function __construct()
    {
        $this->avis = new ArrayCollection();
        $this->repasAjoutes = new ArrayCollection();
        $this->compteRenduVeterinaires = new ArrayCollection();
        $this->contacts = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }

    public function getRoles(): array
    {
        return $this->roles;
    }

    public function setRoles(array $roles): static
    {
        $this->roles = $roles;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(?string $prenom): static
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(?string $nom): static
    {
        $this->nom = $nom;

        return $this;
    }

    public function getDateCreation(): ?\DateTimeInterface
    {
        return $this->dateCreation;
    }

    public function setDateCreation(\DateTimeInterface $dateCreation): static
    {
        $this->dateCreation = $dateCreation;

        return $this;
    }

    /**
     * @return Collection<int, Avis>
     */
    public function getAvis(): Collection
    {
        return $this->avis;
    }

    public function addAvi(Avis $avi): static
    {
        if (!$this->avis->contains($avi)) {
            $this->avis->add($avi);
            $avi->setValidePar($this);
        }

        return $this;
    }

    public function removeAvi(Avis $avi): static
    {
        if ($this->avis->removeElement($avi)) {
            // set the owning side to null (unless already changed)
            if ($avi->getValidePar() === $this) {
                $avi->setValidePar(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Repas>
     */
    public function getRepasAjoutes(): Collection
    {
        return $this->repasAjoutes;
    }

    public function addRepasAjoute(Repas $repasAjoute): static
    {
        if (!$this->repasAjoutes->contains($repasAjoute)) {
            $this->repasAjoutes->add($repasAjoute);
            $repasAjoute->setAjoutePar($this);
        }

        return $this;
    }

    public function removeRepasAjoute(Repas $repasAjoute): static
    {
        if ($this->repasAjoutes->removeElement($repasAjoute)) {
            // set the owning side to null (unless already changed)
            if ($repasAjoute->getAjoutePar() === $this) {
                $repasAjoute->setAjoutePar(null);
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
            $compteRenduVeterinaire->setVeterinaire($this);
        }

        return $this;
    }

    public function removeCompteRenduVeterinaire(CompteRenduVeterinaire $compteRenduVeterinaire): static
    {
        if ($this->compteRenduVeterinaires->removeElement($compteRenduVeterinaire)) {
            // set the owning side to null (unless already changed)
            if ($compteRenduVeterinaire->getVeterinaire() === $this) {
                $compteRenduVeterinaire->setVeterinaire(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Contact>
     */
    public function getContacts(): Collection
    {
        return $this->contacts;
    }

    public function addContact(Contact $contact): static
    {
        if (!$this->contacts->contains($contact)) {
            $this->contacts->add($contact);
            $contact->setTraitePar($this);
        }

        return $this;
    }

    public function removeContact(Contact $contact): static
    {
        if ($this->contacts->removeElement($contact)) {
            // set the owning side to null (unless already changed)
            if ($contact->getTraitePar() === $this) {
                $contact->setTraitePar(null);
            }
        }

        return $this;
    }
}
