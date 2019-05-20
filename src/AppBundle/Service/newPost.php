<?php


namespace AppBundle\Service;
use AppBundle\Document\userPost;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\Request;


class newPost
{
    private $container;
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }
    public function newPostEntry(Request $reuqest){
        $session = $reuqest->getSession();
        $userPost = new userPost();

        $imageFile = $reuqest->files->get('post_image');
        $fileName = md5 ( uniqid () ) . '.' . $imageFile->guessExtension();
        $imageFile->move ( $this->container->getParameter ( 'file_directory' ), $fileName );

        $userPost-> setStudentId($session->get("current_user"));
        $userPost-> setPostImage($fileName);
        $userPost-> setPostData($reuqest->get('post_message'));
        $userPost-> setPostDate(new \MongoDate());

        $dm = $this-> container-> get('doctrine_mongodb')->getManager();
        $dm->persist($userPost);
        $dm->flush();
        return true;
    }
    public function postDisplay(){

        $postObject = $this-> container-> get('doctrine_mongodb')
            ->getRepository('AppBundle:userPost')
            ->createQueryBuilder()
            ->sort('postDate', 'desc')
            ->getQuery()
            ->execute();
        return $postObject;
    }


}