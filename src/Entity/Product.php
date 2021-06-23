<?php

namespace App\Entity;

use App\Repository\ProductRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ProductRepository::class)
 */
class Product
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity=ListeLine::class, mappedBy="product", orphanRemoval=true)
     */
    private $listeLines;

    /**
     * @ORM\ManyToOne(targetEntity=Category::class, inversedBy="products")
     */
    private $category;

    public function __construct()
    {
        $this->listeLines = new ArrayCollection();
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
            $listeLine->setProduct($this);
        }

        return $this;
    }

    public function removeListeLine(ListeLine $listeLine): self
    {
        if ($this->listeLines->removeElement($listeLine)) {
            // set the owning side to null (unless already changed)
            if ($listeLine->getProduct() === $this) {
                $listeLine->setProduct(null);
            }
        }

        return $this;
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
}
