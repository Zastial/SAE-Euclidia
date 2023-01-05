<?php
enum Tri
{
    // no sort
    case AUCUN;

    // sort by price
    case PRIXCROISSANT;
    case PRIXDECROISSANT;

    // sort by email
    case EMAILCROISSANT;
    case EMAILDECROISSANT;

    // sort by name
    case NOMCROISSANT;
    case NOMDECROISSANT;

    // sort by user status
    case ALLSTATUS;
    case ADMIN;
    case RESPONSABLE;
    case UTILISATEUR;
    
    // sort by user state
    case ALLETAT;
    case ACTIF;
    case INACTIF;

    /**
     * return Tri from string, default is AUCUN
     */
    static function getTriFromString(string $tri): Tri {
        switch ($tri) {
            case "prix-asc":
                $tri = Tri::PRIXCROISSANT;
                break;
            case "prix-desc":
                $tri = Tri::PRIXDECROISSANT;
                break;
            case "email-asc":
                $tri = Tri::EMAILCROISSANT;
                break;
            case "email-desc":
                $tri = Tri::EMAILDECROISSANT;
                break;
            case "nom-asc":
                $tri = Tri::NOMCROISSANT;
                break;
            case "nom-desc":
                $tri = Tri::NOMDECROISSANT;
                break;
            case "status-tous":
                $tri = Tri::ALLSTATUS;
                break;
            case "status-admin":
                $tri = Tri::ADMIN;
                break;
            case "status-resp":
                $tri = Tri::RESPONSABLE;
                break;
            case "status-user":
                $tri = Tri::UTILISATEUR;
                break;
            case "etat-tous":
                $tri = Tri::ALLETAT;
                break;
            case "etat-actif":
                $tri = Tri::ACTIF;
                break;
            case "etat-inactif":
                $tri = Tri::INACTIF;
                break;
            default:
                $tri = Tri::AUCUN;
                break;
        }
        return $tri;
    }
}
?>