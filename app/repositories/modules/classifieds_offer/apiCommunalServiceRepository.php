<?php

/**
 * @Author: BetaWare
 * @Date:   2015-04-09 09:35:54
 * @Last Modified by:   BetaWare
 * @Last Modified time: 2015-09-24 09:43:21
 */
class apiCommunalServiceRepository extends \apiRepository {


	const DISTANCE = 3;
    

	public function saveReport($id, $reportData, $saveInstant = true) {

		try{

		if (array_key_exists('note', $reportData)) {

			$note = $reportData['note'];

		} else {

			$note = NULL;

		}

		$newOffer= new ClassifiedOfferEntry();
		$newOffer->category_id=$reportData['type'];
		$newOffer->content=$note;
		$newOffer->user_id=$id;
		$newOffer->save();


				return array('status' => 1);

			} catch (Exception $e) {

				return array('status' => 0, 'message' => $e->getMessage());

			}

	}

	

	private function convert64tojpg($encodedimage) {

		$encodedimage2 = str_replace('data:image/jpeg;base64,', '', $encodedimage);
		$encodedimage2 = str_replace(' ', '+', $encodedimage2);

		$convert = base64_decode($encodedimage2);

		$date = date('dmYhis');
		$random_string = substr(md5(rand()), 0, 12);
		$imageName = $random_string.$date.".jpg";
	    
	    $ifp = fopen(getcwd().'/uploads/modules/classifiedoffer'.$imageName, "wb" );

	    fwrite($ifp, $convert);
	    fclose($ifp);

	    $this->create_thumb($imageName);

		return  $imageName;

	}

	private function create_thumb($imageName) {

		$uploadSuccess = Image::make(getcwd().'/uploads/communalService/'.$imageName)
			->orientate()
			->crop(768, 768)
			->resize(200, 200)
			->save(getcwd().'/uploads/communalService/thumbs/'.$imageName)
			->destroy();

		if ($uploadSuccess) {

			return 1;

		} else {

			return 0;

		}

	}

	public function vote($id, $vote) {

		try {

			$report = CommunalServiceReport::find($id);

			if ($vote) {

				$report->increment('votes');

			} else {

				$report->decrement('votes');

			}

			return array('status' => 1, 'vote' => $report->votes);


		} catch (Exception $e) {

			return array('status' => 0, 'message' => $e->getMessage());

		}

	}



}
