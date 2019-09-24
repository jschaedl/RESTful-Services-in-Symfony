<?php

declare(strict_types=1);

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

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
     */
    private $title;

    /**
     * @ORM\Column(type="date_immutable")
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

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function getWorkshopDate(): ?\DateTimeImmutable
    {
        return $this->workshopDate;
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

    public function toArray()
    {
        return [
            'id' => $this->getId(),
            'title' => $this->getTitle(),
            'workshop_date' => $this->getWorkshopDate()->format('Y-m-d'),
            'attendees' => array_map(function (Attendee $attendee): array {
                return $attendee->toArray();
            }, $this->getAttendees()),
        ];
    }
}
