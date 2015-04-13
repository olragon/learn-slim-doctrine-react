<?php
namespace App\Entity;
use App\Entity;
use Doctrine\ORM\Mapping;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @Entity
 * @Table(name="user")
 */
class User extends Entity
{

    public function __construct()
    {
        parent::__construct();
        $this->items = new ArrayCollection();
        $this->comments = new ArrayCollection();
    }

    /**
     * @Column(type="string", length=255)
     * @var string
     */
    protected $email;

    /**
     * @Column(type="string", length=32)
     * @var string
     */
    protected $password;

    /**
     * @OneToMany(targetEntity="Item", mappedBy="user")
     */
    public $items;

    /**
     * @OneToMany(targetEntity="Comment", mappedBy="user")
     */
    public $comments;
    
    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password = md5($password);
    }
}