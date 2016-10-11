<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once 'scaffolder.php';

class Item_ip extends Scaffolder
{
	var $current_user;
	var $idc_list;
	var $item_category_ver_no;
	var $item_list_ver_no;

	public function __construct()
	{
		parent::__construct();
        $this->load->library('lock_ip');
        $this->load->model('admin/itemmodel');
	}

	public function _init()
	{
		$this->data['schema']['id'] = "item_ip";
		$this->data['schema']['name'] = "자산 IP 대역";


        if($_GET['config_id']){
            $sql = "select * from item_config a , item_category b where a.item_category_ver_no = b.no and a.no ='".$_GET['config_id']."' limit 1 ";
        }else{
            $sql = "select * from item_config a , item_category b where a.item_category_ver_no = b.no and a.item_use ='Y' limit 1 ";
        }
        $conf_data = $this->db-> sqlFetch($sql);

        $this->item_category_ver_no = $conf_data['item_category_ver_no'];
        $this->item_list_ver_no = $conf_data['item_list_ver_no'];


        if(substr($conf_data['zone_list'],strlen($conf_data['zone_list'])-1,1) == ',') $conf_data['zone_list'] = substr($conf_data['zone_list'], 0 ,strlen($conf_data['zone_list'])-1);
        if(substr($conf_data['idc_list'],strlen($conf_data['idc_list'])-1,1) == ',') $conf_data['idc_list'] = substr($conf_data['idc_list'], 0 ,strlen($conf_data['idc_list'])-1);
        if(substr($conf_data['ptype_list'],strlen($conf_data['ptype_list'])-1,1) == ',') $conf_data['ptype_list'] = substr($conf_data['ptype_list'], 0 ,strlen($conf_data['ptype_list'])-1);
        if(substr($conf_data['license_list'],strlen($conf_data['license_list'])-1,1) == ',') $conf_data['license_list'] = substr($conf_data['license_list'], 0 ,strlen($conf_data['license_list'])-1);
        if(substr($conf_data['rack_list'],strlen($conf_data['rack_list'])-1,1) == ',') $conf_data['rack_list'] = substr($conf_data['rack_list'], 0 ,strlen($conf_data['rack_list'])-1);
        if(substr($conf_data['vendor_list'],strlen($conf_data['vendor_list'])-1,1) == ',') $conf_data['vendor_list'] = substr($conf_data['vendor_list'], 0 ,strlen($conf_data['vendor_list'])-1);
        $conf_data['license_list'] = "-,".$conf_data['license_list'];
        $conf_data['os_list'] = "-,".$conf_data['os_list'];
        $conf_data['rack_list'] = "-,".$conf_data['rack_list'];
        $conf_data['vendor_list'] = "-,".$conf_data['vendor_list'];

        $conf_data['zone_list'] = $this->array_2end($conf_data['zone_list']);

        $conf_data['idc_list'] = $conf_data['idc_list'];

        $this->idc_list = $conf_data['idc_list'];
        $conf_data['idc_list'] = $this->array_2end($conf_data['idc_list']);

        $conf_data['ptype_list'] = $this->array_2end($conf_data['ptype_list']);
        $conf_data['license_list'] = $this->array_2end($conf_data['license_list']);
        $conf_data['rack_list'] = $this->array_2end($conf_data['rack_list']);
        $conf_data['vendor_list'] = $this->array_2end($conf_data['vendor_list']);
        $conf_data['os_list'] = $this->array_2end($conf_data['os_list']);


		//-----------define fields-------------------------------------------
		// 속성값은 scaffoler.php의 상단 주석 참고.
		//-------------------------------------------------------------------
		$this->data['fields'] = array(
            'idc'=>array('title'=>'IDC','type'=>'select','options'=>$conf_data['idc_list'], 'rule'=>'required', 'list_hide'=>false,'list_style'=>'text-align:center;color:red','memo'=>'※ IDC는 자산관리 > 버전관리에서 추가해주시기 바랍니다.'),
			'idc_text'=>array('title'=>'IDC 이름','type'=>'input','list_style'=>'text-align:center;width:200px'),
			'idc_zone'=>array('title'=>'설명','type'=>'input','list_style'=>'text-align:left;width:300px'),
			'ip_range'=>array('title'=>'아이피 대역','type'=>'input','list_style'=>'text-align:center;'),
			'nm'=>array('title'=>'서브넷마스크','type'=>'input','list_style'=>'text-align:center;'),
			'gw'=>array('title'=>'게이트웨이','type'=>'input','list_style'=>'text-align:center;'),

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
		$row_data = $this->_listPageingRow($table='item_ip_range',$where='',$orderby=" order by no asc");
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
        //자산번호 유니크 체크
        if($_POST['ip_range']) {
            $sql = "select count(*)  from item_ip_range where ip_range = '" . $_POST['ip_range'] . "'  ";
            $un_validation = $this->db->sqlFetchOne($sql);
        }

        if($un_validation){
            $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode(array('error' => 'error', 'messages' => array("이미 사용중인 아이피 대역입니다."))));

        }else{
            parent::add_action();
        }
	}

