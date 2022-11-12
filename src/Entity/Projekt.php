<?php

namespace App\Entity;

use App\Repository\ProjektRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProjektRepository::class)]
class Projekt
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $pro_bez = null;

    #[ORM\ManyToMany(targetEntity: Benutzer::class, inversedBy: 'no')]
    private Collection $benutzer;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $bild_path = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $pro_beschreibung = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $erst_datum = null;

    public function __construct()
    {
        $this->benutzer = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getProBez(): ?string
    {
        return $this->pro_bez;
    }

    public function setProBez(string $pro_bez): self
    {
        $this->pro_bez = $pro_bez;

        return $this;
    }

    /**
     * @return Collection<int, Benutzer>
     */
    public function getBenutzer(): Collection
    {
        return $this->benutzer;
    }

    public function addBenutzer(Benutzer $benutzer): self
    {
        if (!$this->benutzer->contains($benutzer)) {
            $this->benutzer->add($benutzer);
        }

        return $this;
    }

    public function removeBenutzer(Benutzer $benutzer): self
    {
        $this->benutzer->removeElement($benutzer);

        return $this;
    }

    public function getBildPath(): ?string
    {
        return $this->bild_path;
    }

    public function setBildPath(?string $bild_path): self
    {
        $this->bild_path = $bild_path;

        return $this;
    }

    public function getProBeschreibung(): ?string
    {
        return $this->pro_beschreibung;
    }

    public function setProBeschreibung(?string $pro_beschreibung): self
    {
        $this->pro_beschreibung = $pro_beschreibung;

        return $this;
    }

    public function getErstDatum(): ?\DateTimeInterface
    {
        return $this->erst_datum;
    }

    public function setErstDatum(?\DateTimeInterface $erst_datum): self
    {
        $this->erst_datum = $erst_datum;

        return $this;
    }
}
