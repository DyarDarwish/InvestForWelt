<?php

namespace App\Entity;

use App\Repository\PlzRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PlzRepository::class)]
class Plz
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $plz = null;

    #[ORM\Column(length: 50)]
    private ?string $ort = null;

    #[ORM\OneToMany(mappedBy: 'plz', targetEntity: Benutzer::class)]
    private Collection $benplz;

    public function __construct()
    {
        $this->benplz = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPlz(): ?string
    {
        return $this->plz;
    }

    public function setPlz(string $plz): self
    {
        $this->plz = $plz;

        return $this;
    }

    public function getOrt(): ?string
    {
        return $this->ort;
    }

    public function setOrt(string $ort): self
    {
        $this->ort = $ort;

        return $this;
    }

    /**
     * @return Collection<int, Benutzer>
     */
    public function getBenplz(): Collection
    {
        return $this->benplz;
    }

    public function addBenplz(Benutzer $benplz): self
    {
        if (!$this->benplz->contains($benplz)) {
            $this->benplz->add($benplz);
            $benplz->setPlz($this);
        }

        return $this;
    }

    public function removeBenplz(Benutzer $benplz): self
    {
        if ($this->benplz->removeElement($benplz)) {
            // set the owning side to null (unless already changed)
            if ($benplz->getPlz() === $this) {
                $benplz->setPlz(null);
            }
        }

        return $this;
    }

 
}
