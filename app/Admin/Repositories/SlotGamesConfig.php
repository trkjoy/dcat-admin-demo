<?php

namespace App\Admin\Repositories;

use App\Models\SlotGamesConfig as Model;
use Dcat\Admin\Repositories\EloquentRepository;

class SlotGamesConfig extends EloquentRepository
{
    /**
     * Model.
     *
     * @var string
     */
    protected $eloquentClass = Model::class;



}
