<?php

namespace AdminPack\Controller;


/**
 * Description of Dashboard
 *
 * @author Thomas Darko
 */
class DashboardCtrl extends \Core\Controller {

  
   
    public function index() {
      
         $this ->redirect('adm.dash.editor');
    }
    
    public function editor() {
      
        $this->setTitle('Dashboard');
         $this ->renderView();
    }
    
}
