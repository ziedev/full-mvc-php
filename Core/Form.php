<?php
namespace App\Core;

class Form {
    private $formCode = "";

    public function create () {
        
        return $this->formCode;
    }
     /**
      * 
      *
      * @param array $form POST or Get
      * @param array $champs champs
      * @return void
      */
    public static function validate(array $form , array $champs) {

            foreach ($champs as $champ) {
                if (!isset($form[$champ]) || empty($form[$champ])) {
                    return false;
                }
            }
            return true;
    }

    private function ajoutAttribut(array $attributs) : string{
        $str = "";
        $courts = ["checked","disabled","readonly","required","multiple","autofocus","novalidate","formvalidate"];


        foreach ($attributs as $attribut => $valeur){

            if(in_array($attribut , $courts) && $valeur == true) {

                $str .= " $attribut";

            } else {
                $str .= " $attribut='$valeur'";
            }
        }

        return $str;
    }
    /**
     * Balise dMouverture de formulaire
     *
     * @param string $methode post/get
     * @param string $action action
     * @param array $attributs 
     * @return Form
     */
    public function debutForm(string $methode = "post",string $action = "#",array $attributs = []) : self{
        
        $this->formCode .= "<form action='$action' method='$methode'";
        
        $this->formCode .= $attributs ? $this->ajoutAttribut($attributs).">" : ">";
        
        return $this;
    }
    /**
     * Balise de Fermeture de formulaire
     *
     * @return self
     */
    public function finForm() : self {

        $token = md5(uniqid());

        $this->formCode .= "<input type='hidden' name='token' value='$token'>";



        $this->formCode .= "</form>";
        $_SESSION["token"] = $token;
        return $this;
    }

    public function ajoutLabelFor(string $for , string $text , array $attributs = []) :self {

        $this->formCode .= "<label for='$for'";

        $this->formCode .= $attributs ? $this->ajoutAttribut($attributs) : "";

        $this->formCode .= "> $text </label>";

        return $this;
    }
    /**
     * Ajouter les inputs
     *
     * @param string $type
     * @param string $nom
     * @param array $attributs
     * @return self
     */
    public function ajoutInput(string $type,string $nom, array $attributs = []) :self {

        $this->formCode .= "<input type='$type' name='$nom'";
        $this->formCode .= $attributs ? $this->ajoutAttribut($attributs).">" : ">";
        return $this;
    }

    /**
     * Ajouter un TextArea
     *
     * @param string $nom
     * @param string $valeur
     * @param array $attributs
     * @return self
     */
    public function ajoutTextarea(string $nom ,string $valeur = "", array $attributs = []) :self {

        $this->formCode .= "<textarea name='$nom'";
        $this->formCode .= $attributs ? $this->ajoutAttribut($attributs) : "";
        $this->formCode .= ">$valeur</textarea>";
        return $this;
    }
    /**
     * Select Input
     *
     * @param string $nom
     * @param array $options
     * @param array $attributs
     * @return self
     */
    public function ajoutSelect(string $nom, array $options ,  array $attributs = []) :self {

        $this->formCode .= "<select name='$nom'";
        $this->formCode .= $attributs ? $this->ajoutAttribut($attributs).">" : ">";

        foreach ($options as $key => $value){
            $this->formCode .= "<option value='$key'>$value</option>";
        }
        $this->formCode .= "</select>";
        return $this;
    }


    /**
     * Ajouter Un Bouton
     *
     * @param string $text
     * @param array $attributs
     * @return self
     */
    public function ajoutBouton(string $text ,  array $attributs = []) :self {

        $this->formCode .= "<button ";
        $this->formCode .= $attributs ? $this->ajoutAttribut($attributs).">" : ">";

        
        $this->formCode .= "$text</button>";
        return $this;
    }
}

?>