<?php

namespace App\Entity;

use App\Repository\GameListByUserRepository;
use App\Repository\GameRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: GameRepository::class)]
class Game
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'boolean')]
    private $isVisible;

    #[ORM\Column(type: 'string', length: 100)]
    private $name;

    #[ORM\Column(type: 'string', length: 255)]
    private $rules;

    #[ORM\Column(type: 'string', length: 45)]
    private $ruleVersion;

    #[ORM\Column(type: 'integer')]
    private $minPlayer;

    #[ORM\Column(type: 'integer')]
    private $maxPlayer;

    #[ORM\Column(type: 'integer')]
    private $age;

    #[ORM\Column(type: 'string', length: 255)]
    private $image;

    #[ORM\Column(type: 'text')]
    private $description;

    #[ORM\Column(type: 'string', length: 45, nullable: true)]
    private $onlineVersion;

    #[ORM\Column(type: 'boolean')]
    private $favoris;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private $dateCreation;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private $dateLastUpdate;

    #[ORM\OneToMany(mappedBy: 'games', targetEntity: GameListByUser::class)]
    private $gameListByUsers;

    #[ORM\ManyToOne(targetEntity: Category::class, inversedBy: 'games')]
    private $category;

    public function __construct()
    {
        $this->users = new ArrayCollection();
        $this->gameListByUsers = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function isIsVisible(): ?bool
    {
        return $this->isVisible;
    }

    public function setIsVisible(bool $isVisible): self
    {
        $this->isVisible = $isVisible;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }


    public function getRules(): ?string
    {
        return $this->rules;
    }

    public function setRules(string $rules): self
    {
        $this->rules = $rules;

        return $this;
    }

    public function getRuleVersion(): ?string
    {
        return $this->ruleVersion;
    }

    public function setRuleVersion(string $ruleVersion): self
    {
        $this->ruleVersion = $ruleVersion;

        return $this;
    }

    public function getMinPlayer(): ?int
    {
        return $this->minPlayer;
    }

    public function setMinPlayer(int $minPlayer): self
    {
        $this->minPlayer = $minPlayer;

        return $this;
    }

    public function getMaxPlayer(): ?int
    {
        return $this->maxPlayer;
    }

    public function setMaxPlayer(int $maxPlayer): self
    {
        $this->maxPlayer = $maxPlayer;

        return $this;
    }

    public function getAge(): ?int
    {
        return $this->age;
    }

    public function setAge(int $age): self
    {
        $this->age = $age;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getOnlineVersion(): ?string
    {
        return $this->onlineVersion;
    }

    public function setOnlineVersion(?string $onlineVersion): self
    {
        $this->onlineVersion = $onlineVersion;

        return $this;
    }

    public function isFavoris(): ?bool
    {
        return $this->favoris;
    }

    public function setFavoris(bool $favoris): self
    {
        $this->favoris = $favoris;

        return $this;
    }

    public function getDateCreation(): ?\DateTimeInterface
    {
        return $this->dateCreation;
    }

    public function setDateCreation(?\DateTimeInterface $dateCreation): self
    {
        $this->dateCreation = $dateCreation;

        return $this;
    }

    public function getDateLastUpdate(): ?\DateTimeInterface
    {
        return $this->dateLastUpdate;
    }

    public function setDateLastUpdate(?\DateTimeInterface $dateLastUpdate): self
    {
        $this->dateLastUpdate = $dateLastUpdate;

        return $this;
    }

    /**
     * @return Collection<int, GameListByUser>
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

    public function addUser(GameListByUser $user): self
    {
        if (!$this->users->contains($user)) {
            $this->users[] = $user;
            $user->setGames($this);
        }

        return $this;
    }

    public function removeUser(GameListByUser $user): self
    {
        if ($this->users->removeElement($user)) {
            // set the owning side to null (unless already changed)
            if ($user->getGames() === $this) {
                $user->setGames(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, GameListByUser>
     */
    public function getGameListByUsers(): Collection
    {
        return $this->gameListByUsers;
    }

    public function addGameListByUser(GameListByUser $gameListByUser): self
    {
        if (!$this->gameListByUsers->contains($gameListByUser)) {
            $this->gameListByUsers[] = $gameListByUser;
            $gameListByUser->setGames($this);
        }

        return $this;
    }

    public function removeGameListByUser(GameListByUser $gameListByUser): self
    {
        if ($this->gameListByUsers->removeElement($gameListByUser)) {
            // set the owning side to null (unless already changed)
            if ($gameListByUser->getGames() === $this) {
                $gameListByUser->setGames(null);
            }
        }

        return $this;
    }

    /**
     * @param User $user
     * @return boolean
     */
    public function isUserFavorite (User $user):bool
    {
        foreach($this->gameListByUsers as $gameListByUsers){
            if($gameListByUsers->getUsers() === $user) return true;
        }
        return false;
    }

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(?Category $category): self
    {
        $this->category = $category;

        return $this;
    }

}
