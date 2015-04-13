<?php
namespace App\Entity;
use App\Entity;
use Doctrine\ORM\Mapping;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @Entity
 * @Table(name="item")
 */
class Item extends Entity
{

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @Column(type="string", length=255)
     * @var string
     */
    protected $title;

    /**
     * @Column(type="string", length=255)
     * @var string
     */
    protected $url;

    /**
     * @Column(type="text")
     * @var string
     */
    protected $text;

    /**
     * @Column(type="integer")
     * @var string
     */
    protected $point = 0;

    /**
     * @ManyToOne(targetEntity="User", inversedBy="items")
     * @JoinColumn(name="user_id", referencedColumnName="id")
     */
    public $user;

    /**
     * @OneToMany(targetEntity="Comment", mappedBy="item")
     */
    public $comments;
    
    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @param string $url
     */
    public function setUrl($url)
    {
        $this->url = $url;
    }

    /**
     * @return string
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * @param string $url
     */
    public function setText($text)
    {
        $this->text = $text;
    }

    /**
     * @return string
     */
    public function getPoint()
    {
        return $this->point;
    }

    /**
     * @param string $point
     */
    public function setPoint($point)
    {
        $this->point = $point;
    }

    public function setUser($id)
    {

    }

    public function getUser()
    {
        return $this->user;
    }
}