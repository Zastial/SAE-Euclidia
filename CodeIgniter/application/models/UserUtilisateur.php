<?php

class UserUtilisateur extends UserEntity {
    
    public function getStatus(): UserStatus {
        return UserStatus::UTILISATEUR;
    }
}

?>