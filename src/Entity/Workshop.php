<?php

declare(strict_types=1);

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\WorkshopRepository")
 */
class Workshop
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     *
     * @Assert\NotBlank
     */
    private $title;

    /**
     * @ORM\Column(type="date_immutable")
     *
     * @Assert\NotBlank
     */
    private $workshopDate;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Attendee", mappedBy="workshops")
     */
    private $attendees;

    public function __construct()
    {
        $this->attendees = new ArrayCollection();
    }

    public function updateBy(self $workshop): void
    {
        $this->title = $workshop->getTitle();
        $this->workshopDate = $workshop->getWorkshopDate();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getWorkshopDate(): ?\DateTimeImmutable
    {
        return $this->workshopDate;
    }

    public function setWorkshopDate(\DateTimeImmutable $workshopDate): self
    {
        $this->workshopDate = $workshopDate;

        return $this;
    }

    /**
     * @return Attendee[]
     */
    public function getAttendees(): array
    {
        return $this->attendees->toArray();
    }

    public function addAttendee(Attendee $attendee): self
    {
        if (!$this->attendees->contains($attendee)) {
            $this->attendees->add($attendee);
            $attendee->addWorkshop($this);
        }

        return $this;
    }

    public function removeAttendee(Attendee $attendee): self
    {
        if ($this->attendees->contains($attendee)) {
            $this->attendees->removeElement($attendee);
            $attendee->removeWorkshop($this);
        }

        return $this;
    }
}
