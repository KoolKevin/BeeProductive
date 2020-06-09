<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\StatisticheRepository")
 */
class Statistiche
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $fkIdEvento;

    /**
     * @ORM\Column(type="string", length=30)
     */
    private $titoloEvento;

    /**
     * @ORM\Column(type="string", length=30)
     */
    private $completionDate;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $durata;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFkIdEvento(): ?int
    {
        return $this->fkIdEvento;
    }

    public function setFkIdEvento(?int $fkIdEvento): self
    {
        $this->fkIdEvento = $fkIdEvento;

        return $this;
    }

    public function getTitoloEvento(): ?string
    {
        return $this->titoloEvento;
    }

    public function setTitoloEvento(string $titoloEvento): self
    {
        $this->titoloEvento = $titoloEvento;

        return $this;
    }

    public function getCompletionDate(): ?string
    {
        return $this->completionDate;
    }

    public function setCompletionDate(string $completionDate): self
    {
        $this->completionDate = $completionDate;

        return $this;
    }

    public function getDurata(): ?int
    {
        return $this->durata;
    }

    public function setDurata(?int $durata): self
    {
        $this->durata = $durata;

        return $this;
    }

    
}
