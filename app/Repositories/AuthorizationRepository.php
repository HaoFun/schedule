<?php

namespace App\Repositories;

class AuthorizationRepository extends BaseRepository
{
    public function model()
    {
        return 'App\Models\User';
    }
}
