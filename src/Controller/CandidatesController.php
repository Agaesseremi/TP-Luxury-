<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Candidates;
use App\Entity\JobCategory;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Security;

class CandidatesController extends AbstractController
{
    #[Route('/candidates', name: 'app_candidates_save')]
    public function save(Request $request, EntityManagerInterface $entityManager, Security $security): Response
    {


        $user = $security->getUser();

        $candidate = $entityManager->getRepository(Candidates::class)->findOneBy(['user' => $user]);

        if (!$candidate) {
            $candidates = new Candidates;
            $data = $request->request->all();
            $jobcategory = $entityManager->getRepository(JobCategory::class)->find($data["job_sector"]);


            $candidates->setFirstname($data["first_name"])
                ->setLastname($data["last_name"])
                ->setCurrentLocation($data["current_location"])
                ->setAddress($data["address"])
                ->setCountry($data["country"])
                ->setNationality($data["nationality"])
                ->setBirthLocation($data["birth_place"])
                ->setExperience($data["experience"])
                ->setShortDescription($data["description"])
                ->setGender($data["gender"])
                ->setUser($user)
                ->setJobCategory($jobcategory);
            // ->setBirthdate($data["birth_date"]);

            $entityManager->persist($candidates);
            $entityManager->flush();

            return $this->redirectToRoute('app_profile');
        } else {
            $candidate = $entityManager->getRepository(Candidates::class)->findOneBy(['user' => $user]);

            $data = $request->request->all();
            $jobcategory = $entityManager->getRepository(JobCategory::class)->find($data["job_sector"]);


            $candidate->setFirstname($data["first_name"])
                ->setLastname($data["last_name"])
                ->setCurrentLocation($data["current_location"])
                ->setAddress($data["address"])
                ->setCountry($data["country"])
                ->setNationality($data["nationality"])
                ->setBirthLocation($data["birth_place"])
                ->setExperience($data["experience"])
                ->setShortDescription($data["description"])
                ->setGender($data["gender"])
                ->setUser($user)
                ->setJobCategory($jobcategory);
            // ->setBirthdate($data["birth_date"]);

            $entityManager->persist($candidate);
            $entityManager->flush();

            return $this->redirectToRoute('app_profile');
        }
    }
}
