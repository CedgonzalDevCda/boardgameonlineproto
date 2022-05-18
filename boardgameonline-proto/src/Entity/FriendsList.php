<?php

namespace App\Entity;

use App\Repository\FriendsListRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FriendsListRepository::class)]
class FriendsList
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\ManyToOne(targetEntity: Friend::class, inversedBy: 'friendsLists')]
    private $friends;

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'friendsLists')]
    private $users;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFriends(): ?Friend
    {
        return $this->friends;
    }

    public function setFriends(?Friend $friends): self
    {
        $this->friends = $friends;

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
