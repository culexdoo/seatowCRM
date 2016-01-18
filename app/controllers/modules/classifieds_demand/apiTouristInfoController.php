<?php
/**
 * @Author: BetaWare
 * @Date:   2015-04-23 10:52:04
 * @Last Modified by:   BetaWare
 * @Last Modified time: 2015-04-23 14:20:50
 */
class apiTouristInfoController extends \ResponseController
{
	
	function __construct()
	{
		$this->repo = new apiTouristInfoRepository;
		$this->api = new apiRepository;
	}

	public function getCategories() {

		if (Auth::check()) {
		$kategorije['status']=0;
				$categories = ClassifiedsCategory::all();
				foreach ($categories as $key => $category) {
					$kategorije['categories'][]=$category;
					$kategorije['status']=1;
				}

				if ($kategorije['status']) {

					return $this->response(1, $kategorije['categories']);
					
				} else {

					return $this->response(1, 0);

				}
			
		} else {

			return $this->response(0, 'Invalid credentials');

		}

	}

	public function getEntries($id) {

		$multi = true;

		if (Auth::check()) {
		$entry['status']=0;


			$entries = ClassifiedOfferEntry::where('category_id', '=', $id)->get();

			foreach ($entries as $key => $ent) {
				$entry['status']=1;
				$entry['entries'][]=$ent;				
			}

			if ($entry['status']) {

					return $this->response(1, $entry['entries']);
				
			} else {

				return $this->response(0, $entry['reason']);

			}

		} else {

			$this->response(0, 'Invalid credentials');
		
		}

	}

	public function getEntry($id) {

		$multi = true;

		if (Auth::check()) {
		$entry['status']=0;


			$entries = ClassifiedOfferEntry::find($id);

			if ($entries) {
				$entry['status']=1;
				$entry['entries']=$entries;
				$entry['entries']['user']=Auth::user();			
			}

			if ($entry['status']) {

					return $this->response(1, $entry['entries']);
				
			} else {

				return $this->response(0, 'Oglas je nedostupan');

			}

		} else {

			$this->response(0, 'Invalid credentials');
		
		}

	}

}