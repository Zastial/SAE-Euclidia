<?php
class UserAdmin extends UserEntity {
    public function getStatus(): string {
        return "Administrateur";
    }
}
?>