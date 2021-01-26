<?php

/*
 *
 *Base Controller
 *Loads the models and views 
 * 
 */
class Controller
{
	public function model($model) // Load model file
	{
		require_once './app/models/' . $model . '.php'; //Require model file
		return new $model();
	}
	public function view($view, $data = [])
	{
		if (file_exists('./app/views/' . $view . '.php'))
			require_once './app/views/' . $view . '.php';
		else {
			die('view not found'); //if don't have view will require 403
		}
	}
}
