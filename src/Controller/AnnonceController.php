<?php

namespace App\Controller;
          
use App\Entity\Annonce;
use App\Entity\Search;
use App\Form\AnnonceType;
use App\Form\SearchType;
use App\Repository\AnnonceRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;


/**
 * @Route("/annonce")
 */

class AnnonceController extends AbstractController
{

    /////////////////////////// Zone de Test ///////////////////////////////

    /**
     * @Route("/", name="annonce_index", methods={"GET"})
     */
    public function index(AnnonceRepository $annonceRepository, Request $request, PaginatorInterface $paginator): Response
    {
        $search  = new Search;
        $form = $this->createForm(SearchType::class, $search);
        $form->handleRequest($request);
   
        $query = $this->getDoctrine()->getRepository(Annonce::class)->findPaginateArticle($search);
        $requestedPage= $request->query->getInt('page', 1);

            if($requestedPage < 1){
                throw new NotFoundHttpException();
            }

            $em = $this->getDoctrine()->getManager();

        $query = $em->createQuery('SELECT annonce FROM App\Entity\Annonce annonce');

        $pageAnnonces = $paginator->paginate(
            $query,
            $requestedPage,
            3
        );

        return $this->render('annonce/index.html.twig',
            [
                'annonces' => $pageAnnonces,
                'form' => $form->createView()
            ]);
    }
    /////////////////////////////////////////////////////////////////////////////////////////////

    /*public function index(AnnonceRepository $annonceRepository): Response
    {
        return $this->render('annonce/index.html.twig', [
            'annonces' => $annonceRepository->findAll(),
        ]);
    }
    */

    //////////////////////////////// Test pour affichage annonces du user //////////////////////////////////
    /**
     * @Route("/user", name="annonce_user", methods={"GET"})
     * @Security("is_granted('ROLE_USER')")
     */
    public function indexUser(Request $request, PaginatorInterface $paginator)
    {        
        $user = $this->getUser()->getId();

        // dump($user);

        $requestedPage= $request->query->getInt('page', 1);

        // dump($requestedPage);

            if($requestedPage < 1){
                throw new NotFoundHttpException();
            }

        $em = $this->getDoctrine()->getManager(); // création de l'entity manager

        $qb = $em->createQueryBuilder(); // création du QueryBuilder

        $qb->select('a')
            ->from(Annonce::class, 'a')
            ->where('a.proprietaire = :id_user')
            ->setParameter('id_user', $user);

        $query = $qb->getQuery();

        $pageAnnonces = $paginator->paginate(
            $query,
            $requestedPage,
            3
        );

        return $this->render('annonce/index.user.html.twig',
            [
                'annonces' => $pageAnnonces
            ]);
    }
    ////////////////////////////////////////////////////////////////////////////////////////////////////////

    /**
     * @Route("/new", name="annonce_new", methods={"GET","POST"})
     * @Security("is_granted('ROLE_USER')")
     */
    public function new(Request $request): Response
    {
        $user = $this->getUser();
        $annonce = new Annonce();
        $form = $this->createForm(AnnonceType::class, $annonce);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $annonce->setProprietaire($user);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($annonce);
            $entityManager->flush();

            return $this->redirectToRoute('annonce_index');
        }

        return $this->render('annonce/new.html.twig', [
            'annonce' => $annonce,
            'annonceForm' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="annonce_show", methods={"GET"})
     */
    public function show(Annonce $annonce): Response
    {
        return $this->render('annonce/show.html.twig', [
            'annonce' => $annonce,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="annonce_edit", methods={"GET","POST"})
     * @Security("is_granted('ROLE_USER')")
     */
    public function edit(Request $request, Annonce $annonce): Response
    {

        if ($annonce->isProprietaire($this->getUser())) {

        $form = $this->createForm(AnnonceType::class, $annonce);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('annonce_index');
        }

        return $this->render('annonce/edit.html.twig', [
            'annonce' => $annonce,
            'annonceForm' => $form->createView(),
        ]);

        } else {
            return $this->redirectToRoute('annonce_index');
        }
    }

    /**
     * @Route("/{id}", name="annonce_delete", methods={"DELETE"})
     * @Security("is_granted('ROLE_USER')")
     */
    public function delete(Request $request, Annonce $annonce): Response
    {
        if ($annonce->isProprietaire($this->getUser())) {

        if ($this->isCsrfTokenValid('delete'.$annonce->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($annonce);
            $entityManager->flush();
        }

        return $this->redirectToRoute('annonce_index');

        } else {
            return $this->redirectToRoute('annonce_index');
        }
    }

///////////////////////////////////// Fonction Recherche //////////////////////////////////////////////////////////

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

}