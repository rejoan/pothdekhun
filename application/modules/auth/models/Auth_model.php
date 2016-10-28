<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Authentication Model
 *
 * @author Rejoanul Alam
 */
class Auth_model extends CI_Model {

    public function check_credential($USER_USERNAME, $USER_PASSWORD) {
        $user_password_crypt = md5($USER_PASSWORD);
        $is_user = $this->db->where('email', $USER_USERNAME)
                ->where('password', $user_password_crypt)
                ->where('status', 1)
                ->get('users');
        if ($is_user->num_rows()) {
            $user = $is_user->row();
            $user_data = array(
                'user_id' => $user->id,
                'username' => $user->username,
                'email' => $user->email,
                'avatar' => $user->avatar,
                'user_type' => $user->user_type
            );
            return $user_data;
        } else {
            return false;
        }
    }

    function check_credential_secure($user_email, $user_password) {
        $user_password_crypt = crypt($user_password, $this->config->item('pwsalt'));
        $is_user = $this->db->where('admin_email', $user_email)->where('admin_password', $user_password_crypt)->get('admin');
        if ($is_user->num_rows()) {
            $user = $is_user->row();
            $userdata['email'] = $user->admin_email;
            $userdata['user_email'] = $user->admin_email; //to avoid some prob. need to remove above session
            $userdata['type'] = $user->admin_type;
            $userdata['displayName'] = $user->admin_name;
            $userdata['user_id'] = $user->admin_id;
            $userdata['is_admin'] = TRUE;
            return $userdata;
        } else {
            return false;
        }
    }

    function signup_save() {
        $data['user_displayName'] = $this->input->post('user_displayName');
        $data['user_address'] = $this->input->post('user_address');
        $data['country_id'] = $this->input->post('country_id');
        $data['city_id'] = $this->input->post('city_id');
        $data['user_place'] = $this->input->post('user_place');
        $data['user_zip_code'] = $this->input->post('user_zip_code');
        $data['user_regType'] = $this->input->post('user_regType');

        if ($this->input->post('user_regType')) {
            //only for company
            $data['user_company'] = $this->input->post('user_company');
        }

        if ($this->input->post('islicensee')) {
            $city = getCityName($this->input->post('city_id'));
            $country = getCountryName($this->input->post('country_id'));
            $complete_address = $this->input->post('user_address') . ", " . $city . ", " . $country;
            $latitude_longitude = getGeocode($complete_address); //getGeocode return array

            $data['user_type'] = $this->input->post('user_type');
            $data['user_latitude'] = $latitude_longitude["lat"];
            $data['user_longitude'] = $latitude_longitude["long"];
        } else {
            $data['user_type'] = 'private'; //Non-licensee user
        }

        $data['user_currency'] = "USD";
        $data['user_email'] = $this->input->post('user_email');
        $data['user_password'] = adPWCrypt($this->input->post('user_password'));
        $data['user_createDate'] = date("Y-m-d H:i:s");
        $this->db->insert('user', $data);
        $user_id = $this->db->insert_id();
        $user_email = $data['user_email'];

        //Insert data in "user_billing" table
        $billing_data = array();
        $billing_data["user_id"] = $user_id;
        $billing_data["billing_name"] = $this->input->post('user_displayName');
        $billing_data["billing_address"] = $this->input->post('user_address');
        $billing_data["billing_city"] = $this->input->post('city_id');
        $billing_data["billing_country"] = $this->input->post('country_id');
        $billing_data["billing_createDate"] = date("Y-m-d H:i:s");
        $billing_data["billing_updateDate"] = date("Y-m-d H:i:s");
        $this->db->insert('user_billing', $billing_data);


        //Insert data in "user_shipping" table
        $shipping_data = array();
        $shipping_data["user_id"] = $user_id;
        $shipping_data["shipping_name"] = $this->input->post('user_displayName');
        $shipping_data["shipping_address"] = $this->input->post('user_address');
        $shipping_data["shipping_city"] = $this->input->post('city_id');
        $shipping_data["shipping_country"] = $this->input->post('country_id');
        $shipping_data["shipping_createDate"] = date("Y-m-d H:i:s");
        $shipping_data["shipping_updateDate"] = date("Y-m-d H:i:s");
        $this->db->insert('user_shipping', $shipping_data);


        //Insert data into "licensee" table
        if ($this->input->post('islicensee')) {
            $last_licensee_progressive_num = $this->select_last_licensee_progressive_num();
            $new_licensee_progressive_num = $last_licensee_progressive_num + 1;

            $country_code = $this->select_country_code_by_id($this->input->post('country_id'));

            $dataLicensee = array();
            $dataLicensee['user_id'] = $user_id;
            $dataLicensee['licensee_license_code'] = $country_code . str_pad($new_licensee_progressive_num, 6, "0", STR_PAD_LEFT);
            $dataLicensee['licensee_progressive_num'] = $new_licensee_progressive_num;
            $dataLicensee['licensee_business_since'] = sqldate($this->input->post('licensee_business_since'), "/", "d/m/Y");
            $dataLicensee['licensee_alias'] = makeLicenseeAlias($data['user_displayName']);
            $this->db->insert('licensee', $dataLicensee);
        }

        //Start: Insert "Starter Kit" information data now in "order" table
//        $order_data = array();
//        
//        $current_year = date("Y");
//        $last_invoice_code = $this->select_last_invoice_code();
//        
//        $last_invoice_code_year = (int)substr($last_invoice_code,0,4);
//        $last_invoice_number = (int)substr($last_invoice_code,5);
//        
//        if($current_year > $last_invoice_code_year)
//        {
//            $invoice_code = $current_year."/"."1";
//        }
//        else
//        {
//            $new_number = $last_invoice_number+1;
//            $invoice_code = $last_invoice_code_year."/".$new_number;
//        }
//        
//        
//        $order_data["invoice_code"] = $invoice_code;
//        $order_data["order_type"] = "1";  //1=registration, 2=purchase
//        $order_data["order_quantity"] = $this->input->post('sac_code_quantity');
//        $order_data["order_subtotal"] = $this->input->post('licensee_fee');
//        $order_data["order_total"] = $this->input->post('total');
//	  $order_data["user_id"] = $user_id;
//        $order_data["order_status"] = "1";
//	  $order_data["order_createDate"] = date("Y-m-d H:i:s");
//
//        $this->db->insert('order',$order_data);
//        
//        $insert = $this->db->insert_id();
        //End: Insert "Starter Kit" information 


        if ($user_id) {
            $notification_count = $this->adata_notify->get_current_user_notification_count($user_id, $user_email);
            if ($notification_count) {
                $this->adata_notify->increment_new_notification_count($user_id, $notification_count);
            }
            return $user_id;
        } else {
            return FALSE;
        }
    }

