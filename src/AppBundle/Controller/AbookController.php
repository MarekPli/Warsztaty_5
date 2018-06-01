<?php

namespace AppBundle\Controller;


use AppBundle\Entity\Person;
use AppBundle\Entity\Address;
use AppBundle\Entity\Phone;
use AppBundle\Entity\Email;
use AppBundle\Entity\Circle;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

class AbookController extends Controller
{
    private function giveName($name) {
        return array('label' => $name . ": " , 
            'attr' => [
                'style' => 'color:#cc6600;background-color:#ffffcc;
                width:250px;margin-left:14px;margin-right:50%;font-size:15px'
            ]);
    }

    private function makeFormPerson($person, $submitMsg) {

        return $this->createFormBuilder($person)
        ->add('name', TextType::class, $this->giveName('Imię'))
        ->add('surname', TextType::class, $this->giveName('Nazwisko'))
        ->add('description', TextType::class, $this->giveName('Opis'))
        ->add('save', SubmitType::class, array('label' => $submitMsg,
            'attr' => ['style' => 'color:green;width:150px;margin:5px 5px;
            font-size:20px;height:40px']
            ))
        ->getForm();
    }

    /**
     * @Route("/", name="abook_list")
     */
    public function listAction(Request $request)
    {
        // $persons2 = $this->getDoctrine()
        // ->getRepository('AppBundle:Person')
        // ->findBy(
        //     ['surname' => 'ASC']
        // );
        // ->findAll();
        
        $em = $this->getDoctrine()->getManager();
        $query = $em->createQuery (
            "SELECT p FROM AppBundle:Person p ORDER BY p.surname ASC");
        $persons = $query->getResult();

        return $this->render('abook/index.html.twig', 
            ['todos' => $persons]);
    }
 

    /**
     * @Route("/create", name="abook_create")
     */
    public function createAction(Request $request)
    {
        
        $person = new Person;
        $form = $this->makeFormPerson($person, 'Utwórz');
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($person);
            $em->flush();
            return $this->redirectToRoute('abook_edit', 
                ['id' => $person->getId()]);
        }

        return $this->render('abook/create.html.twig',
            array('form' => $form->createView()));
    }
 

    /**
     * @Route("/details/{id}", name="abook_details")
     */
    public function detailsAction(Request $request, $id)
    {
        $person = $this->getDoctrine()
            ->getRepository('AppBundle:Person')
            ->find($id);

        // $addresses = $person->getAddresses();

        return $this->render('abook/details.html.twig', 
            ['todo' => $person, 
            'addresses' => $person->getAddresses(),
            'phones' => $person->getPhones(),
            'emails' => $person->getEmails(),
            'circles' => $person->getCircles(),
        ]);
    }

    /**
     * @Route("/edit/{id}", name="abook_edit")
     */
    public function editAction(Request $request, $id)
    {
        $person = $this->getDoctrine()
            ->getRepository('AppBundle:Person')
            ->find($id);

        // $addresses = $person->getAddresses();

        $form = $this->makeFormPerson($person, 'Edytuj');
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($person);
            $em->flush();
            // niech wraca nie zamykając formularza!
            // return $this->redirectToRoute('abook_list');
        }

        return $this->render('abook/edit.html.twig',
            array('form' => $form->createView(),
                'person_id' => $id,
                'addresses' => $person->getAddresses(),
                'phones' => $person->getPhones(),
                'emails' => $person->getEmails(),
                'circles' => $person->getCircles(),
            ));
    }
 
    /**
     * @Route("/delete/{id}", name="abook_delete")
     */
    public function deleteAction($id)
    {
        
        $em = $this->getDoctrine()->getManager();
        $person = $em->getRepository('AppBundle:Person')
            ->find($id);

        $addresses = $person->getAddresses();
        foreach ($addresses as $address) {
            $person->removeAddress($address); 
            $em->remove($address);  
        }

        $phones = $person->getPhones();
        foreach ($phones as $phone) {
            $person->removePhone($phone); 
            $em->remove($phone);  
        }

        $emails = $person->getEmails();
        foreach ($emails as $email) {
            $person->removeEmail($email); 
            $em->remove($email);  
        }

        $circles = $person->getCircles();
        foreach ($circles as $circle) {
            $person->removeEmail($circle); 
            $em->remove($circle);  
        }
        
        $em->remove($person);
        $em->flush();

        return $this->redirectToRoute('abook_list');
    }
}
