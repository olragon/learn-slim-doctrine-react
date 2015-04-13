<?php
namespace App;
use Doctrine\ORM\Mapping as ORM;
use JsonSerializable;

/**
 * @MappedSuperclass
 * @HasLifecycleCallbacks()
 */
abstract class Entity implements JsonSerializable
{
    /**
     * @var integer
     *
     * @Column(name="id", type="integer")
     * @Id
     * @GeneratedValue(strategy="AUTO")
     */
    protected $id;
    /**
     * @Column(type="datetime")
     * @var \DateTime
     */
    protected $created;
    /**
     * @Column(type="datetime")
     * @var \DateTime
     */
    protected $updated;
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->setCreated(new \DateTime());
        $this->setUpdated(new \DateTime());
    }
    /**
     * @PreUpdate
     */
    public function setUpdatedValue()
    {
        $this->setUpdated(new \DateTime());
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
     * @param $created
     */
    public function setCreated($created)
    {
        $this->created = $created;
    }
    /**
     * @return \DateTime
     */
    public function getCreated()
    {
        return $this->created;
    }
    /**
     * @param $updated
     */
    public function setUpdated($updated)
    {
        $this->updated = $updated;
    }
    /**
     * @return \DateTime
     */
    public function getUpdated()
    {
        return $this->updated;
    }

    public function jsonSerialize()
    {
        $entity = [];
        $methods = get_class_methods(get_class($this));
        foreach ($methods as $method) {
            if (preg_match('/get([A-Z][a-z]+)/', $method, $match)) {
                $prop = strtolower($match[1]);
                if (isset($this->{$prop})) {
                    $entity[$prop] = $this->{$method}();
                }
                
            }
        }
        return $entity;
    }
}