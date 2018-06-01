<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Address
 *
 * @ORM\Table(name="address")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\AddressRepository")
 */
class Address
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
     * @ORM\Column(name="city", type="string", length=255)
     */
    private $city;

    /**
     * @var string
     *
     * @ORM\Column(name="street", type="string", length=255)
     */
    private $street;

    /**
     * @var string
     *
     * @ORM\Column(name="house_nr", type="string", length=30)
     */
    private $houseNr;

    /**
     * @var string
     *
     * @ORM\Column(name="flat_nr", type="string", length=30)
     */
    private $flatNr;

    /**
    * @ORM\ManyToOne(targetEntity="Person", inversedBy="addresses")
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
     * Set city
     *
     * @param string $city
     *
     * @return Address
     */
    public function setCity($city)
    {
        $this->city = $city;

        return $this;
    }

    /**
     * Get city
     *
     * @return string
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * Set street
     *
     * @param string $street
     *
     * @return Address
     */
    public function setStreet($street)
    {
        $this->street = $street;

        return $this;
    }

    /**
     * Get street
     *
     * @return string
     */
    public function getStreet()
    {
        return $this->street;
    }

    /**
     * Set houseNr
     *
     * @param string $houseNr
     *
     * @return Address
     */
    public function setHouseNr($houseNr)
    {
        $this->houseNr = $houseNr;

        return $this;
    }

    /**
     * Get houseNr
     *
     * @return string
     */
    public function getHouseNr()
    {
        return $this->houseNr;
    }

    /**
     * Set flatNr
     *
     * @param string $flatNr
     *
     * @return Address
     */
    public function setFlatNr($flatNr)
    {
        $this->flatNr = $flatNr;

        return $this;
    }

    /**
     * Get flatNr
     *
     * @return string
     */
    public function getFlatNr()
    {
        return $this->flatNr;
    }


    /**
     * Set person
     *
     * @param \AppBundle\Entity\Person $person
     *
     * @return Address
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
