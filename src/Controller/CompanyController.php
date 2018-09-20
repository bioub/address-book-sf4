<?php

namespace App\Controller;

use App\Entity\Company;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

class CompanyController extends Controller
{
    /**
     * @Route("/company/")
     */
    public function listAction()
    {
        $repo = $this->getDoctrine()->getRepository(Company::class);
        $companies = $repo->findAll();

        return $this->render('company/list.html.twig', [
            'companies' => $companies,
        ]);
    }

    /**
     * @Route("/company/{id}")
     */
    public function showAction($id)
    {
        $repo = $this->getDoctrine()->getRepository(Company::class);
        $company = $repo->find($id);

        return $this->render('company/show.html.twig', [
            'company' => $company
        ]);
    }

}
