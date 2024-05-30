<?php

namespace App\Entity;

use App\Repository\JourneyRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: JourneyRepository::class)]
class Journey
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id = null;

    #[ORM\Column(type: 'text')]
    private ?string $note;

    #[ORM\ManyToOne(targetEntity: "App\Entity\User")]
    #[ORM\JoinColumn(name: "user_id", referencedColumnName: "id")]
    private ?\App\Entity\User $user;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNote(): ?string
    {
        return $this->Note;
    }

    public function setNote(string $note): self
    {
        $this->Note = $note;
        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;
        return $this;
    }
}
