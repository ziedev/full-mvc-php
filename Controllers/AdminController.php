<?php
namespace App\Controllers;

use App\Models\AnnoncesModel;

class AdminController extends Controller {

    public function index()
    {
        
        if($this->isAdmin()) {
            $this->render("admin/index" , [] , "admin");
        }
    }
    
    

    public function annonces()
    {
        if($this->isAdmin()) {
            $annoncesModel = new AnnoncesModel;

            $annonces = $annoncesModel->findAll();
            
            $this->render("admin/annonces",compact("annonces"),"admin");
        }
    }

    /**
     * Verification si c'est Admin
     *
     * @return boolean
     */

    private function isAdmin()
    {
        # code...
        if(isset($_SESSION["user"]) && in_array("ROLE_ADMIN" , $_SESSION["user"]["roles"])) {

            return true;

        } else{
            
            header("Location: /");
            exit;

        }

       
    }
}