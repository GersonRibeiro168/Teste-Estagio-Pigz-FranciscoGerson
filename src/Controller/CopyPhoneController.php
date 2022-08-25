<?php

namespace App\Controller;

use App\Entity\Phone as EntityPhone;
use App\Form\PhoneType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;


class CopyPhoneController extends AbstractController
{

    /**
     * @Route("/Phone/adicionar", name="phone_adicionar")
     */
    public function adicionar(Request $request, EntityManagerInterface $emi): Response
    {
        $msg = "";
        $phone = new EntityPhone();

        $form = $this->createForm(PhoneType::class, $phone->getId());
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            //$emi é um objeto que vai auxiliar a execuçao de açoes no BD
            $emi->persist($phone); // salvar a persistencia em nivel de memoria
            $emi->flush(); // executa em definitivo no banco de dados
            $msg = "Cliente cadastrado";
        }

        $data['titulo'] = 'Adicionar novo número';
        $data['form'] = $form;
        $data['msg'] = $msg;

        return $this->renderForm('Phone/form.html.twig', $data);
    }
}
