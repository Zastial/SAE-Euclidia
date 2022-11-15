<?php
class UserEntity {

    private int $id_utilisateur;
    private string $nom;
    private string $prenom;
    private string $password;
    private string $email;
    private string $status;
   
    /**
     * @return int
     */
    public function getId(): int {
        return $this->id_utilisateur;
    }

    /**
     * @return string
     */
    public function getNom(): string {
        return $this->nom;
    }

    /**
     * @return string
     */
    public function getPrenom(): string {
        return $this->prenom;
    }

    /**
     * @return string
     */
    public function getEmail(): string {
        return $this->email;
    }

    /**
     * @return string
     */
    public function getStatus(): string {
        return $this->status;
    }

    /**
     * @return string
     */
    public function getPassword(): string {
        return $this->password;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void {
        $this->id_utilisateur = $id;
    }

    /**
     * @param string $nom
     */
    public function setNom(string $nom): void {
        $this->nom = $nom;
    }

    /**
     * @param string $prenom
     */
    public function setPrenom(string $prenom): void {
        $this->prenom = $prenom;
    }

    /**
     * @param string $password
     */
    public function setEncryptedPassword(string $password): void {
        $this->password =password_hash($password, PASSWORD_DEFAULT);
    }

    /**
     * @param string $email
     */
    public function setEmail(string $email): void {
        $this->email = $email;
    }

    /**
     * @param string $status
     */
    public function setStatus(string $status): void {
        $this->status = $status;
    }

     /**
     * @param string $password
     */
    public function isValidPassword(string $password): bool {
        return password_verify($password, $this->password);
    }

}
?>