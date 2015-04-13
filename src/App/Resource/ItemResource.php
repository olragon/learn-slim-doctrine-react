<?php

namespace App\Resource;

use App\Resource;

/**
 * Class Resource
 * @package App
 */
class ItemResource extends Resource
{
    protected $repository = 'App\Entity\Item';
    protected $entityName = 'item';
    protected $entityNamePlural = 'items';
}