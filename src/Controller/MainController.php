<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Type;
use App\Form\TypeForm;


class MainController extends AbstractController
{
    public function index(Request $request): Response
    {
        $type = new Type();
        $form = $this->createForm(TypeForm::class, $type);
        $form->handleRequest($request);
        $response = "";

        // get data from form
        if ($form->isSubmitted() && $form->isValid()) {
            $type = $form->getData();
        }

        return $this->renderForm('main/index.html.twig', [
            'form' => $form,
            'typeOfNumber' => $type->getTypeOfNumber(),
            'number' => $type->getNumber(),
        ]);
    }
}
