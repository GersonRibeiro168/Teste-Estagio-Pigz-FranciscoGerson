<?php

namespace App\Form;

use App\Entity\Client;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class PhoneType extends AbstractType
{


    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder
            ->add('number', TextType::class, ['label' => 'Numero do Cliente: '])
            ->add('idClient_fk', EntityType::class, [
                'label'=>'Código do cliente','class' => Client::class,
                'choice_label' => 'id'
            ])
            ->add('Salvar', SubmitType::class);
    }
}
