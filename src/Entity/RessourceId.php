<?php
declare(strict_types=1);

namespace App\Entity;
use Symfony\Component\Serializer\Annotation\Groups;

trait RessourceId
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"user_read","user_details_read","article_details_read","article_read"})
     */
    private int $id;

    public function getId(): ?int
    {
        return $this->id;
    }
}
