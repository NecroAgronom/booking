<?php




Class PagesController extends Controller {


    public function __construct($data = array())
    {
        parent::__construct($data);
        $this->model = new Page();
    }

    public function index()
    {

        $this->data['stadium'] = $this->model->getStadium();

    }

    public function book(){

        if( isset($this->params['0'])){
            $this->data['seat'] = $this->model->getById($this->params['0']);
            if($this->data['seat']['status'] == 2 || !$this->data['seat']){
                Router::redirect('/');
            } elseif($this->data['seat']['status'] == 0) {
                $result = $this->model->startBooking($this->params['0']);
                if(!$result){
                    Router::redirect('/');
                }
            }

        } else {
            Router::redirect('/static.html');
        }

        if($_POST['book']){
            if($this->model->getStatus($this->params['0']) == 0){
                $result = $this->model->save($_POST);
                Router::redirect('/pages/success');
            } else {
                Router::redirect('/pages/fail');
            }


        }
        if($_POST['cancel']){
            if($this->model->getStatus($this->params['0']) == 0){
                $result = $this->model->cancel($_POST['id']);
            }
            //var_dump($_POST);

            Router::redirect('/');

        }


    }


    public function admin_index(){

        $this->data['stadium'] = $this->model->adminGetStadium();

    }



    public function admin_edit(){
        if( isset($this->params['0'])){
            $this->data['seat'] = $this->model->getById($this->params['0']);
        } else {
            Router::redirect('/static.html');
        }
        if( $_POST ){

            $result = $this->model->adminSave($_POST);
            if($result){
                Router::redirect('/admin/pages');
            } else {
                Router::redirect('/static.html');
            }


        }
    }


    public function success(){

    }
    public function fail(){

    }



}

