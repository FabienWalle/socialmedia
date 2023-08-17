<?php

namespace App\Controller;

use App\Entity\Post;
use App\Form\PostFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PostController extends AbstractController
{
    #[Route('/addpost', name:'addpost')]
    public function addPost(Request $request, EntityManagerInterface $em): Response
    {
        $post = new Post();
        $form = $this->createForm(PostFormType::class, $post);
        $form->handleRequest($request);

        if($form->isSubmitted()&&$form->isValid()) {
            $user = $this->getUser();
            $post->setUser($user);

            $em->persist($post);
            $em->flush();

            $this->addFlash('success','Votre post a été créé avec succès.');
            return $this->render('main/index.html.twig');
        }

        return $this->render('post/index.html.twig', [
            'PostForm'=>$form->createView()
        ]);
    }
}
