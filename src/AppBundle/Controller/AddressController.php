<?php

namespace AppBundle\Controller;


use AppBundle\Entity\Person;
use AppBundle\Entity\Address;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

class AddressController extends Controller
{
	
    private function makeFormAddress($address, $submitMsg) {
        return $this->createFormBuilder($address)
	        ->add('city', TextType::class)
	        ->add('street', TextType::class)
	        ->add('house_nr', TextType::class)
	        ->add('flat_nr', TextType::class)
	        ->add('save', SubmitType::class, array('label' => $submitMsg))
	        ->getForm();
    }


    /**
     * @Route("/createaddress/{person_id}", name="abook_address")
     */
    public function createAction(Request $request, $person_id)
    {
        
        $address = new Address;
        $form = $this->makeFormAddress($address, 'Utwórz');
        $form->handleRequest($request);
        

        if ($form->isSubmitted() && $form->isValid()) {
            
            $person = $this->getDoctrine()
                ->getRepository('AppBundle:Person')
                ->find($person_id);

            $person->addAddress($address);

            $address->setPerson($person);
            $em = $this->getDoctrine()->getManager();
            $em->persist($address);
            $em->flush();
            return $this->redirectToRoute('abook_edit',
                ['id' => $person_id]);
        }

        return $this->render('element/createElement.html.twig',
            array('form' => $form->createView(),
                'id' => $person_id,
                'element' => 'adres',
        ));
    }

    /**
     * @Route("/editaddress/{person_id}/{id}", name="abook_edit_address")
     */
    public function editAction(Request $request, $person_id, $id) {
        $person = $this->getDoctrine()
                ->getRepository('AppBundle:Person')
                ->find($person_id);

        $address = $this->getDoctrine()
                ->getRepository('AppBundle:Address')
                ->find($id);

        $form = $this->makeFormAddress($address, 'Edytuj');
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            
            // $person->addAddress($address);

            // $address->setPerson($person);
            $em = $this->getDoctrine()->getManager();
            $em->persist($address);
            $em->flush();
            return $this->redirectToRoute('abook_edit',
                ['id' => $person_id]);
        }

        return $this->render('element/createElement.html.twig',
            array('form' => $form->createView(),
                'id' => $person_id,
                'element' => 'adres'
            ));
    }

    /**
     * @Route("/deleteaddress/{person_id}/{id}", name="abook_del_address")
     */
    public function deleteAction(Request $request, $person_id, $id) {
        $person = $this->getDoctrine()
                ->getRepository('AppBundle:Person')
                ->find($person_id);
        $address = $this->getDoctrine()
                ->getRepository('AppBundle:Address')
                ->find($id);
        $em = $this->getDoctrine()->getManager();
        $person->removeAddress($address); 
        $em->remove($address);  
        $em->flush();
        return $this->redirectToRoute('abook_edit',
            ['id' => $person_id]);
        
    }

}