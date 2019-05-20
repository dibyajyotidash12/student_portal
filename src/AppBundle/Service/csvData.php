<?php


namespace AppBundle\Service;


use AppBundle\Document\student;
use AppBundle\Document\userPost;
use Doctrine\Common\Annotations\Reader;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\Request;


class csvData
{private $container;
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }
    public function csvUpload(Request $reuqest){
        $session = $reuqest->getSession();
        $student = new student();

        $csvFile = $reuqest->files->get('csv_file');
        $fileName = md5 ( uniqid () ) . '.' . $csvFile->guessExtension();
        $csvFile->move ( $this->container->getParameter ( 'file_directory_csv' ), $fileName );





        $row = 1;
        if (($handle = fopen($this->container->getParameter ( 'file_directory_csv' )."/".$fileName, "r")) !== FALSE) {
            while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                $num = count($data);

                $row++;

                $student->setStudentId($data[0]);
                $student->setStudentName($data[1]);
                if($data[2]!=""){
                    $student->setStudentContact($data[2]);
                }
                if($data[3]!=''){
                    $student->setMailId($data[3]);
                }




                $dm = $this-> container-> get('doctrine_mongodb')->getManager();
                $dm->persist($student);
                $dm->flush();



            }
            fclose($handle);
        }



        return true;
    }
    public function displayDate(){

        $userObject = $this-> container-> get('doctrine_mongodb')
            ->getRepository('AppBundle:student')
            ->createQueryBuilder()
            ->getQuery()
            ->execute();
        return $userObject;
    }

}