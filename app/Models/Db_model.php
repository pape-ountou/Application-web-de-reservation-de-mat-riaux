<?php
#THEME: Association sportive ( foot en salle) 
#VERSION: V2.1
#AUTEUR : PAPE OUNTOU DIOP

#HOMEPAGE: https://obiwan.univ-brest.fr/~e21909825/index.php


namespace App\Models;
use CodeIgniter\Model;
class Db_model extends Model
{
protected $db;
public function __construct()
{
$this->db = db_connect(); //charger la base de données
// ou
// $this->db = \Config\Database::connect();
}
// fonction qui permet d'afficher tous les comptes actifs
public function get_all_compte()
{
    $resultat = $this->db->query("SELECT cpt_pseudo, cpt_role, cpt_etat FROM t_compte_cpt WHERE cpt_etat='A';");
    return $resultat->getResultArray();
}
//fonction qui permet de compter le nombre de comptes dans la base de donnèes
public function get_number_compte(){
    $resultat1 = $this->db->query("SELECT COUNT(DISTINCT(cpt_id)) AS total FROM t_compte_cpt WHERE cpt_etat='A';");
    return $resultat1->getRow();
}
//fonction qui permet d'ajouter un  nouveau compte dans la base de donnèes en récupérant les champs de saisie 
public function set_compte($saisie)
{
    //Récuparation (+ traitement si nécessaire) des données du formulaire
    $login=addslashes($saisie['pseudo']);
    $mot_de_passe=addslashes($saisie['mdp']);
    $sql="INSERT INTO t_compte_cpt VALUES(NULL,'".$login."', 'I', 'A', 
    '".$mot_de_passe."');";
    return $this->db->query($sql);
}

//fonction qui permet grace à un numéro donné comme paramètre de récupérer l'actualité d'identifiant $numero
public function get_actualite($numero)
{

    $requete="SELECT * FROM t_actualite_act WHERE act_id=".$numero.";";
    $resultat = $this->db->query($requete);
        return $resultat->getRow();
}

//fonction qui permet  de récupérer les 5 dernières actualités  de notre BD

public function get_all_actualite(){
    $requete1="SELECT * FROM VIEW_ACTU;";
    $resultat1 = $this->db->query($requete1);
    return $resultat1->getResultArray();
}
//fonction qui permet de récupérer la question d'un visiteur à l'aide d'un code fourni en paramètre
public function get_question_visiteur($code){
    $requete2="SELECT * FROM t_message_mes WHERE mes_code_genere= '".$code."';";
    $resultat2=$this->db->query($requete2);
    return $resultat2->getRow();
}

//fonction qui permet à un visiteur de pooser une question en remplissant le formulaire avec les champs $quest, $suj et $email
public function insert_question($saisie){
    $quest=addslashes($saisie['question']);
    $suj=addslashes($saisie['sujet']);
    $email=addslashes($saisie['email']);
    $code_genere="SUBSTRING(MD5(RAND()), 1,20)";
    $requete="INSERT INTO t_message_mes VALUES (NULL,'".$suj."','".$quest."', NULL, '".$email."', $code_genere, CURDATE(), NULL);";
    return $this->db->query($requete);
}
//fonction qui permet de récupérer le code généré qui servira dee faire le suivi
public function recup_code(){
    $requete1='SELECT mes_code_genere FROM t_message_mes ORDER BY mes_id DESC LIMIT 1;';
    $resultat=$this->db->query($requete1);
    return $resultat->getRow();
}
//fnction qui permet de récupérer la question d'un visiteur en renseignant le code fourni en paramètre 
public function get_question($saisie){
    $code=$saisie['code'];
    $requete2="SELECT * FROM t_message_mes WHERE mes_code_genere= '$code' ;";
    $resultat2=$this->db->query($requete2);
    return $resultat2->getRow();
}

//fonction qui permet de vérifier la correspondance entre les paramétres et les donnèes de la BD
public function connect_compte($u, $p){
    $sql="SELECT cpt_pseudo,cpt_mot_de_passe FROM t_compte_cpt WHERE cpt_pseudo='".$u."' AND cpt_mot_de_passe='".$p."';";
    $resultat=$this->db->query($sql);
    if($resultat->getNumRows() > 0)
    {   
        return true;
    }
    else
    {
        return false;
    }
}

//fonction qui permet de recuperer toutes les reservations auxquelles sont inscrites $u notamment son nom, sa date, les participants....
public function recup_reservations($u){
$sql = "SELECT 
    rsr_nom, 
    rsr_date, 
    res_nom, 
    GROUP_CONCAT(cpt_pseudo SEPARATOR ', ') AS part
FROM t_reservation_rsr
JOIN t_inscription_ins USING (rsr_id)
JOIN t_compte_cpt USING (cpt_id)
JOIN t_ressource_res USING (res_id)
WHERE DATE(rsr_date) > CURDATE() 
AND rsr_id IN (
    SELECT rsr_id 
    FROM t_inscription_ins 
    JOIN t_compte_cpt USING (cpt_id)
    WHERE cpt_pseudo = '".$u."'
)
GROUP BY rsr_id, rsr_nom, rsr_date, res_nom
ORDER BY rsr_date ASC;";
    $resultat=$this->db->query($sql);
    return $resultat->getResultArray();
}

