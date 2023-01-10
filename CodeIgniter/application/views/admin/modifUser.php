<?php

$prenom = empty(set_value('prenom')) ? $this->session->user["prenom"] : set_value('prenom');
$nom = empty(set_value('nom')) ? $this->session->user["nom"] : set_value('nom');
$email = empty(set_value('email')) ? $this->session->user["email"] : set_value('email');

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href=<?= base_url("css/modifyAccount.css")?>>


    <title>Modifier le compte</title>
</head>

<style>
    
</style>
<body>
    
    <?php require_once(APPPATH.'views/header.php'); ?>
    
    <section>

        <?php
            $url = site_url("admin/users");
            //Méthode pour empecher de rester bloqué sur la même page lors du retour en arrière.
            if (isset($_SERVER['HTTP_REFERER']) && !empty($_SERVER['HTTP_REFERER'])) { //Si il y a un referer
                if ($this->session->flashdata('original-url')==NULL){   //Si on a pas d'URL sauvegardée
                    $url = htmlspecialchars($_SERVER['HTTP_REFERER']);  //
                    $this->session->set_flashdata('original-url', $url);//On sauvegarde l'URL dans une flashdata
                } else {                                                //Si il y a une url dans la flashdata
                    $url = $this->session->flashdata('original-url');   //
                    $this->session->keep_flashdata('original-url');     //On la garde pour la prochaine requete
                }
            } else {                                                    //Si il n'y a pas de referer (accès direct)
                $this->session->set_flashdata('original-url', site_url("admin/users")); //On redirige vers admin/users si l'utilisateur revient en arrière
            }
        ?>
        <a class="btn btn-orange" href="<?=$url?>"> <img src="" alt=""> < Retour </a>

        <?php echo form_open('admin/modifUser/'.$user->getId()); ?>
            <div class="form-container">
                
    
                <div class="form-head">
                    <h1>Modifier les informations de l'utilisateur</h1>
                </div>

    
                <div class="form-input-modifyAccount">         
                        <div class="first-name">
                            <label for="first-name" class="labelTypo require" size="30">Prénom</label><br>
                            <input class="input" type="text" name="prenom" value="<?= $user->getPrenom() ?>" required>
                            <?php echo form_error('prenom'); ?>
                        </div>
                        <div class="name">
                            <label for="name" class="labelTypo require" size="30" >Nom</label><br>
                            <input class="input" type="text" name="nom" value="<?= $user->getNom() ?>" required>
                            <?php echo form_error('nom'); ?>
                        </div>
                    <div class="email">
                        <label for="email" class="labelTypo require" size="30" >Email</label><br>
                        <input class="input" type="email" name="email" value="<?= $user->getEmail() ?>" required>
                        <?php echo form_error('email'); ?>
                    </div>
    
                    <div class="password">
                        <label for="password" class="labelTypo" size="30" >Mot de passe (non obligatoire)</label><br>
                        <input class="input" type="password" name="password" value="<?= set_value('password'); ?>">
                        <?php echo form_error('password'); ?>
                    </div>
                    <div class="status">
                        <label for="status" class="labelTypo require" size="30">Statut</label><br>
                        <select name="status" > 
                            <option value="Administrateur" <?php if ($user->getStatus() == "Administrateu"){ echo'selected';} ?>>Administrateur</option>
                            <option value="Responsable" <?php if ($user->getStatus() == "Responsable"){ echo'selected';} ?>>Responsable</option>
                            <option value="Utilisateur"<?php if ($user->getStatus() == "Utilisateur"){ echo'selected';} ?>>Utilisateur</option>
                        </select>
                    </div>
                </div>
    
                <div class="form-btn">
                    <button class="btn btn-orange btn-main"type="submit">Appliquer les modifications</button>
                </div>
            </div>
        </form>
       

        
    </section>
    
</body>


    <?php require_once(APPPATH.'views/footer.php'); ?>

</html>