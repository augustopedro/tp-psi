<?php

namespace App\Http\DAO;
use App\Http\DAO\DAO;
use DB;
use App\Veterinario;
use Illuminate\Support\Facades\Input;

class VeterinarioDAO implements DAO
{
	public function inserir()
    {
    	$data = Input::all();
        try
        {
            DB::beginTransaction();
            $veterinario = $this->setData();
            $veterinario->save();
            DB::commit();
            return $veterinario;
        }
        catch(Exception $e)
        {
            throw new Exception($e->getMessage(), $e->getCode()); 
        }
    }
    public function consultar($id)
    {
        try
        {
        	$id = Input::get('id');
        	$veterinario = Veterinario::find($id);
            return $veterinario;

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
        	$veterinario = Veterinario::find(Input::get('id')); 
            $veterinario = $this->setData($veterinario);
            $veterinario->save();
            return $veterinario;
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
        	$veterinario = Veterinario::find($id); 
            $veterinario->status = Consts::INACTIVE;
            $veterinario->save();
            return $veterinario;
        }
        catch(Exception $e)
        {
            throw new Exception($e->getMessage(), $e->getCode()); 
        }
    }
    public function setData($veterinario='')
    {
        if(empty($veterinario))
        $veterinario = new Veterinario();    
        
        if(!empty($ctps = Input::get('ctps')))
        {
            $veterinario->ctps = $ctps;
        }
        if(!empty($cliente_id = Input::get('cliente_id')))
        {
            $veterinario->cliente_id = $cliente_id;
        }
        return $veterinario;
    }

}