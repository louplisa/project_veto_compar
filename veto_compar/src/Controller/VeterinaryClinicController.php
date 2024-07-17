<?php

namespace App\Controller;

use App\Entity\VeterinaryClinic;
use App\Form\VeterinaryClinicType;
use App\Repository\VeterinaryClinicRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/veterinary/clinic')]
class VeterinaryClinicController extends AbstractController
{
    #[Route('/', name: 'app_veterinary_clinic_index', methods: ['GET'])]
    public function index(VeterinaryClinicRepository $veterinaryClinicRepository): Response
    {
        return $this->render('veterinary_clinic/index.html.twig', [
            'veterinary_clinics' => $veterinaryClinicRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_veterinary_clinic_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $veterinaryClinic = new VeterinaryClinic();
        $form = $this->createForm(VeterinaryClinicType::class, $veterinaryClinic);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($veterinaryClinic);
            $entityManager->flush();

            return $this->redirectToRoute('app_veterinary_clinic_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('veterinary_clinic/new.html.twig', [
            'veterinary_clinic' => $veterinaryClinic,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_veterinary_clinic_show', methods: ['GET'])]
    public function show(VeterinaryClinic $veterinaryClinic): Response
    {
        return $this->render('veterinary_clinic/show.html.twig', [
            'veterinary_clinic' => $veterinaryClinic,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_veterinary_clinic_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, VeterinaryClinic $veterinaryClinic, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(VeterinaryClinicType::class, $veterinaryClinic);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_veterinary_clinic_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('veterinary_clinic/edit.html.twig', [
            'veterinary_clinic' => $veterinaryClinic,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_veterinary_clinic_delete', methods: ['POST'])]
    public function delete(Request $request, VeterinaryClinic $veterinaryClinic, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$veterinaryClinic->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($veterinaryClinic);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_veterinary_clinic_index', [], Response::HTTP_SEE_OTHER);
    }
}
