<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Form\ContactType;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class ContactController extends Controller
{
    /**
     * @Route("/contacts/")
     */
    public function listAction()
    {
        $repo = $this->getDoctrine()->getRepository(Contact::class);
        $contactsList = $repo->findAll();

        return $this->render('contact/list.html.twig', [
            'contacts' => $contactsList,
        ]);
    }

    /**
     * @Route("/contacts/add")
     */
    public function addAction(Request $request)
    {
        $form = $this->createForm(ContactType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $contact = $form->getData();

            $em = $this->getDoctrine()->getManager();
            $em->persist($contact);
            $em->flush();

            $this->addFlash(
                'success',
                "Contact {$contact->getFirstName()} {$contact->getLastName()} has been created successfully"
            );

            return $this->redirectToRoute('app_contact_list');
        }

        return $this->render('contact/add.html.twig', [
            'contactForm' => $form->createView(),
        ]);
    }
    
    /**
     * @Route("/contacts/{id}", requirements={"id": "[1-9][0-9]*"})
     */
    public function showAction($id)
    {
        $repo = $this->getDoctrine()->getRepository('App:Contact');
        $contact = $repo->find($id);

        return $this->render('contact/show.html.twig', [
            'contact' => $contact
        ]);
    }

    /**
     * @Route("/contacts/{id}/update")
     */
    public function updateAction($id, Request $request)
    {
        $repo = $this->getDoctrine()->getRepository('App:Contact');
        $contact = $repo->find($id);

        $form = $this->createForm(ContactType::class);
        $form->setData($contact);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $contact = $form->getData();

            $em = $this->getDoctrine()->getManager();
            $em->persist($contact);
            $em->flush();

            $this->addFlash(
                'success',
                "Contact {$contact->getFirstName()} {$contact->getLastName()} has been modified successfully"
            );

            return $this->redirectToRoute('app_contact_list');
        }

        return $this->render('contact/update.html.twig', [
            'contactForm' => $form->createView(),
        ]);
    }

    /**
     * @Route("/contacts/{id}/delete")
     */
    public function deleteAction($id, Request $request)
    {
        $repo = $this->getDoctrine()->getRepository('App:Contact');
        $contact = $repo->find($id);

        if ($request->get('confirm') === 'yes') {
            $em = $this->getDoctrine()->getManager();
            $em->remove($contact);
            $em->flush();

            $this->addFlash(
                'success',
                "Contact {$contact->getFirstName()} {$contact->getLastName()} has been deleted successfully"
            );
        }

        if ($request->isMethod('POST')) {
            return $this->redirectToRoute('app_contact_list');
        }

        return $this->render('contact/delete.html.twig', [
            'contact' => $contact
        ]);
    }

}
