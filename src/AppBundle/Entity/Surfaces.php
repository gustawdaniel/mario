<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Surfaces
 *
 * @ORM\Table(name="surfaces")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\SurfacesRepository")
 */
class Surfaces
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
     * @ORM\Column(name="Name", type="string", length=255, nullable=true)
     */
    private $name;


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
     * Set surfaces
     *
     * @param string $surfaces
     *
     * @return Surfaces
     */
    public function setName($name)
    {
        $this->$name = $name;

        return $this;
    }

    /**
     * Get surfaces
     *
     * @return string
     */
    public function getName()
    {
        return $this->$name;
    }
}

