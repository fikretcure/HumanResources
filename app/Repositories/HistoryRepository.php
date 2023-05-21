<?php

namespace App\Repositories;

use App\Enums\RouteName;
use App\Models\History;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

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

    /**
     * @param $status
     * @return mixed
     */
    public function create($status = 1): mixed
    {
        return $this->model->create([
            'data' => json_encode([
                'route' => RouteName::statusNote(),
                'request' => request()->all(),
                'url' => request()->url()
            ]),
            'user_id' => Auth::id(),
            'status' => $status
        ]);
    }

}
