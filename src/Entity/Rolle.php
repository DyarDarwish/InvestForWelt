<?php

namespace App\Entity;

use App\Repository\RolleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RolleRepository::class)]
class Rolle
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $roll_bez = null;

    #[ORM\OneToMany(mappedBy: 'rolle', targetEntity: Benutzer::class)]
    private Collection $benroll;

    public function __construct()
    {
        $this->benroll = new ArrayCollection();
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRollBez(): ?string
    {
        return $this->roll_bez;
    }

    public function setRollBez(string $roll_bez): self
    {
        $this->roll_bez = $roll_bez;

        return $this;
    }

    /**
     * @return Collection<int, Benutzer>
     */
    public function getBenroll(): Collection
    {
        return $this->benroll;
    }

    public function addBenroll(Benutzer $benroll): self
    {
        if (!$this->benroll->contains($benroll)) {
            $this->benroll->add($benroll);
            $benroll->setRolle($this);
        }

        return $this;
    }

    public function removeBenroll(Benutzer $benroll): self
    {
        if ($this->benroll->removeElement($benroll)) {
            // set the owning side to null (unless already changed)
            if ($benroll->getRolle() === $this) {
                $benroll->setRolle(null);
            }
        }

        return $this;
    }
}
