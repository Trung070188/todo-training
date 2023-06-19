<?php

namespace App\Repositories;

use Illuminate\Support\Arr;

class BaseRepository
{
    protected $model;
    private $reflection;

    public function getByQuery($params = [])
    {
        $query = Arr::except($params,[]);
        $lModel = $this->getModel();
        if (count($query)) {
            $lModel = $this->applyFilterScope($lModel, $query)->get();
            return $lModel;
        }
        else {
            $lModel = $lModel->get();
            return $lModel;
        }
    }

    public function show($id)
    {
       return $this->getModel()->find($id);
    }
    public function create(array $data)
    {
       return $this->getModel()->create($data);

    }
    public function update($id, array $data)
    {
        $dataUpdate = $this->show($id);
        $dataUpdate->fill($data);
        $dataUpdate->save();
        return $dataUpdate;
    }
    public function delete($id)
    {
        return $this->show($id)->delete();
    }

    public function getModel()
    {
        return $this->model;
    }
    protected function applyFilterScope($lModel, array $params)
    {
        foreach ($params as $funcName => $funcParams) {
            $funcName = \Illuminate\Support\Str::studly($funcName);
            if ($this->getReflection()->hasMethod('scope' . $funcName)) {
                $funcName = lcfirst($funcName);
                $lModel = $lModel->$funcName($funcParams);
            }
        }
        return $lModel;
    }

    protected function getReflection()
    {
        if ($this->reflection) {
            return $this->reflection;
        }
        $this->reflection = new \ReflectionClass($this->getModel());
        return $this->reflection;
    }



}
