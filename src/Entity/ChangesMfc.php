<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ChangesMfc
 *
 * @ORM\Table(name="changes_mfc")
 * @ORM\Entity
 */
class ChangesMfc
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
     * @ORM\Column(name="date_change", type="datetime", nullable=false)
     */
    private $dateChange;

    /**
     * @ORM\ManyToOne(targetEntity=QueryMfc::class, inversedBy="changes")
     */
    private $query;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $oldstatus;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateChange(): ?\DateTimeInterface
    {
        return $this->dateChange;
    }

    public function setDateChange(\DateTimeInterface $dateChange): self
    {
        $this->dateChange = $dateChange;

        return $this;
    }

    public function getQuery(): ?QueryMfc
    {
        return $this->query;
    }

    public function setQuery(?QueryMfc $query): self
    {
        $this->query = $query;

        return $this;
    }

    public function getOldstatus(): ?string
    {
        return $this->oldstatus;
    }

    public function setOldstatus(?string $oldstatus): self
    {
        $this->oldstatus = $oldstatus;

        return $this;
    }


}
