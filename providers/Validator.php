<?php
namespace App\Providers;

class Validator {
    // $errors -> stocker les erreurs de validation
    private $errors = array();
    private $key;
    // Valeur à valider
    private $value;
    //l'attribut pour les messages d'erreur
    private $name;

    /**
     * Définition de la clé, la valeur et le nom de l'attribut à valider
     */
    public function field($key, $value, $name = null){
        $this->key = $key;
        $this->value = $value;
        if($name == null){
            // Mettre en majuscule la première lettre du nom par défaut
            $this->name = ucfirst($key);
        }else{
            $this->name = ucfirst($name);
        }
        return $this;
    }

    /**
     * Vérifier si la valeur est présente
     */
    public function required(){
        if (empty($this->value)){
            $this->errors[$this->key] = "$this->name est requis";
        }
        return $this;
    }

    /**
     * Vérifier si la longueur de la valeur ne dépasse pas la longueur maximale
     */
    public function max($length){
        if(strlen($this->value) > $length){
            $this->errors[$this->key] = "$this->name doit comporter moins de $length caractères";
        }
        return $this;
    }

    /**
     * Vérifier si la longueur de la valeur est supérieure ou égale à la longueur minimale
     */
    public function min($length){
        if(strlen($this->value) < $length){
            $this->errors[$this->key] = "$this->name must be more than $length characters";
        }
        return $this;
    }

    /**
     * Vérifier si la valeur est une adresse e-mail valide
     */
    public function email(){
        if(!empty($this->value) && !filter_var($this->value, FILTER_VALIDATE_EMAIL)){
            $this->errors[$this->key] = "Invalid $this->name format";
        }
        return $this;
    }

    /**
     * Vérifier si la valeur est une date valide et si elle n'est pas antérieure à aujourd'hui
     */
    public function date($format = 'Y-m-d') {
        if (!empty($this->value)) {
            // Créer un objet DateTime à partir de la chaîne de date
            $d = \DateTime::createFromFormat($format, $this->value);
    
            // Vérifier si la date est valide et correspond au format
            if (!($d && $d->format($format) === $this->value)) {
                $this->errors[$this->key] = "Format de la date, doit être : " . $format . ", " . $this->value . " est donné.";
            } else {
                // Créer un objet DateTime pour la date d'aujourd'hui
                $today = new \DateTime();
    
                // Comparer la date choisie avec la date d'aujourd'hui
                if ($d < $today) {
                    $this->errors[$this->key] = "La date ne peut pas être antérieure à aujourd'hui.";
                }
            }
        }
        return $this;
    }
    

    /**
     * Valider le format de l'heure contre H:i
     */
    public function time() {
        if (!empty($this->value)) {
            // Définir l'expression régulière pour valider le format HH:mm
            $pattern = '/^([01]\d|2[0-3]):([0-5]\d)$/';

            // Retirer les secondes en extrayant uniquement les heures et les minutes
            $value = substr($this->value, 0, 5);
    
            // Vérifier si l'heure correspond à l'expression régulière
            if (!preg_match($pattern, $value)) {
                $this->errors[$this->key] = "Format du temps doit être  H:i. " . $this->value . " est donné.";
            }
        }
        return $this;
    }
    
    /**
     * Vérifier si la validation a réussi (pas d'erreurs)
     */
    public function isSuccess(){
        if(empty($this->errors)) return true;
    }

    /**
     * Obtenir les erreurs de validation
     */
    public function getErrors(){
        if(!$this->isSuccess()) return $this->errors;
    }
}

?>