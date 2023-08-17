<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\EditProfileFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/user', name: 'user_')]
class UserController extends AbstractController
{

    #[Route('/', name: 'index')]
    public function userProfile(): Response
    {
        return $this->render('user/index.html.twig');
    }

    #[Route('/edit', name: 'edit')]
    public function editUserProfile(Request $request, EntityManagerInterface $em): Response
    {
        $user = $this->getUser();

        $form = $this->createForm(EditProfileFormType::class, $user);
        $form->handleRequest($request);

        if($form->isSubmitted()&&$form->isValid()) {
            $em->persist($user);
            $em->flush();

            $this->addFlash('success','Votre profil a été modifié avec succès.');
            return $this->render('main/index.html.twig');
        }

        return $this->render('user/edit.html.twig', [
            'editProfileForm'=>$form->createView()
        ]);
    }

}
