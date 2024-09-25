<?php

namespace App\Repositories;

use App\Services\DatabaseService;

class BaseRepository
{
    /**
     * The database service instance.
     *
     * @var DatabaseService
     */
    protected DatabaseService $databaseService;
    public function __construct(){
        $this->databaseService = new DatabaseService();
    }
}