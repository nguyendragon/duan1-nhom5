<?php 

class Load{
	

	public function __construct(){
		Session::init();
	}

	public function view($fileName, $data = false){
		if($data){
			extract($data);
		}
		include 'app/views/'.$fileName.'.php';
	}
	public function model($fileName){
		include 'app/models/'.$fileName.'.php';
		return new $fileName();
	}
	
}



?>