//fonction qui prend un utilisateur en argument et permet de recupérer les donnees du profil de l'utilisateur $u
public function recup_donnees_profil($u){
    $sql="SELECT pfl_nom, pfl_prenom, pfl_email, pfl_num_telephone, pfl_adresse, pfl_date_naissance, cpt_role, cpt_etat FROM t_compte_cpt JOIN t_profil_pfl USING (cpt_id) WHERE cpt_pseudo='".$u."';";
    $resultat=$this->db->query($sql);
    return $resultat->getRow();
}

//fonction qui permet de lister tous les messages en mettant tout en haut les messages qui n'ont pas de reponse   et les plus recents
public function get_all_message(){
    
    $sql="SELECT * 
FROM t_message_mes  
ORDER BY 
    (mes_reponse IS NULL OR mes_reponse = '') DESC,
    mes_date DESC; ";
    $resultat=$this->db->query($sql);
    return $resultat->getResultArray();
}


//fonction qui recupere les donnees d'un compte  en connaissant son id
public function recup_pseudo($login){
    $sql="SELECT cpt_id FROM t_compte_cpt WHERE cpt_pseudo='".$login."';";
    $resultat=$this->db->query($sql);
    return $resultat->getRow();
}

//fonction qui met à jour la réponse tapée par l'administrateur
public function ajout_reponse($code, $saisie, $id){
    $sql="UPDATE t_message_mes SET mes_reponse='".addslashes($saisie)."', cpt_id=".$id."  WHERE mes_code_genere='".$code."' ;";
    return $this->db->query($sql);
}
//permet de recuperer le statut d'un compte
public function recup_role($username){
    $sql="SELECT cpt_role FROM t_compte_cpt WHERE cpt_pseudo='".$username."';";
    $resultat=$this->db->query($sql);
    return $resultat->getRow();
}

//fonction qui liste tous les profils des membres connectés
public function get_all_member(){
    $sql="SELECT pfl_nom, pfl_prenom, pfl_email, pfl_num_telephone FROM t_profil_pfl JOIN t_compte_cpt USING (cpt_id) WHERE cpt_role='M' AND cpt_etat='A';";
    $resultat=$this->db->query($sql);
    return $resultat->getResultArray();
}

//fonction qui permet de lister toutes les ressources
public function get_all_ressources(){
    $sql="SELECT * FROM t_ressource_res;";
    $resultat=$this->db->query($sql);
    return $resultat->getResultArray();

}
//fonction qui supprime une ressource qui prend en paramètre son identifiant
public function supp_ressources($id){
    $sql="DELETE FROM t_ressource_res WHERE res_id=".$id;
    return $this->db->query($sql);
}
//fonction qui permet d'ajouter une nouvelle ressource qui prend en argument un tableau associatif
public function ajout_ressources($saisie){
    $nom=addslashes($saisie['nom']);
    $descriptif=addslashes($saisie['descriptif']);
    $jauge=addslashes($saisie['jauge']);
    $list=addslashes($saisie["liste"]);
    $sql="INSERT INTO t_ressource_res VALUES(NULL, '".$nom."', '".$descriptif."', 'Lemon.jpg', '.$jauge.', '".$list."');";
    return $this->db->query($sql);
}

//fonction qui affiche les reservations d'une date choisie groupéés par ressource
public function afficher_reservation($date_choisie)
{
    $sql = "SELECT
                t_reservation_rsr.rsr_id,
                t_reservation_rsr.rsr_nom,
                t_reservation_rsr.rsr_date,
                t_reservation_rsr.rsr_bilan_reservation,
                t_ressource_res.res_id,
                t_ressource_res.res_nom,
                t_ressource_res.res_chemin_fichier,
                t_ressource_res.res_jauge,
                GROUP_CONCAT(
                    CONCAT(t_compte_cpt.cpt_pseudo, ' (', t_inscription_ins.par_role, ')')
                    ORDER BY t_inscription_ins.par_role DESC, t_compte_cpt.cpt_pseudo
                    SEPARATOR ', '
                ) as participants
            FROM t_reservation_rsr
            LEFT JOIN t_ressource_res USING(res_id)
            LEFT JOIN t_inscription_ins USING(rsr_id)
            LEFT JOIN t_compte_cpt USING(cpt_id)
            WHERE DATE(t_reservation_rsr.rsr_date) = ?
            GROUP BY t_reservation_rsr.rsr_id
            ORDER BY t_ressource_res.res_nom ASC, t_reservation_rsr.rsr_date ASC";

    $resultat = $this->db->query($sql, [$date_choisie])->getResult();

    //Même travail que ta version précédente : regroupement par ressource
    $parRessource = [];

    foreach ($resultat as $ligne) {
        $nomRessource = $ligne->res_nom;

        if (!isset($parRessource[$nomRessource])) {
            $parRessource[$nomRessource] = [];
        }

        $parRessource[$nomRessource][] = $ligne;
    }

    return $parRessource;
}
//fonction qui permet de récupérer un pseudo et ses informations associées , classées par etat
public function get_compte(){
    $sql="SELECT cpt_pseudo, pfl_nom, pfl_prenom, pfl_email, cpt_role, cpt_etat FROM t_profil_pfl RIGHT JOIN t_compte_cpt USING (cpt_id) ORDER BY cpt_etat;";
    $resultat=$this->db->query($sql);
    return $resultat->getResultArray();
}


}
