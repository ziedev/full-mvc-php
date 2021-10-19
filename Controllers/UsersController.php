<?php
namespace App\Controllers;
use App\Core\Form;
use App\Models\UsersModel;


class UsersController extends Controller {
    
    /**
     * Login
     *
     * @return void
     */
    public function login() {
        // Delete Session $_SESSION["message"]
      

        if(Form::validate( $_POST,["email","password"])) {
           
            $email = strip_tags($_POST["email"]);

           
            $userModel = new UsersModel;
            $userArray = $userModel->findOneByEmail($email);

            if(!$userArray) {
                $_SESSION["erreur"] = "Adresse Email et/ou le mot de passe est incorrect";
                header("Location: /users/login");
                exit;

            }

            $user = $userModel->hydrate($userArray);
            
            if(password_verify($_POST["password"],$user->getPassword())) {
                $user->setSession();
                header("Location: /");
                exit;
            }else{
                $_SESSION["erreur"] = "Adresse Email et/ou le mot de passe est incorrect";
                header("Location: /users/login");
                exit;
            }

            


        }

      //  $_SESSION["user"] = ["id" => 1, "email" => "me@test.fr"];

        $form = new Form();
        
        $form->debutForm("post" ,"login",["class"=>"form" , "id"=>"formulaire"])
               ->ajoutLabelFor("email","E-mail")
               ->ajoutInput("email","email",["class" => "form-control" , "id" => "email"])
               ->ajoutLabelFor("password","Password")
               ->ajoutInput("password","password",["class" => "form-control" , "id" => "password"])
               ->ajoutBouton("Me Connecter",["class" => "btn btn-primary" , "id" => "save"])
              ->finForm();

        $this->render("users/login",["loginForm" => $form->create()]);
        
    }

    /**
     * Inscription des utilisateurs
     *
     * @return void
     */
    public function register() {

        if(Form::validate( $_POST,["email","password"])) {
           
            $email = strip_tags($_POST["email"]);
            $password = password_hash($_POST["password"] , PASSWORD_ARGON2I) ;

           
            $user = new UsersModel;
            $user->setEmail($email)
                  ->setPassword($password);
            
                  $user->create();


        } 


        $form = new Form();
        
        $form->debutForm("post" ,"register",["class"=>"form" , "id"=>"formulaire"])
               ->ajoutLabelFor("email","E-mail")
               ->ajoutInput("email","email",["class" => "form-control" , "id" => "email"])
               ->ajoutLabelFor("password","Password")
               ->ajoutInput("password","password",["class" => "form-control" , "id" => "password"])
               ->ajoutBouton("Inscription",["class" => "btn btn-primary" , "id" => "save"])
              ->finForm();

        $this->render("users/register",["registerForm" => $form->create()]);

    }

    public function logout() {
        unset($_SESSION["user"]);
        header("Location: ".$_SERVER["HTTP_REFERER"]);
        exit;
    }
}
?>