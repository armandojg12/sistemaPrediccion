<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;


/**
 * Tema
 *
 * @ORM\Table(name="tema")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\TemaRepository")
 */
class Tema
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
     * @ORM\Column(name="nombre", type="string", length=255, unique=true)
     */
    private $nombre;

    /**
     * @var array
     *
     * @ORM\ManyToMany(targetEntity="Categoria", cascade={"persist", "remove"}, orphanRemoval=true)
     * @ORM\JoinTable(name="temas_categorias",
     *      joinColumns={@ORM\JoinColumn(name="tema_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="categoria_id", referencedColumnName="id", unique=true)}
     *      )
     */
    private $categorias;
    /**
     * @ORM\ManyToMany(targetEntity="Tema", mappedBy="hijos")
     */
    private $padres;
    /**
     * @ORM\ManyToMany(targetEntity="Tema", inversedBy="padres")
     * @ORM\JoinTable(name="temas_hijos",
     *      joinColumns={@ORM\JoinColumn(name="tema_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="tema_hijo_id", referencedColumnName="id")}
     *      )
     */
    private $hijos;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->categorias = new ArrayCollection(array(new Categoria()));
        $this->padres = new ArrayCollection();
        $this->hijos = new ArrayCollection();
    }

    public function __toString()
    {
        return $this->nombre;
    }
    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     * @return Tema
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get nombre
     *
     * @return string 
     */
    public function getNombre()
    {
        return $this->nombre;
    }


    /**
     * Add categorias
     *
     * @param \AppBundle\Entity\Categoria $categorias
     * @return Tema
     */
    public function addCategoria(\AppBundle\Entity\Categoria $categorias)
    {
        $this->categorias[] = $categorias;

        return $this;
    }

    /**
     * Remove categorias
     *
     * @param \AppBundle\Entity\Categoria $categorias
     */
    public function removeCategoria(\AppBundle\Entity\Categoria $categorias)
    {
        $this->categorias->removeElement($categorias);
    }
    /**
     * Remove categorias
     *
     */
    public function removeAllCategorias()
    {
        $this->categorias->clear();
    }
    /**
     * Get categorias
     *
     * @return \ArrayCollection 
     */
    public function getCategorias()
    {
        return $this->categorias;
    }

    /**
     * Add padre
     *
     * @param \AppBundle\Entity\Tema $padre
     * @return Tema
     */
    public function addPadre(\AppBundle\Entity\Tema $padre)
    {
        $this->padres[] = $padre;
        $padre->addHijo($this);

        return $this;
    }

    /**
     * Remove padre
     *
     * @param \AppBundle\Entity\Tema $padre
     */
    public function removePadre(\AppBundle\Entity\Tema $padre)
    {
        $this->padres->removeElement($padre);
    }

    /**
     * Get padre
     *
     * @return \ArrayCollection
     */
    public function getPadres()
    {
        return $this->padres;
    }

    /**
     * Add hijos
     *
     * @param \AppBundle\Entity\Tema $hijo
     * @return Tema
     */
    public function addHijo(\AppBundle\Entity\Tema $hijo)
    {
        $this->hijos[] = $hijo;

        return $this;
    }

    /**
     * Remove hijos
     *
     * @param \AppBundle\Entity\Tema $hijo
     */
    public function removeHijo(\AppBundle\Entity\Tema $hijo)
    {
        $this->hijos->removeElement($hijo);
    }

    /**
     * Get hijos
     *
     * @return \ArrayCollection
     */
    public function getHijos()
    {
        return $this->hijos;
    }
}
