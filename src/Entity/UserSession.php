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
     * @ORM\Column(type="integer")
     */
    private $fkIdUser;

    /**
     * @ORM\Column(type="string")
     */
    private $sessId;

    /**
     * @ORM\Column(type="string", length=30)
     */
    private $addDate;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFkIdUser()
    {
        return $this->$fkIdUser;
    }

    public function setFkIdUser( $fkIdUser)
    {
        $this->$fkIdUser = $fkIdUser;

        return $this;
    }

    public function getSessId(): ?int
    {
        return $this->$sessId;
    }

    public function setSessId( $sessId)
    {
        $this->$sessId = $sessId;

        return $this;
    }

    public function getAddDate()
    {
        return $this->addDate;
    }

    public function setAddDate( $addDate): self
    {
        $this->addDate = $addDate;

        return $this;
    }
}
