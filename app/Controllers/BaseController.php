<?php

namespace App\Controllers;

/**
 * Class BaseController
 *
 * BaseController provides a convenient place for loading components
 * and performing functions that are needed by all your controllers.
 * Extend this class in any new controllers:
 *     class Home extends BaseController
 *
 * For security be sure to declare any new methods as protected or private.
 *
 * @package CodeIgniter
 */

use CodeIgniter\Controller;

class BaseController extends Controller
{

	/**
	 * An array of helpers to be loaded automatically upon
	 * class instantiation. These helpers will be available
	 * to all other controllers that extend BaseController.
	 *
	 * @var array
	 */
	protected $helpers = ['form', 'database', 'request', 'fungsi'];

	/**
	 * Constructor.
	 */
	public function initController(\CodeIgniter\HTTP\RequestInterface $request, \CodeIgniter\HTTP\ResponseInterface $response, \Psr\Log\LoggerInterface $logger)
	{
		// Do Not Edit This Line
		parent::initController($request, $response, $logger);
		$this->validator =  \Config\Services::validation();

		//--------------------------------------------------------------------
		// Preload any models, libraries, etc, here.
		//--------------------------------------------------------------------
		// E.g.:
		// $this->session = \Config\Services::session();
	}
	public function
	default()
	{
		$myfile = fopen('E:\WEBPROJECT\WORKPLACE\laragon\www\lipsum.txt', "r") or die("Unable to open file!");
		$echo = fread($myfile, filesize('E:\WEBPROJECT\WORKPLACE\laragon\www\lipsum.txt'));
		fclose($myfile);

		$this->response->setContentType('application/json');
		return json_encode([
			'text' => $echo
		], JSON_PRETTY_PRINT);
	}
	public function masterView($page, array $data)
	{
		echo view('templates/header', $data);
		echo view('templates/sidebar', $data);
		echo view($page, $data);
		echo view('templates/footer');
	}
	public function error404()
	{
		$this->response->setContentType('application/json');
		$this->response->setStatusCode(404);
		echo json_encode([
			'error' => [
				'code' => 404,
				'message' => 'Page Not Found.'
			]
		], JSON_PRETTY_PRINT);
	}

	public function checkAlreadyLogin()
	{
		// return header("Location: /user/pegawai");
		return redirect()->to(base_url('/user/admin'));
	}
}