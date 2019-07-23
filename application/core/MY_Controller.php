
<?php
class MY_Controller extends CI_Controller {

    protected $view_folder = 'pages/';

    function __construct(){
        parent::__construct();
    }

    public function render_html($data){
        $this->load->view($this->view_folder.$data['content'], $data);
    }

    public function render_json($response){
        header('Content-Type: application/json');
        echo json_encode($response); exit;
    }

    public function render_preview()
    {
        $input = $this->input->get('v');
        $this->load->view($input);
    }

    public function render_template($data){
        $this->load->view('patials/header');
        $this->load->view($this->view_folder.$data['content'], $data);
        $this->load->view('patials/footer');
    }
}

class Core_Controller extends MY_Controller {

    function __construct(){
        parent::__construct();
        if($this->session->admin['id'] == ''):
            redirect('/login');
        endif;
    }
}

?>
