<?php

namespace App\Controller;

use App\Entity\Doctor;
use App\Entity\Patient;
use App\Repository\DoctorRepository;
use App\Repository\PatientRepository;
use App\Repository\ScheduleRepository;
use Doctrine\ORM\EntityManagerInterface;
use FOS\RestBundle\View\View;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use FOS\RestBundle\Controller\Annotations as Rest;

class apiController extends Controller
{
    private $encoder;
    private $normalizer;
    private $serializer;
    private $em;
    private $doctorRepository;
    private $patientRepository;
    private $scheduleRepository;

    public function __construct(EntityManagerInterface $em, DoctorRepository $doctorRepository, PatientRepository $patientRepository, ScheduleRepository $scheduleRepository)
    {
        $this->encoder = [new JsonEncoder()];
        $this->normalizer = [new ObjectNormalizer()];
        $this->serializer = new Serializer($this->normalizer, $this->encoder);
        $this->em = $em;
        $this->doctorRepository = $doctorRepository;
        $this->patientRepository = $patientRepository;
        $this->scheduleRepository = $scheduleRepository;
    }

    /**
     * @Rest\Get("/api/doctors", name="doctors")
     * @return \FOS\RestBundle\View\View
     */
    public function getDoctor()
    {
        return View::create($this->doctorRepository->findAll(), Response::HTTP_OK);
    }

    /**
     * @Rest\Get("/api/doctors/{id}", name="doctorByID")
     * @param int $id
     * @return \FOS\RestBundle\View\View
     */
    public function getDoctorById(int $id)
    {
        return View::create($this->doctorRepository->find($id), Response::HTTP_OK);
    }

    /**
     * @Rest\Get("/api/schedules", name="doctorByID")
     * @return \FOS\RestBundle\View\View
     */
    public function getSchedules()
    {
        $schedules = $this->scheduleRepository->findAll();

        $list = [];

        foreach ($schedules as $schedule){
            $list[substr($schedule->getSchedule(), 0, 10)][] = $schedule;
        }

        return View::create($list, Response::HTTP_OK);
    }

    /**
     * @Rest\Get("/api/patient", name="patient")
     * @return \FOS\RestBundle\View\View
     */
    public function getPatient()
    {
        return View::create($this->patientRepository->find(1), Response::HTTP_OK);
    }

    /**
     * @Rest\Post("/api/patient", name="patientPost")
     * @param Request $request
     * @return bool|float|int|string
     */
    public function setPatient(Request $request)
    {
        $patient = $this->patientRepository->find(1);
        $patient->setAppointment($request->get('appointment'));
        $this->em->persist($patient);
        $this->em->flush();
        return View::create($patient, Response::HTTP_OK);
    }

    /**
     * @Rest\Get("/api/videos/{time}", name="video")
     * @param int $time
     * @return \FOS\RestBundle\View\View
     */
    public function getVideo(int $time)
    {
        if ($time < 5 or $time > 15) {
            return View::create(['response' => 'KO'], Response::HTTP_NOT_FOUND);
        }
        switch ($time) {
            case 5 :
                $video = [
                    'code' => 'x6iik1g',
                    'theme' => '',
                    'author' => '',
                    'name' => ''
                ];
                break;
            case 6 :
                $video = [
                    'code' => 'x6l6egf',
                    'theme' => '',
                    'author' => '',
                    'name' => ''
                ];
                break;
            case 7 :
                $video = [
                    'code' => 'x6gzklv',
                    'theme' => '',
                    'author' => '',
                    'name' => ''
                ];
                break;
            case 8 :
                $video = [
                    'code' => 'x9cf40',
                    'theme' => '',
                    'author' => '',
                    'name' => ''
                ];
                break;
            case 9 :
                $video = [
                    'code' => '',
                    'theme' => '',
                    'author' => '',
                    'name' => ''
                ];
                break;
            case 10 :
                $video = [
                    'code' => '',
                    'theme' => '',
                    'author' => '',
                    'name' => ''
                ];
                break;
            case 11 :
                $video = [
                    'code' => '',
                    'theme' => '',
                    'author' => '',
                    'name' => ''
                ];
                break;
            case 12 :
                $video = [
                    'code' => '',
                    'theme' => '',
                    'author' => '',
                    'name' => ''
                ];
                break;
            case 13 :
                $video = [
                    'code' => '',
                    'theme' => '',
                    'author' => '',
                    'name' => ''
                ];
                break;
            case 14 :
                $video = [
                    'code' => '',
                    'theme' => '',
                    'author' => '',
                    'name' => ''
                ];
                break;
            case 15 :
                $video = [
                    'code' => '',
                    'theme' => '',
                    'author' => '',
                    'name' => ''
                ];
                break;
        }
        return View::create($video, Response::HTTP_OK);
    }
}