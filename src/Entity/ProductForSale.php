<?php

namespace App\Entity;

use App\Repository\ProductForSaleRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ProductForSaleRepository::class)
 */
class ProductForSale
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="float")
     */
    private $prixPlancher;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="productForSales")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity=State::class, inversedBy="productForSales")
     * @ORM\JoinColumn(nullable=false)
     */
    private $state;

    /**
     * @ORM\ManyToOne(targetEntity=Product::class, inversedBy="productForSales")
     * @ORM\JoinColumn(nullable=false)
     */
    private $product;

    /**
     * @ORM\Column(type="float")
     */
    private $prixMax;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPrixPlancher(): ?float
    {
        return $this->prixPlancher;
    }

    public function setPrixPlancher(float $prixPlancher): self
    {
        $this->prixPlancher = $prixPlancher;

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

    public function getState(): ?State
    {
        return $this->state;
    }

    public function setState(?State $state): self
    {
        $this->state = $state;

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

    public function getPrixMax(): ?float
    {
        return $this->prixMax;
    }

    public function setPrixMax(float $prixMax): self
    {
        $this->prixMax = $prixMax;

        return $this;
    }
}
