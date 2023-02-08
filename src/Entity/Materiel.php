<?php

namespace App\Entity;

use App\Repository\MaterielRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MaterielRepository::class)]
class Materiel
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column(nullable: true)]
    private ?int $nombre = null;

    #[ORM\OneToMany(mappedBy: 'materiel', targetEntity: Pret::class)]
    private Collection $prets;

    #[ORM\Column(nullable: true)]
    private ?int $en_stock = null;

    #[ORM\Column(nullable: true)]
    private ?int $en_pret = null;

    public function __construct()
    {
        $this->prets = new ArrayCollection();
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

    public function getNombre(): ?int
    {
        return $this->nombre;
    }

    public function setNombre(?int $nombre): self
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * @return Collection<int, Pret>
     */
    public function getPrets(): Collection
    {
        return $this->prets;
    }

    public function addPret(Pret $pret): self
    {
        if (!$this->prets->contains($pret)) {
            $this->prets->add($pret);
            $pret->setMateriel($this);
        }

        return $this;
    }

    public function removePret(Pret $pret): self
    {
        if ($this->prets->removeElement($pret)) {
            // set the owning side to null (unless already changed)
            if ($pret->getMateriel() === $this) {
                $pret->setMateriel(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return $this->nom;
    }

    public function getEnStock(): ?int
    {
        return $this->en_stock;
    }

    public function setEnStock(?int $en_stock): self
    {
        $this->en_stock = $en_stock;

        return $this;
    }

    public function getEnPret(): ?int
    {
        return $this->en_pret;
    }

    public function setEnPret(?int $en_pret): self
    {
        $this->en_pret = $en_pret;

        return $this;
    }
}
