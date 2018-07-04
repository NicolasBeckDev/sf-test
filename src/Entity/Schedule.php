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
     * @ORM\Column(type="datetime", length=255)
     */
    private $schedule;

    /**
     * Many Schedules have Many Doctors.
     * @ORM\ManyToMany(targetEntity="Doctor", mappedBy="schedules")
     */
    private $doctors;

    public function __construct() {
        $this->doctors = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function getId()
    {
        return $this->id;
    }

    public function getSchedule()
    {
        return $this->schedule->format('Y-m-d H:i:s');
    }

    public function setSchedule(\DateTime $schedule): self
    {
        $this->schedule = $schedule;

        return $this;
    }


    public function getDoctors(): Collection
    {
        return $this->doctors;
    }

    public function addDoctor(Doctor $doctor): self
    {
        if (!$this->doctors->contains($doctor)) {
            $this->doctors[] = $doctor;
            $doctor->addSchedule($this);
        }

        return $this;
    }

    public function removeDoctor(Doctor $doctor): self
    {
        if ($this->doctors->contains($doctor)) {
            $this->doctors->removeElement($doctor);
            $doctor->removeSchedule($this);
        }

        return $this;
    }
}
