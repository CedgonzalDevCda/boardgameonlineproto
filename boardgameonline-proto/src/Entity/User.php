<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use phpDocumentor\Reflection\Types\Boolean;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[UniqueEntity(fields: ['username'], message: 'Il existe déjà un compte avec ce username')]
// TODO:à modifier email sera le champs unique
//#[UniqueEntity(fields: ['email'], message: 'There is already an account with this email')]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private int $id;

    #[ORM\Column(type: 'string', length: 180, unique: true)]
    private string $username;

    #[ORM\Column(type: 'json')]
    #[Assert\NotNull()]
    private array $roles = [];

//    private ?string $plainPassword = null;

    #[ORM\Column(type: 'string')]
//    #[Assert\NotBlank()]
    private string $password;

    #[ORM\Column(type: 'string', length: 180, nullable: true)]
    #[Assert\Email()]
    private ?string $email;

    #[ORM\Column(type: 'datetime_immutable')]
    #[Assert\NotNull()]
    private \DateTimeImmutable $createdAt;

    #[ORM\Column(type: 'datetime_immutable')]
    #[Assert\NotNull()]
    private \DateTimeImmutable $updatedAt;

    #[ORM\Column(name: "is_author", type:"boolean")]
    private bool $isAuthor = false;



    #[ORM\Column(name: "is_admin", type:"boolean")]
    private bool $isAdmin = false;

    #[ORM\OneToMany(mappedBy: 'users', targetEntity: GameListByUser::class)]
    private $gameListByUsers;

    #[ORM\OneToMany(mappedBy: 'users', targetEntity: FriendsList::class)]
    private $friendsLists;


    public function __construct()
    {
        $this->createdAt = new \DateTimeImmutable();
        $this->updatedAt = new \DateTimeImmutable();
        $this->gameListByUsers = new ArrayCollection();
        $this->friendsLists = new ArrayCollection();
    }



    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->username;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        //
        if($this->isAdmin){
            $roles[]='ROLE_ADMIN';
        }
        if($this->isAuthor){
            $roles[]='ROLE_AUTHOR';
        }
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';
        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
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
            $gameListByUser->setUsers($this);
        }

        return $this;
    }

    public function removeGameListByUser(GameListByUser $gameListByUser): self
    {
        if ($this->gameListByUsers->removeElement($gameListByUser)) {
            // set the owning side to null (unless already changed)
            if ($gameListByUser->getUsers() === $this) {
                $gameListByUser->setUsers(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, FriendsList>
     */
    public function getFriendsLists(): Collection
    {
        return $this->friendsLists;
    }

    public function addFriendsList(FriendsList $friendsList): self
    {
        if (!$this->friendsLists->contains($friendsList)) {
            $this->friendsLists[] = $friendsList;
            $friendsList->setUsers($this);
        }

        return $this;
    }

    public function removeFriendsList(FriendsList $friendsList): self
    {
        if ($this->friendsLists->removeElement($friendsList)) {
            // set the owning side to null (unless already changed)
            if ($friendsList->getUsers() === $this) {
                $friendsList->setUsers(null);
            }
        }

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
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
     * @return bool
     */
    public function isAuthor(): bool
    {
        return $this->isAuthor;
    }

    /**
     * @param bool $isAuthor
     */
    public function setIsAuthor(bool $isAuthor): void
    {
        $this->isAuthor = $isAuthor;
    }

}