    public function select_country_code_by_id($country_id) {
        $this->db->select("country_code");
        $this->db->from("country");
        $this->db->where("country_id", $country_id);

        $return = $this->db->get();

        if ($return->num_rows()) {
            return $return->row()->country_code;
        } else {
            return false;
        }
    }

    public function select_last_licensee_progressive_num() {
        $this->db->select("licensee_progressive_num");
        $this->db->from("licensee");
        $this->db->order_by("licensee_id", "desc");
        $this->db->limit(1);
        $return = $this->db->get();

        if ($return->num_rows()) {
            return $return->row()->licensee_progressive_num;
        } else {
            return 1;
        }
    }

    public function select_last_invoice_code() {
        $this->db->select("invoice_code");
        $this->db->from("order");
        $this->db->order_by("order_id", "desc");
        $this->db->limit(1);
        $return = $this->db->get();

        if ($return->num_rows()) {
            return $return->row()->invoice_code;
        } else {
            return 1;
        }
    }

    public function activate_account($user_id) {
        $data["user_status"] = 1;
        $data["user_updateDate"] = date("Y-m-d H:i:s");
        $this->db->where("user_id", $user_id);
        return $this->db->update("user", $data);
    }

    public function check_email($user_email) {
        $this->db->from("user");
        $this->db->where("user_email", $user_email);
        return $this->db->count_all_results();
    }

    public function forgot_pw_token($user_email) {
        $data['pw_forgot_token'] = random_string('alnum', 16);
        $data['pw_forgot_email'] = $user_email;
        $data['pw_forgot_req_date'] = date("Y-m-d H:i:s");
        if ($this->db->insert("user_forgot_pw", $data)) {
            return $data['pw_forgot_token'];
        } else {
            return FALSE;
        }
    }

    public function chk_forgot_pw_token($email, $token) {
        $this->db->where("pw_forgot_email", $email);
        $this->db->order_by("pw_forgot_req_date", "desc");
        $this->db->limit(1);
        $query = $this->db->get("user_forgot_pw");
        if ($query->num_rows()) {
            $row = $query->row();
            if ($row->pw_forgot_token == $token) {
                return TRUE;
            } else {
                return FALSE;
            }
        } else {
            return FALSE;
        }
    }

    public function reset_pw($email, $token) {
        if ($this->chk_forgot_pw_token($email, $token)) {
            $user_password = $this->input->post("user_pw");
            $user_password_crypt = crypt($user_password, $this->config->item('pwsalt'));

            $this->db->where("pw_forgot_token", $token)
                    ->where("pw_forgot_email", $email)
                    ->update("user_forgot_pw", array("pw_forgot_status" => 1));

            return $this->db->where("user_email", $email)
                            ->update("user", array("user_password" => $user_password_crypt));
        } else {
            return FALSE;
        }
    }

}
