<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
error_reporting(E_ALL ^ E_NOTICE);
/**
 * 테이블 관리 어드민 스캐폴더 추상 클래스
//-----------define fields-------------------------------------------
// title : 필드 이름
// type : input, now(현재시간)
// rule : required, integer
// non_editable : 수정 가능 여부
// is_key : primary key 여부
//-------------------------------------------------------------------
 */

abstract class Scaffolder extends CI_Controller
{
    var $data = array();
    var $is_https_request = false;
    var $login_user_email = '';


    abstract function _init();
    abstract function _list_db_get();
    abstract function _edit_db_get();
    abstract function _delete_from_db();

    public function __construct()
    {
        parent::__construct();

        $this->layout = 'default_bt';
        if(!$_GET['ajax']){
            $this->yield = true;
        }else{
            $this->yield = false;
        }

        $this->type = "admin" ;

        // $uri_s = uri_string();
        $no_val =  $this->uri->segment(4);

        $no = preg_replace("/[^0-9]*/s", "", $no_val);
        $_GET['no'] = $no;
        $_GET['idx_cum'] = $this->onlyHanAlpha($no_val);


        $this->data['one_page'] = true; // 페이징이 없는 한 페이지짜리가 기본값
        $this->data['enable_add'] = true;
        $this->data['edit_btn_name'] = "수정";

        $this->_init();

        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<li>', '</li>');
        $this->form_validation->set_message('required', '%s(은)는 필수 입력 항목입니다.');
        $this->form_validation->set_message('integer', '%s(은)는 숫자를 입력해야합니다.');
        $this->form_validation->set_message('valid_email', '이메일 형식이 맞지 않습니다.');
        $this->form_validation->set_message('is_unique', '%s가 이미 존재합니다.');
        $this->form_validation->set_message('valid_ip', '유효한 아이피 형식이 아닙니다.');

        foreach($this->data['fields'] as $field_key => $field_val) {
            $this->form_validation->set_rules($field_key, $field_val['title'], $field_val['rule']);
        }


        // $this->output->enable_profiler(TRUE);

        //템플릿언더바 로드
        $this->load->library('display');

    }

    public function index()
    {

        $this->load->view('_scaffolder_list', $this->data );

    }

    public function add()
    {
        $this->yield = false;
        $this->load->view('_scaffolder_add',$this->data );

    }

    public function add_action()
    {
        if($this->form_validation->run())
        {
            if($this->_add_to_db()) {
                
                echo json_encode(array('error' => null, 'messages' => array('Success')));
                exit;
            } else {
                echo json_encode(array('error' => 'error', 'messages' => array("생성 도중 DB 오류가 발생하였습니다.".$this->db->_error_message() )));
                exit;
            }
        }
        else
        {
            echo json_encode(array('error' => 'error', 'messages' => validation_errors()));
            exit;
        }
    }

    public function add_action_https()
    {
        $this->is_https_request = true;
        if(!$this->form_validation->run()){
            $this->_send_json2('error', 'VALIDATION ERROR:'.validation_errors());
        }
        if(!$this->_add_to_db()) {
            $this->_send_json2('error', array("생성 도중 DB 오류가 발생하였습니다. " . $this->db->_error_message() ));
        }
        $this->_send_json2(null, array('Success'));
    }

    public function _add_to_db($table)
    {
        $add_data = array();

        foreach($this->data['fields'] as $key => $val)
        {
            if($val['custom_field']) {
                continue;
            }

            if($val['is_key']) {
                $add_data[$key] = null;
            } else if($val['type']=='now') {
                $add_data[$key] = date('Y-m-d H:i:s');
            } else if($val['type']=='password') {
                $add_data[$key] = md5($_POST[$key]);
                // $add_data[$key] = hash("sha256" , $_POST[$key]); //유저디비 생성시 sha256으로 생성 by now17
            } else {
                if($_POST[$key]==null) {
                    $_POST[$key] = $val['default_value'];
                }
                $add_data[$key] = $_POST[$key];
            }
        }


 

        return $this->db->insert($table, $add_data);
    }

    public function edit()
    {
        $this->yield = false;
        $this->data['rows'] = $this->_edit_db_get();
        $this->data['is_edit'] = true;

        $this->load->view('_scaffolder_add',$this->data );

    }

    public function edit_action()
    {
        if($this->form_validation->run())
        {
            if($this->_edit_from_db()) {
                echo json_encode(array('error' => null, 'messages' => array('Success')));
                exit;
            } else {
               echo json_encode(array('error' => 'error', 'messages' => array("수정 도중 DB 오류가 발생하였습니다.")));
                exit;
            }
        }
        else
        {
            echo json_encode(array('error' => 'error', 'messages' => 'VALIDATION ERROR:'.validation_errors()));
            exit;
        }
    }

    public function edit_action_https()
    {
        $this->is_https_request = true;

        if(!$this->form_validation->run()){
            $this->_send_json2('error', 'VALIDATION ERROR:'.validation_errors());
        }
        if(!$this->_edit_from_db()) {
            $this->_send_json2('error', array("수정 도중 DB 오류가 발생하였습니다."));
        }
        $this->_send_json2(null, array('Success'));
    }

