<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\ProductRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

/**
 * @ORM\Entity(repositoryClass=ProductRepository::class)
 */
#[ApiResource(
    normalizationContext:['groups' => ['product_read']],
    collectionOperations:[
        "get",
        "post" => ["security" => "is_granted('ROLE_ADMIN')"]
    ],
    itemOperations:[
        "get",
        "put" => ["security" => "is_granted('ROLE_ADMIN')"],
        "delete" => ["security" => "is_granted('ROLE_ADMIN')"]
    ]
)]
class Product
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    #[Groups(['product_read','subresource_liste_listeLine'])]
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     */
    #[Groups(['product_read','subresource_liste_listeLine'])]
    #[NotBlank(['message' => 'Veuillez saisir un nom de produit'])]
    #[Length([
        'min' => '3',
        'minMessage' => 'Nom trop court',
        'max' => '100',
        'maxMessage' => 'Nom trop long'
    ])]
    private $name;

    /**
     * @ORM\OneToMany(targetEntity=ListeLine::class, mappedBy="product", orphanRemoval=true)
     */
    #[Groups(['product_read'])]
    private $listeLines;

    /**
     * @ORM\ManyToOne(targetEntity=Category::class, inversedBy="products")
     */
    #[Groups(['product_read','subresource_liste_listeLine'])]
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
