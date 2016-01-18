<?php

class ResponseController extends \BaseController {

	protected function response($status, $data) {

		return Response::json(array("status" => $status, "data" => $data));

	}

}