	public function _add_to_db()
	{

		if(parent::_add_to_db('item_ip_range')) {
            $this->ip_mapping();
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
		return $this->db->get('item_ip_range')->row_array();
	}

	public function edit_action()
	{
		$this->form_validation->set_rules('idc', 'IDC', 'required');
		$this->form_validation->set_rules('ip_range', '아이피 대역', 'required');

        //자산번호 유니크 체크
        if($_POST['ip_range']) {
            $sql = "select count(*)  from item_ip_range where ip_range = '" . $_POST['ip_range'] . "' and no != '".$_POST['no']."'   ";
            $un_validation = $this->db->sqlFetchOne($sql);
        }

        if($un_validation){
            $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode(array('error' => 'error', 'messages' => array("이미 사용중인 아이피 대역입니다."))));

        }else {
            parent::edit_action();
        }
	}

	public function _edit_from_db()
	{
		if(parent::_edit_from_db('item_ip_range')) {
            $this->ip_mapping();
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
        //행동 로그 남기기 by now17
        $ldata['no'] = $this->input->post('no');
        $this->action_log->insert('DB delete',$ldata,$table='item_ip_range');

        $rw = $this->db->where('no', $this->input->post('no'));
        $this->ip_mapping();
        return $rw;
	}

    public function ip_map(){

        //$row = $this->db->select(' idc_text , count(*) as cu')->group_by('idc_text')->order_by('no','asc')->get('item_ip_range')->result_array();

        //캐시
        global $application_folder;
        $cache_file = $application_folder."/cache/item_ip_map.cache";

        $this->action_log->insert('IP MAP View');

        if(!is_file($cache_file) || date('Ym') > date('Ym',filemtime($cache_file)) || $_GET['cache_del'] == 'y') {

        $idc = explode(",",$this->idc_list);;

        for($ii=0; $ii<count($idc); $ii++) {
            $row[$ii]['idc'] = $idc[$ii];
            $row[$ii]['ip_list'] = $this->db->select(' idc_zone , count(*) as cu')->group_by('idc_zone')->order_by('no','asc')->where('idc',$idc[$ii])->get('item_ip_range')->result_array();
            for($i=0; $i<count($row[$ii]['ip_list']); $i++) {
                $row[$ii]['ip_list'][$i]['ip_ranges'] = $this->db->select(' ip_range , nm , gw , count(*) as cu')->group_by('ip_range')->order_by('no','asc')->where('idc_zone',$row[$ii]['ip_list'][$i]['idc_zone'])->where('idc',$idc[$ii])->get('item_ip_range')->result_array();

                for($ia=0; $ia<count($row[$ii]['ip_list'][$i]['ip_ranges']); $ia++) {
                    unset($ip_s);
                    $ip_s = explode("/",$row[$ii]['ip_list'][$i]['ip_ranges'][$ia]['ip_range']);
                    $row[$ii]['ip_list'][$i]['ip_ranges'][$ia]['ips'] = $this->lock_ip->ip_list($ip_s[0],$ip_s[1]);
                        for($ib=0; $ib<count($row[$ii]['ip_list'][$i]['ip_ranges'][$ia]['ips']); $ib++) {
                            unset($ip_info);
                            $row[$ii]['ip_list'][$i]['ip_ranges'][$ia]['ips'][$ib]['ip_info'] = $this->db->where('item_list_no',$this->item_list_ver_no)->where('ip',$row[$ii]['ip_list'][$i]['ip_ranges'][$ia]['ips'][$ib]['ip'])->get('item_ip_maping')->row_array();


                        }
                }
            }
        }
        /*echo "<xmp>";
        print_r($row);*/
        $this->display->assign('LIST',$row);

        $this->display->assign('item_list_ver_no',$this->item_list_ver_no);

        $this->display->define('CONTENT', $this->display->getTemplate('admin/ip_map.php'));
        $content = $this->display->fetch('CONTENT');


            @unlink($cache_file);
            $fp = fopen($cache_file,'w');
            fwrite($fp,$content);
            fclose($fp);

        }else{
            $content =  file_get_contents($cache_file);
            $this->display->assign('cache_y','y');

        }
        echo  $content;
    }

    public function ip_mapping($verno=''){

        if(!$verno) $verno = $this->item_list_ver_no;
        $this->itemmodel->ip_mapping($verno);

    }
}
