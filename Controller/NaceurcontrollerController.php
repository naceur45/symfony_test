<?php

namespace App\Controller;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\NACEUR;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\NACEURRepository;
use App\Form\FormType;


final class NaceurcontrollerController extends AbstractController
{
    #[Route('/naceurcontroller', name: 'app_naceurcontroller')]
    public function index(): Response
    {
        return $this->render('naceurcontroller/index.html.twig', [
            'controller_name' => 'NaceurcontrollerController',
        ]);
    }
    #[Route('/add', name: 'app_add')]
    public function add (Request $request,EntityManagerInterface $er){
        $naceur=new naceur();
        $form = $this->createForm(FormType::class, $naceur);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $er->persist($naceur);
            $er->flush();
            return $this->redirectToRoute('app_list');
        }
        return $this->render('naceurcontroller/add.html.twig', [
            'form' => $form,
        ]);
        dd($naceur);
    }
    #[Route('/edit/{id}', name: 'app_edit')]
    public function edit (Request $request,$id,NACEURRepository $r,EntityManagerInterface $er){
        $naceur=$r->find($id);
        $form = $this->createForm(FormType::class, $naceur);

    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
        $er->flush(); 
        return $this->redirectToRoute('app_list');
    }

    return $this->render('naceurcontroller/add.html.twig', [
        'form' => $form->createView(),
        'edit' => true,
    ]);
    }
     #[Route('/delete/{id}', name: 'app_delete')]
     public function delete($id,NACEURRepository $r,EntityManagerInterface $er){
        $naceur=$r->find($id);
        $er->remove($naceur);
        $er->flush();
        return $this->redirectToRoute('app_list');

     }
      #[Route('/list', name: 'app_list')]
      public function list  (NACEURRepository $r){
        $naceurs=$r->findAll();
        return $this->render('naceurcontroller/form.html.twig',[
            'naceurs'=>$naceurs
        ]);

      }
}

