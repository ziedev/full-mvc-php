<?php
namespace App\Models;
use App\Core\Db;

class Model extends Db {

    protected $table;

    private $db;

    public function findAll() {

        $query = $this->requette("SELECT * FROM ".$this->table);
        return $query->fetchAll();
    }

    public function findBy(array $criteres) {

        $champs = [];
        $valeurs = [];

        // Separer les champs et valeurs

        foreach($criteres as $champ => $valeur){
            $champs[] = "$champ = ?";
            $valeurs[] = $valeur;
            
        }

        $liste_champs = implode(" AND ",$champs);

        return $this->requette("SELECT * FROM ".$this->table." WHERE ".$liste_champs, $valeurs)->fetchAll();
    }

    public function find(int $id) {
        return $this->requette("SELECT * FROM ".$this->table." WHERE id = ".$id)->fetch();
    }



    public function requette(string $sql , array $attributs = null){
        
        $this->db = Db::getInstance();

        if ($attributs != null) {
            $query = $this->db->prepare($sql);
            $query->execute($attributs);
            return $query;
        } else {

            return $this->db->query($sql);
            }
    }

    public function create(){

        $champs = [];
        $inter = [];
        $valeurs = [];

        // Separer les champs et valeurs

        foreach($this as $champ => $valeur){
            if ($valeur !== null && $champ != 'db' && $champ != "table") {
                $champs[] = $champ;
                $inter[] = "?";
                $valeurs[] = $valeur;
            }
            
            
        }

        $liste_champs = implode(", ",$champs);
        $liste_inter = implode(', ',$inter);
    
        return $this->requette("INSERT INTO ".$this->table." (".$liste_champs.") VALUES (".$liste_inter.")", $valeurs);

    }

    public function hydrate($donnees) {

        foreach($donnees as $key => $value){
            $setter = "set".ucfirst($key);

            if(method_exists($this,$setter)){
                $this->$setter($value);
            }
        }

        return $this;
    }

    public function update(){

        $champs = [];
        $valeurs = [];

        // Separer les champs et valeurs

        foreach($this as $champ => $valeur){
            if ($valeur !== null && $champ != 'db' && $champ != "table") {
                $champs[] = "$champ = ?";
                $valeurs[] = $valeur;
            }
            
            
        }
        $valeurs[] = $this->id;
        $liste_champs = implode(", ",$champs);
    
        return $this->requette("UPDATE ".$this->table." SET ".$liste_champs." WHERE id = ?", $valeurs);

    }

    public function delete(int $id){
       
        return $this->requette("DELETE FROM ".$this->table." WHERE id = ?", [$id]);

    }

}


?>