<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 */
class User
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
    private $username;

    /**
     * @ORM\Column(type="string", length=30)
     */
    private $mail;

    /**
     * @ORM\Column(type="string", length=20)
     */
    private $password;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\UserSession", mappedBy="fk_id_user", orphanRemoval=true)
     */
    private $sess_id;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Eventi", mappedBy="fk_id_utente", orphanRemoval=true)
     */
    private $eventi;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Eventi", mappedBy="fk_id_utente", orphanRemoval=true)
     */
    private $eventis;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Progetti", mappedBy="fkIdUtente", orphanRemoval=true)
     */
    private $progettis;

    public function __construct()
    {
        $this->sess_id = new ArrayCollection();
        $this->eventi = new ArrayCollection();
        $this->eventis = new ArrayCollection();
        $this->progettis = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    public function getMail(): ?string
    {
        return $this->mail;
    }

    public function setMail(string $mail): self
    {
        $this->mail = $mail;

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
     * @return Collection|UserSession[]
     */
    public function getSessId(): Collection
    {
        return $this->sess_id;
    }

    public function addSessId(UserSession $sessId): self
    {
        if (!$this->sess_id->contains($sessId)) {
            $this->sess_id[] = $sessId;
            $sessId->setFkIdUser($this);
        }

        return $this;
    }

    public function removeSessId(UserSession $sessId): self
    {
        if ($this->sess_id->contains($sessId)) {
            $this->sess_id->removeElement($sessId);
            // set the owning side to null (unless already changed)
            if ($sessId->getFkIdUser() === $this) {
                $sessId->setFkIdUser(null);
            }
        }

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
            $eventi->setFkIdUtente($this);
        }

        return $this;
    }

    public function removeEventi(Eventi $eventi): self
    {
        if ($this->eventi->contains($eventi)) {
            $this->eventi->removeElement($eventi);
            // set the owning side to null (unless already changed)
            if ($eventi->getFkIdUtente() === $this) {
                $eventi->setFkIdUtente(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Eventi[]
     */
    public function getEventis(): Collection
    {
        return $this->eventis;
    }

    /**
     * @return Collection|Progetti[]
     */
    public function getProgettis(): Collection
    {
        return $this->progettis;
    }

    public function addProgetti(Progetti $progetti): self
    {
        if (!$this->progettis->contains($progetti)) {
            $this->progettis[] = $progetti;
            $progetti->setFkIdUtente($this);
        }

        return $this;
    }

    public function removeProgetti(Progetti $progetti): self
    {
        if ($this->progettis->contains($progetti)) {
            $this->progettis->removeElement($progetti);
            // set the owning side to null (unless already changed)
            if ($progetti->getFkIdUtente() === $this) {
                $progetti->setFkIdUtente(null);
            }
        }

        return $this;
    }
}
