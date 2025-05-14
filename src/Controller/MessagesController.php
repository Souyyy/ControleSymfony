<?php

namespace App\Controller;

use App\Entity\Messages;
use App\Form\MessagesForm;
use App\Repository\UserRepository;
use App\Repository\MessagesRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;


#[Route('/dashboard/messages')]
final class MessagesController extends AbstractController
{
    #[Route(name: 'app_messages_index', methods: ['GET'])]
    public function index(MessagesRepository $messagesRepository): Response
    {
        $user = $this->getUser();

        if (!$user) {
            throw $this->createAccessDeniedException();
        }

        $messages = $messagesRepository->findBy(['Recoit' => $user]);

        return $this->render('messages/index.html.twig', [
            'messages' => $messages,
        ]);
    }

    #[Route('/new', name: 'app_messages_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $message = new Messages();
        $form = $this->createForm(MessagesForm::class, $message);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $message->setDatetime(new \DateTime());

            // Utilisateur connecté comme émetteur
            $user = $this->getUser();
            if ($user) {
                $message->setEmet($user);
            }

            $entityManager->persist($message);
            $entityManager->flush();

            $this->addFlash('success', 'Message envoyé !');
            return $this->redirectToRoute('app_messages_index');
        }

        return $this->render('messages/new.html.twig', [
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_messages_show', methods: ['GET'])]
    public function show(Messages $message): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        // Ne montrer le message que s'il est reçu ou envoyé par l'utilisateur
        $user = $this->getUser();
        if ($message->getRecoit() !== $user && $message->getEmet() !== $user) {
            throw $this->createAccessDeniedException();
        }

        return $this->render('messages/show.html.twig', [
            'message' => $message,
        ]);
    }


    #[Route('/{id}/edit', name: 'app_messages_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Messages $message, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(MessagesForm::class, $message);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_messages_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('messages/edit.html.twig', [
            'message' => $message,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_messages_delete', methods: ['POST'])]
    public function delete(Request $request, Messages $message, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete' . $message->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($message);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_messages_index', [], Response::HTTP_SEE_OTHER);
    }

    #[Route('/{id}/reply', name: 'app_messages_reply', methods: ['GET', 'POST'])]
    public function reply(Messages $original, Request $request, EntityManagerInterface $em): Response
    {
        $user = $this->getUser();

        if ($original->getRecoit() !== $user && $original->getEmet() !== $user) {
            throw $this->createAccessDeniedException();
        }

        $reply = new Messages();
        $reply->setRepondA($original);
        $reply->setEmet($user);
        $reply->setRecoit($original->getEmet());
        $reply->setTitre("Re: " . $original->getTitre());

        $form = $this->createForm(MessagesForm::class, $reply);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $reply->setDatetime(new \DateTime());
            $em->persist($reply);
            $em->flush();

            $this->addFlash('success', 'Réponse envoyée !');
            return $this->redirectToRoute('app_messages_index');
        }

        return $this->render('messages/reply.html.twig', [
            'form' => $form,
            'original' => $original,
        ]);
    }
}
