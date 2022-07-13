<?php

namespace App\Entity;

use App\Repository\FriendRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FriendRepository::class)]
class Friend
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private int $id;

    #[ORM\Column(type: 'string', length: 255)]
    private string $name;

    #[ORM\Column(type: 'string', length: 255)]
    #[Assert\Regex(pattern:"/^[a-zA-Z0-9_.-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/", message:"not_valid_email")]
    private string $email;

    #[ORM\OneToMany(mappedBy: 'friends', targetEntity: FriendsList::class)]
    private $friendsLists;

    public function __construct()
    {
        $this->friendsLists = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

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
            $friendsList->setFriends($this);
        }

        return $this;
    }

    public function removeFriendsList(FriendsList $friendsList): self
    {
        if ($this->friendsLists->removeElement($friendsList)) {
            // set the owning side to null (unless already changed)
            if ($friendsList->getFriends() === $this) {
                $friendsList->setFriends(null);
            }
        }

        return $this;
    }

    /**
     * Ajoute un ami à sa liste d'ami
     * @param User|null $user
     * @return bool
     */
    public function isUserFriendsLists (?User $user):bool
    {
        foreach($this->friendsLists as $friendsLists){
            if($friendsLists->getUsers() === $user) return true;
        }
        return false;
    }


}
