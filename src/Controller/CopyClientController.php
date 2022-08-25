<?php

namespace App\Controller;

use App\Entity\Client as EntityClient;
use App\Form\ClientType;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class CopyClientController extends AbstractController
{

    private $input;


    /**
     *@Route("/clients")
     */
    public function indexAction(ManagerRegistry $doctrine)
    {

        $client = $doctrine->getRepository('App\Entity\Client')->findAll();

        $client = $this->input::get('jms_serializer')->serialize($client, 'json');

        return new JsonResponse($client);
    }

    /**
     *@Route("/client/{id}")
     */
    public function getAction(EntityClient $id, ManagerRegistry $doctrine)
    {
        $client = $doctrine->getManager()->getRepository('App\Entity\Client');
        $client->find($id);
        $client->serialize($id, 'json');
        //$client = $this->input::get('jms_serializer')->serialize($id, 'json');

        return new JsonResponse($client);
    }


    /**
     * @Route("/Client/adicionar", name="client_adicionar")
     */
    public function adicionar(Request $request, EntityManagerInterface $emi)
    {

        $msg = "";
        $client = new EntityClient();

        $form = $this->createForm(ClientType::class, $client);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            //$emi é um objeto que vai auxiliar a execuçao de açoes no BD
            $emi->persist($client); // salvar a persistencia em nivel de memoria
            $emi->flush(); // executa em definitivo no banco de dados
            $msg = "Cliente cadastrado";
        }


        $data['titulo'] = 'Adicionar novo cliente';
        $data['form'] = $form;
        $data['msg'] = $msg;

        return $this->renderForm('Client/form.html.twig', $data);
    }
}
