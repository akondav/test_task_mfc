<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * QueryMfc
 *
 * @ORM\Table(name="query_mfc")
 * @ORM\Entity
 */
class QueryMfc
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
     * @var \DateTime
     *
     * @ORM\Column(name="date_create", type="datetime", nullable=false)
     */
    private $dateCreate;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=50, nullable=false)
     */
    private $title;

    /**
     * @var string|null
     *
     * @ORM\Column(name="main_text", type="text", length=0, nullable=true)
     */
    private $mainText;

    /**
     * @ORM\ManyToOne(targetEntity=StatusMfc::class, inversedBy="query")
     */
    private $status;

    /**
     * @ORM\OneToMany(targetEntity=ChangesMfc::class, mappedBy="query",cascade={"persist", "remove"})
     */
    private $changes;

    /**
     * @ORM\OneToMany(targetEntity=ImagesMfc::class, mappedBy="query",cascade={"persist", "remove"})
     */
    private $images;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $dateLastChange;

    public function __construct()
    {
        $this->changes = new ArrayCollection();
        $this->images = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateCreate(): ?\DateTimeInterface
    {
        return $this->dateCreate;
    }

    public function setDateCreate(\DateTimeInterface $dateCreate): self
    {
        $this->dateCreate = $dateCreate;

        return $this;
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

    public function getMainText(): ?string
    {
        return $this->mainText;
    }

    public function setMainText(?string $mainText): self
    {
        $this->mainText = $mainText;

        return $this;
    }

    public function getStatus(): ?StatusMfc
    {
        return $this->status;
    }

    public function setStatus(?StatusMfc $status): self
    {
        $this->status = $status;

        return $this;
    }

    /**
     * @return Collection|ChangesMfc[]
     */
    public function getChanges(): Collection
    {
        return $this->changes;
    }

    public function addChange(ChangesMfc $change): self
    {
        if (!$this->changes->contains($change)) {
            $this->changes[] = $change;
            $change->setQuery($this);
        }

        return $this;
    }

    public function removeChange(ChangesMfc $change): self
    {
        if ($this->changes->removeElement($change)) {
            // set the owning side to null (unless already changed)
            if ($change->getQuery() === $this) {
                $change->setQuery(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|ImagesMfc[]
     */
    public function getImages(): Collection
    {
        return $this->images;
    }

    public function addImage(ImagesMfc $image): self
    {
        if (!$this->images->contains($image)) {
            $this->images[] = $image;
            $image->setQuery($this);
        }

        return $this;
    }

    public function removeImage(ImagesMfc $image): self
    {
        if ($this->images->removeElement($image)) {
            // set the owning side to null (unless already changed)
            if ($image->getQuery() === $this) {
                $image->setQuery(null);
            }
        }

        return $this;
    }

    public function getDateLastChange(): ?\DateTimeInterface
    {
        return $this->dateLastChange;
    }

    public function setDateLastChange(?\DateTimeInterface $dateLastChange): self
    {
        $this->dateLastChange = $dateLastChange;

        return $this;
    }


}
