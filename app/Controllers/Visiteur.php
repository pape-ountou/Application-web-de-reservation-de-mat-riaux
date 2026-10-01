<?php
namespace App\Controllers;
use App\Models\Db_model;
use CodeIgniter\Exceptions\PageNotFoundException;
class Visiteur extends BaseController
{
    public function afficher()
    {
        $model = model(Db_model::class);
            $data['titre']= '<center>Liste de toutes les actualités</center>';

        $data['news'] = $model->get_all_actualite();
        return view('Views/menu_visiteur', $data).view('templates/bas');
    }
}
?>