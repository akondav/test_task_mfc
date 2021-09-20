<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ImagesMfc
 *
 * @ORM\Table(name="images_mfc")
 * @ORM\Entity
 */
class ImagesMfc
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
     * @ORM\Column(name="ref_image", type="string", length=255, nullable=false)
     */
    private $refImage;

    /**
     * @ORM\ManyToOne(targetEntity=QueryMfc::class, inversedBy="images")
     */
    private $query;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRefImage(): ?string
    {
        return $this->refImage;
    }

    public function setRefImage(string $refImage): self
    {
        $this->refImage = $refImage;

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


}
