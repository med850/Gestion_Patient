<?php

namespace App\Controller;

use App\Entity\Seances;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class SeanceController extends AbstractController
{
    /**
     * @Route("/list_seance", name="list_seance")
     */
    public function index(): Response
    {
        $seances = $this->getDoctrine()->getRepository(Seances::class)->findAll();

        return $this->render('seance/index.html.twig', [
            "seances" => $seances,
        ]);
    }

      /**
 * @Route("/add_seance", name="add_seance")
 */
public function addProduct(Request $request): Response
{
    $seance = new Seances();
    $form = $this->createForm(AddPatientType::class, $seance);
    $form->handleRequest($request);

    if($form->isSubmitted() && $form->isValid())
    {
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($seance);
        $entityManager->flush();

        return $this->redirectToRoute('list_seance');
        }
  

    return $this->render('seance/addSeance.html.twig',
    
    ['form'=>$form->createView()]);
   

}




}
