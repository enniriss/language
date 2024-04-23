<?php

namespace App\Entity;

use App\Repository\ArabeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ArabeRepository::class)]
class Arabe
{
    /** @var int */
    public int $p = 1;
    /** @var string */
    public string $q = "";
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $classe = null;

    #[ORM\Column(length: 255)]
    private ?string $mot = null;

    #[ORM\ManyToMany(targetEntity: Francais::class, inversedBy: 'arabe')]
    private Collection $francais;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $image = null;

    public function __construct()
    {
        $this->francais = new ArrayCollection();
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
     * @return Collection<int, Francais>
     */
    public function getFrancais(): Collection
    {
        return $this->francais;
    }

    public function addFrancai(Francais $francai): static
    {
        if (!$this->francais->contains($francai)) {
            $this->francais->add($francai);
        }

        return $this;
    }

    public function removeFrancai(Francais $francai): static
    {
        $this->francais->removeElement($francai);

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
}
