<?php

namespace App\Entity;

use App\Repository\CategoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

#[ORM\Entity(repositoryClass: CategoryRepository::class)]
#[Vich\Uploadable]
class Category
{
    #[ORM\Id, ORM\GeneratedValue, ORM\Column(type: 'integer')]
    private ?int $id = null;

    #[ORM\Column(type: 'string', length: 255)]
    private ?string $label = null;

    #[ORM\OneToMany(mappedBy: 'category', targetEntity: Activity::class, orphanRemoval: true)]
    private Collection $activities;

    #[ORM\Column(type: 'string', length: 255)]
    private ?string $picture = null;

    #[Vich\UploadableField(mapping: 'category_images', fileNameProperty: 'picture')]
    private ?File $pictureFile = null;

    #[Gedmo\Slug(fields: ['label'])]
    #[ORM\Column(type: 'string', length: 255, unique: true)]
    private ?string $slug = null;

    #[ORM\Column(type: 'string', length: 255)]
    private ?string $headerphoto = null;

    #[Vich\UploadableField(mapping: 'category_images', fileNameProperty: 'headerphoto')]
    private ?File $headerphotoFile = null;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private ?\DateTimeInterface $updatedAt = null;

    public function __construct()
    {
        $this->activities = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLabel(): ?string
    {
        return $this->label;
    }

    public function setLabel(string $label): self
    {
        $this->label = $label;
        return $this;
    }

    /**
     * @return Collection|Activity[]
     */
    public function getActivities(): Collection
    {
        return $this->activities;
    }

    public function addActivity(Activity $activity): self
    {
        if (!$this->activities->contains($activity)) {
            $this->activities[] = $activity;
            $activity->setCategory($this);
        }
        return $this;
    }

    public function removeActivity(Activity $activity): self
    {
        if ($this->activities->removeElement($activity)) {
            if ($activity->getCategory() === $this) {
                $activity->setCategory(null);
            }
        }
        return $this;
    }

    public function getPicture(): ?string
    {
        return $this->picture;
    }

    public function setPicture(?string $picture): self
    {
        $this->picture = $picture;
        return $this;
    }

    public function getPictureFile(): ?File
    {
        return $this->pictureFile;
    }

    public function setPictureFile(?File $pictureFile): void
    {
        $this->pictureFile = $pictureFile;
        if ($pictureFile) {
            $this->updatedAt = new \DateTimeImmutable();
        }
    }

    public function getHeaderphoto(): ?string
    {
        return $this->headerphoto;
    }

    public function setHeaderphoto(?string $headerphoto): self
    {
        $this->headerphoto = $headerphoto;
        return $this;
    }

    public function getHeaderphotoFile(): ?File
    {
        return $this->headerphotoFile;
    }

    public function setHeaderphotoFile(?File $headerphotoFile): void
    {
        $this->headerphotoFile = $headerphotoFile;
        if ($headerphotoFile) {
            $this->updatedAt = new \DateTimeImmutable();
        }
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): self
    {
        $this->slug = $slug;
        return $this;
    }

    public function __toString(): string
    {
        return (string) $this->label;
    }
}

