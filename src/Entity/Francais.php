<?php

namespace App\Entity;

use App\Repository\FrancaisRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FrancaisRepository::class)]
class Francais
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $classe = null;

    #[ORM\Column(length: 255)]
    private ?string $mot = null;

    #[ORM\ManyToMany(targetEntity: Japonais::class, mappedBy: 'francais')]
    private ?Collection $japonais = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $image = null;

    #[ORM\ManyToMany(targetEntity: Arabe::class, mappedBy: 'francais')]
    private Collection $arabe;

    public function __construct()
    {
        $this->japonais = new ArrayCollection();
        $this->arabe = new ArrayCollection();
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): static
    {
        $this->id = $id;

        return $this;
    }

    public function getClasse(): ?string
    {
        return $this->classe;
    }

    public function setClasse(string $classe): static
    {
        $this->classe = $classe;

        return $this;
    }

    public function getMot(): ?string
    {
        return $this->mot;
    }

    public function setMot(string $mot): static
    {
        $this->mot = $mot;

        return $this;
    }

    /**     
     * @return ArrayCollection|Japonais[]
     */
    public function getJaponais()
    {
        return $this->japonais;
    }

    public function addJaponai(Japonais $japonai)
    {
        if ($this->japonais->contains($japonai)) {
            return;
        }
        $this->japonais[] = $japonai;
    }

    public function removeJaponai(Japonais $japonai): static
    {
        if ($this->japonais->removeElement($japonai)) {
            $japonai->removeFrancai($this);
        }

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

    /**
     * @return Collection<int, Arabe>
     */
    public function getArabe(): Collection
    {
        return $this->arabe;
    }

    public function addArabe(Arabe $arabe): static
    {
        if (!$this->arabe->contains($arabe)) {
            $this->arabe->add($arabe);
            $arabe->addFrancai($this);
        }

        return $this;
    }

    public function removeArabe(Arabe $arabe): static
    {
        if ($this->arabe->removeElement($arabe)) {
            $arabe->removeFrancai($this);
        }

        return $this;
    }
  
}
