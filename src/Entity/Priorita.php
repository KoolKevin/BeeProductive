<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PrioritaRepository")
 */
class Priorita
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=20)
     */
    private $nome;

    /**
     * @ORM\Column(type="string", length=10)
     */
    private $colore;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNome(): ?string
    {
        return $this->nome;
    }

    public function setNome(string $nome): self
    {
        $this->nome = $nome;

        return $this;
    }

    public function getColore(): ?string
    {
        return $this->colore;
    }

    public function setColore(string $colore): self
    {
        $this->colore = $colore;

        return $this;
    }
}
