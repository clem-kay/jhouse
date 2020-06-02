<?php

namespace SitePack\Controller;

/**
 * Description of HomeCtrl
 *
 * @author Thomas Darko
 */
class HomeCtrl extends \Core\Controller
{

    /**
     * loads user data after login
     */
    public function index()
    {
        $this->renderView();
    }
    public function register()
    {
        if ($this->request()->isPost()) {
            $formData = $this->request()->getParams();
            $userDetails['email'] = $formData['email'];
            $userDetails['first_name'] = $formData['firstname'];
            $userDetails['last_name'] = $formData['lastname'];
            $userDetails['password'] = md5($formData['password']);
            $userDetails['email'] = $formData['email'];
            $userDetails['usertype'] = $formData['usertype'];
            $userDetails['username'] = $formData['username'];
            $userDetails['date_joined'] = date('y/m/d');

            $mailService = $this->service('mailer');
            $ok = $mailService->send($formData['email'], ' asbuject...', ' content' );

            var_dump($ok); exit;

            $this->table('auth_user')->add($userDetails);

            // var_dump( $formData ); exit;

            $this->redirect('site.activatecheck');
        }

        $this->renderView();
    }
    public function login()
    {
    
        if ($this->request()->isPost()) {
            $formData = $this->request()->getParams();
            $param['email'] = $formData['email'];
            $param['password'] = md5($formData['password']);

            if ($this->table('auth_user')->findby($param > 0))
            {
                $this->redirect('site.freelancedashboard');
            }
            
        }
        
        
        $this->renderview();
    }
    public function activate_check()
    {
        $this->renderview();
    }
    public function freelance_dashboard()
    {
        $this->renderview();
    }
    public function client_message()
    {
        
        $this->renderview();
    }
    public function client_dashboard()
    {
        $this->renderview();
    }

    public function personalprofile()
    {
        if ($this->request()->isPost()) {


            $formData = $this->request()->getParams();
            $userDetails['address'] = $formData['address'];
            $userDetails['phone'] = $formData['phone'];
            $userDetails['location_country'] = $formData['country'];
            $userDetails['city'] = $formData['city'];
            $userDetails['profile_summary'] = $formData['summary'];
            $userDetails['picture'] = $formData['picture'];
            $userDetails['links'] = $formData['links'];

            $this->table('mainapp_userprofile')->add($userDetails);

            $this->redirect('site.freelancedashboard');
        }
        
            
        $this->renderview();
    }
    public function freelance_message()
    {
        if ($this->request()->isPost()) {
            $formData = $this->request()->getParams();
            $userDetails['sender']= $formData['address'];
            $userDetails['receiver']=$formData['receiver'];
            $userDetails['message']=$formData['message'];

        }
        $this->renderview();
    }

    /**
     * 
     *  
     */
    public function search()
    {

        $input = $this->request()->getParam('user_input');

        $list = $this->table('xx')->findBy($input);

        $this->addData('result', $list);

        $this->renderResponse();
    }
}
