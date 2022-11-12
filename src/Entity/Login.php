<?php

namespace App\Entity;

use App\Repository\LoginRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LoginRepository::class)]
class Login
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $ben_name = null;

    #[ORM\Column(length: 50)]
    private ?string $password = null;

    #[ORM\OneToMany(mappedBy: 'log', targetEntity: Benutzer::class)]
    private Collection $benlog;

    public function __construct()
    {
        $this->benlog = new ArrayCollection();
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

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @return Collection<int, Benutzer>
     */
    public function getBenlog(): Collection
    {
        return $this->benlog;
    }

    public function addBenlog(Benutzer $benlog): self
    {
        if (!$this->benlog->contains($benlog)) {
            $this->benlog->add($benlog);
            $benlog->setLog($this);
        }

        return $this;
    }

    public function removeBenlog(Benutzer $benlog): self
    {
        if ($this->benlog->removeElement($benlog)) {
            // set the owning side to null (unless already changed)
            if ($benlog->getLog() === $this) {
                $benlog->setLog(null);
            }
        }

        return $this;
    }



}
