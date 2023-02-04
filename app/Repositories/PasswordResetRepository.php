<?php

namespace App\Repositories;


use App\Models\PasswordReset;
use Exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Throwable;


/**
 *
 */
class PasswordResetRepository extends Repository
{
    /**
     * @var Builder
     */
    private Builder $model;

    /**
     *
     */
    public function __construct()
    {
        $this->model = PasswordReset::query();
    }

    /**
     * @return array|Collection
     */
    public function index(): array|Collection
    {
        return $this->model->get();
    }

    /**
     * @param array $attributes
     * @return Model|Builder
     */
    public function store(array $attributes): Builder|Model
    {
        return $this->model->create(
            attributes: $attributes
        );
    }

    /**
     * @param $uuid
     * @return Builder|Model
     * @throws Throwable
     */
    public function show($uuid): Model|Builder
    {
        $data = $this->model->with("user")->where("token", $uuid)->where("expired_at", ">=", now())->first();
        throw_unless($data, Exception::class, 'Şifrenizi güncellemek için şifremi unuttum yönergelerini izlemelisiniz !');
        return $data;
    }

    /**
     * @param $uuid
     * @return mixed
     */
    public function destroy($uuid): mixed
    {
        return $this->model->where("token", $uuid)->delete();
    }


}
