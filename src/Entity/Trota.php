<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TrotaRepository")
 */
class Trota
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $lunghezza;

    /**
     * @ORM\Column(type="boolean")
     */
    private $no;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLunghezza(): ?string
    {
        return $this->lunghezza;
    }

    public function setLunghezza(string $lunghezza): self
    {
        $this->lunghezza = $lunghezza;

        return $this;
    }

    public function getNo(): ?bool
    {
        return $this->no;
    }

    public function setNo(bool $no): self
    {
        $this->no = $no;

        return $this;
    }
}
