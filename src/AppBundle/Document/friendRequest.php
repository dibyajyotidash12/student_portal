<?php


namespace AppBundle\Document;


use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;
use Doctrine\ODM\MongoDB\Mapping\Annotations\ReferenceOne;
use Doctrine\ODM\MongoDB\Mapping\Annotations\ReferenceMany;

/**
 * @MongoDB\Document
 */
class friendRequest
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
    protected $friendReuqetTo;

    /**
     * @MongoDB\ReferenceOne(targetDocument="AppBundle\Document\student")
     */
    protected $requestedFriendObject;

      /**
       * @MongoDB\Field(type="date")
       */
      protected $requestDate;

      /**
       * @MongoDB\Field(type="integer")
       */
      protected $requestStatus;

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
    public function getFriendReuqetTo()
    {
        return $this->friendReuqetTo;
    }

    /**
     * @param mixed $friendReuqetTo
     */
    public function setFriendReuqetTo($friendReuqetTo)
    {
        $this->friendReuqetTo = $friendReuqetTo;
    }

    /**
     * @return mixed
     */
    public function getRequestedFriendObject()
    {
        return $this->requestedFriendObject;
    }

    /**
     * @param mixed $requestedFriendObject
     */
    public function setRequestedFriendObject($requestedFriendObject)
    {
        $this->requestedFriendObject = $requestedFriendObject;
    }

    /**
     * @return mixed
     */
    public function getRequestDate()
    {
        return $this->requestDate;
    }

    /**
     * @param mixed $requestDate
     */
    public function setRequestDate($requestDate)
    {
        $this->requestDate = $requestDate;
    }

    /**
     * @return mixed
     */
    public function getRequestStatus()
    {
        return $this->requestStatus;
    }

    /**
     * @param mixed $requestStatus
     */
    public function setRequestStatus($requestStatus)
    {
        $this->requestStatus = $requestStatus;
    }



}