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
    private $fk_id_user;

    /**
     * @ORM\Column(type="integer")
     */
    private $sess_id;

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
        return $this->fk_id_user;
    }

    public function setFkIdUser(?User $fk_id_user): self
    {
        $this->fk_id_user = $fk_id_user;

        return $this;
    }

    public function getSessId(): ?int
    {
        return $this->sess_id;
    }

    public function setSessId(int $sess_id): self
    {
        $this->sess_id = $sess_id;

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
