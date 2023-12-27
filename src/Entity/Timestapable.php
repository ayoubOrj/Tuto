<?php

declare(strict_types=1);

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

trait Timestapable
{
    /**
     * @var \DateTimeInterface
     * @ORM\Column(type="datetime")
     */
    private \DateTimeInterface $createdAt;

    /**
     * @var \DateTimeInterface
     * @ORM\Column(type="datetime", nullable=true)
     */
    private ?\DateTimeInterface $updatedAt;

    /**
     * @param \DateTimeInterface $createdAt
     * @return Timestapable
     */
    public function setCreatedAt(\DateTimeInterface $createdAt): Timestapable
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * @return \DateTimeInterface
     */
    public function getCreatedAt(): \DateTimeInterface
    {

        return $this->createdAt;
    }

    public function setUpdatedtAt(?\DateTimeInterface $updatedAt): Timestapable
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    public function getUpdatedtAt(): ?\DateTimeInterface
    {

        return $this->updatedAt;
    }
}
