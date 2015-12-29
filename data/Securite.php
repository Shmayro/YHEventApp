<?php

/**
 * Class Securite Propose deux fonctions pour securiser les entrées et les sorties des données
 */
class Securite
{
    // Données entrantes
    /**
     * securise les Entrées
     * @param $string
     * @return int|string
     */
    public static function bdd($string)
    {
        // On regarde si le type de string est un nombre entier (int)
        if (ctype_digit($string)) {
            $string = intval($string);
        } // Pour tous les autres types
        else {
            $string = addcslashes($string, '%_');
        }

        return $string;

    }

    // Données sortantes
    /**
     * securise les sorties
     * @param $string
     * @return string
     */
    public static function html($string)
    {
        return htmlentities($string);
    }
}

?>