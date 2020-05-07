<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ProgettiRepository")
 */
class Progetti
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=30)
     */
    private $titolo;

    /**
     * @ORM\Column(type="object")
     */
    private $startDate;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Eventi", mappedBy="fk_id_progetto", orphanRemoval=true)
     */
    private $eventi;

    public function __construct()
    {
        $this->eventi = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitolo(): ?string
    {
        return $this->titolo;
    }

    public function setTitolo(string $titolo): self
    {
        $this->titolo = $titolo;

        return $this;
    }

    public function getStartDate()
    {
        return $this->startDate;
    }

    public function setStartDate($startDate): self
    {
        $this->startDate = $startDate;

        return $this;
    }

    /**
     * @return Collection|Eventi[]
     */
    public function getEventi(): Collection
    {
        return $this->eventi;
    }

    public function addEventi(Eventi $eventi): self
    {
        if (!$this->eventi->contains($eventi)) {
            $this->eventi[] = $eventi;
            $eventi->setFkIdProgetto($this);
        }

        return $this;
    }

    public function removeEventi(Eventi $eventi): self
    {
        if ($this->eventi->contains($eventi)) {
            $this->eventi->removeElement($eventi);
            // set the owning side to null (unless already changed)
            if ($eventi->getFkIdProgetto() === $this) {
                $eventi->setFkIdProgetto(null);
            }
        }

        return $this;
    }
}
