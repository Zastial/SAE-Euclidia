<?php
class UserEntity {

    private int $id_utilisateur;
    private string $nom;
    private string $prenom;
    private string $password;
    private string $email;
    private string $status;
    private string $numrue;
    private string $adresse;
    private string $ville;
    private string $postalcode;
    private string $pays;
   
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
     * @return string
     */
    public function getNumRue(): string {
        return $this->numrue;
    }

    /**
     * @return string
     */
    public function getAdresse(): string {
        return $this->adresse;
    }

    /**
     * @return string
     */
    public function getVille(): string {
        return $this->ville;
    }

    /**
     * @return string
     */
    public function getPostalCode(): string {
        return $this->postalcode;
    }

    /**
     * @return string
     */
    public function getPays(): string {
        return $this->pays;
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
     * @param string $numrue
     */
    public function setNumRue(string $numrue): void {
        $this->numrue = $numrue;
    }

    /**
     * @param string $adresse
     */
    public function setAdresse(string $adresse): void {
        $this->adresse = $adresse;
    }

    /**
     * @param string $ville
     */
    public function setVille(string $ville): void {
        $this->ville = $ville;
    }

    /**
     * @param string $postalcode
     */
    public function setPostalCode(string $postalcode): void {
        $this->postalcode = $postalcode;
    }

    /**
     * @param string $pays
     */
    public function setPays(string $pays): void {
        $this->pays = $pays;
    }



     /**
     * @param string $password
     */
    public function isValidPassword(string $password): bool {
        return password_verify($password, $this->password);
    }

}
?>