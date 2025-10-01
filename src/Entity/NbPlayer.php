<?php

namespace App\Entity;

use App\Repository\NbPlayerRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: NbPlayerRepository::class)]
class NbPlayer
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::SMALLINT)]
    private ?int $minPlayers = null;

    #[ORM\Column(type: Types::SMALLINT, nullable: true)]
    private ?int $maxPlayers = null;

    /**
     * @var Collection<int, Game>
     */
    #[ORM\OneToMany(targetEntity: Game::class, mappedBy: 'nbPlayers')]
    private Collection $games;

    public function __construct()
    {
        $this->games = new ArrayCollection();
    }
    
    public function __toString()
    {
        return $this->getPlayersLabel();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMinPlayers(): ?int
    {
        return $this->minPlayers;
    }

    public function setMinPlayers(int $minPlayers): static
    {
        $this->minPlayers = $minPlayers;

        return $this;
    }

    public function getMaxPlayers(): ?int
    {
        return $this->maxPlayers;
    }

    public function setMaxPlayers(?int $maxPlayers): static
    {
        $this->maxPlayers = $maxPlayers;

        return $this;
    }

    /**
     * Retourne une représentation textuelle du nombre de joueurs.
     */
    public function getPlayersLabel(): string
    {
        if ($this->maxPlayers && $this->minPlayers !== $this->maxPlayers) {
            return $this->minPlayers . '-' . $this->maxPlayers . ' joueurs';
        }
        return $this->minPlayers . ' joueurs';
    }

    /**
     * @return Collection<int, Game>
     */
    public function getGames(): Collection
    {
        return $this->games;
    }

    public function addGame(Game $game): static
    {
        if (!$this->games->contains($game)) {
            $this->games->add($game);
            $game->setNbPlayers($this);
        }

        return $this;
    }

    public function removeGame(Game $game): static
    {
        if ($this->games->removeElement($game)) {
            // set the owning side to null (unless already changed)
            if ($game->getNbPlayers() === $this) {
                $game->setNbPlayers(null);
            }
        }

        return $this;
    }
}
