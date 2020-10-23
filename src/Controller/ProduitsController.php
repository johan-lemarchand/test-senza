<?php

namespace App\Controller;

use App\Entity\Produits;
use App\Form\ProduitsType;
use App\Repository\ProduitsRepository;
use App\Services\ImageUploader;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class ProduitsController extends AbstractController
{
    /**
     * @Route("/", name="home")
     * @param ProduitsRepository $produitsRepository
     * @return Response
     */
    public function browse(ProduitsRepository $produitsRepository)
    {
        return $this->render('produits/index.html.twig', [
            'produit' => $produitsRepository->findAll(),
        ]);
    }

    /**
     * @Route("/produit/{id}", name="produit_read", requirements={"id": "\d+"})
     * @param Produits $produits
     * @return Response
     */
    public function read(Produits $produits)
    {
        return $this->render('produits/single.html.twig', [
            'produit' => $produits,
        ]);
    }

    /**
     * @Route("/produit/add", name="produit_ajouter")
     * @param Request $request
     * @param ImageUploader $imageUploader
     * @return RedirectResponse|Response
     */
    public function add(Request $request, ImageUploader $imageUploader )
    {
        $produit = new Produits();

        $form = $this->createForm(ProduitsType::class, $produit);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){

            $file = $form->get('photos')->getData();
            dump($file);

            if ($imageUploader->upload($file)) {
                $produit->setPhotos($file->getClientOriginalName());
            }

            $em = $this->getDoctrine()->getManager();
            $em->persist($produit);
            $em->flush();

            $this->addFlash('message', 'Produit ajouté');
            return $this->redirectToRoute('home');
        }

        return $this->render('produits/add.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
