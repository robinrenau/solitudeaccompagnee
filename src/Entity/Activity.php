<?php

namespace App\Entity;

use App\Repository\ActivityRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Mapping\Annotation as Gedmo;

#[ORM\Entity(repositoryClass: ActivityRepository::class)]
#[ORM\HasLifecycleCallbacks]
class Activity
{
    #[ORM\Id, ORM\GeneratedValue, ORM\Column(type: 'integer')]
    private ?int $id = null;

    #[ORM\Column(type: 'string', length: 255)]
    private ?string $title = null;

    #[ORM\Column(type: 'text')]
    private ?string $description = null;

    #[ORM\Column(type: 'datetime')]
    private ?\DateTimeInterface $eventdate = null;

    #[ORM\Column(type: 'datetime')]
    private ?\DateTimeInterface $createdAt = null;

    #[ORM\ManyToOne(targetEntity: City::class, inversedBy: 'activities')]
    #[ORM\JoinColumn(nullable: false)]
    private ?City $city = null;

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'activities')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $user = null;

    #[Gedmo\Slug(fields: ['title'])]
    #[ORM\Column(type: 'string', unique: true, length: 255)]
    private ?string $slug = null;

    #[ORM\ManyToOne(targetEntity: Category::class, inversedBy: 'activities')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Category $category = null;

    #[ORM\OneToMany(mappedBy: 'activity', targetEntity: Comment::class, orphanRemoval: true)]
    private Collection $comments;

    #[ORM\Column(type: 'string', length: 255)]
    private ?string $address = null;

    #[ORM\OneToMany(mappedBy: 'activity', targetEntity: ActivityParticipation::class, cascade: ['persist', 'remove'])]
    private Collection $participations;

    #[ORM\Column(type: 'integer')]
    #[Assert\Positive]
    private ?int $maxParticipants = null;

    public function __construct()
    {
        $this->comments = new ArrayCollection();
        $this->participations = new ArrayCollection();
    }

    public function getId(): ?int { return $this->id; }
    public function getTitle(): ?string { return $this->title; }
    public function setTitle(string $title): self { $this->title = $title; return $this; }
    public function getDescription(): ?string { return $this->description; }
    public function setDescription(string $description): self { $this->description = $description; return $this; }
    public function getEventdate(): ?\DateTimeInterface { return $this->eventdate; }
    public function setEventdate(\DateTimeInterface $eventdate): self { $this->eventdate = $eventdate; return $this; }
    public function getCreatedAt(): ?\DateTimeInterface { return $this->createdAt; }
    public function setCreatedAt(\DateTimeInterface $createdAt): self { $this->createdAt = $createdAt; return $this; }
    public function getCity(): ?City { return $this->city; }
    public function setCity(?City $city): self { $this->city = $city; return $this; }
    public function getUser(): ?User { return $this->user; }
    public function setUser(?User $user): self { $this->user = $user; return $this; }
    public function getCategory(): ?Category { return $this->category; }
    public function setCategory(?Category $category): self { $this->category = $category; return $this; }
    public function getAddress(): ?string { return $this->address; }
    public function setAddress(string $address): self { $this->address = $address; return $this; }
    public function getSlug(): ?string { return $this->slug; }
    public function setSlug(string $slug): self { $this->slug = $slug; return $this; }
    public function getMaxParticipants(): ?int { return $this->maxParticipants; }
    public function setMaxParticipants(int $maxParticipants): self { $this->maxParticipants = $maxParticipants; return $this; }
    public function __toString(): string { return (string) $this->title; }

    #[ORM\PrePersist]
    public function prePersist(): void
    {
        $this->createdAt = new \DateTime();
    }

    /** @return Collection|Comment[] */
    public function getComments(): Collection { return $this->comments; }
    public function addComment(Comment $comment): self
    {
        if (!$this->comments->contains($comment)) {
            $this->comments[] = $comment;
            $comment->setActivity($this);
        }
        return $this;
    }
    public function removeComment(Comment $comment): self
    {
        if ($this->comments->removeElement($comment) && $comment->getActivity() === $this) {
            $comment->setActivity(null);
        }
        return $this;
    }

    /** @return Collection|ActivityParticipation[] */
    public function getParticipations(): Collection { return $this->participations; }
    public function addParticipation(ActivityParticipation $participation): self
    {
        if (!$this->participations->contains($participation)) {
            $this->participations[] = $participation;
            $participation->setActivity($this);
        }
        return $this;
    }
    public function removeParticipation(ActivityParticipation $participation): self
    {
        if ($this->participations->removeElement($participation) && $participation->getActivity() === $this) {
            $participation->setActivity(null);
        }
        return $this;
    }

    public function participateByUser(User $user): bool
    {
        foreach ($this->participations as $participation) {
            if ($participation->getUser() === $user) return true;
        }
        return false;
    }
}

