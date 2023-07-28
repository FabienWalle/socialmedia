<?php

namespace App\Entity;

use App\Entity\Trait\CreatedAtTrait;
use App\Repository\RepostRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RepostRepository::class)]
class Repost
{
use CreatedAtTrait;
    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $repost_text = null;

    #[ORM\Id]
    #[ORM\ManyToOne(inversedBy: 'reposts')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $user = null;

    #[ORM\Id]
    #[ORM\ManyToOne(inversedBy: 'reposts')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Post $post = null;

    public function __construct(){
        $this->created_at = new \DateTimeImmutable();
    }
    public function getRepostText(): ?string
    {
        return $this->repost_text;
    }

    public function setRepostText(?string $repost_text): static
    {
        $this->repost_text = $repost_text;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): static
    {
        $this->user = $user;

        return $this;
    }

    public function getPost(): ?Post
    {
        return $this->post;
    }

    public function setPost(?Post $post): static
    {
        $this->post = $post;

        return $this;
    }

}
