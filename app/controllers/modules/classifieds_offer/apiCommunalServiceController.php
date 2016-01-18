<?php

class apiCommunalServiceController extends ResponseController {


	public function __construct() {

		$this->api = new apiCommunalServiceRepository;

	}

    
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{


		if (Auth::check()) {

			$postData = Input::get();

			$cityId = false;


			$reports = $this->api->getAllReports(Auth::user()->id, $lat, $lon, $page, $filter, $cityId);

			if ($reports['status']) {

				return $this->response(1, $reports['data']);

			} else {

				return $this->response(0, $reports['message']);

			}

		} else {

			return $this->response(0, 'Invalid credentials');

		}

	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{

		if (Auth::check()) {

			$reportData = Input::json()->all();

			if (array_key_exists('saveInstant', $reportData)) {

				$saveInstant = $reportData['saveInstant'];

			} else {

				$saveInstant = false;

			}

			$saveReport = $this->api->saveReport(Auth::user()->id, $reportData);

			if ($saveReport['status'] == 1) {

				return $this->response(1, $saveReport['status']);

			} elseif ($saveReport['status'] == 2) {

				return $this->response(2, $saveReport['data']);

			} else {

				return $this->response(0, $saveReport['message']);

			}

		} else {

			return $this->response(0, 'Invalid credentials');

		}

	}

	public function vote() {

		if (Auth::check()) {

			$voteData = Input::get();

			$voting = $this->api->vote($voteData['id'], $voteData['val']);

			if ($voting['status']) {

				return $this->response(1, $voting['vote']);

			} else {

				return $this->response(0, $voting['message']);

			}

		} else {

			return $this->response(0, 'Invalid credentials');

		}

	}

	public function getSingleReport(){
			if (Auth::check()) {



		try{

			$report = DB::table('communalservice_reports as r')
				->join('communalservice_reports_cities as rc', 'r.id', '=', 'rc.report_id')
				->join('communalservice_report_statuses as s', 'r.status_id', '=', 's.id')
				->join('communalservice_report_subtypes as st', 'r.subtype_id', '=', 'st.id')
				->join('communalservice_report_types as t', 'st.type_id', '=', 't.id')
				->select('r.id as id',
						 'r.description as note',
						 'r.is_active as active',
						 'r.latitude as lat',
						 'r.longitude as lon',
						 'r.image as img',
						 'r.votes as vote',
						 'r.location_address as address',
						 'r.admin_note as adminNote',
                         'r.attach_image as adminNotePhoto',
						 DB::raw('DATE_FORMAT(r.created_at, "%d.%m.%y %H:%i") as date'),
						 DB::raw('DATE_FORMAT(r.updated_at, "%d.%m.%y %H:%i") as date_resolved'),
						 's.identifier as status',
						 't.name as type',
						 't.id as type_id',
						 'st.name as subtype',
						 'st.id as subtype_id')
				->where('r.id', '=', Input::get('id'))
				->orderBy('r.created_at', 'DESC')
				->first();
			return array('status' => 1, 'report' => $report) ;

		} catch (Exception $e) {

			return array('status' => 0, 'message' => $e->getMessage());

		}
	}

	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}


}
