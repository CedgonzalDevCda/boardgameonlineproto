<?php

namespace App\Entity;

use App\Repository\PlayerHasGameroomRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PlayerHasGameroomRepository::class)]
class PlayerHasGameroom
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\ManyToOne(targetEntity: Player::class, inversedBy: 'gamerooms')]
    private $players;

    #[ORM\ManyToOne(targetEntity: Gameroom::class, inversedBy: 'playerHasGamerooms')]
    private $gamerooms;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPlayers(): ?Player
    {
        return $this->players;
    }

    public function setPlayers(?Player $players): self
    {
        $this->players = $players;

        return $this;
    }

    public function getGamerooms(): ?Gameroom
    {
        return $this->gamerooms;
    }

    public function setGamerooms(?Gameroom $gamerooms): self
    {
        $this->gamerooms = $gamerooms;

        return $this;
    }
}
