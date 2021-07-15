<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\ListeLineRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints\GreaterThan;
use Symfony\Component\Validator\Constraints\Type;

/**
 * @ORM\Entity(repositoryClass=ListeLineRepository::class)
 */
#[ApiResource(
    attributes: [
        "pagination_enabled" => [false]
    ],
    subresourceOperations:[
        'api_listes_liste_lines_get_subresource' => [
            'method' => 'GET',
            'normalization_context' => [
                'groups' => ['subresource_liste_listeLine']
            ]
        ]
    ]
)]
class ListeLine
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    #[Groups(['subresource_liste_listeLine'])]
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    #[Groups(['subresource_liste_listeLine'])]
    #[Type([
        'type' => 'integer',
        'message' => 'La quantité doit être de type entier'
    ])]
    #[GreaterThan(
        ['value' => 0,]
    )]
    private $quantity;

    /**
     * @ORM\Column(type="boolean")
     */
    #[Groups(['subresource_liste_listeLine'])]
    private $isFinished;

    /**
     * @ORM\ManyToOne(targetEntity=Product::class, inversedBy="listeLines")
     * @ORM\JoinColumn(nullable=false)
     */
    #[Groups(['subresource_liste_listeLine'])]
    private $product;

    /**
     * @ORM\ManyToOne(targetEntity=Liste::class, inversedBy="listeLines")
     */
    private $liste;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    public function setQuantity(int $quantity): self
    {
        $this->quantity = $quantity;

        return $this;
    }

    public function getIsFinished(): ?bool
    {
        return $this->isFinished;
    }

    public function setIsFinished(bool $isFinished): self
    {
        $this->isFinished = $isFinished;

        return $this;
    }

    public function getProduct(): ?Product
    {
        return $this->product;
    }

    public function setProduct(?Product $product): self
    {
        $this->product = $product;

        return $this;
    }

    public function getListe(): ?Liste
    {
        return $this->liste;
    }

    public function setListe(?Liste $liste): self
    {
        $this->liste = $liste;

        return $this;
    }
}
