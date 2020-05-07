<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\EventiRepository")
 */
class Eventi
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="eventis")
     * @ORM\JoinColumn(nullable=false)
     */
    private $fk_id_utente;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Progetti", inversedBy="eventi")
     * @ORM\JoinColumn(nullable=false)
     */
    private $fk_id_progetto;

    /**
     * @ORM\Column(type="object")
     */
    private $startDate;

    /**
     * @ORM\Column(type="string", length=30)
     */
    private $titolo;

    /**
     * @ORM\Column(type="integer")
     */
    private $priorita;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFkIdUtente(): ?User
    {
        return $this->fk_id_utente;
    }

    public function setFkIdUtente(?User $fk_id_utente): self
    {
        $this->fk_id_utente = $fk_id_utente;

        return $this;
    }

    public function getFkIdProgetto(): ?Progetti
    {
        return $this->fk_id_progetto;
    }

    public function setFkIdProgetto(?Progetti $fk_id_progetto): self
    {
        $this->fk_id_progetto = $fk_id_progetto;

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

    public function getTitolo(): ?string
    {
        return $this->titolo;
    }

    public function setTitolo(string $titolo): self
    {
        $this->titolo = $titolo;

        return $this;
    }

    public function getPriorita(): ?int
    {
        return $this->priorita;
    }

    public function setPriorita(int $priorita): self
    {
        $this->priorita = $priorita;

        return $this;
    }
}
