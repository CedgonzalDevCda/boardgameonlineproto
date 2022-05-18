<?php

namespace App\Entity;

use App\Repository\GameListByUserRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: GameListByUserRepository::class)]
class GameListByUser
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\ManyToOne(targetEntity: Game::class, inversedBy: 'gameListByUsers')]
    private $games;

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'gameListByUsers')]
    private $users;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getGames(): ?Game
    {
        return $this->games;
    }

    public function setGames(?Game $games): self
    {
        $this->games = $games;

        return $this;
    }

    public function getUsers(): ?User
    {
        return $this->users;
    }

    public function setUsers(?User $users): self
    {
        $this->users = $users;

        return $this;
    }
}
