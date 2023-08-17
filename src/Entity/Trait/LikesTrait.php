<?php

namespace App\Entity\Trait;

use Doctrine\ORM\Mapping as ORM;

trait LikesTrait
{
    #[ORM\Column(nullable: true)]
    private ?int $likes = null;

    public function getLikes(): ?int
    {
        return $this->likes;
    }

    public function setLikes(int $likes): self
    {
        $this->likes = $likes;

        return $this;
    }
}