<?php

namespace News\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * An example of how to implement a Test entity.
 *
 * @ORM\Entity
 * @ORM\Table(name="news")
 *
 * 
 */
class News
{
    /**
     * @var int
     * @ORM\Id
     * @ORM\Column(type="bigint")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    public $id;

    /**
     * @var datetime
     * @ORM\Column(type="datetime")
     */
    public $time_create;

    /**
     * @var datetime
     * @ORM\Column(type="datetime")
     */
    public $time_update;

    /**
     * @var string
     * @ORM\Column(type="string")
     */
    public $title;

    /**
     * @var text
     * @ORM\Column(type="text")
     */
    public $preview;

    /**
     * @var text
     * @ORM\Column(type="text")
     */
    public $body_text;

    /**
     * 
     * @ORM\Column(type="boolean")
     */
    public $publish;

    /**
     * Get id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set id.
     *
     * @param int $id
     *
     * @return void
     */
    public function setId($id)
    {
        $this->id = (int)$id;
    }

    /**
     * Get title.
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set title.
     *
     * @param string $title
     *
     * @return void
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * Get text.
     *
     * @return string
     */
    public function getBodyText()
    {
        return $this->body_text;
    }

    /**
     * Set text.
     *
     * @param string $text
     *
     * @return void
     */
    public function setBodyText($text)
    {
        $this->body_text = $text;
    }



    /**
     * Get created.
     *
     * @return int
     */
    public function getTimeUpdate()
    {
        return $this->time_update;
    }

    /**
     * Set created.
     *
     * @param int $created
     *
     * @return void
     */
    public function setTimeUpdate($time)
    {
        $this->time_update = $time;
    }

      /**
     * Get created.
     *
     * @return int
     */
    public function getTimeCreate()
    {
        return $this->time_create;
    }

    /**
     * Set created.
     *
     * @param int $created
     *
     * @return void
     */
    public function setTimeCreate($time)
    {
        $this->time_create = $time;
    }

    /**
     * Get state.
     *
     * @return int
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * Set state.
     *
     * @param int $state
     *
     * @return void
     */
    public function setState($state)
    {
        $this->state = $state;
    }

    /**
     * Helper function.
     */
    public function exchangeArray($data)
    {
        foreach ($data as $key => $val) {
            if (property_exists($this, $key)) {
                $this->$key = ($val !== null) ? $val : null;
            }
        }
    }

    /**
     * Helper function
     */
    public function getArrayCopy()
    {
        return get_object_vars($this);
    }

}