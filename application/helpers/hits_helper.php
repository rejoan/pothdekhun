<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
if ( ! function_exists('count_hits'))
{
	function count_hits()
	{

		//Determine whether the user agent browsing your site is a web browser, a mobile device, or a robot.
		if ($this->agent->is_browser())
		{
			$agent = $this->agent->browser() . ' ' . $this->agent->version() . ' - ' . $this->agent->platform();
		}
		elseif ($this->agent->is_robot())
		{
			$agent = $this->agent->robot();
		}
		elseif ($this->agent->is_mobile())
		{
			$agent = $this->agent->mobile();
		}
		else
		{
			$agent = 'Unidentified User Agent';
		}

		//Detect if the user is referred from another page
		if ($this->agent->is_referral())
		{
			$referrer = $this->agent->referrer();
		}

		// correcting date time difference by adding 563 to it.
		$date = date('Y-m-j H:i:s', strtotime(date('Y-m-j H:i:s')) + 563);

		$data = array (

			'page_Address'  =>   current_url(),

			'user_IP'       =>   $this->input->ip_address(),

			'user_Agent'    =>   $agent,

			'user_Referrer' =>   $referrer,

			'hit_Date'      =>   $date

		);

		$this->db->insert('counter', $data);

	}
}