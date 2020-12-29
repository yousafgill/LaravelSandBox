<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Artisan;
class SetupController extends Controller
{

     /**
     * Create a new controller instance.
     *
     * @return void
     */
     public function __construct()
     {
        // $this->middleware('auth');
     }

    public function migrations()
    {
        
        if(! defined('STDIN')) define('STDIN', fopen("php://stdin","r"));
        //Artisan::call('migrate');
        //dd('all migration run successfully');

        try 
        {
            \Artisan::call('migrate:refresh --seed');
            echo('done');
        } catch (Exception $e) {
            echo $e;
        }
    }
    public function dosymlink(){
        try
        {
            \Artisan::call('storage:link');
            echo('done');
        }
        catch(Exception $e)
        {
            echo $e;
        }
        
    }
}