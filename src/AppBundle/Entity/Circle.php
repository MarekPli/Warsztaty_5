<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;


/**
 * Circle
 *
 * @ORM\Table(name="circle")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\CircleRepository")
 */
class Circle
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
     * @ORM\Column(name="circle_name", type="string", length=40)
     */
    private $circleName;


    /**
    * @ORM\ManyToMany(targetEntity="Person", inversedBy="circles") 
    * @ORM\JoinTable(name="persons_circles")
    */
    private $persons;

    public function __construct() {
        $this->persons = new ArrayCollection();
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
     * Set circleName
     *
     * @param string $circleName
     *
     * @return Circle
     */
    public function setCircleName($circleName)
    {
        $this->circleName = $circleName;

        return $this;
    }

    /**
     * Get circleName
     *
     * @return string
     */
    public function getCircleName()
    {
        return $this->circleName;
    }

    /**
     * Add person
     *
     * @param \AppBundle\Entity\Person $person
     *
     * @return Circle
     */
    public function addPerson(\AppBundle\Entity\Person $person)
    {
        $this->persons[] = $person;

        return $this;
    }

    /**
     * Remove person
     *
     * @param \AppBundle\Entity\Person $person
     */
    public function removePerson(\AppBundle\Entity\Person $person)
    {
        $this->persons->removeElement($person);
    }

    /**
     * Get persons
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPersons()
    {
        return $this->persons;
    }
}
