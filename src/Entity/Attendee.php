<?php

declare(strict_types=1);

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AttendeeRepository")
 */
class Attendee
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
    private $firstname;

    /**
     * @ORM\Column(type="string", length=255)
     *
     * @Assert\NotBlank
     */
    private $lastname;

    /**
     * @ORM\Column(type="string", length=255)
     *
     * @Assert\NotBlank
     * @Assert\Email
     */
    private $email;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Workshop", inversedBy="attendees")
     */
    private $workshops;

    public function __construct()
    {
        $this->workshops = new ArrayCollection();
    }

    public function updateBy(self $otherAttendee): void
    {
        $this->firstname = $otherAttendee->getFirstname();
        $this->lastname = $otherAttendee->getLastname();
        $this->email = $otherAttendee->getEmail();
    }

    /**
     * Every Attendee can only attend one workshop per day.
     */
    public function canAttend(Workshop $workshop): bool
    {
        foreach ($this->getWorkshops() as $attendeeWorkshop) {
            if ($workshop->getWorkshopDate()->getTimestamp() === $attendeeWorkshop->getWorkshopDate()->getTimestamp()) {
                return false;
            }
        }

        return true;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): self
    {
        $this->lastname = $lastname;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * @return Workshop[]
     */
    public function getWorkshops(): array
    {
        return $this->workshops->toArray();
    }

    public function addWorkshop(Workshop $workshop): self
    {
        if (!$this->workshops->contains($workshop)) {
            $this->workshops[] = $workshop;
        }

        return $this;
    }

    public function removeWorkshop(Workshop $workshop): self
    {
        if ($this->workshops->contains($workshop)) {
            $this->workshops->removeElement($workshop);
        }

        return $this;
    }
}
