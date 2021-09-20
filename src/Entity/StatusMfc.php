<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * StatusMfc
 *
 * @ORM\Table(name="status_mfc")
 * @ORM\Entity
 */
class StatusMfc
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="status", type="string", length=50, nullable=false)
     */
    private $status;

    /**
     * @ORM\OneToMany(targetEntity=QueryMfc::class, mappedBy="status")
     */
    private $query;

    public function __construct()
    {
        $this->query = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): self
    {
        $this->status = $status;

        return $this;
    }

    /**
     * @return Collection|QueryMfc[]
     */
    public function getQuery(): Collection
    {
        return $this->query;
    }

    public function addQuery(QueryMfc $query): self
    {
        if (!$this->query->contains($query)) {
            $this->query[] = $query;
            $query->setStatus($this);
        }

        return $this;
    }

    public function removeQuery(QueryMfc $query): self
    {
        if ($this->query->removeElement($query)) {
            // set the owning side to null (unless already changed)
            if ($query->getStatus() === $this) {
                $query->setStatus(null);
            }
        }

        return $this;
    }


}
