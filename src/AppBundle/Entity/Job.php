<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="job")
 */
class Job {

    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    
    /**
     * @ORM\Column(type="string", length=200)
     */
    private $name;
    
    /** @ORM\Column(type="text") */
    private $description;
    
    /** @ORM\Column(type="datetime") */
    private $datetime;
    
    /** @ORM\Column(type="text") */
    private $location;
    
    /** @ORM\Column(type="text") */
    private $experience;
    
    /** @ORM\Column(type="text") */
    private $salary;

    function getId() {
        return $this->id;
    }

    function getName() {
        return $this->name;
    }

    function getDescription() {
        return $this->description;
    }

    function getDatetime() {
        return $this->datetime;
    }

    function getLocation() {
        return $this->location;
    }

    function getExperience() {
        return $this->experience;
    }

    function getSalary() {
        return $this->salary;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setName($name) {
        $this->name = $name;
    }

    function setDescription($description) {
        $this->description = $description;
    }

    function setDatetime($datetime) {
        $this->datetime = $datetime;
    }

    function setLocation($location) {
        $this->location = $location;
    }

    function setExperience($experience) {
        $this->experience = $experience;
    }

    function setSalary($salary) {
        $this->salary = $salary;
    }

}
