<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Phone
 *
 * @ORM\Table(name="phone")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\PhoneRepository")
 */
class Phone
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
     * @ORM\Column(name="phone_nr", type="string", length=30)
     */
    private $phoneNr;

    /**
     * @var string
     *
     * @ORM\Column(name="phone_type", type="string", length=30)
     */
    private $phoneType;


    /**
    * @ORM\ManyToOne(targetEntity="Person", inversedBy="phones")
    * @ORM\JoinColumn(name="person_id", referencedColumnName="id") */
    private $person;


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
     * Set phoneNr
     *
     * @param string $phoneNr
     *
     * @return Phone
     */
    public function setPhoneNr($phoneNr)
    {
        $this->phoneNr = $phoneNr;

        return $this;
    }

    /**
     * Get phoneNr
     *
     * @return string
     */
    public function getPhoneNr()
    {
        return $this->phoneNr;
    }

    /**
     * Set phoneType
     *
     * @param string $phoneType
     *
     * @return Phone
     */
    public function setPhoneType($phoneType)
    {
        $this->phoneType = $phoneType;

        return $this;
    }

    /**
     * Get phoneType
     *
     * @return string
     */
    public function getPhoneType()
    {
        return $this->phoneType;
    }

    /**
     * Set person
     *
     * @param \AppBundle\Entity\Person $person
     *
     * @return Phone
     */
    public function setPerson(\AppBundle\Entity\Person $person = null)
    {
        $this->person = $person;

        return $this;
    }

    /**
     * Get person
     *
     * @return \AppBundle\Entity\Person
     */
    public function getPerson()
    {
        return $this->person;
    }
}
