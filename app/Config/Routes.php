<?php

use CodeIgniter\Router\RouteCollection;
use App\Controllers\Accueil;
use App\Controllers\Compte;
use App\Controllers\Actualite;
use App\Controllers\Message;
use App\Controllers\Visiteur;
use App\Controllers\Contact;
use App\Controllers\Reponse;
/**
 * @var RouteCollection $routes
 */

$routes->get('/', [Accueil::class, 'afficher']);
$routes->get('accueil/afficher', [Accueil::class, 'afficher']);
$routes->get('accueil/afficher/(:segment)', [Accueil::class, 'afficher']);

$routes->get('compte/lister', [Compte::class, 'lister']);

$routes->get('actualite/afficher', [Actualite::class, 'afficher']);
$routes->get('actualite/afficher/(:num)', [Actualite::class, 'afficher']);

$routes->get('message/faire_suivi', [Message::class, 'faire_suivi']);
$routes->get('message/faire_suivi/(:segment)', [Message::class, 'faire_suivi']);

$routes->get('visiteur/afficher', [Visiteur::class, 'afficher']);

$routes->get('compte/creer', [Compte::class, 'creer']);
$routes->post('compte/creer', [Compte::class, 'creer']);

$routes->get('contact/creer', [Contact::class, 'creer']);
$routes->post('contact/creer', [Contact::class, 'creer']);

$routes->get('message/entrer', [Message::class, 'entrer']);
$routes->post('message/entrer', [Message::class, 'entrer']);

$routes->get('compte/connecter', [Compte::class, 'connecter']);
$routes->post('compte/connecter', [Compte::class, 'connecter']);

$routes->get('compte/afficher_reservations', [Compte::class, 'afficher_reservations']);

$routes->get('compte/adherent', [Compte::class, 'adherent']);


$routes->get('compte/deconnecter', [Compte::class, 'deconnecter']);

$routes->get('compte/afficher_profil', [Compte::class, 'afficher_profil']);

$routes->get('reponse/repondre_question', [Reponse::class, 'repondre_question']);

$routes->get('reponse/reponse_admin/(:segment)', [Reponse::class, 'reponse_admin']);
$routes->post('reponse/reponse_admin/(:segment)', [Reponse::class, 'reponse_admin']);

$routes->get('compte/gestion_ressource', [Compte::class, 'gestion_ressource']);

$routes->get('compte/ajout_ressource', [Compte::class, 'ajout_ressource']);
$routes->post('compte/ajout_ressource', [Compte::class, 'ajout_ressource']);

$routes->get('compte/supp_ressource/(:num)', [Compte::class, 'supp_ressource']);
$routes->post('compte/suup_ressource/(:num)', [Compte::class, 'supp_ressource']);


$routes->get('compte/seances', [Compte::class, 'seances']);
$routes->post('compte/seances', [Compte::class, 'seances']);




?>