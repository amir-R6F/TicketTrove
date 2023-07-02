<?php


namespace App\Repositories;
use Illuminate\Http\Request;

interface MovieRepositoryInterface
{
    public function setModel($model);
    public function create(Request $request);
    public function update($id, Request $request);
    public function delete($id);
    public function where($column, $value);
    public function fWhere($column, $value);
    public function report();
}
