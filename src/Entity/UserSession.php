<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserSessionRepository")
 */
class UserSession
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="sess_id")
     * @ORM\JoinColumn(nullable=false)
     */
    private $fkIdUser;

    /**
     * @ORM\Column(type="string")
     */
    private $sessId;

    /**
     * @ORM\Column(type="date")
     */
    private $addDate;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFkIdUser(): ?User
    {
        return $this->$fkIdUser;
    }

    public function setFkIdUser(?User $fkIdUser): self
    {
        $this->$fkIdUser = $fkIdUser;

        return $this;
    }

    public function getSessId(): ?int
    {
        return $this->$sessId;
    }

    public function setSessId(string $sessId): self
    {
        $this->$sessId = $sessId;

        return $this;
    }

    public function getAddDate(): ?\DateTimeInterface
    {
        return $this->addDate;
    }

    public function setAddDate(\DateTimeInterface $addDate): self
    {
        $this->addDate = $addDate;

        return $this;
    }
}
