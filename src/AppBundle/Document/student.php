<?php


namespace AppBundle\Document;
use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;
/**
 * @MongoDB\Document
 */
class student
{
    /**
     * @MongoDB\Id
     */
    protected  $id;
    /**
     * @MongoDB\Field(type="string")
     */
    protected  $studentId;
    /**
     * @MongoDB\Field(type="string")
     */
    Protected  $studentName;
    /**
     * @MongoDB\Field(type="string")
     */
    protected  $studentContact;
    /**
     * @MongoDB\Field(type="string")
     */
    protected  $password;
    /**
     * @MongoDB\Field(type="date")
     */
    protected  $dateOfBirth;
    /**
     * @MongoDB\Field(type="string")
     */
    protected  $mailId;

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
    public function getStudentName()
    {
        return $this->studentName;
    }

    /**
     * @param mixed $studentName
     */
    public function setStudentName($studentName)
    {
        $this->studentName = $studentName;
    }

    /**
     * @return mixed
     */
    public function getStudentContact()
    {
        return $this->studentContact;
    }

    /**
     * @param mixed $studentContact
     */
    public function setStudentContact($studentContact)
    {
        $this->studentContact = $studentContact;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    /**
     * @return mixed
     */
    public function getDateOfBirth()
    {
        return $this->dateOfBirth;
    }

    /**
     * @param mixed $dateOfBirth
     */
    public function setDateOfBirth($dateOfBirth)
    {
        $this->dateOfBirth = $dateOfBirth;
    }

    /**
     * @return mixed
     */
    public function getMailId()
    {
        return $this->mailId;
    }

    /**
     * @param mixed $mailId
     */
    public function setMailId($mailId)
    {
        $this->mailId = $mailId;
    }

}