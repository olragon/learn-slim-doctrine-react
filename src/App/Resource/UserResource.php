<?php

namespace App\Resource;

use App\Resource;

/**
 * Class Resource
 * @package App
 */
class UserResource extends Resource
{
    protected $repository = 'App\Entity\User';
    protected $entityName = 'user';
    protected $entityNamePlural = 'users';
}