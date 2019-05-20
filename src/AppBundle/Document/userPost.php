<?php


namespace AppBundle\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;
/**
 * @MongoDB\Document
 */
class userPost
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
    protected  $postImage;
    /**
     * @MongoDB\Field(type="string")
     */
    protected  $postData;
    /**
     * @MongoDB\Field(type="date")
     */
    protected  $postDate;

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
    public function getPostImage()
    {
        return $this->postImage;
    }

    /**
     * @param mixed $postImage
     */
    public function setPostImage($postImage)
    {
        $this->postImage = $postImage;
    }

    /**
     * @return mixed
     */
    public function getPostData()
    {
        return $this->postData;
    }

    /**
     * @param mixed $postData
     */
    public function setPostData($postData)
    {
        $this->postData = $postData;
    }

    /**
     * @return mixed
     */
    public function getPostDate()
    {
        return $this->postDate;
    }

    /**
     * @param mixed $postDate
     */
    public function setPostDate($postDate)
    {
        $this->postDate = $postDate;
    }



}