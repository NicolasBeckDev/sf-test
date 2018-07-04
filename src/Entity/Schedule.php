<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use App\Entity\Doctor;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ScheduleRepository")
 */
class Schedule
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $schedule;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Doctor", inversedBy="schedules")
     * @ORM\JoinColumn(nullable=false)
     */
    private $doctor;

    public function getDoctor(): ?Doctor
    {
        return $this->doctor;
    }

    public function setDoctor(Doctor $doctor): self
    {
        $this->doctor = $doctor;

        return $this;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getSchedule(): ?string
    {
        return $this->schedule;
    }

    public function setSchedule(string $schedule): self
    {
        $this->schedule = $schedule;

        return $this;
    }
}
