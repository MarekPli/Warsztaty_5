<?php

namespace AppBundle\Controller;


use AppBundle\Entity\Person;
use AppBundle\Entity\Email;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

class EmailController extends Controller
{
    
    private function makeFormEmail($email, $submitMsg) {
        return $this->createFormBuilder($email)
            ->add('emailAddress', TextType::class)
            ->add('emailType', TextType::class)
            ->add('save', SubmitType::class, array('label' => $submitMsg))
            ->getForm();
    }


    /**
     * @Route("/createemail/{person_id}", name="abook_email")
     */
    public function createAction(Request $request, $person_id)
    {
        
        $email = new Email;
        $form = $this->makeFormEmail($email, 'Utwórz');
        $form->handleRequest($request);
        

        if ($form->isSubmitted() && $form->isValid()) {
            
            $person = $this->getDoctrine()
                ->getRepository('AppBundle:Person')
                ->find($person_id);

            $person->addEmail($email);

            $email->setPerson($person);
            $em = $this->getDoctrine()->getManager();
            $em->persist($email);
            $em->flush();
            return $this->redirectToRoute('abook_edit',
                ['id' => $person_id]);
        }

        return $this->render('element/createElement.html.twig',
            array('form' => $form->createView(),
                'id' => $person_id,
                'element' => 'adres mailowy'
            ));
    }

    /**
     * @Route("/editemail/{person_id}/{id}", name="abook_edit_email")
     */
    public function editAction(Request $request, $person_id, $id) {
        $person = $this->getDoctrine()
                ->getRepository('AppBundle:Person')
                ->find($person_id);

        $email = $this->getDoctrine()
                ->getRepository('AppBundle:Email')
                ->find($id);

        $form = $this->makeFormEmail($email, 'Edytuj');
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            
            // $person->addAddress($address);

            // $address->setPerson($person);
            $em = $this->getDoctrine()->getManager();
            $em->persist($email);
            $em->flush();
            return $this->redirectToRoute('abook_edit',
                ['id' => $person_id]);
        }
        return $this->render('element/createElement.html.twig',
            array('form' => $form->createView(),
                'id' => $person_id,
                'element' => 'adres mailowy'
            ));
    }

    /**
     * @Route("/deleteemail/{person_id}/{id}", name="abook_del_email")
     */
    public function deleteAction(Request $request, $person_id, $id) {
        $person = $this->getDoctrine()
                ->getRepository('AppBundle:Person')
                ->find($person_id);
        $email = $this->getDoctrine()
                ->getRepository('AppBundle:Email')
                ->find($id);
        $em = $this->getDoctrine()->getManager();
        $person->removeEmail($email); 
        $em->remove($email);  
        $em->flush();
        return $this->redirectToRoute('abook_edit',
            ['id' => $person_id]);
        
    }

}