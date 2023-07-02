<?php


namespace App\Repositories;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MovieRepository implements MovieRepositoryInterface
{
    private $model;
    private $baseModel;

    public function __construct($model)
    {
        $this->setModel($model);
    }

    public function setModel($model)
    {
        $this->model = $model;
        $this->baseModel = $model;
    }

    public function create(Request $request)
    {
        return $this->baseModel->create($request->only($this->baseModel->fillable));
    }

    public function update($id, Request $request)
    {
        return $id->update($request->only($this->baseModel->fillable));
    }

    public function delete($id)
    {
        return $id->delete();
    }

    public function where($column, $value)
    {
        return $this->baseModel->where($column, $value);
    }

    public function fWhere($column, $value)
    {
        return $this->baseModel->firstWhere($column, $value);
    }

    public function report()
    {
        return $this->model->join('tickets', 'seats.id', '=', 'tickets.seat_id')->select('number as seat_number', DB::raw('count(*) as total'))->groupByRaw('tickets.seat_id')->get();
    }
}
