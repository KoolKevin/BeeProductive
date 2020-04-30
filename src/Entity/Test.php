<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TestRepository")
 */
class Test
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="boolean")
     */
    private $funziona;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFunziona(): ?bool
    {
        return $this->funziona;
    }

    public function setFunziona(bool $funziona): self
    {
        $this->funziona = $funziona;

        return $this;
    }
}
