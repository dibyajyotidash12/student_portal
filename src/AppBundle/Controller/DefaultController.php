<?php

namespace AppBundle\Controller;

use AppBundle\Document\student;
use AppBundle\Service\register;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {

        return $this->render('default/index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
        ]);
    }
    /**
     * @Route("/signUp", name="app_default_signup")
     */
    public function signUpAction(Request $request)
    {
        if( $request-> get('userId') &&
            ("" != $request-> get('userId')) &&
            $request-> get('studentName') &&
            ("" != $request-> get('studentName')) &&
            $request-> get('studentContact') &&
            ("" != $request-> get('studentContact')) &&
            $request-> get('pass') &&
            ("" != $request-> get('pass'))){

            $student_info = array(  'userId' => $request-> get('userId'),
                                    'studentName' => $request-> get('studentName'),
                                    'studentContact' => $request-> get('studentContact'),
                                    'pass' => $request-> get('pass'));
            $reg_student = $this->get('registration');
            if($reg_student->studentRegister($student_info)){
                $saveStatus = 1;
            }
            else{
                $saveStatus = 2;
            }


            return $this->render('default/index.html.twig', array( 'message' => $saveStatus ));

        }
        else{
            return $this->render('default/signup.html.twig');
        }

    }
    /**
     * @Route("/login", name="app_default_login")
     */
    public function loginAction(Request $request)
    {
        $session = $request->getSession();
        if( $request-> get('userId') &&
            ("" != $request-> get('userId')) &&
            $request-> get('pass') &&
            ("" != $request-> get('pass'))){

            $student_info = array(  'userId' => $request-> get('userId'),
                'pass' => $request-> get('pass'));
            $reg_student = $this->get('registration');
            $loginResponse = $reg_student->studentLogin($student_info);
            if($loginResponse){
               if($loginResponse == $request-> get('pass')){

                   $session->set('current_user', $student_info["userId"]);
                   $newPost = $this->get('newPost');

                   return $this->render('default/dashboard.html.twig',array('displayPost'=> $newPost-> postDisplay()));
               }
               else{
                   return $this->render('default/index.html.twig', array( 'message' => 3 ));
               }
            }
            else{
                return $this->render('default/index.html.twig', array( 'message' => 4 ));
            }




        }
        else{
            return $this->render('default/index.html.twig', array( 'message' => 5 ));
        }

    }
    /**
     * @Route("/portal/dashboard", name="app_default_Dashboard")
     */
    public function dashboardAction(Request $request)
    {
        $newPost = $this->get('newPost');


        return $this-> render('default/dashboard.html.twig',array('displayPost'=> $newPost-> postDisplay()));

    }
    /**
     * @Route("/portal/newPost", name="app_default_new_post")
     */
    public function newPostAction(Request $request)
    {
        if($request->get('post_message') &&
            ("" != $request->get('post_message'))){

            $newPost = $this->get('newPost');
            if($newPost-> newPostEntry($request)){

                return $this-> render('default/newpost.html.twig');
            }
            else{
                return $this-> render('default/newpost.html.twig');
            }

        }
        else{
            return $this-> render('default/newpost.html.twig');
        }


    }
    /**
     * @Route("/portal/findFriend", name="app_default_find_friend")
     */
    public function findFriendAction(Request $request)
    {
        $friendList = $this->get('friend');

        if($request->get('friend_request') &&
            ("" != $request->get('friend_request'))){
            if($friendList-> friendRequestlistOne($request,$request->get('friend_request'))){

                $friendList-> friendRequest($request);
                $allUserList = $friendList-> userlist($request);
                $allRequestList = $friendList-> friendRequestlist($request);
                return $this-> render('default/findfriend.html.twig',array('allUserList' => $allUserList,
                                                                                 'allRequestList' => $allRequestList,
                                                                                 'notification' => '1'));
            }
            else{

                $allUserList = $friendList-> userlist($request);
                $allRequestList = $friendList-> friendRequestlist($request);
                return $this-> render('default/findfriend.html.twig',array('allUserList' => $allUserList,
                                                                                 'allRequestList' => $allRequestList,
                                                                                 'notification' => '2'));
            }


        }
        else{
            $allUserList = $friendList-> userlist($request);
            $allRequestList = $friendList-> friendRequestlist($request);
            return $this-> render('default/findfriend.html.twig',array('allUserList' => $allUserList,
                                                                             'allRequestList' => $allRequestList));
        }


    }
    /**
     * @Route("/portal/friendRequest", name="app_default_friend_request")
     */
    public function friendRequestAction(Request $request)
    {

        $friendList = $this->get('friend');
        if($request->get('friend_request_accept') &&
            ("" != $request->get('friend_request_accept'))){
            if($friendList-> friendRequestAccept($request,$request->get('friend_request_accept'))){

                $friendList-> friendRequest($request);
                $allUserList = $friendList-> userlist($request);
                $allRequestList = $friendList-> friendRequestlist($request);
                return $this-> render('default/friendrequest.html.twig',array('allRequestList' => $allRequestList, 'notification' => '1'));

            }
            else{

                return $this-> render('default/friendrequest.html.twig',array('error' => '2'));
            }


        }
        else{
            if($allRequestList = $friendList-> myFriendRequestlist($request)){

                return $this-> render('default/friendrequest.html.twig',array('allRequestList' => $allRequestList));

            }
            else{

                return $this-> render('default/friendrequest.html.twig',array('error' => '1'));
            }
        }


    }
    /**
     * @Route("/portal/friendList", name="app_default_friend_list")
     */
    public function friendListAction(Request $request)
    {
        $friendList = $this->get('friend');
        if($allList = $friendList-> myFriendlist($request)){

            return $this-> render('default/friendList.html.twig',array('allList' => $allList));

        }
        else{

            return $this-> render('default/friendList.html.twig',array('error' => '1'));
        }


    }
    /**
     * @Route("/portal/profileUpdate", name="app_default_profile_update")
     */
    public function profileUpdateAction(Request $request)
    {
        $session = $request->getSession();
        $studentObject = $this->get('registration');
        if($request->get('student_name') &&
            ("" != $request->get('student_name'))){

            if($studentObject-> studentProfileUpdate($request)){
                return $this-> render('default/profileUpdate.html.twig', array(
                    'studentObject' => $studentObject-> studentProfileData($session->get('current_user')),
                    'notification' => '1'));
            }
            else{
                return $this-> render('default/profileUpdate.html.twig', array(
                    'studentObject' => $studentObject-> studentProfileData($session->get('current_user')),
                    'notification' => '2'));
            }


        }
        else{
            return $this-> render('default/profileUpdate.html.twig', array('studentObject' => $studentObject-> studentProfileData($session->get('current_user'))));
        }
    }
    /**
     * @Route("/portal/csvUpload", name="app_default_csv_upload")
     */
    public function csvUploadAction(Request $request)
    {
        $session = $request->getSession();
        $studentObject = $this->get('csvData');

        if($request->files->get('csv_file')){

            if($studentObject-> csvUpload($request)){
                return $this-> render('default/csvUpload.html.twig', array(
                    'notification' => '1'));
            }
            else{
                return $this-> render('default/csvUpload.html.twig', array(
                    'notification' => '2'));
            }


        }
        else{
            return $this-> render('default/csvUpload.html.twig');
        }
    }
    /**
     * @Route("/portal/displayData", name="app_default_display_data")
     */
    public function displayDataAction(Request $request)
    {
        $session = $request->getSession();
        $studentObject = $this->get('csvData');
        $userObject = $studentObject-> displayDate();

            return $this-> render('default/displayData.html.twig', array('userObject' => $userObject));
    }
}
