<?php


namespace AppBundle\Service;
use AppBundle\Document\friendList;
use AppBundle\Document\friendRequest;
use AppBundle\Document\student;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\Request;



class friend
{
    private $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;

    }

    public function currentUserObject(Request $reuqest){
        $session = $reuqest->getSession();

        $userObject = $this-> container->get('doctrine_mongodb')
            ->getRepository('AppBundle:student')
            ->findOneby(array('studentId' => $session->get("current_user")));
        return $userObject;
    }



    public function userlist(Request $reuqest){
        $session = $reuqest->getSession();
        $userObject = $this-> container-> get('doctrine_mongodb')
            ->getRepository('AppBundle:student')
            ->createQueryBuilder()
            ->field('studentId')->notEqual($session->get("current_user"))
            ->getQuery()
            ->execute();
        return $userObject;
    }
    public function friendRequest(Request $reuqest){
        $session = $reuqest->getSession();



        $userObject = $this-> container->get('doctrine_mongodb')
            ->getRepository('AppBundle:student')
            ->findOneby(array('studentId' => $reuqest->get('friend_request')));


        $friendRequestEntry = new friendRequest();
        $friendRequestEntry->setStudentObject($this -> currentUserObject($reuqest));
        $friendRequestEntry->setRequestedFriendObject($userObject);
        $friendRequestEntry->setStudentId($session->get("current_user"));
        $friendRequestEntry->setFriendReuqetTo($reuqest->get('friend_request'));
        $friendRequestEntry->setRequestDate(new \MongoDate());
        $friendRequestEntry->setRequestStatus(0);

        $dm = $this-> container-> get('doctrine_mongodb')->getManager();
        $dm->persist($friendRequestEntry);
        $dm->flush();
        return true;
    }
    public function friendRequestlistOne(Request $reuqest,$friendId){
        $session = $reuqest->getSession();


        $requestrObject = $this-> container->get('doctrine_mongodb')
            ->getRepository('AppBundle:friendRequest')
            ->findOneby(array('studentId' => $session->get("current_user"), 'friendReuqetTo' => $friendId));


        if(!$requestrObject){
            return true;
        }
        else{
            return false;
        }

    }
    public function friendRequestlist(Request $reuqest){
        $session = $reuqest->getSession();
        $requestrObject = $this-> container-> get('doctrine_mongodb')
            ->getRepository('AppBundle:friendRequest')
            ->createQueryBuilder()
            ->field('studentId')->equals($session->get("current_user"))
            ->field('requestStatus')->equals(0)
            ->getQuery()
            ->execute();



            return $requestrObject;


    }
    public function myFriendRequestlist(Request $reuqest){
        $session = $reuqest->getSession();

        $userrObject = $this-> container->get('doctrine_mongodb')
            ->getRepository('AppBundle:student')
            ->findOneby(array('studentId' => $session->get("current_user")));
        if($userrObject){
            $requestrObject = $this-> container-> get('doctrine_mongodb')
                ->getRepository('AppBundle:friendRequest')
                ->createQueryBuilder()
                ->field('requestedFriendObject')->references($userrObject)
                ->field('requestStatus')->equals(0)
                ->getQuery()
                ->execute();
            if($requestrObject){
                return $requestrObject;
            }
            else{
                return false;
            }
        }
        else{
            return false;
        }








    }
    public function friendRequestAccept(Request $reuqest,$requestId){
        $session = $reuqest->getSession();
            $requestrObject = $this-> container-> get('doctrine_mongodb')
                ->getRepository('AppBundle:friendRequest')
                ->findOneby(array('id' => $requestId));
            if($requestrObject){

                $friendListEntry = new friendList();
                $friendListEntry->setStudentId($requestrObject->getStudentId());
                $friendListEntry->setFriendId($requestrObject->getFriendReuqetTo());
                $friendListEntry->setStudentObject($requestrObject->getStudentObject());
                $friendListEntry->setFriendObject($requestrObject->getRequestedFriendObject());
                $dm = $this-> container-> get('doctrine_mongodb')->getManager();
                $dm->persist($friendListEntry);
                $dm->flush();

                return true;

            }
            else{
                return false;
            }

    }
    public function myFriendlist(Request $reuqest){
        $session = $reuqest->getSession();

        $userrObject = $this-> container->get('doctrine_mongodb')
            ->getRepository('AppBundle:student')
            ->findOneby(array('studentId' => $session->get("current_user")));
        if($userrObject){
            $requestrObject = $this-> container-> get('doctrine_mongodb')
                ->getRepository('AppBundle:friendList')
                ->createQueryBuilder()
                ->field('friendObject')->references($userrObject)
                ->getQuery()
                ->execute();
            if($requestrObject){
                return $requestrObject;
            }
            else{
                return false;
            }
        }
        else{
            return false;
        }








    }

}