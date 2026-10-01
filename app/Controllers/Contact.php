<?php
namespace App\Controllers;
use App\Models\Db_model;
use CodeIgniter\Exceptions\PageNotFoundException;
class Contact extends BaseController
{
public function __construct()
{
//...
}
public function creer()
{

    helper('form');
    $model = model(Db_model::class);


    if ($this->request->getMethod()=="POST")
        {
                if (! $this->validate([
                        'sujet' => 'required|max_length[255]|min_length[2]',
                        'question' => 'required|max_length[255]|min_length[2]',
                        'email' => 'required|valid_email|max_length[255]'
                ],
                [ // Configuration des messages d’erreurs
                'sujet' => [
                'required' => 'Veuillez entrer un sujet pour votre question !',
                'min_length' => 'Le sujet saisi est trop court !',
                ],
                'question' => [
                'required' => 'Veuillez entrer une question à votre demande !',
                'min_length' => 'La question saisie est trop courte !',
                ],
                'email' =>[
                'required' => 'Veuillez entrer un email svp !',
                'valid_email' => 'Veuillez entrer un email au bon format',
                ]
                ]
                ))
                {
                // La validation du formulaire a échoué, retour au formulaire !
                return view('templates/haut_visiteur', ['titre' => 'Rédiger le formulaire '])
                        . view('contact/creer_contact')
                        . view('templates/bas');
                }                       
                // La validation du formulaire a réussi, traitement du formulaire
                $recuperation = $this->validator->getValidated();
                $model->insert_question($recuperation);
                //Appel de la fonction créée dans le précédent tutoriel :
                $data['le_code']=$model->recup_code();
                $data['le_message']="Formulaire rempli, le message a été envoyé avac succès . Pour faire le suivi de votre demande renseigner le code suivant :";
                return view('templates/haut_visiteur', $data)
                        . view('contact/contact_succes')
                        . view('templates/bas');
        }
        
        // L’utilisateur veut afficher le formulaire pour rediger un formulaire
        return view('templates/haut_visiteur', ['titre' => 'Formulaire de contact'])
        . view('contact/creer_contact')
        . view('templates/bas');
}   
}