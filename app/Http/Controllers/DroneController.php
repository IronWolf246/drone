<?php

namespace App\Http\Controllers;

use App\Models\Drone;
use Illuminate\Http\Request;


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
        return $this->drone::all();
    }

    public function insert(Request $request)
    {
        $this->validate($request, $this->rules);
        $this->drone::create($request->all());
        return 'Drone criado com sucesso!';
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, $this->rules);

        $drone = $this->drone->find($id);

        if($drone)
        {
            $drone->update($request->all());
            return 'Atualizado com sucesso!';
        }else{
            return 'Não foi possível atualizar. Drone não encontrado!';
        }
    }

    public function delete(Request $request, $id)
    {
        $drone = $this->drone->find($id);

        if($drone)
        {
            $drone->delete();
            return 'Deletado com sucesso!';
        }else{
            return 'Não foi possível deletar. Drone não encontrado!';

        }
    }

    public function paginate($limit)
    {
        return $this->drone::paginate($limit);
    }

    public function sort($field, $order)
    { 
        return $this->drone::orderBy($field, $order)->get();
    }

    public function filter($name, $status)
    { 
        return $this->drone::where('name', 'like', '%'.$name.'%')
            ->where('status', $status)
            ->get();
    }

}