    public function _edit_from_db($table)
    {
        $upd_data = array();
        foreach($this->data['fields'] as $key => $val)
        {
            if($val['is_key'] || $val['uneditable'] || $val['custom_field'])
                continue;

            if($val['type']=='now') {
                $upd_data[$key] = date('Y-m-d H:i:s');
            } else {
                $upd_data[$key] = $_POST[$key];
            }
        }
        $this->db->where('no', $_POST['no']);


        return $this->db->update($table, $upd_data);
    }

    public function delete_action()
    {
        if($this->_delete_from_db()) {
            echo json_encode(array('error' => null, 'messages' => array('Success')));
        } else {
            echo json_encode(array('error' => 'error', 'messages' => array("삭제 도중 DB 오류가 발생하였습니다.")));
        }
        exit;
    }

    public function _send_result($error, $msg='')
    {
        $result = array();
        $result['messages'] =$msg;

        if($error === true){
            $result['error'] = true;
        }else{
            $result['error'] = null;
        }

        echo json_encode($result);
        exit;
    }

    public function _send_json($items) {
        if($items['data']){

            echo json_encode(array('error' => null, 'items' => $items['data'], 'pagehtml' => $items['pagehtml'], 'total' => $items['total'], 'listnum' => $items['listnum'], 'page' => $items['page']));
            exit;
        }else {
            echo json_encode(array('error' => null, 'items' => $items));
            exit;
        }
    }

    public function _send_json2($error, $msg)
    {
        /*
        * _send_result와 _send_json 메소드가 이미 있는데
        * 각각 리턴 포멧이 다르다. 또한 같은 이름의 메소드가
        * 현재 프로젝트에 하나 이상 존재하고 호출되는 지점이 상이하여
        * 의존성 및 사이드 이펙트를 예상하기 어려워 기존 메소드를 수정하지 않고 _send_json2 로 새로 만들었다.
        * 2016-04-15 by choyeah
        */

        $return = json_encode(array('error' => $error, 'messages' => $msg));

        if($this->is_https_request){
            echo 'myCallback(' . $return . ');' ;
        }else{
           echo $return;
        }
        exit;
    }

