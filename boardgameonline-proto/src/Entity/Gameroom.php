<?php

namespace App\Entity;

use App\Repository\GameroomRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: GameroomRepository::class)]
class Gameroom
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'integer')]
    private $nbPlayer;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private $dateInvit;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $hashInvit;

    #[ORM\Column(type: 'datetime')]
    private $hashTimeout;

    #[ORM\Column(type: 'string', length: 255)]
    private $leader;

    #[ORM\ManyToOne(targetEntity: Game::class, inversedBy: 'gamerooms')]
    private $games;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNbPlayer(): ?int
    {
        return $this->nbPlayer;
    }

    public function setNbPlayer(int $nbPlayer): self
    {
        $this->nbPlayer = $nbPlayer;

        return $this;
    }

    public function getDateInvit(): ?\DateTimeInterface
    {
        return $this->dateInvit;
    }

    public function setDateInvit(?\DateTimeInterface $dateInvit): self
    {
        $this->dateInvit = $dateInvit;

        return $this;
    }

    public function getHashInvit(): ?string
    {
        return $this->hashInvit;
    }

    public function setHashInvit(?string $hashInvit): self
    {
        $this->hashInvit = $hashInvit;

        return $this;
    }

    public function getHashTimeout(): ?\DateTimeInterface
    {
        return $this->hashTimeout;
    }

    public function setHashTimeout(\DateTimeInterface $hashTimeout): self
    {
        $this->hashTimeout = $hashTimeout;

        return $this;
    }

    public function getLeader(): ?string
    {
        return $this->leader;
    }

    public function setLeader(string $leader): self
    {
        $this->leader = $leader;

        return $this;
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
}
