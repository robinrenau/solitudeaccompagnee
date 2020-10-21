<?php

namespace App\Controller;

use App\Entity\Activity;
use App\Entity\ActivityParticipation;
use App\Form\ActivitySearchType;
use App\Form\ActivityType;
use App\Repository\ActivityParticipationRepository;
use App\Repository\ActivityRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/activity")
 */
class ActivityController extends AbstractController
{
    /**
     * @Route("/", name="activity_index", methods={"GET","POST"})
     */
    public function index(Request $request, ActivityRepository $repo, PaginatorInterface $paginator): Response
    {

        $searchForm = $this->createForm(ActivitySearchType::class);
        $searchForm->handleRequest($request);

        $donnees = $repo->findBy([], ['eventdate' => 'asc']);

        // Méthode findBy qui permet de récupérer les données avec des critères de filtre et de tri

        if ($searchForm->isSubmitted() && $searchForm->isValid()) {


            $title = $searchForm->getData()->getTitle();
            $donnees = $repo->search($title);
            //$request->request->get('search', $title);
            if ($donnees == null) {
                $this->addFlash('erreur', 'Aucune activité contenant ce mot clé dans le titre n\'a été trouvé, essayez en un autre.');

            }
        }

        $activities = $paginator->paginate(
            $donnees, // Requête contenant les données à paginer (ici nos activités)
            $request->query->getInt('page', 1), // Numéro de la page en cours, passé dans l'URL, 1 si aucune page
            6 // Nombre de résultats par page
        );


        return $this->render('activity/index.html.twig', [
            'activities' => $activities,
            'searchForm' => $searchForm->createView()
        ]);
    }


    /**
     * @Route("/new", name="activity_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $activity = new Activity();
        $form = $this->createForm(ActivityType::class, $activity);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $activity->setUser($this->getUser());
            $entityManager->persist($activity);
            $entityManager->flush();

            return $this->redirectToRoute('activity_index');
        }

        return $this->render('activity/new.html.twig', [
            'activity' => $activity,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{slug}", name="activity_show", methods={"GET"})
     */
    public function show(Activity $activity): Response
    {
        return $this->render('activity/show.html.twig', [
            'activity' => $activity,
        ]);
    }

    /**
     * @Route("/{id}/participation", name="activity_participation")
     */
    public function participation(Activity $activity, ActivityParticipationRepository $participationRepo): Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        $user = $this->getUser();

        if (!$user) return $this->json([
            'code' => 403,
            'message' => "Unauthorized"

        ], 403);
        if ($activity->participateByUser($user)) {
            $participation = $participationRepo->findOneBy([
                'activity' => $activity,
                'user' => $user

            ]);
            $entityManager->remove($participation);
            $entityManager->flush();

            return $this->json([
                'code' => 200,
                'message' => 'Participation annulée',
                'participations' => $participationRepo->count(['activity' => $activity])
            ], 200);

        }
        $participation = new ActivityParticipation();
        $participation->setActivity($activity)
            ->setUser($user);
        $entityManager->persist($participation);
        $entityManager->flush();

        return $this->json([
            'code' => 200,
            'message' => "Participation bien prise en compte",
            "participations" => $participationRepo->count(['activity' => $activity])
        ], 200);

    }

    /**
     * @Route("/{id}/edit", name="activity_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Activity $activity): Response
    {
        if ($this->getUser() != $activity->getUser()) {
            throw $this->createAccessDeniedException("Vous n'avez pas le droit de modifier cette activité !");
        }
        $form = $this->createForm(ActivityType::class, $activity);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('user_show', ['id' => $activity->getUser()->getId()]);
        }

        return $this->render('activity/edit.html.twig', [
            'activity' => $activity,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="activity_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Activity $activity): Response
    {

        if ($this->isCsrfTokenValid('delete' . $activity->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($activity);
            $entityManager->flush();
        }

        return $this->redirectToRoute('user_show', ['id' => $activity->getUser()->getId()]);
    }


}
