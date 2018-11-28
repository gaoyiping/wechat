<?php

class setupAction extends Action {

    public function getDefaultView() {

        $request = $this->getContext()->getRequest();
        $home = $this->getContext()->getStorage()->read('home');
        print_r($home);
        $request->setAttribute("home",$home);
        return View :: INPUT;
    }

    public function execute(){

    }

    public function getRequestMethods(){
        return Request :: NONE;
    }

}

?>