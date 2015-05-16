<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * CodeIgniter
 *
 * An open source application development framework for PHP 5.1.6 or newer
 *
 * @package		CodeIgniter
 * @author		ExpressionEngine Dev Team
 * @copyright	Copyright (c) 2008 - 2011, EllisLab, Inc.
 * @license		http://codeigniter.com/user_guide/license.html
 * @link		http://codeigniter.com
 * @since		Version 1.0
 * @filesource
 */

// ------------------------------------------------------------------------

/**
 * CodeIgniter Application Controller Class
 *
 * This class object is the super class that every library in
 * CodeIgniter will be assigned to.
 *
 * @package		CodeIgniter
 * @subpackage	Libraries
 * @category	Libraries
 * @author		ExpressionEngine Dev Team
 * @link		http://codeigniter.com/user_guide/general/controllers.html
 */
class MY_Controller extends CI_Controller{

	/**
	 * Constructor
	 */
	public function __construct()
	{
		parent::__construct();
		if (substr($this->uri->uri_string,0,8) == 'modules/')
		{
			header('location:/');exit;
		}
		if ($this->router->is_in_module === TRUE)
		{
			$this->load->add_package_path(APPPATH.$this->router->fetch_module());
		}
		$this->view->assign('assets_url', config_item('assets_url'));
	}

	public function module_url($uri)
	{
		return $this->router->fetch_module().$uri;
	}

	
}

// END Controller class
/* End of file Controller.php */
/* Location: ./system/core/Controller.php */