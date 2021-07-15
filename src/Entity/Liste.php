<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiSubresource;
use App\Repository\ListeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints\Type;

/**
 * @ORM\Entity(repositoryClass=ListeRepository::class)
 */
#[ApiResource(
    normalizationContext:['groups' => ['liste_read']],
    subresourceOperations:[
        'listeLines_get_subresource' => [
            'path' => '/listes/{id}/listeLines'
        ]
    ],
    attributes:[
        "pagination_enabled"=> [false]
    ],
)]
class Liste
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    #[Groups(['liste_read'])]
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     */
    #[Groups(['liste_read'])]
    private $title;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    #[Groups(['liste_read'])]
    private $description;

    /**
     * @ORM\Column(type="datetime_immutable")
     */
    #[Groups(['liste_read'])]
    #[Type(['type' => "DateTimeInterface", "message" => "la date doit être au format yyy-mm-ddT00:00:00"])]
    private $createdAt;

    /**
     * @ORM\Column(type="datetime_immutable", nullable=true)
     */
    #[Groups(['liste_read'])]
    #[Type(['type' => "DateTimeInterface", "message" => "la date doit être au format yyy-mm-ddT00:00:00"])]
    private $updatedAt;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    #[Groups(['liste_read'])]
    private $slug;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    #[Groups(['liste_read'])]
    private $color;

    /**
     * @ORM\OneToMany(targetEntity=ListeLine::class, mappedBy="liste")
     */
    #[Groups(['liste_read'])]
    #[ApiSubresource()]
    private $listeLines;

    /**
     * @ORM\Column(type="integer")
     */
    #[Groups(['liste_read'])]
    private $chrono;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="listes")
     */
    #[Groups(['liste_read'])]
    private $user;

    public function __construct()
    {
        $this->listeLines = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

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

    public function setUpdatedAt(?\DateTimeImmutable $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(?string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }

    public function getColor(): ?string
    {
        return $this->color;
    }

    public function setColor(?string $color): self
    {
        $this->color = $color;

        return $this;
    }

    /**
     * @return Collection|ListeLine[]
     */
    public function getListeLines(): Collection
    {
        return $this->listeLines;
    }

    public function addListeLine(ListeLine $listeLine): self
    {
        if (!$this->listeLines->contains($listeLine)) {
            $this->listeLines[] = $listeLine;
            $listeLine->setListe($this);
        }

        return $this;
    }

    public function removeListeLine(ListeLine $listeLine): self
    {
        if ($this->listeLines->removeElement($listeLine)) {
            // set the owning side to null (unless already changed)
            if ($listeLine->getListe() === $this) {
                $listeLine->setListe(null);
            }
        }

        return $this;
    }

    public function getChrono(): ?int
    {
        return $this->chrono;
    }

    public function setChrono(int $chrono): self
    {
        $this->chrono = $chrono;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }
}
