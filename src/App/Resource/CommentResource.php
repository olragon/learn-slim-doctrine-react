<?php

namespace App\Resource;

use App\Resource;

/**
 * Class Resource
 * @package App
 */
class CommentResource extends Resource
{
    protected $repository = 'App\Entity\Comment';
    protected $entityName = 'comment';
    protected $entityNamePlural = 'comments';
}