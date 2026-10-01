<?php
namespace App\Controllers;
use App\Models\Db_model;
use CodeIgniter\Exceptions\PageNotFoundException;
class Reponse extends BaseController
{
public function __construct()
{
//...
}
public function repondre_question(){
    helper('form');

    $session=session();
    $model = model(Db_model::class);
    $login=$session->get('user');
    $statut=$model->recup_role($login);
     if (!$session->has('user')) {
        return redirect()->to('/compte/connecter');
    }
        if($statut->cpt_role=='A'){
            $data['titre'] = "Liste des messages reçus";
            $data['messages'] = $model->get_all_message();

            return view('templates/haut2', $data)
                    . view('message_a_repondre')
                    . view('templates/bas2');

        }
        else{

            return view('templates/haut_visiteur', ['titre' => 'Se connecter'])
                . view('connexion/compte_connecter')
                . view('templates/bas');
        }

    
    
    
     }


public function reponse_admin($code)
{
    helper('form');
    $session=session();
    $model = model(Db_model::class);
    $login=$session->get('user');
    $statut=$model->recup_role($login);
     if (!$session->has('user')) {
        return redirect()->to('/compte/connecter');
    }
    if($statut->cpt_role=='A'){
$data['message'] = $model->get_question_visiteur($code);
    $data['titre'] = "Répondre au message";
    // Si un formulaire est soumis
        if ($this->request->getMethod() === 'POST') {

        // Récupérer la saisie du textarea
        $saisie = $this->request->getVar('reponse');

        $compte=$model->recup_pseudo($login);
        $cpt_id=$compte->cpt_id;

        // Mise à jour de la réponse dans la base
        $model->ajout_reponse($code, $saisie, $cpt_id);

        // Afficher message de succès
        return view('templates/haut2',$data)
            . view('repondre/reponse_succes')
            . view('templates/bas2');
        }
    // Sinon : afficher le formulaire pour ce message
        else{
            return view('templates/haut2', $data)
        . view('repondre/repondre_creer')
        . view('templates/bas2');
    }
}
    else{

        return view('templates/haut_visiteur', ['titre' => 'Se connecter'])
                . view('connexion/compte_connecter')
                . view('templates/bas');
    }
    


   
}

}


