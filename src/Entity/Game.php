<?php

namespace App\Entity;

use App\Repository\GameRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: GameRepository::class)]
class Game
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(type: Types::SMALLINT, nullable: true)]
    private ?int $duration = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTime $lastDatePlayed = null;

    #[ORM\Column(type: Types::SMALLINT, nullable: true)]
    #[Assert\Range(
        min: 0,
        max: 10,
        notInRangeMessage: 'La note doit être comprise entre {{ min }} et {{ max }}.',
    )]
    private ?int $note = null;

    #[ORM\ManyToOne(inversedBy: 'games')]
    #[ORM\JoinColumn(nullable: false)]
    private ?NbPlayer $nbPlayers = null;

    #[ORM\ManyToOne(targetEntity: Category::class)]
    #[ORM\JoinColumn(nullable: false)]
    private ?Category $category = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getDuration(): ?int
    {
        return $this->duration;
    }

    public function setDuration(?int $duration): static
    {
        $this->duration = $duration;

        return $this;
    }

    public function getLastDatePlayed(): ?\DateTime
    {
        return $this->lastDatePlayed;
    }

    public function setLastDatePlayed(?\DateTime $lastDatePlayed): static
    {
        $this->lastDatePlayed = $lastDatePlayed;

        return $this;
    }

    public function getNote(): ?int
    {
        return $this->note;
    }

    public function setNote(?int $note): static
    {
        $this->note = $note;

        return $this;
    }

    public function getNbPlayers(): ?NbPlayer
    {
        return $this->nbPlayers;
    }

    public function setNbPlayers(?NbPlayer $nbPlayers): static
    {
        $this->nbPlayers = $nbPlayers;

        return $this;
    }

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(?Category $category): static
    {
        $this->category = $category;

        return $this;
    }
}