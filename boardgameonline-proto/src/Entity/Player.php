<?php

namespace App\Entity;

use App\Repository\PlayerRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PlayerRepository::class)]
class Player
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 45, nullable: true)]
    private $pseudo;

    #[ORM\Column(type: 'string', length: 45, nullable: true)]
    private $endGameScore;

    #[ORM\OneToMany(mappedBy: 'player', targetEntity: Survey::class)]
    private $surveys;

    #[ORM\OneToMany(mappedBy: 'players', targetEntity: PlayerHasGameroom::class)]
    private $playerHasGamerooms;

    public function __construct()
    {
        $this->surveys = new ArrayCollection();
        $this->playerHasGamerooms = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPseudo(): ?string
    {
        return $this->pseudo;
    }

    public function setPseudo(?string $pseudo): self
    {
        $this->pseudo = $pseudo;

        return $this;
    }

    public function getEndGameScore(): ?string
    {
        return $this->endGameScore;
    }

    public function setEndGameScore(?string $endGameScore): self
    {
        $this->endGameScore = $endGameScore;

        return $this;
    }

    /**
     * @return Collection<int, Survey>
     */
    public function getSurveys(): Collection
    {
        return $this->surveys;
    }

    public function addSurvey(Survey $survey): self
    {
        if (!$this->surveys->contains($survey)) {
            $this->surveys[] = $survey;
            $survey->setPlayer($this);
        }

        return $this;
    }

    public function removeSurvey(Survey $survey): self
    {
        if ($this->surveys->removeElement($survey)) {
            // set the owning side to null (unless already changed)
            if ($survey->getPlayer() === $this) {
                $survey->setPlayer(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, PlayerHasGameroom>
     */
    public function getPlayerHasGamerooms(): Collection
    {
        return $this->playerHasGamerooms;
    }

    public function addPlayerHasGamerooms(PlayerHasGameroom $playerHasGamerooms): self
    {
        if (!$this->playerHasGamerooms->contains($playerHasGamerooms)) {
            $this->playerHasGamerooms[] = $playerHasGamerooms;
            $playerHasGamerooms->setPlayers($this);
        }

        return $this;
    }

    public function removeGameroom(PlayerHasGameroom $playerHasGamerooms): self
    {
        if ($this->playerHasGamerooms->removeElement($playerHasGamerooms)) {
            // set the owning side to null (unless already changed)
            if ($playerHasGamerooms->getPlayers() === $this) {
                $playerHasGamerooms->setPlayers(null);
            }
        }

        return $this;
    }
}
