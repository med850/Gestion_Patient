<?php

namespace App\Controller;

use App\Entity\Patients;
use App\Form\AddPatientType;
use App\Form\EditPatientType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class PatientController extends AbstractController
{
    /**
     * @Route("/list_patient", name="list_patient")
     */
    public function index(): Response
    {
        $patients = $this->getDoctrine()->getRepository(Patients::class)->findAll();

        return $this->render('patient/index.html.twig', [
            "patients" => $patients,
        ]);
    }


 /**
     * @Route("/add_patient", name="add_patient")
     */
public function addPatient(Request $request): Response
{
    $patient = new Patients();
    $form = $this->createForm(AddPatientType::class, $patient);
    $form->handleRequest($request);

    if($form->isSubmitted() && $form->isValid())
    {
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($patient);
        $entityManager->flush();

        return $this->redirectToRoute('list_patient');
        }
  

    return $this->render('patient/addPatient.html.twig',
    
    ['form'=>$form->createView()]);
   

}
  

          /**
     * @Route("/modifier_patient/{id}", name="modify_patient")
     */
    public function editUser( Request $request, int $id){

     

        $entityManager = $this->getDoctrine()->getManager();

        $patient = $entityManager->getRepository(Patients::class)->find($id);
        $form = $this->createForm(EditPatientType::class, $patient);
        $form->handleRequest($request);
    
       // dd($user);
       if($form->isSubmitted() && $form->isValid())
        {   
            $entityManager->persist($patient);
            $entityManager->flush();
         

            return $this -> redirectToRoute("list_patient");
        }
    
        return $this->render('patient/editPatient.html.twig', [
            'form'=>$form->createView()
        ]);

    }







/**
 * @Route("/delete_patient/{id}", name="delete_patient")
 */
public function deleteProduct(int $id): Response
{
    $entityManager = $this->getDoctrine()->getManager();
    $patient = $entityManager->getRepository(Patients::class)->find($id);
    $entityManager->remove($patient);
    $entityManager->flush();

    return $this->redirectToRoute("list_patient");
}




}





