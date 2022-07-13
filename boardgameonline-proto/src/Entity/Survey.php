<?php

namespace App\Entity;

use App\Repository\SurveyRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SurveyRepository::class)]
class Survey
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 150)]
    private $nameSurvey;

    #[ORM\Column(type: 'string', length: 45, nullable: true)]
    private $question1;

    #[ORM\Column(type: 'string', length: 45, nullable: true)]
    private $question2;

    #[ORM\Column(type: 'string', length: 45, nullable: true)]
    private $question3;

    #[ORM\Column(type: 'string', length: 45, nullable: true)]
    private $question4;

    #[ORM\Column(type: 'string', length: 45, nullable: true)]
    private $question5;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $score1;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $score2;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $score3;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $score4;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $score5;

    #[ORM\ManyToOne(targetEntity: Player::class, inversedBy: 'surveys')]
    private $player;

    #[ORM\OneToMany(mappedBy: 'survey', targetEntity: Game::class)]
    private $games;


    public function __construct()
    {
        $this->games = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNameSurvey(): ?string
    {
        return $this->nameSurvey;
    }

    public function setNameSurvey(string $nameSurvey): self
    {
        $this->nameSurvey = $nameSurvey;

        return $this;
    }

    public function getQuestion1(): ?string
    {
        return $this->question1;
    }

    public function setQuestion1(?string $question1): self
    {
        $this->question1 = $question1;

        return $this;
    }

    public function getQuestion2(): ?string
    {
        return $this->question2;
    }

    public function setQuestion2(?string $question2): self
    {
        $this->question2 = $question2;

        return $this;
    }

    public function getQuestion3(): ?string
    {
        return $this->question3;
    }

    public function setQuestion3(?string $question3): self
    {
        $this->question3 = $question3;

        return $this;
    }

    public function getQuestion4(): ?string
    {
        return $this->question4;
    }

    public function setQuestion4(?string $question4): self
    {
        $this->question4 = $question4;

        return $this;
    }

    public function getQuestion5(): ?string
    {
        return $this->question5;
    }

    public function setQuestion5(?string $question5): self
    {
        $this->question5 = $question5;

        return $this;
    }

    public function getScore1(): ?int
    {
        return $this->score1;
    }

    public function setScore1(?int $score1): self
    {
        $this->score1 = $score1;

        return $this;
    }

    public function getScore2(): ?int
    {
        return $this->score2;
    }

    public function setScore2(?int $score2): self
    {
        $this->score2 = $score2;

        return $this;
    }

    public function getScore3(): ?int
    {
        return $this->score3;
    }

    public function setScore3(?int $score3): self
    {
        $this->score3 = $score3;

        return $this;
    }

    public function getScore4(): ?int
    {
        return $this->score4;
    }

    public function setScore4(?int $score4): self
    {
        $this->score4 = $score4;

        return $this;
    }

    public function getScore5(): ?int
    {
        return $this->score5;
    }

    public function setScore5(?int $score5): self
    {
        $this->score5 = $score5;

        return $this;
    }

    public function getPlayer(): ?Player
    {
        return $this->player;
    }

    public function setPlayer(?Player $player): self
    {
        $this->player = $player;

        return $this;
    }

    /**
     * @return Collection<int, Game>
     */
    public function getGames(): Collection
    {
        return $this->games;
    }

    public function addGame(Game $game): self
    {
        if (!$this->games->contains($game)) {
            $this->games[] = $game;
            $game->setSurvey($this);
        }

        return $this;
    }

    public function removeGame(Game $game): self
    {
        if ($this->games->removeElement($game)) {
            // set the owning side to null (unless already changed)
            if ($game->getSurvey() === $this) {
                $game->setSurvey(null);
            }
        }

        return $this;
    }


}
