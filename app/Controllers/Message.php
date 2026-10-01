<?php
namespace App\Controllers;
use App\Models\Db_model;
use CodeIgniter\Exceptions\PageNotFoundException;
class Message extends BaseController
{
public function __construct()
{
//...
}
public function faire_suivi($code=null)
{
    $model = model(Db_model::class);
    if ($code===null)
    {
        return redirect()->to('/');
    }
    else{
        $data['titre']="Suivi de votre message";
        $data['mes'] = $model->get_question_visiteur($code);
        return view('templates/haut_visiteur', $data)
        . view('affichage_message')
        . view('templates/bas');
    }
    
}
public function entrer()
{
        helper('form');
        $model = model(Db_model::class);
        // L’utilisateur a validé le formulaire en cliquant sur le bouton
        if ($this->request->getMethod()=="POST")
        {
                if (! $this->validate([
                        'code' => 'required|max_length[20]|min_length[20]|is_not_unique[t_message_mes.mes_code_genere]',
                ],
                [ // Configuration des messages d’erreurs
                'code' => [
                'required' => 'Veuillez entrer un code pour letat de votre demande !',
                'min_length' => 'Le code saisi doit être de 20 caractères !',
                'max_length'  => 'Ce code saisi doit être de 20 caractères !',
                'is_not_unique'=> 'Le code fourni n//existe pas',
                ],
                ]
                ))
                {
                // La validation du formulaire a échoué, retour au formulaire !
                return view('templates/haut_visiteur', ['titre' => 'Renseigner votre code de suivi'])
                        . view('message/suivi_message')
                        . view('templates/bas');
                }                       
                // La validation du formulaire a réussi, traitement du formulaire
                $recuperation = $this->validator->getValidated();
               $mes=$model->get_question($recuperation);
               $data = [
                'titre' => 'Suivi de votre message',
                'mes'   => $mes
            ];

                return view('templates/haut_visiteur', $data)
                        . view('affichage_message.php')
                        . view('templates/bas');
        }
        
        // L’utilisateur veut afficher le formulaire pour créer un compte
        return view('templates/haut_visiteur', ['titre' => 'Suivi de message'])
        . view('message/suivi_message')
        . view('templates/bas');
}
}