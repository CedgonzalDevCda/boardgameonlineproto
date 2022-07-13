<?php

namespace App\Entity;

use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Validator\Constraints as Assert;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use App\Repository\GameRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: GameRepository::class)]
#[Vich\Uploadable]
class Game
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private int $id;

    #[ORM\Column(type: 'boolean',)]
    private bool $isVisible = false;

    #[ORM\Column(type: 'string', length: 100)]
    private string $name;

    #[ORM\Column(type: 'text')]
    private string $rules;

    #[ORM\Column(type: 'string', length: 45)]
    private string $ruleVersion;

    #[ORM\Column(type: 'integer')]
    private int $minPlayer;

    #[ORM\Column(type: 'integer')]
    private int $maxPlayer;

    #[ORM\Column(type: 'integer')]
    private int $minPlayingTime;

    #[ORM\Column(type: 'integer')]
    private int $maxPlayingTime;

    #[ORM\Column(type: 'integer')]
    private int $age;

    #[ORM\Column(type: 'datetime_immutable')]
    #[Assert\NotNull()]
    private \DateTimeImmutable $createdAt;

    #[ORM\Column(type: 'datetime_immutable')]
    #[Assert\NotNull()]
    private \DateTimeImmutable $updatedAt;


    #[Vich\UploadableField(mapping:"game_images", fileNameProperty:"image")]
    private ?File $imageFile = null;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private ?string $image = null;

    #[ORM\Column(type: 'text')]
    private string $description;

    #[ORM\Column(type: 'string', length: 45, nullable: true)]
    private string $onlineVersion;

    //TODO: Modifier MCD-MLD puis supprimer
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

    #[ORM\OneToMany(mappedBy: 'games', targetEntity: Gameroom::class)]
    private $gamerooms;

    #[ORM\ManyToOne(targetEntity: Survey::class, inversedBy: 'games')]
    private $survey;

    public function __construct()
    {
        $this->createdAt = new \DateTimeImmutable;
        $this->updatedAt = new \DateTimeImmutable();
        $this->users = new ArrayCollection();
        $this->gameListByUsers = new ArrayCollection();
        $this->gamerooms = new ArrayCollection();
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

    /**
     * If manually uploading a file (i.e. not using Symfony Form) ensure an instance
     * of 'UploadedFile' is injected into this setter to trigger the update. If this
     * bundle's configuration parameter 'inject_on_load' is set to 'true' this setter
     * must be able to accept an instance of 'File' as the bundle will inject one here
     * during Doctrine hydration.
     *
     * @param File|\Symfony\Component\HttpFoundation\File\UploadedFile|null $imageFile
     */
    public function setImageFile(?File $imageFile = null): void
    {
        $this->imageFile = $imageFile;

        if (null !== $imageFile) {
            // It is required that at least one field changes if you are using doctrine
            // otherwise the event listeners won't be called and the file is lost
            $this->updatedAt = new \DateTimeImmutable();
        }
    }

    public function getImageFile(): ?File
    {
        return $this->imageFile;
    }

    public function setImage(?string $image): void
    {
        $this->image = $image;
    }

    public function getImage(): ?string
    {
        return $this->image;
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

    //TODO: Modifier MCD-MLD puis supprimer
    public function isFavoris(): ?bool
    {
        return $this->favoris;
    }

    //TODO: Modifier MCD-MLD puis supprimer
    public function setFavoris(bool $favoris): self
    {
        $this->favoris = $favoris;

        return $this;
    }
    //TODO: Modifier MCD-MLD puis supprimer
    public function getDateCreation(): ?\DateTimeInterface
    {
        return $this->dateCreation;
    }
    //TODO: Modifier MCD-MLD puis supprimer
    public function setDateCreation(?\DateTimeInterface $dateCreation): self
    {
        $this->dateCreation = $dateCreation;

        return $this;
    }
    //TODO: Modifier MCD-MLD puis supprimer
    public function getDateLastUpdate(): ?\DateTimeInterface
    {
        return $this->dateLastUpdate;
    }
    //TODO: Modifier MCD-MLD puis supprimer
    public function setDateLastUpdate(?\DateTimeInterface $dateLastUpdate): self
    {
        $this->dateLastUpdate = $dateLastUpdate;

        return $this;
    }

    /**
     * @return \DateTimeImmutable
     */
    public function getCreatedAt(): \DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTimeImmutable $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

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
     *
     * @param null|User $user
     * @return boolean
     */
    public function isUserFavorite (?User $user):bool
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

    /**
     * @return int
     */
    public function getMinPlayingTime(): int
    {
        return $this->minPlayingTime;
    }

    /**
     * @param int $minPlayingTime
     * @return Game
     */
    public function setMinPlayingTime(int $minPlayingTime): self
    {
        $this->minPlayingTime = $minPlayingTime;

        return $this;
    }

    /**
     * @return int
     */
    public function getMaxPlayingTime(): int
    {
        return $this->maxPlayingTime;
    }

    /**
     * @param int $maxPlayingTime
     */
    public function setMaxPlayingTime(int $maxPlayingTime): self
    {
        $this->maxPlayingTime = $maxPlayingTime;
        return $this;
    }

    /**
     * @return Collection<int, Gameroom>
     */
    public function getGamerooms(): Collection
    {
        return $this->gamerooms;
    }

    public function addGameroom(Gameroom $gameroom): self
    {
        if (!$this->gamerooms->contains($gameroom)) {
            $this->gamerooms[] = $gameroom;
            $gameroom->setGames($this);
        }

        return $this;
    }

    public function removeGameroom(Gameroom $gameroom): self
    {
        if ($this->gamerooms->removeElement($gameroom)) {
            // set the owning side to null (unless already changed)
            if ($gameroom->getGames() === $this) {
                $gameroom->setGames(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return $this->name;
    }

    public function getSurvey(): ?Survey
    {
        return $this->survey;
    }

    public function setSurvey(?Survey $survey): self
    {
        $this->survey = $survey;

        return $this;
    }

}
