<?php

namespace App\Http\Controllers;

use App\Models\Drone;
use Illuminate\Http\Request;
use App\ResponseReturn\ApiReturn;


class DroneController extends Controller
{
    public $drone;

    public $rules = [
        'image' => 'required',
        'name'  => 'required|max:255',
        'address' => 'required|max:255',
        'battery' => 'required|numeric|between:0,100',
        'max_speed' => 'required|numeric',
        'average_speed' => 'required|numeric',
        'status'  => 'required'
    ];

    public function __construct()
    {
        return $this->drone = new Drone;
    }

    public function list()
    {
        // Sort
        if(request('_sort')){
            $field = request('_sort');
            $order = request('_order');
            try{
                $data = $this->drone::orderBy($field, $order)->get();
                return ApiReturn::defaultReturn(false, null, $data, 200);
            }catch(\Exception $e){
                return ApiReturn::defaultReturn(true, $e->getMessage(), null, 400);
            }
        }
        // Filter
        else if(request('name')){
            $name = request('name');
            $status = request('status');
            try{
                $data = $this->drone::where('name', 'like', '%'.$name.'%')
                ->where('status', $status)
                ->get();
                if(!$data->isEmpty()){
                    return ApiReturn::defaultReturn(false, null, $data, 200);
                }else{
                    return ApiReturn::defaultReturn(false, 'Não foi possível encontrar nenhum drone com essas informações', null, 200);
                }
            }catch(\Exception $e){
                return ApiReturn::defaultReturn(true, $e->getMessage(), null, 400);
            }
        }
        // Paginate
        else if(request('_page')){
            $page = request('_page');
            $limit = request('_limit');
            try{
                $data = $this->drone::paginate($limit, ['*'], 'page', $page);
                return ApiReturn::defaultReturn(false, null, $data, 200);
            }catch(\Exception $e){
                return ApiReturn::defaultReturn(true, $e->getMessage(), null, 400);
            }
        }

        // List All
        try{
            $data = $this->drone::all();
            return ApiReturn::defaultReturn(false, null, $data, 200);
        }catch(\Exception $e){
            return ApiReturn::defaultReturn(true, $e->getMessage(), null, 400);
        }
    }

    public function insert(Request $request)
    {
        $validator = $this->validate($request, $this->rules);
        
        try{
            $this->drone::create($request->all());
            return ApiReturn::defaultReturn(false, 'Drone criado com sucesso!', null, 201);
        }catch(\Exception $e){
            return ApiReturn::defaultReturn(true, $e->getMessage(), null, 400);
        }
    }

    public function update(Request $request, $id)
    {
        $validator = $this->validate($request, $this->rules);

        $drone = $this->drone->find($id);

        if($drone)
        {  
            try{
                $drone->update($request->all());
                return ApiReturn::defaultReturn(false, 'Atualizado com sucesso!', null, 200);
            }catch(\Exception $e){
                return ApiReturn::defaultReturn(true, $e->getMessage(), null, 400);
            }
            
        }else{
            return ApiReturn::defaultReturn(true, 'Não foi possível atualizar. Drone não encontrado!', null, 404);
        }
    }

    public function delete(Request $request, $id)
    {
        $drone = $this->drone->find($id);

        if($drone)
        {
            try{
                $drone->delete();
                return ApiReturn::defaultReturn(false, 'Deletado com sucesso!', null, 200);
            }catch(\Exception $e){
                return ApiReturn::defaultReturn(true, $e->getMessage(), null, 400);
            }

        }else{
            return ApiReturn::defaultReturn(true, 'Não foi possível deletar. Drone não encontrado!', null, 404);
        }
    }

    public function paginate($limit)
    {
        return $this->drone::paginate($limit);
    }

    public function sort($field, $order)
    {
        try{
            $data = $this->drone::orderBy($field, $order)->get();
            return ApiReturn::defaultReturn(false, null, $data, 200);
        }catch(\Exception $e){
            return ApiReturn::defaultReturn(true, $e->getMessage(), null, 400);
        }
    }

    public function filter($name, $status)
    {
        try{
            $data = $this->drone::where('name', 'like', '%'.$name.'%')
            ->where('status', $status)
            ->get();
            if(!$data->isEmpty()){
                return ApiReturn::defaultReturn(false, null, $data, 200);
            }else{
                return ApiReturn::defaultReturn(false, 'Não foi possível encontrar nenhum drone com essas informações', $data, 200);
            }
        }catch(\Exception $e){
            return ApiReturn::defaultReturn(true, $e->getMessage(), null, 400);
        }
    }

}
