<?php

namespace App\Entity;

use App\Repository\GameroomRepository;
use DateInterval;
use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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

    #[ORM\OneToMany(mappedBy: 'gamerooms', targetEntity: PlayerHasGameroom::class)]
    private $playerHasGamerooms;

    public function __construct()
    {
        $this->leader = 'test';
        $this->hashInvit = $this->generateHashInvit();
        $this->dateInvit = new DateTime();
        $this->hashTimeout = $this->calculateHashTimeout(new DateTime());
        $this->playerHasGamerooms = new ArrayCollection();
    }

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

    /**
     * @return Collection<int, PlayerHasGameroom>
     */
    public function getPlayerHasGamerooms(): Collection
    {
        return $this->playerHasGamerooms;
    }

    public function addPlayerHasGameroom(PlayerHasGameroom $playerHasGameroom): self
    {
        if (!$this->playerHasGamerooms->contains($playerHasGameroom)) {
            $this->playerHasGamerooms[] = $playerHasGameroom;
            $playerHasGameroom->setGamerooms($this);
        }

        return $this;
    }

    public function removePlayerHasGameroom(PlayerHasGameroom $playerHasGameroom): self
    {
        if ($this->playerHasGamerooms->removeElement($playerHasGameroom)) {
            // set the owning side to null (unless already changed)
            if ($playerHasGameroom->getGamerooms() === $this) {
                $playerHasGameroom->setGamerooms(null);
            }
        }

        return $this;
    }

    /**
     * Génère un hash d'invitation sans caractères spéciaux.
     * @param $length
     * @return string
     */
    private function generateHashInvit($length = 32) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    /**
     * Ajoute un jou
     * @param $dateToUpdate
     * @return mixed
     */
    private function calculateHashTimeout($dateToUpdate){
        return $dateToUpdate->add(new DateInterval('P1D'));
    }

}