    function _listPageingRow($table,$where,$orderby="",$page='',$listnum='',$key="",$search="" ,$cum="*",$tn1='')
    {
        $DB = $this->db;
        $tpl = $this->display;



        //페이징
        if (!$_GET['limit']) {
            $limit = 12;
        } else {
            $limit = $_GET['limit'];
        }

        if($listnum) $limit = $listnum;



        if ($_GET['per_page'] != '') {
            $page = $_GET['per_page'];
        } else {
            $page = "0";
        }




        if ($page > 0) $page = ($page / $limit) + 1;

        if ($where) $where = " where " . $where;

        if ($key && $search) {
            if ($where) {
                $whereadd = " AND $key LIKE '%$search%'";
            } else {
                $whereadd = " where $key LIKE '%$search%'";
            }
        }

        if ($_GET['keyword']) {

            $frow = $this->data['fields'];
            if($this->data['fields_master']) $frow =$this->data['fields_master'];
            if ($where) {
                if(strtolower(substr($where,-2)) == "or"){
                    $whereadd = "  (";
                }else{
                    $whereadd = " AND  (";
                }

            } else {
                $whereadd = " where  (";
            }




            foreach ($frow as $val => $value) {
                $val_ = $val;

                if(!$value['no_keyword']){
                    if (!strstr($val, '[]')) {
                        if ($tn1) {
                            $val_ = $tn1 . ".`" . $val . "`";
                        } else {
                            $val_ = " `" . $val . "`";
                        }
                        if (!$tds) {
                            $whereadd .= "  " . $val_ . " LIKE '%" . $_GET['keyword'] . "%'";
                            $tds++;
                        } else {
                            $whereadd .= " or " . $val_ . " LIKE '%" . $_GET['keyword'] . "%'";
                        }
                    }
                }

            }



            if($cum !="*") {
                $frow = explode(",",$cum);
                for($ii=0; $ii<count($frow); $ii++) {
                    $val_ = $frow[$ii];
                    if (!strstr($val_, '*') ) {
                        if(!strstr($val_, ' as ')) {
                            $whereadd .= " or " . $val_ . " LIKE '%" . $_GET['keyword'] . "%'";
                        }else{
                            $val_s = explode(" as ",$val_);
                            $whereadd .= " or " . trim($val_s[0]) . " LIKE '%" . $_GET['keyword'] . "%'";
                        }
                    }

                }

            }

            $whereadd .=") ";
        }



        foreach( $_GET as $val => $value ){
            if(strstr($val,"sch_")){
                if($where || $whereadd){
                    if($value !="") $add_where .=  " and ".str_replace("sch_","",$val)." = '$value' ";
                }else{
                    if($value !="") $add_where .=  " where ".str_replace("sch_","",$val)." = '$value' ";
                }
                $tpl->assign(array($val =>$value));
            }

            if(strstr($val,"like_")){
                if($where || $whereadd){
                    if($value !="") $add_where .=  " and ".str_replace("like_","",$val)." like '%$value%' ";
                }else{
                    if($value !="") $add_where .=  " where ".str_replace("like_","",$val)." like '%$value%' ";
                }
                $tpl->assign(array($val =>$value));
            }

            if(strstr($val,"time_s_")){
                if($where || $whereadd){
                    if($value !="") {

                        $add_where .=  " and ".str_replace("time_s_","",$val)." >= '".$this->mkday($value)."' ";
                    }
                }else{
                    if($value !="") {
                        $add_where .=  " where ".str_replace("time_s_","",$val)." >= '".$this->mkday($value)."' ";
                    }
                }
                $tpl->assign(array($val =>$value));
            }

            if(strstr($val,"time_e_")){
                if($where || $whereadd){
                    if($value !="") {

                        $add_where .=  " and ".str_replace("time_e_","",$val)." <= '".($this->mkday($value)+86400)."' ";
                    }
                }else{
                    if($value !="") {
                        $add_where .=  " where ".str_replace("time_e_","",$val)." <= '".($this->mkday($value)+86400)."' ";
                    }
                }
                $tpl->assign(array($val =>$value));
            }
        }

        $sql = "select count(*) from ".$table." $where $whereadd $add_where  ";
        $total = $DB->sqlFetchOne($sql);

        if(!$total) $total = 0;
        if (!$page) $page = 1;

        $seek = $limit * ($page - 1);
        $offset = $seek + $limit;

        $sql = " select ".$cum." from ".$table." $where $whereadd $add_where  $orderby LIMIT $seek , $limit  ";

        $data = $DB->sqlFetchAll($sql);


        for($ii=0; $ii<count($data); $ii++) {
            $data[$ii][num] = $total - $seek - $ii;
        }

        $redata['page'] = $page;
        $redata['total'] = $total;
        $redata['listnum'] = $limit;
        $redata['data'] = $data;

        $this->load->library('pagination');

        $GET_sq = $_GET;
        unset($GET_sq['per_page']);
        $rqs = http_build_query($GET_sq);
        if($rqs){
            $uris = $this->uri->segment('')."?".$rqs;
        }else{
            $uris = $this->uri->segment('');
        }

        $config['base_url'] = $uris;

        $config['page_query_string'] = TRUE;

        $config['total_rows'] = $total;
        $config['per_page'] = $limit;

        $config['full_tag_open'] = '<nav><ul class="pagination box  box-shadow">';
        $config['full_tag_close'] = '</ul><nav>';

        $config['first_tag_open'] = '<li>';
        $config['first_link'] = '<span aria-hidden="true">«</span>';
        $config['first_tag_close'] = '</li>';

        $config['last_tag_open'] = '<li>';
        $config['last_link'] = '<span aria-hidden="true">»</span>';
        $config['last_tag_close'] = '</li>';

        $config['next_tag_open'] = '<li>';
        $config['next_link'] = '다음';
        $config['next_tag_close'] = '</li>';

        $config['prev_tag_open'] = '<li>';
        $config['prev_link'] = '이전';
        $config['prev_tag_close'] = '</li>';

        $config['cur_tag_open'] = ' <li class="active"><a>';
        $config['cur_tag_close'] = '</a></li>';

        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';

        $this->pagination->initialize($config);
        $pagehtml = $this->pagination->create_links();;
        $redata['pagehtml'] = $pagehtml;
        $redata['uris'] = $uris;




        return $redata;

    }



    public function _page_link($base_url = '', $total_rows = 1000, $page_row_count = 20)
    {
        $this->load->library('pagination');
        // $config['base_url'] = 'http://example.com/index.php/test/page/';
        // $config['total_rows'] = 1000;
        // $config['page_row_count'] = 20;
        $config['base_url'] = $base_url;
        $config['total_rows'] = $total_rows;
        $config['page_row_count'] = $page_row_count;
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';
        $config['prev_tag_open'] = '<li>';
        $config['prev_tag_close'] = '</li>';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['first_link'] = '<span class="glyphicon glyphicon-step-backward"></span>';
        $config['last_link'] = '<span class="glyphicon glyphicon-step-forward"></span>';
        $config['prev_link'] = '<span class="glyphicon glyphicon-chevron-left"></span>';
        $config['next_link'] = '<span class="glyphicon glyphicon-chevron-right"></span>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a href="#'.$this->data['schema']['id'].'/index?page='.$this->input->get_post('page').'">';
        $config['cur_tag_close'] = '</a></li>';
        $config['uri_segment'] = 4;
        $config['use_page_numbers'] = TRUE;
        $config['page_query_string'] = TRUE;
        $config['query_string_segment'] = 'page';
        $this->pagination->initialize($config);
        return $this->pagination->create_links();
    }

    function onlyHanAlpha($subject) {

        $pattern = '/([\xEA-\xED][\x80-\xBF]{2}|[a-zA-Z])+/';
        preg_match_all($pattern, $subject, $match);
        return implode('', $match[0]);
    }

}