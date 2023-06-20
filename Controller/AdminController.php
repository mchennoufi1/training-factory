<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Training;
use App\Form\UserType;
use App\Form\TrainingType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractController
{
    /**
     * @Route("/admin", name="app_admin")
     */
    public function index(): Response
    {
        $users = $this->getDoctrine()->getRepository(User::class)->findAll();

        return $this->render('admin/index.html.twig', [
            'controller_name' => 'AdminController',
            'users' => $users,
        ]);
    }

    /**
     * @Route("/admin/user/{id}/edit", name="admin_user_edit")
     */
    public function editUser(Request $request, User $user): Response
    {
        $form = $this->createForm(UserType::class, $user);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->flush();

            return $this->redirectToRoute('app_admin');
        }

        return $this->render('admin/edit.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/admin/user/{id}/delete", name="admin_user_delete")
     */
    public function deleteUser(User $user): Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($user);
        $entityManager->flush();

        return $this->redirectToRoute('app_admin');
    }

    /**
     * @Route("/admin/instructeurs", name="admin_instructeurs")
     */
    public function manageInstructeurs(): Response
    {

        return $this->render('admin/add.html.twig');
    }

    /**
     * @Route("/admin/instructeur/add", name="admin_instructeur_add")
     */
    public function addInstructeur(Request $request): Response
    {
        $user = new User();
        $form = $this->createForm(UserType::class, $user);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            
            return $this->redirectToRoute('app_admin');
        }

        return $this->render('admin/add.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/admin/trainings", name="admin_trainings")
     */
    public function manageTrainings(): Response
    {
        $trainings = $this->getDoctrine()->getRepository(Training::class)->findAll();

        return $this->render('admin/training.html.twig', [
            'trainings' => $trainings,
        ]);
    }

    /**
 * @Route("/admin/training/add", name="admin_training_add")
 */
public function addTraining(Request $request): Response
{
    $training = new Training();
    $form = $this->createForm(TrainingType::class, $training);

    $form->handleRequest($request);
    if ($form->isSubmitted() && $form->isValid()) {
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($training);
        $entityManager->flush();

        return $this->redirectToRoute('admin_trainings');
    }

    return $this->render('admin/training.html.twig', [
        'trainings' => null, 
        'form' => $form->createView(),
    ]);
}

    /**
 * @Route("/admin/training/{id}/edit", name="admin_training_edit")
 */
public function editTraining(Request $request, Training $training): Response
{
    $form = $this->createForm(TrainingType::class, $training);

    $form->handleRequest($request);
    if ($form->isSubmitted() && $form->isValid()) {
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->flush();

        return $this->redirectToRoute('admin_trainings');
    }

    return $this->render('admin/edit_training.html.twig', [
        'form' => $form->createView(),
    ]);
}
/**
 * @Route("/admin/training/{id}/delete", name="admin_training_delete")
 */
public function deleteTraining(Training $training): Response
{
    $entityManager = $this->getDoctrine()->getManager();
    $entityManager->remove($training);
    $entityManager->flush();

    return $this->redirectToRoute('admin_trainings');
}
}
