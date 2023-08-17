<?php

namespace App\Controller;

use App\Entity\Post;
use App\Form\PostFormType;
use App\Repository\PostRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    #[Route('/', name: 'main')]
    public function index(Request $request, EntityManagerInterface $em, PostRepository $postRepository): Response
    {
        $user = $this->getUser();
        $userPosts = $postRepository->findLatestPostsByUser($user->getId(), 3);
        $latestPosts = $postRepository->findLatestPosts();

        $post = new Post();
        $form = $this->createForm(PostFormType::class, $post);
        $form->handleRequest($request);

        if($form->isSubmitted()&&$form->isValid()) {
            $user = $this->getUser();
            $post->setUser($user);

            $em->persist($post);
            $em->flush();

            $this->addFlash('success','Votre post a été créé avec succès.');
            return $this->redirectToRoute('main');
        }

        return $this->render('main/index.html.twig', [
            'PostForm'=>$form->createView(),
            'userPosts'=>$userPosts,
            'latestPosts'=>$latestPosts
        ]);
    }
}
