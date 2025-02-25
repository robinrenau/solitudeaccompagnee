<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use App\Repository\UserRepository;
use App\Service\FileUploader;
use App\Service\FileUploaderUsers;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/user")
 */
class UserController extends AbstractController
{


    /**
     * @Route("/{id}", name="user_show", methods={"GET"})
     */
    public function show(User $user): Response
    {
        // condition d'accès sur la route /user/{id} :
        if ($this->getUser() != $user) {
            throw $this->createAccessDeniedException("Vous n'avez pas le droit !");
        }
        return $this->render('user/show.html.twig', [
            'user' => $user,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="user_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, User $user, FileUploaderUsers $fileUploaderusers): Response
    {
        // condition d'accès à l'édit d'un profil user :
        if ($this->getUser() != $user) {
            throw $this->createAccessDeniedException("Vous n'avez pas le droit de modifier un profil qui n'est pas le vôtre !");
        }

        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            //Gère l'enregistrement de la photo de profil uploadée par l'utilisateur
            /** @var UploadedFile $pictureFile */
            $pictureFile = $form['profilPicture']->getData();

            if ($pictureFile) {
                $pictureFilename = $fileUploaderusers->upload($pictureFile);
                $user->setProfilPicture($pictureFilename);
            }

            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('user_show', ['id' => $user->getId()]);
        }

        return $this->render('user/edit.html.twig', [
            'user' => $user,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="user_delete", methods={"DELETE"})
     */
    public function delete(Request $request, User $user): Response
    {
        if ($this->isCsrfTokenValid('delete'.$user->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($user);
            $entityManager->flush();
        }

        return $this->redirectToRoute('user_index');
    }
}
