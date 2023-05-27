<?php

namespace App\Repositories;

use App\Models\History;
use Illuminate\Database\Eloquent\Model;

/**
 *
 */
class HistoryRepository extends Repository
{
    /**
     * @var History|Model
     */
    public Model|History $model;

    /**
     *
     */
    public function __construct()
    {
        $this->model = new History();
        parent::__construct($this->model);
    }

}
