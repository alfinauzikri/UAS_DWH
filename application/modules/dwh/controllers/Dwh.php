<?php defined('BASEPATH') or exit('No direct script access allowed');

use Phpml\Regression\LeastSquares;

class Dwh extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
	}

	private  function dateDiffInDays($date1, $date2)
	{
		// Calculating the difference in timestamps
		$diff = strtotime($date2) - strtotime($date1);

		// 1 day = 24 hours
		// 24 * 60 * 60 = 86400 seconds
		return abs(round($diff / 86400));
	}

	public function index()
	{
		$omset = $this->universal->getMulti('', 'omset');

		$tg = [];

		foreach ($omset as $dt) {
			$tg[] = $dt->omset;
		}

		$samples = [
			[1],
			[2],
			[3],
			[4],
			[5],
			[6],
			[7],
			[8],
			[9],
			[10],
			[11],
			[12],
			[13],
			[14],
			[15],
			[16],
			[17],
			[18],
			[19],
			[20],
			[21],
			[22],
			[23],
			[24],
			[25],
			[26],
			[27],
			[28],
			[29],
			[30],
			[31],
			[32],
			[33],
			[34],
			[35],
			[36],
			[37],
			[38],
			[39],
			[40],
			[41]
		];
		$targets = $tg;


		$regression = new LeastSquares();
		$regression->train($samples, $targets);

		$predicted = [];

		$x = 1;

		foreach ($omset as $dt) {
			$data = [
				'waktu' => $dt->sk_waktu,
				'omset' => $dt->omset,
				'pre' => round(
					$regression->predict([$x++])
				)
			];

			array_push($predicted, $data);
		}

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
			'omset' => $omset,
			'predicted' => $predicted
		];

		$this->load->view('home', $data);
	}

	public function prediksi()
	{
		$this->load->view('prediksi');
	}

	public function proses()
	{
		$date = $this->input->post('waktu');
		$key = 1 + $this->dateDiffInDays('2005-05-24', $date);

		$omset = $this->universal->getMulti('', 'omset');

		$tg = [];

		foreach ($omset as $dt) {
			$tg[] = $dt->omset;
		}

		$samples = [
			[1],
			[2],
			[3],
			[4],
			[5],
			[6],
			[7],
			[8],
			[9],
			[10],
			[11],
			[12],
			[13],
			[14],
			[15],
			[16],
			[17],
			[18],
			[19],
			[20],
			[21],
			[22],
			[23],
			[24],
			[25],
			[26],
			[27],
			[28],
			[29],
			[30],
			[31],
			[32],
			[33],
			[34],
			[35],
			[36],
			[37],
			[38],
			[39],
			[40],
			[41]
		];
		$targets = $tg;


		$regression = new LeastSquares();
		$regression->train($samples, $targets);

		$this->session->set_flashdata('hasil', round($regression->predict([$key])));
		$this->session->set_flashdata('tgl', $date);

		redirect($_SERVER['HTTP_REFERER']);
	}
}
