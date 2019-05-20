<?php


namespace AppBundle\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;
/**
 * @MongoDB\Document
 */
class friendList
{
    /**
     * @MongoDB\Id
     */
    protected $id;
    /**
     * @MongoDB\Field(type="string")
     */
    protected $studentId;
    /**
     * @MongoDB\ReferenceOne(targetDocument="AppBundle\Document\student")
     */
    protected $studentObject;
    /**
     * @MongoDB\Field(type="string")
     */
    protected $friendId;
    /**
     * @MongoDB\ReferenceOne(targetDocument="AppBundle\Document\student")
     */
    protected $friendObject;
    /**
     * @MongoDB\Field(type="date")
     */
    protected $friendRequestDate;
    /**
     * @MongoDB\Field(type="string")
     */
    protected $frendRequestBy;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getStudentId()
    {
        return $this->studentId;
    }

    /**
     * @param mixed $studentId
     */
    public function setStudentId($studentId)
    {
        $this->studentId = $studentId;
    }

    /**
     * @return mixed
     */
    public function getStudentObject()
    {
        return $this->studentObject;
    }

    /**
     * @param mixed $studentObject
     */
    public function setStudentObject($studentObject)
    {
        $this->studentObject = $studentObject;
    }

    /**
     * @return mixed
     */
    public function getFriendId()
    {
        return $this->friendId;
    }

    /**
     * @param mixed $friendId
     */
    public function setFriendId($friendId)
    {
        $this->friendId = $friendId;
    }

    /**
     * @return mixed
     */
    public function getFriendObject()
    {
        return $this->friendObject;
    }

    /**
     * @param mixed $friendObject
     */
    public function setFriendObject($friendObject)
    {
        $this->friendObject = $friendObject;
    }

    /**
     * @return mixed
     */
    public function getFriendRequestDate()
    {
        return $this->friendRequestDate;
    }

    /**
     * @param mixed $friendRequestDate
     */
    public function setFriendRequestDate($friendRequestDate)
    {
        $this->friendRequestDate = $friendRequestDate;
    }

    /**
     * @return mixed
     */
    public function getFrendRequestBy()
    {
        return $this->frendRequestBy;
    }

    /**
     * @param mixed $frendRequestBy
     */
    public function setFrendRequestBy($frendRequestBy)
    {
        $this->frendRequestBy = $frendRequestBy;
    }


}