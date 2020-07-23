<?php

namespace App\Entity;

use App\Repository\StateRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=StateRepository::class)
 */
class State
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=32)
     */
    private $name;

    /**
     * @ORM\Column(type="integer")
     */
    private $rank;

    /**
     * @ORM\OneToMany(targetEntity=ProductForSale::class, mappedBy="state")
     */
    private $productForSales;

    public function __construct()
    {
        $this->productForSales = new ArrayCollection();
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

    public function getRank(): ?int
    {
        return $this->rank;
    }

    public function setRank(int $rank): self
    {
        $this->rank = $rank;

        return $this;
    }

    /**
     * @return Collection|ProductForSale[]
     */
    public function getProductForSales(): Collection
    {
        return $this->productForSales;
    }

    public function addProductForSale(ProductForSale $productForSale): self
    {
        if (!$this->productForSales->contains($productForSale)) {
            $this->productForSales[] = $productForSale;
            $productForSale->setState($this);
        }

        return $this;
    }

    public function removeProductForSale(ProductForSale $productForSale): self
    {
        if ($this->productForSales->contains($productForSale)) {
            $this->productForSales->removeElement($productForSale);
            // set the owning side to null (unless already changed)
            if ($productForSale->getState() === $this) {
                $productForSale->setState(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return $this->name;
    }
}
