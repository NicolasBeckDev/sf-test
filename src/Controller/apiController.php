<?php

namespace App\Controller;

use App\Entity\Doctor;
use App\Entity\Patient;
use App\Repository\MedecinRepository;
use App\Repository\PatientRepository;
use Doctrine\ORM\EntityManagerInterface;
use FOS\RestBundle\View\View;
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
    private $medecinRepository;
    private $patientRepository;

    public function __construct(EntityManagerInterface $em, MedecinRepository $medecinRepository, PatientRepository $patientRepository)
    {
        $this->encoder = [new JsonEncoder()];
        $this->normalizer = [new ObjectNormalizer()];
        $this->serializer = new Serializer($this->normalizer, $this->encoder);
        $this->em = $em;
        $this->medecinRepository = $medecinRepository;
        $this->patientRepository = $patientRepository;
    }

    /**
     * @Rest\Get("/api/doctors", name="doctors")
     * @return \FOS\RestBundle\View\View
     */
    public function getDoctor()
    {
        return View::create($this->medecinRepository->findAll(), Response::HTTP_OK);
    }

    /**
     * @Rest\Get("/api/doctor/{id}", name="doctorByID")
     * @param int $id
     * @return \FOS\RestBundle\View\View
     */
    public function getDoctorById(int $id)
    {
        return View::create($this->medecinRepository->find($id), Response::HTTP_OK);
    }

    /**
     * @Rest\Get("/api/patient/{id}", name="patient")
     * @return \FOS\RestBundle\View\View
     */
    public function getClient()
    {
        return View::create($this->patientRepository->find(0), Response::HTTP_OK);
    }

    /**
     * @Route("/api/patient", name="patient")
     * @param \DateTime $date
     * @return bool|float|int|string
     */
    public function setClient(\DateTime $date)
    {
        $patient = $this->patientRepository->find(0);

        $patient->setAppointment($date);

        $this->em->persist($patient);
        $this->em->flush();

        return View::create($patient, Response::HTTP_OK);
    }


    /**
     * @Rest\Get("/api/video/{time}", name="video")
     * @param int $time
     * @return \FOS\RestBundle\View\View
     */
    public function getVideo(int $time)
    {

        if($time < 5 or $time > 15) {
            return View::create(['response' => 'KO'], Response::HTTP_NOT_FOUND);
        }

        switch($time) {
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








//        if($firstDate->format('h') < '6' ){
//            $firstDate->setTime(6, 0, 0,0);
//        }elseif($firstDate->format('h') > '20'){
//            $firstDate
//                ->setDate(intval($firstDate->format('Y')), intval($firstDate->format('m')), intval($firstDate->format('d'))+1)
//                ->setTime(6, 0,0,0);
//        }else{
//            $h = intval($firstDate->format('i'));
//            if ( $h >= 0 && $h < 15) { $firstDate->setTime(intval($firstDate->format('H')), 15);  }
//            elseif ( $h >= 15 && $h < 30 ) { $firstDate->setTime(intval($firstDate->format('H')), 30); }
//            elseif ( $h >= 30 && $h < 45 ) { $firstDate->setTime(intval($firstDate->format('H')), 45); }
//            elseif ( $h >= 45 && $h < 60 ) { $firstDate->setTime(intval($firstDate->format('H'))+1, 0); }
//        }

}
