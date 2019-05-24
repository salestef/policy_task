<?php

class Home extends Controller {

    /**
     * Application default home controller and default index method.
     */
	public function index(){
        $this->view('policies/input');
        return true;
    }
	
}