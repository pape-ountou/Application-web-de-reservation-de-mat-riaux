<?php
namespace App\Controllers;
use App\Models\Db_model;
use CodeIgniter\Exceptions\PageNotFoundException;
class Compte extends BaseController
{
public function __construct()
{
//.
}
public function lister()
{
        $session=session();
        helper('form');
        $model = model(Db_model::class);
        $login=$session->get('user');
        $statut=$model->recup_role($login);
 if (!$session->has('user')) {
        return redirect()->to('/compte/connecter');
    }
        
        if($statut->cpt_role=='A'){
        $data['titre']="Liste de tous les comptes/profils";
        $data['logins'] = $model->get_compte();
        //$data['nombre_de_comptes']=$model->get_number_compte();
        return view('templates/haut2', $data)
        . view('connexion/gestion_compte')
        . view('templates/bas2');
        }
        else{
             return view('templates/haut_visiteur', ['titre' => 'Se connecter'])
                . view('connexion/compte_connecter')
                . view('templates/bas');   
        }
       
}
public function creer()
{
        helper('form');
        $model = model(Db_model::class);
        $session=session();
        $login=$session->get('user');
        $statut=$model->recup_role($login);
        
     if ($statut->cpt_role!='A') {
        return redirect()->to('/compte/connecter');
    }
        // L’utilisateur a validé le formulaire en cliquant sur le bouton
        if ($this->request->getMethod()=="POST")
        {
                if (! $this->validate([
                        'pseudo' => 'required|max_length[255]|is_unique[t_compte_cpt.cpt_pseudo]',
                        'mdp' => 'required|max_length[255]|'
                ],
                [ // Configuration des messages d’erreurs
                'pseudo' => [
                'required' => 'Veuillez entrer un pseudo pour le compte !',
                'is_unique'  => 'Ce compte existe déjà !'
                ],
                'mdp' => [
                'required' => 'Veuillez entrer un mot de passe !',
                ],
                ]
                ))
                {
                // La validation du formulaire a échoué, retour au formulaire !
                return view('templates/haut2', ['titre' => 'Créer un compte'])
                        . view('compte/compte_creer')
                        . view('templates/bas2');
                }                       
                // La validation du formulaire a réussi, traitement du formulaire
                $recuperation = $this->validator->getValidated();
                $model->set_compte($recuperation);
                $data['le_compte']=$recuperation['pseudo'];
                $data['le_message']="Nouveau nombre de comptes : ";
                //Appel de la fonction créée dans le précédent tutoriel :
                $data['le_total']=$model->get_number_compte();
                return view('templates/haut2', $data)
                        . view('compte/compte_succes')
                        . view('templates/bas2');
        }

        
else{
 // L’utilisateur veut afficher le formulaire pour créer un compte
        return view('templates/haut2', ['titre' => 'Créer un compte'])
        . view('compte/compte_creer')
        . view('templates/bas2');
}
       
}
public function connecter(){
        helper('form');
        $model = model(Db_model::class);
        // L’utilisateur a validé le formulaire en cliquant sur le bouton
        if ($this->request->getMethod()=="POST"){
                if (! $this->validate([
                        'pseudo' => 'required',
                        'mdp' => 'required'
                ],[ // Configuration des messages d’erreurs
                        'pseudo' => [
                        'required' => 'Veuillez entrer un mettre un pseudo pour vous connecter!',
                
                        ],
                        'mdp' => [
                        'required' => 'Veuillez entrer un mot de passe pour vous connecter',
                ],
                ]
                ))
                
                { // La validation du formulaire a échoué, retour au formulaire !
                        return view('templates/haut_visiteur', ['titre' => 'Se connecter'])
                                . view('connexion/compte_connecter')
                                . view('templates/bas');
                }       
                // La validation du formulaire a réussi, traitement du formulaire
                $username=$this->request->getVar('pseudo');
                $password=$this->request->getVar('mdp');
                 // Hasher le mot de passe de la même manière que le trigger
                $salt = 'Monmotdepasse'; // Doit être identique au trigger
                $password_hash = hash('sha256', $salt . $password);
                if ($model->connect_compte($username,$password_hash)==true)
                {

                $session=session();
                $session->set('user',$username);
                 
                return    redirect()->to('/compte/afficher_reservations');
                                /*view('templates/haut2',$data)
                        . view('connexion/compte_accueil')
                        . view('templates/bas2');*/
                }
                else
                {

                return view('templates/haut_visiteur', ['titre' => 'Se connecter',
                                                        'message'=> 'identifiant incorrect ou inexistant !'])
                        . view('connexion/compte_connecter')
                        . view('templates/bas');
                }
        }
        // L’utilisateur veut afficher le formulaire pour se connecter
        return view('templates/haut_visiteur', ['titre' => 'Se connecter'])
                . view('connexion/compte_connecter')
                . view('templates/bas');
}

public function afficher_reservations(){
        helper('form');
        $model = model(Db_model::class);
        $session=session();
        if($session->has('user'))
        {
                $data['titre']="Liste de mes reservations à venir";
                $login=session()->get('user');
                $statut=$model->recup_role($login);
                if($statut->cpt_role=='A' ){
                        $data['reservations'] = $model->recup_reservations($login);
                        return  view('templates/haut2',$data)
                        . view('connexion/compte_accueil')
                        . view('templates/bas2');
                }
                else if($statut->cpt_role=='M'){
                        $data['reservations'] = $model->recup_reservations($login);
                        return  view('templates/haut3',$data)
                        . view('connexion/compte_accueil')
                        . view('templates/bas3');

                }
                else {
                        $data['reservations'] = $model->recup_reservations($login);
                        return  view('templates/haut_invite',$data)
                        . view('connexion/compte_accueil')
                        . view('templates/bas3');
                }
        }
        else{
                return view('templates/haut_visiteur', ['titre' => 'Se connecter'])
                . view('connexion/compte_connecter')
                . view('templates/bas');
        }
}
public function afficher_profil()

{  
              helper('form');
        $model = model(Db_model::class);
        $session=session();
        if ($session->has('user'))
        {
                $username = $session->get('user');
        // Récupération des données du profil
                $data['profil'] = $model->recup_donnees_profil($username);
                $data['le_message']="Affichage des données du profil ici !!!";
                 $statut=$model->recup_role($username);
                 if($statut->cpt_role=='A' ){
                        $data['profil'] = $model->recup_donnees_profil($username);
                        return  view('templates/haut2',$data)
                        . view('connexion/compte_profil')
                        . view('templates/bas2');
                }
                else if($statut->cpt_role=='M'){
                        $data['profil'] = $model->recup_donnees_profil($username);
                        return  view('templates/haut3',$data)
                        . view('connexion/compte_profil')
                        . view('templates/bas3');

                }
                else {
                         $data['profil'] = $model->recup_donnees_profil($username);
                        return  view('templates/haut_invite',$data)
                        . view('connexion/compte_profil')
                        . view('templates/bas3');
                }
       
}
else{
        return view('templates/haut_visiteur', ['titre' => 'Se connecter'])
                . view('connexion/compte_connecter')
                . view('templates/bas');
}
}

public function adherent(){
        helper('form');
        $model = model(Db_model::class);
        $session=session();
        if(!$session->has('user')){
                
        return redirect()->to('/compte/connecter');
    
        }
        $login=$session->get('user');
        $statut=$model->recup_role($login);
        if($statut->cpt_role=='M'){
        $data['titre']="Liste de tous les adhérents";
        $data['adherent'] = $model->get_all_member();
                return view('templates/haut3', $data)
                . view('afficher_adherent')
                . view('templates/bas3');

        }
        else{
                return view('templates/haut_visiteur', ['titre' => 'Se connecter'])
                . view('connexion/compte_connecter')
                . view('templates/bas');
        }
        
}

public function gestion_ressource(){
        $session=session();
        helper('form');
        $model = model(Db_model::class);
        
        if(!$session->has('user')){
                
        return redirect()->to('/compte/connecter');
    
        }
        $login=$session->get('user');
        $statut=$model->recup_role($login);
        if($statut->cpt_role=='A'){
                $data['titre']="Liste de toutes les ressources reservables";
                $data['ressource']=$model->get_all_ressources();
                return view('templates/haut2', $data)
                        .View('afficher_ressource')
                        .view('templates/bas2');
        }
        else{
                return view('templates/haut_visiteur', ['titre' => 'Se connecter'])
                . view('connexion/compte_connecter')
                . view('templates/bas');
        }
}
public function supp_ressource($id){
        $session=session();
        helper('form');
        $model = model(Db_model::class);
        if(!$session->has('user')){ 
        return redirect()->to('/compte/connecter');
        }
        $login=$session->get('user');
        $statut=$model->recup_role($login);
        if($statut->cpt_role=='A'){
                $data['supp']=$model->supp_ressources($id);
        // Récupérer la liste des ressources mise à jour
                $data['ressource'] = $model->get_all_ressources();
                return view('templates/haut2', $data)
                        .View('afficher_ressource')
                        .view('templates/bas2');

        }
        else{
                return view('templates/haut_visiteur', ['titre' => 'Se connecter'])
                . view('connexion/compte_connecter')
                . view('templates/bas');
        }


}
public function ajout_ressource(){
         helper('form');
        $model = model(Db_model::class);
        $session=session();
        $login=$session->get('user');
        $statut=$model->recup_role($login);
        
     if ($statut->cpt_role!='A') {
        return redirect()->to('/compte/connecter');
    }
        // L’utilisateur a validé le formulaire en cliquant sur le bouton
        if ($this->request->getMethod()=="POST")
        {
                if (! $this->validate([
                        'nom' => 'required|max_length[255]|is_unique[t_ressource_res.res_nom]',
                        'descriptif' => 'required|max_length[255]',
                        'jauge' => 'required|integer|greater_than[0]',
                        'liste' => 'required|max_length[255]'
                ],
                [ // Configuration des messages d’erreurs
                'nom' => [
                'required' => 'Veuillez entrer un nom pour la ressource !',
                'is_unique'  => 'Ce nom de ressource existe deja !.'
                ],
                'descriptif' => [
                'required' => 'Veuillez entrer un descriptif de la ressource  !',
                ],
                'jauge' => [
                'required' => 'Veuillez entrer un jauge max de la ressource  !',
                'integer' => 'La jauge doit être un nombre entier !',
                'greater_than' => 'La jauge doit être supérieure à 0 !'
                ],
                'liste' => [
                'required' => 'Veuillez entrer une liste de materiels à reserver  !',
                ],
                ]
                ))
                {
                // La validation du formulaire a échoué, retour au formulaire !
                return view('templates/haut2', ['titre' => 'Ajouter une ressource'])
                        . view('ressource/ressource_creer')
                        . view('templates/bas2');
                }                       
                // La validation du formulaire a réussi, traitement du formulaire
                $recuperation = $this->validator->getValidated();
                $recuperation['chemin'] = 'public/bootstrap2/img/Lemon.jpg';
                 $model->ajout_ressources($recuperation);
                //Appel de la fonction créée dans le précédent tutoriel :
                $data['le_message']="Ajout d'une nouvelle ressource effectuée avec succés";
                return view('templates/haut2', $data)
                        . view('ressource/ressource_succes')
                        . view('templates/bas2');
        }

else{
 // L’utilisateur veut afficher le formulaire pour créer un compte
        return view('templates/haut2', ['titre' => 'ajouter une reservation'])
        . view('ressource/ressource_creer')
        . view('templates/bas2');
}
}
public function seances()
{
    helper('form');
    $model = model(Db_model::class);
    $session = session();

    // 🔒 Vérification connexion
    if (!$session->has('user')) {
        return view('templates/haut_visiteur', ['titre' => 'Se connecter'])
            . view('connexion/compte_connecter')
            . view('templates/bas');
    }

    $login = $session->get('user');
    $statut = $model->recup_role($login);

    // Valeurs par défaut
    $data['titre'] = "Séances Réservées";
    $data['date_selectionnee'] = "";
    $data['reservations_par_ressource'] = [];
    $data['date_actuelle'] = date('Y-m-d');

    // Si POST
    if ($this->request->getMethod() == "POST") {

        //  Si validation échoue → afficher seulement le formulaire + erreurs
        if (!$this->validate(['date' => 'required|valid_date'])) {

            if ($statut->cpt_role == 'A') {
                return view('templates/haut2', $data)
                    . view('seance_reservee')
                    . view('templates/bas2');
            }

            if ($statut->cpt_role == 'M') {
                return view('templates/haut3', $data)
                    . view('seance_reservee')
                    . view('templates/bas3');
            }

            // Rôle inconnu → déconnexion
            return view('templates/haut_visiteur', ['titre' => 'Se connecter'])
                . view('connexion/compte_connecter')
                . view('templates/bas');
        }

        // ✔️ Validation OK → traitement
        $recup = $this->validator->getValidated();
        $data['date_selectionnee'] = $recup['date'];
        $data['date_affichage'] = date('d/m/Y', strtotime($recup['date']));
        $data['reservations_par_ressource'] = $model->afficher_reservation($recup['date']);
    }

    // ✔️ CHOIX DU TEMPLATE SELON RÔLE
    if ($statut->cpt_role == 'A') {
        return view('templates/haut2', $data)
            . view('seance_reservee')
            . view('templates/bas2');
    }

    if ($statut->cpt_role == 'M') {
        return view('templates/haut3', $data)
            . view('seance_reservee')
            . view('templates/bas3');
    }

    // Sinon → visiteur
    return view('templates/haut_visiteur', ['titre' => 'Se connecter'])
        . view('connexion/compte_connecter')
        . view('templates/bas');
}


public function deconnecter()
{        helper('form');
        $session=session();
        $session->destroy();
        return view('templates/haut_visiteur', ['titre' => 'Se connecter'])
                . view('connexion/compte_connecter')
                . view('templates/bas');
        }
}