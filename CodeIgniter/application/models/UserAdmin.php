<?php
class UserAdmin extends UserEntity {
    public function getStatus(): UserStatus {
        return UserStatus::ADMINISTRATEUR;
    }
}
?>