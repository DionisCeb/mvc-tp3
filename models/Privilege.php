<?php
namespace App\Models;
use App\Models\DB\CRUD;

/**
 * Le modèle pour récupérer l'identifiant de privilège
 */
class Privilege extends CRUD{
    protected $table = "privilege";
    protected $primaryKey = "id";
}