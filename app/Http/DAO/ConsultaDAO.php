<?php

namespace App\Http\DAO;
use App\Http\DAO\DAO;
use DB;
use App\Consulta;
use Illuminate\Support\Facades\Input;

class ConsultaDAO implements DAO
{
	public function inserir()
    {
        try
        {
            DB::beginTransaction();
            $consulta = $this->setSubjectData();
            $consulta->save();
            DB::commit();
            return $consulta;
        }
        catch(Exception $e)
        {
            throw new Exception($e->getMessage(), $e->getCode()); 
        }
    }
    public function consultar()
    {
        try
        {
            $id = Input::get('id');
            $consulta = Consulta::find($id);
            return $consulta;
        }
        catch(Exception $e) 
        {
            throw new Exception($e->getMessage(), $e->getCode()); 
        }        
    }
    public function alterar()
    {
        $data =Input::all();    
        try
        {                                       
            $consulta = Consulta::find(Input::get('id')); 
            $consulta = $this->makeUpdate($consulta);
            $consulta->save();
            return $consulta;
        }
        catch(Exception $e) 
        {
            throw new Exception($e->getMessage(), $e->getCode()); 
        }
    }
    public function deletar($id)
    {
        try
        {
            $consulta = Consulta::find($id); 
            $consulta->status = Consts::INACTIVE;
            $consulta->save();
            return $consulta;
        }
        catch(Exception $e)
        {
            throw new Exception($e->getMessage(), $e->getCode()); 
        }
    }
    public function setData($consulta='')
    {
        if(empty($consulta))
        $consulta = new Consulta();    
        if(!empty($data = Input::get('data')))
        {
            $consulta->data = $data;
        }
        if(!empty($veterinarios_id = Input::get('veterinarios_id')))
        {
            $consulta->veterinarios_id = $veterinarios_id;
        }
        if(!empty($animals_id = Input::get('animals_id')))
        {
            $consulta->animals_id = $animals_id;
        }
        return $consulta;
    }
}
