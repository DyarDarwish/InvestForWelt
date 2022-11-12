<?php

namespace App\Entity;

use App\Repository\BenutzerRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BenutzerRepository::class)]
class Benutzer
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $ben_name = null;

    #[ORM\ManyToMany(targetEntity: Projekt::class, mappedBy: 'benutzer')]
    private Collection $no;

    #[ORM\ManyToOne(inversedBy: 'benlog')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Login $log = null;

    #[ORM\ManyToOne(inversedBy: 'benroll')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Rolle $rolle = null;

    #[ORM\ManyToOne(inversedBy: 'benplz')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Plz $plz = null;

    public function __construct()
    {
        $this->no = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBenName(): ?string
    {
        return $this->ben_name;
    }

    public function setBenName(string $ben_name): self
    {
        $this->ben_name = $ben_name;

        return $this;
    }

    /**
     * @return Collection<int, Projekt>
     */
    public function getNo(): Collection
    {
        return $this->no;
    }

    public function addNo(Projekt $no): self
    {
        if (!$this->no->contains($no)) {
            $this->no->add($no);
            $no->addBenutzer($this);
        }

        return $this;
    }

    public function removeNo(Projekt $no): self
    {
        if ($this->no->removeElement($no)) {
            $no->removeBenutzer($this);
        }

        return $this;
    }

    public function getLog(): ?Login
    {
        return $this->log;
    }

    public function setLog(?Login $log): self
    {
        $this->log = $log;

        return $this;
    }

    public function getRolle(): ?Rolle
    {
        return $this->rolle;
    }

    public function setRolle(?Rolle $rolle): self
    {
        $this->rolle = $rolle;

        return $this;
    }

    public function getPlz(): ?Plz
    {
        return $this->plz;
    }

    public function setPlz(?Plz $plz): self
    {
        $this->plz = $plz;

        return $this;
    }
}
