<?php

declare(strict_types=1);

namespace App\Entity;

use App\Repository\ArticleRepository;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;
use App\Controller\ArticleUpdatedAt;


/**
 * @ORM\Entity(repositoryClass=ArticleRepository::class)
 * @ApiResource(
 *   collectionOperations={
 *             "get"={"normalization_context"={"groups"={"article_read"}}
 *              },
 *             "post"
 *    },
 *  itemOperations={
 *             "get"={"normalization_context"= {"groups"={"article_details_read"}}
 *              },
 *              "put",
 *              "patch",
 *              "delete",
 *              "PUT_UPDATED_AT"={
 *                      "method"="PUT",
 *                      "path"="/article/{id}/updated-at",
 *                      "controller"=ArticleUpdatedAt::class
 *              }
 *    }
 * )
 */
class Article
{
    use RessourceId;
    use Timestapable;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"user_details_read","article_details_read","article_read"})
     */
    private string $name;

    /**
     * @ORM\Column(type="text", nullable=true)
     * @Groups({"article_read","article_details_read"})
     */
    private string $content;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="articles")
     * @Groups({"article_details_read"})
     */
    private User $author;

    public function __construct()
    {
        $this->createdAt = new \DateTimeImmutable();
    }
    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(?string $content): self
    {
        $this->content = $content;

        return $this;
    }

    public function getAuthor(): ?User
    {
        return $this->author;
    }

    public function setAuthor(?User $author): self
    {
        $this->author = $author;

        return $this;
    }
}
