<?php

namespace App\Entity;

use App\Repository\PanierRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PanierRepository::class)]
class Panier
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\OneToMany(mappedBy: 'panier', targetEntity: detailPanier::class)]
    private Collection $detailPanier;

    public function __construct()
    {
        $this->detailPanier = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection<int, detailPanier>
     */
    public function getDetailPanier(): Collection
    {
        return $this->detailPanier;
    }

    public function addDetailPanier(detailPanier $detailPanier): self
    {
        if (!$this->detailPanier->contains($detailPanier)) {
            $this->detailPanier->add($detailPanier);
            $detailPanier->setPanier($this);
        }

        return $this;
    }

    public function removeDetailPanier(detailPanier $detailPanier): self
    {
        if ($this->detailPanier->removeElement($detailPanier)) {
            // set the owning side to null (unless already changed)
            if ($detailPanier->getPanier() === $this) {
                $detailPanier->setPanier(null);
            }
        }

        return $this;
    }
}
