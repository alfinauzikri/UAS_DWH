<?php defined('BASEPATH') or exit('No direct script access allowed');

class Dwh extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$grafik = $this->universal->getMulti('', 'grafik_penjualan');
		$dt1 = [];
		$dt2 = [];
		foreach ($grafik as $gf) {
			$dt1[] = "'" . $gf->waktu . "'";
			$dt2[] = $gf->omset;
		}

		$data = [
			'dt1' => $dt1,
			'dt2' => $dt2,
			'omset' => $this->universal->getMulti('', 'omset')
		];

		$this->load->view('home', $data);
	}
}
