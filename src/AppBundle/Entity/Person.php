<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
   
 
/**
 * Person
 *
 * @ORM\Table(name="person")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\PersonRepository")
 */
class Person
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="surname", type="string", length=255)
     */
    private $surname;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255)
     */
    private $description;


    /**
    * @ORM\OneToMany(targetEntity="Address", mappedBy="person")
    *
    *
    */
    private $addresses;
    
    /**
    * @ORM\OneToMany(targetEntity="Phone", mappedBy="person")
    *
    *
    */
    private $phones;

    /**
    * @ORM\OneToMany(targetEntity="Email", mappedBy="person")
    *
    *
    */
    private $emails;
    
    
    /**
    * @ORM\ManyToMany(targetEntity="Circle", mappedBy="persons")
    */
    private $circles;

    public function __construct() {
        $this->addresses = new ArrayCollection();
        $this->phones = new ArrayCollection();
        $this->emails = new ArrayCollection();
        $this->circles = new ArrayCollection();
    }
    

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Person
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set surname
     *
     * @param string $surname
     *
     * @return Person
     */
    public function setSurname($surname)
    {
        $this->surname = $surname;

        return $this;
    }

    /**
     * Get surname
     *
     * @return string
     */
    public function getSurname()
    {
        return $this->surname;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Person
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Add address
     *
     * @param \AppBundle\Entity\Address $address
     *
     * @return Person
     */
    public function addAddress(\AppBundle\Entity\Address $address)
    {
        $this->addresses[] = $address;

        return $this;
    }

    /**
     * Remove address
     *
     * @param \AppBundle\Entity\Address $address
     */
    public function removeAddress(\AppBundle\Entity\Address $address)
    {
        $this->addresses->removeElement($address);
    }

    /**
     * Get addresses
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAddresses()
    {
        return $this->addresses;
    }

    /**
     * Add phone
     *
     * @param \AppBundle\Entity\Phone $phone
     *
     * @return Person
     */
    public function addPhone(\AppBundle\Entity\Phone $phone)
    {
        $this->phones[] = $phone;

        return $this;
    }

    /**
     * Remove phone
     *
     * @param \AppBundle\Entity\Phone $phone
     */
    public function removePhone(\AppBundle\Entity\Phone $phone)
    {
        $this->phones->removeElement($phone);
    }

    /**
     * Get phones
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPhones()
    {
        return $this->phones;
    }

    /**
     * Add email
     *
     * @param \AppBundle\Entity\Email $email
     *
     * @return Person
     */
    public function addEmail(\AppBundle\Entity\Email $email)
    {
        $this->emails[] = $email;

        return $this;
    }

    /**
     * Remove email
     *
     * @param \AppBundle\Entity\Email $email
     */
    public function removeEmail(\AppBundle\Entity\Email $email)
    {
        $this->emails->removeElement($email);
    }

    /**
     * Get emails
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getEmails()
    {
        return $this->emails;
    }

    /**
     * Add circle
     *
     * @param \AppBundle\Entity\Circle $circle
     *
     * @return Person
     */
    public function addCircle(\AppBundle\Entity\Circle $circle)
    {
        $this->circles[] = $circle;

        return $this;
    }

    /**
     * Remove circle
     *
     * @param \AppBundle\Entity\Circle $circle
     */
    public function removeCircle(\AppBundle\Entity\Circle $circle)
    {
        $this->circles->removeElement($circle);
    }

    /**
     * Get circles
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCircles()
    {
        return $this->circles;
    }
}
