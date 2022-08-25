<?php

namespace App\Form;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;

class ClientType extends AbstractType{
    
    public function buildForm(FormBuilderInterface $formBuilderInterface, array $options){

        $formBuilderInterface
            -> add('name', TextType::class, 
            ['label'=> 'Nome do Cliente: '])
            ->add('doc', TextType::class, ['label'=>'documento: '])
            ->add('Salvar', SubmitType::class);

    }
}