<?php

namespace App\Controller;

use App\Entity\Soins;
use App\Form\AddSoinType;
use App\Form\EditSoinType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class SoinController extends AbstractController
{
      /**
     * @Route("/list_soin", name="list_soin")
     */
    public function index(): Response
    {
        $soins = $this->getDoctrine()->getRepository(Soins::class)->findAll();

        return $this->render('soin/index.html.twig', [
            "soins" => $soins,
        ]);
    }



        /**
 * @Route("/add_soin", name="add_patient")
 */
public function addSoin(Request $request): Response
{
    $soin = new Soins();
    $form = $this->createForm(AddSoinType::class, $soin);
    $form->handleRequest($request);

    if($form->isSubmitted() && $form->isValid())
    {
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($soin);
        $entityManager->flush();

        return $this->redirectToRoute('list_soin');
        }
  

    return $this->render('soin/addSoin.html.twig',
    
    ['form'=>$form->createView()]);
   

}
  




              /**
     * @Route("/modifier_soin/{id}", name="modify_soin")
     */
    public function editUser( Request $request, int $id){

     

        $entityManager = $this->getDoctrine()->getManager();

        $soin = $entityManager->getRepository(Soins::class)->find($id);
        $form = $this->createForm(EditSoinType::class, $soin);
        $form->handleRequest($request);
    
       // dd($user);
       if($form->isSubmitted() && $form->isValid())
        {   
            $entityManager->persist($soin);
            $entityManager->flush();
         

            return $this -> redirectToRoute("list_soin");
        }
    
        return $this->render('soin/editSoin.html.twig', [
            'form'=>$form->createView()
        ]);

    }






    /**
 * @Route("/delete_soin/{id}", name="delete_soin")
 */
public function deleteProduct(int $id): Response
{
    $entityManager = $this->getDoctrine()->getManager();
    $patient = $entityManager->getRepository(Soins::class)->find($id);
    $entityManager->remove($patient);
    $entityManager->flush();

    return $this->redirectToRoute("list_soin");
}






}
