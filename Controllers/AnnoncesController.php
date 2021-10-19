<?php
namespace App\Controllers;
use App\Models\AnnoncesModel;
use App\Core\Form;

class AnnoncesController extends Controller {

    public function index() {
        $annoncesModel = new AnnoncesModel;

        $annonces = $annoncesModel->findBy(["actif" => 1]);

        $this->render("annonces/index",compact("annonces"));
        
    }

    public function lire(int $id) {
        $annoncesModel = new AnnoncesModel;
        $annonce = $annoncesModel->find($id);
        $this->render("annonces/lire",compact("annonce"));
    }

    public function ajouter(){
        if(isset($_SESSION["user"]) && !empty($_SESSION["user"]["id"])) {
         
                if(Form::validate( $_POST,["titre","description"])) {
                
                    $titre = strip_tags($_POST["titre"]);
                    $description = strip_tags($_POST["description"]);

                
                    $annonce = new AnnoncesModel;

                    $annonce->setTitre($titre)
                            ->setDescription($description)
                            ->setUser_id($_SESSION["user"]["id"]);

                    $annonce->create();

                    $_SESSION["erreur"] = "Votre Annonce a été enregistré";
                    header("Location: /");
                    exit;

                    

                }
                else {


                }
            
            $form = new Form();
        
            $form->debutForm("post" ,"ajouter",["class"=>"form" , "id"=>"formulaire"])
                   ->ajoutLabelFor("titre","Titre")
                   ->ajoutInput("text","titre",["class" => "form-control" , "id" => "titre"])
                   ->ajoutLabelFor("description","Description")
                   ->ajoutTextArea("description" , "",["class" => "form-control" , "id" => "description"])
                   ->ajoutBouton("Ajouter",["class" => "btn btn-primary" , "id" => "save"])
                  ->finForm();
            $this->render("annonces/ajouter",["form" => $form->create()]);

        }
        else {
            $_SESSION["erreur"] = "Vous devez se connecter pour ajouter une annonce";
            header("Location: /users/login");
            exit;
        }
    }

    public function modifier(int $id){
        
        
        if(isset($_SESSION["user"]) && !empty($_SESSION["user"]["id"])) {
            
            $annoncesModel = new AnnoncesModel;
            $annonce = $annoncesModel->find($id);

            if(!$annonce){
                http_response_code(404);
                $_SESSION["erreur"] = "Annonce not found";
                header("Location: /annonces");
                exit;
            }

            if($annonce->user_id !== $_SESSION["user"]["id"] && !in_array("ROLE_ADMIN" , $_SESSION["user"]["roles"])){
                http_response_code(404);
                $_SESSION["erreur"] = "vous n'avez pas access a cette page";
                header("Location: /annonces");
                exit;
            }


            if(Form::validate( $_POST,["titre","description"])) {
            
                $titre = strip_tags($_POST["titre"]);
                $description = strip_tags($_POST["description"]);

                $annonceModif = new AnnoncesModel;
                
                $annonceModif->setId($annonce->id)
                            ->setTitre($titre)
                            ->setDescription($description);

                $annonceModif->update();

                $_SESSION["erreur"] = "Votre Annonce a été enregistré";
                header("Location: /");
                exit;

                

            }
            else {


            }
       
             
        $form = new Form();
    
        $form->debutForm()
               ->ajoutLabelFor("titre","Titre")
               ->ajoutInput("text","titre",["class" => "form-control" , "id" => "titre" , "value" => $annonce->titre])
               ->ajoutLabelFor("description","Description")
               ->ajoutTextArea("description" , $annonce->description,["class" => "form-control" , "id" => "description"])
               ->ajoutBouton("Ajouter",["class" => "btn btn-primary" , "id" => "save"])
              ->finForm();
        $this->render("annonces/ajouter",["form" => $form->create()]);
    }
    else {
        $_SESSION["erreur"] = "Vous devez se connecter pour ajouter une annonce";
        header("Location: /users/login");
        exit;
    }



    }
}