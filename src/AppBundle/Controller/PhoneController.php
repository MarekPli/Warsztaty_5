<?php

namespace AppBundle\Controller;


use AppBundle\Entity\Person;
use AppBundle\Entity\Phone;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

class PhoneController extends Controller
{
	
    private function makeFormPhone($phone, $submitMsg) {
        return $this->createFormBuilder($phone)
	        ->add('phone_nr', TextType::class)
	        ->add('phone_type', TextType::class)
	        ->add('save', SubmitType::class, array('label' => $submitMsg))
	        ->getForm();
    }


    /**
     * @Route("/createphone/{person_id}", name="abook_phone")
     */
    public function createAction(Request $request, $person_id)
    {
        
        $phone = new Phone;
        $form = $this->makeFormPhone($phone, 'Utwórz');
        $form->handleRequest($request);
        

        if ($form->isSubmitted() && $form->isValid()) {
            
            $person = $this->getDoctrine()
                ->getRepository('AppBundle:Person')
                ->find($person_id);

            $person->addPhone($phone);

            $phone->setPerson($person);
            $em = $this->getDoctrine()->getManager();
            $em->persist($phone);
            $em->flush();
            return $this->redirectToRoute('abook_edit',
                ['id' => $person_id]);
        }

        return $this->render('element/createElement.html.twig',
            array('form' => $form->createView(),
                'id' => $person_id,
                'element' => 'telefon'
            ));
    }

    /**
     * @Route("/editphone/{person_id}/{id}", name="abook_edit_phone")
     */
    public function editAction(Request $request, $person_id, $id) {
        $person = $this->getDoctrine()
                ->getRepository('AppBundle:Person')
                ->find($person_id);

        $phone = $this->getDoctrine()
                ->getRepository('AppBundle:Phone')
                ->find($id);

        $form = $this->makeFormPhone($phone, 'Edytuj');
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            
            // $person->addAddress($address);

            // $address->setPerson($person);
            $em = $this->getDoctrine()->getManager();
            $em->persist($phone);
            $em->flush();
            return $this->redirectToRoute('abook_edit',
                ['id' => $person_id]);
        }
        return $this->render('element/createElement.html.twig',
            array('form' => $form->createView(),
                'id' => $person_id,
                'element' => 'telefon'
            ));
    }

    /**
     * @Route("/deletephone/{person_id}/{id}", name="abook_del_phone")
     */
    public function deleteAction(Request $request, $person_id, $id) {
        $person = $this->getDoctrine()
                ->getRepository('AppBundle:Person')
                ->find($person_id);
        $phone = $this->getDoctrine()
                ->getRepository('AppBundle:Phone')
                ->find($id);
        $em = $this->getDoctrine()->getManager();
        $person->removePhone($phone); 
        $em->remove($phone);  
        $em->flush();
        return $this->redirectToRoute('abook_edit',
            ['id' => $person_id]);
        
    }

}