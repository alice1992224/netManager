<?php
class Manager_model extends CI_Model {

    public function __construct()
    {
        $this->load->database();
    }
	
    public function show_user()
    {
        $this->db->select('*');
        $this->db->from('ipstatus');
        $this->db->join('userprofile', 'userprofile.account = ipstatus.owner');
        $query = $this->db->get();
        return $query->result();
    }
    
    public function ip_setting_show_user()
    {
        $this->db->distinct()->select('account')->from('userprofile');
        $query = $this->db->get();
        return $query->result();
    }

    public function add_ip_setting_show_ip()
    {
        $this->db->select('ip')->from('ipstatus')->where('status',0);
        $query = $this->db->get();
        return $query->result();
    }

    public function del_ip_setting_show_ip()
    {
        $this->db->select('ip')->from('ipstatus')->where('status',1);
        $query = $this->db->get();
        return $query->result();
    }

    public function show_userprofile()
    {
        $query = $this->db->get('userprofile');
        return $query->result();
    }

	public function enable_nework($client, $priority){
		$url = "http://140.113.131.82:8080/wm/staticflowentrypusher/json";

		$content = '{"switch": "00:00:c8:d3:a3:5d:0a:5d", "name":"'.$client.'-1",
					"cookie":"0", "priority":"'.$priority.'","ether-type":"0x0800", "src-ip":"'.$client.'",
					"active":"true", "actions":"output=1"}';

		$command = "curl -d '".$content."' ".$url;
		$content2 = '{"switch": "00:00:c8:d3:a3:5d:0a:5d", "name":"'.$client.'-2",
					"cookie":"0", "priority":"'.$priority.'","ether-type":"0x0800", "dst-ip":"'.$client.'",
					"ingress-port":"1", "active":"true", "actions":"output=flood"}';
		$command2 = "curl -d '".$content2."' ".$url;

		exec($command);
		exec($command2);
	}

	public function login_user()
    {
        // check user is employee or manager
        $account = $this->security->xss_clean($this->input->post('account'));
        $query = $this->db->get_where('userprofile', array('account' => $account)); 
        $priority = '30000';

        foreach ($query->result() as $row)
        {
           if( $account == $row->account){
                if($row->office == 'manager'){
                    $priority = '32100';
                }
            }
        }

		//////// set rule ///////////
		$client = $this->input->ip_address();
		$this->enable_nework($client, $priority);
    
		//////// update database ///////////
		$account = $this->security->xss_clean($this->input->post('account'));
        $data = array('status' => '1');
        $this->db->where('ip', $client);
        return $this->db->update('user', $data);
    }

	public function disable_network($client){
		$url = "http://140.113.131.82:8080/wm/staticflowentrypusher/json";

		$content = '{"name":"'.$client.'-1"}';
		$command = "curl -X DELETE -d '".$content."' ".$url;

		$content2 = '{"name":"'.$client.'-2"}';
		$command2 = "curl -X DELETE -d '".$content2."' ".$url;

		exec($command);
		exec($command2);
	}


   	public function change_status($ip){
        $this->db->select('*');
        $this->db->from('userprofile');
        $this->db->join('ipstatus', 'userprofile.account = ipstatus.owner');
        $query = $this->db->get();
		foreach($query->result() as $row){
			if($ip == $row->ip){
				$account = $row->account;
				if($row->status == '0'){ 
					$new_status = '1';
				}
				else{
					$new_status = '0';
				}
			}
		}

		if( $new_status == '0'){
			//////// delete rule ///////////
			$this->disable_network($ip);
		}
		else {
			//////// add rule ///////////
			$this->enable_nework($ip);
		}
	
		$data = array('status' => $new_status);
		$this->db->where('ip', $ip);
		return $this->db->update('ipstatus', $data);

	}


   	public function change_office($account){
        $query = $this->db->get('userprofile');
        foreach($query->result() as $row){
            if($account == $row->account){
                if($row->office == 'employee'){ 
                //////// employee -> employer ///////////
                    $office = 'manager';
                }
                else{
			    //////// employer -> employee ///////////
                    $office = 'employee';
                }
            }
        }
        $data = array('office' => $office);
        $this->db->where('account', $account);
        return $this->db->update('userprofile', $data);
    }


    public function check_user()
    {
        $query = $this->db->get('userprofile');

		$account = $this->security->xss_clean($this->input->post('account'));
		$password = $this->security->xss_clean($this->input->post('password'));
		
		foreach ($query->result() as $row)
		{
			if( $row->account == $account && $row->password == hash('sha256', $password) ){
				return TRUE;
			}
		}
		return FALSE;
    }

    public function check_status(){
		$ip = $this->input->ip_address();
		$query = $this->db->get('user');
		foreach ($query->result() as $row){
			if($ip == $row->ip){
				if($row->status == 0){
					return FALSE;
				}else{
					return TRUE;
				}
			}	
		}
    }

	public function get_ip_list(){
		$ip_array = array();	
		$query = $this->db->get('user');
		foreach ($query->result() as $row){

			if (!array_key_exists($row->account, $ip_array)) {
				$ip_array[$row->account] = $row->ip;	
			}
			else{
				$ip_array[$row->account] = $ip_array[$row->account].", ".$row->ip;	
			}
		}
		return $ip_array;
	}

	public function set_ip(){
		$account = $this->input->post('account');
        $ip = $this->input->post('ip');

        $ip_data = array(
                'status' => 1,
                'owner' => $account
                );
        $this->db->where('ip', $ip);
        return $this->db->update('ipstatus', $ip_data);
    }

    public function delete_ip(){
        $account = $this->input->post('account');
        $ip = $this->input->post('ip');
        $query = $this->db->select('owner')->from('ipstatus')->where('owner', $account);
        if($query){
            $ip_data = array(
                    'status' => 0,
                    'owner' => ""
                    );
            $this->db->where('ip', $ip);
            return $this->db->update('ipstatus', $ip_data);
        }
	}

	public function timer(){
		return "10:00";
	}

	public function count_remain(){

        exec('scripts/update_cron 8 17'); //for blacklist

		$time_limit = 30;

		$now = date("Y-m-d H:i:s");
		$ip = $this->input->ip_address();	
		$query = $this->db->get_where('user', array('ip' => $ip));
		foreach ($query->result() as $row){
			$time = $row->time;
		}

		return $time_limit - (strtotime($now) - strtotime($time))/ (60);


	}

    public function show_blacklist()
    {
        $query = $this->db->get('blacklist');
        return $query->result();
    }

    public function add_blacklist()
    {

        $app_name = $this->input->post('app_name');
        $ip = $this->input->post('ip');
        $command = 'cd scripts && ./set_blacklist add '.$app_name.' '.$ip;
        $result = exec($command);
        echo $result;
    }

    public function remove_blacklist($ip)
    {
        $command = 'cd scripts && ./set_blacklist delete '.$ip;
        exec($command);
    }
    
	public function set_signup(){
		$username = $this->security->xss_clean($this->input->post('username'));
		$account = $this->security->xss_clean($this->input->post('account'));
		$password = $this->security->xss_clean($this->input->post('password'));
		$office = $this->security->xss_clean($this->input->post('office'));
		$email = $this->security->xss_clean($this->input->post('email'));

		$data = array(
				'username' => $username, 
				'account' => $account, 
				'password' => hash('sha256', $password),
				'office' => $office,
				'email' => $email,
			     );
        $this->db->insert('userprofile', $data);
	
	}

    public function change_verify_status($id){
        
        $data = array('verified' => '1');
        $this->db->where('id', $id);
        return $this->db->update('userprofile', $data);
    }

}
