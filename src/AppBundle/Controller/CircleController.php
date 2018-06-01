<?php

namespace AppBundle\Controller;


use AppBundle\Entity\Person;
use AppBundle\Entity\Circle;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

class CircleController extends Controller
{
    private function makeForm($array, $submitMsg) {
        return $this->createFormBuilder($array)
	        ->add('circle_name', TextType::class)
	        ->add('save', SubmitType::class, array('label' => $submitMsg))
	        ->getForm();
    }


    /**
     * @Route("/createcircle/{person_id}", name="abook_circle")
     */
    public function createAction(Request $request, $person_id)
    {
        
        $element = new Circle;
        $form = $this->makeForm($element, 'Utwórz');
        $form->handleRequest($request);
        

        if ($form->isSubmitted() && $form->isValid()) {
            
            $person = $this->getDoctrine()
                ->getRepository('AppBundle:Person')
                ->find($person_id);

            $person->addCircle($element);

            $element->addPerson($person);

            $em = $this->getDoctrine()->getManager();
            $em->persist($element);
            $em->flush();
            return $this->redirectToRoute('abook_edit',
                ['id' => $person_id]);
        }

        return $this->render('element/createElement.html.twig',
            array('form' => $form->createView(),
                'id' => $person_id,
                'element' => 'grupę'
            ));
    }

    /**
     * @Route("/editcircle/{person_id}/{id}", name="abook_edit_circle")
     */
    public function editAction(Request $request, $person_id, $id) {
        $person = $this->getDoctrine()
                ->getRepository('AppBundle:Person')
                ->find($person_id);

        $element = $this->getDoctrine()
                ->getRepository('AppBundle:Circle')
                ->find($id);

        $form = $this->makeForm($element, 'Edytuj');
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            
            // $person->addAddress($address);

            // $address->setPerson($person);
            $em = $this->getDoctrine()->getManager();
            $em->persist($element);
            $em->flush();
            return $this->redirectToRoute('abook_edit',
                ['id' => $person_id]);
        }
        return $this->render('element/createElement.html.twig',
            array('form' => $form->createView(),
                'id' => $person_id,
                'element' => 'grupę'
            ));
    }

    /**
     * @Route("/deletecircle/{person_id}/{id}", name="abook_del_circle")
     */
    public function deleteAction(Request $request, $person_id, $id) {
        $person = $this->getDoctrine()
                ->getRepository('AppBundle:Person')
                ->find($person_id);
        $element = $this->getDoctrine()
                ->getRepository('AppBundle:Circle')
                ->find($id);
        $em = $this->getDoctrine()->getManager();
        $person->removeCircle($element); 
        $em->remove($element);  
        $em->flush();
        return $this->redirectToRoute('abook_edit',
            ['id' => $person_id]);
        
    }

}