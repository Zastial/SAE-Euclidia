<?php
class UserResponsable extends UserEntity {
    public function getStatus(): UserStatus {
        return UserStatus::RESPONSABLE;
    }
}
?>