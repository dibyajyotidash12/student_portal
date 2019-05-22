<?php


namespace AppBundle\Service;


use AppBundle\Document\student;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class register
{
    private $container;
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function studentRegister($student_info){


        $qb = $this-> container-> get('doctrine_mongodb')
            ->getRepository('AppBundle:student')
            ->createQueryBuilder();

        $qb ->addOr(
                $qb->expr()
                    ->field('studentId')->equals($student_info['userId'])
            )
            ->addOr(
                $qb->expr()
                    ->field('studentName')->equals($student_info['studentName'])
            );

        $userData =$qb->getQuery()->getSingleResult();

        if(!$userData){
            $student = new student();
            $student-> setStudentId($student_info["userId"]);
            $student-> setStudentName($student_info['studentName']);
            $student-> setStudentContact($student_info['studentContact']);

            $student-> setPassword(md5($student_info['pass']));

            $dm = $this-> container-> get('doctrine_mongodb')->getManager();
            $dm->persist($student);
            $dm->flush();
            return true;
        }
        return false;
    }
    public function studentLogin($student_info){

        $studentObject = $this ->container-> get('doctrine_mongodb')
            ->getRepository('AppBundle:student')
            ->findOneby([
                'studentId' => $student_info['userId']
            ]);
        if($studentObject){
            return $studentObject->getPassword();
        }
        else{
            return false;
        }
    }
    public function studentProfileData($studentId){

        $studentObject = $this ->container-> get('doctrine_mongodb')
            ->getRepository('AppBundle:student')
            ->findOneby([
                'studentId' => $studentId
            ]);
       if($studentObject){
           return $studentObject;
       }
       else{
           return false;
       }
    }
    public function studentProfileUpdate(Request $request){

        $studentObject = $this-> container-> get('doctrine_mongodb')
            ->getRepository('AppBundle:student')
            ->createQueryBuilder()
            ->updateOne()
            ->field('studentName')->set($request->get('student_name'))
            ->field('studentContact')->set($request->get('studentContact'))
            ->field('dateOfBirth')->set($request->get('dateOfBirth'))
            ->field('mailId')->set($request->get('mailId'))
            ->field('studentId')->equals($request->get('studentId'))
            ->getQuery()
            ->execute();
        if($studentObject){
            return $studentObject;
        }
        else{
            return false;
        }
    }

}