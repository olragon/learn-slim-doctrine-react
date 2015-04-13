<?php
namespace App\Entity;

use App\Entity;
use Doctrine\ORM\Mapping;

/**
 * @Entity
 * @Table(name="comment")
 */
class Comment extends Entity
{
    /**
     * @Column(type="text")
     * @var string
     */
    protected $text;

    /**
     * @ManyToOne(targetEntity="Item", inversedBy="comments")
     * @JoinColumn(name="item_id", referencedColumnName="id")
     */
    public $item;

    /**
     * @ManyToOne(targetEntity="User", inversedBy="comments")
     * @JoinColumn(name="user_id", referencedColumnName="id")
     */    
    public $user;

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
}