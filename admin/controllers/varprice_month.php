<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once 'scaffolder.php';

class Varprice_month extends Scaffolder {

    var $table_tn = "iiop_varprice_month";
    var $db_id = "varprice_month";
    var $db_name = "월별 가격";

    function __construct() {
        parent::__construct();


        //레이아웃 파일 설정
        $this->layout = 'default_bt';

        $this->type = "admin" ;
        check_session();
        $this->left = 'left3' ;



        $this->param = $this->input->post(NULL, true);
    }
    
    public function _init()
    {

        $this->data['schema']['id'] = $this->db_id;
        $this->data['schema']['name'] = $this->db_name;

        //$this->data['one_page'] = true;
        //$this->data['enable_add'] = false;
        $this->data['width'] = '1200px';
        $this->data['style'] = 'margin:0 auto';
        $this->data['top_text'] = '월을 지정하여 해당 날짜에 가격과 가격명을 정합니다.';
        $this->data['top_text_subject'] = '안내';

        $price_names = array(
            ''=>'-- 가격명 선택 --',
            '비수기'=>'비수기',
            '준성수기'=>'준성수기',
            '성수기'=>'성수기',

            );


        $years = array(
            '2017'=>'2017',
            '2018'=>'2018',
            '2019'=>'2019',
            '2020'=>'2020',

            );

        $months = array(
            '01'=>'01',
            '02'=>'02',
            '03'=>'03',
            '04'=>'04',
            '05'=>'05',
            '06'=>'06',
            '07'=>'07',
            '08'=>'08',
            '09'=>'09',
            '10'=>'10',
            '11'=>'11',
            '12'=>'12',
        );
        //-----------define fields-------------------------------------------
        // 속성값은 scaffoler.php의 상단 주석 참고.
        //-------------------------------------------------------------------
        $this->data['fields'] = array(
            'year'=>array('title'=>'년','type'=>'select','options' => $years, 'rule'=>'required', 'list_hide'=>false,'list_style'=>'text-align:center;color:blue','label'=>'년'),
            'month'=>array('title'=>'월','type'=>'select','options' => $months, 'rule'=>'required', 'list_hide'=>false,'list_style'=>'text-align:center;color:blue','label'=>'월'),
            'price_name'=>array('title'=>'구분','type'=>'select','options' => $price_names,'list_style'=>'text-align:center;width:200px','rule'=>'required'),
            'price'=>array('title'=>'가격(주중)','type'=>'number','list_style'=>'text-align:center;width:300px','label'=>'원','rule'=>'required','placeholder'=>'000,000'),

            'price2'=>array('title'=>'가격(주말)','type'=>'number','list_style'=>'text-align:center;width:300px','label'=>'원','rule'=>'required','placeholder'=>'000,000'),

            'created'=>array('title'=>'생성일','type'=>'now','list_style'=>'text-align:center;;'),
            'no'=>array('title'=>'번호','type'=>'hidden','is_key'=>true,'list_style'=>'text-align:center;;width:200px')
        );
    }

    public function index()
    {
        parent::index();
    }

    public function _list_db_get()
    {
        $row_data = $this->_listPageingRow($this->table_tn,$where='',$orderby=" order by year asc , month asc");

        for($ii=0; $ii<count($row_data['data']); $ii++) {
            $row_data['data'][$ii]['price'] = number_format($row_data['data'][$ii]['price']);
            $row_data['data'][$ii]['price2'] = number_format($row_data['data'][$ii]['price2']);
        }

        return $row_data;
    }

    public function list_json()
    {
        
        $items = $this->_list_db_get();
        parent::_send_json($items);
    }

    public function add()
    {
        parent::add();
    }

    public function add_action()
    {
         parent::add_action();
    }

    public function _add_to_db()
    {

        if(parent::_add_to_db($this->table_tn)) {

            return true;
        } else {
            return false;
        }
    }

    public function edit()
    {
        parent::edit();
    }

    public function _edit_db_get()
    {
        $this->db->where('no', $this->input->get_post('no'));
        return $this->db->get($this->table_tn)->row_array();
    }

    public function edit_action()
    {
/*        $this->form_validation->set_rules('idc', 'IDC', 'required');
        $this->form_validation->set_rules('ip_range', '아이피 대역', 'required');
*/

        parent::edit_action();

    }

    public function _edit_from_db()
    {
        if(parent::_edit_from_db($this->table_tn)) {
            return true;
        } else {
            return false;
        }
    }

    public function delete_action()
    {
        parent::delete_action();
    }

    public function _delete_from_db()
    {

        $this->db->where('no', $this->input->post('no'));
        $rw = $this->db->delete($this->table_tn);
        return $rw;
    }


}
