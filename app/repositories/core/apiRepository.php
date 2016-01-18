<?php
/**
 * @Author: BetaWare
 * @Date:   2015-04-08 13:09:53
 * @Last Modified by:   BetaWare
 * @Last Modified time: 2015-05-04 15:12:49
 */
class apiRepository
{

	/**
	 * api update 15.08
	 * get city by pointInPolygon
	 */

	public $pointOnVertex = true;

	public function checkCurrentCityPolygon($id, $lat, $lon) {

		try {


			$points = $lat.' '.$lon;

			$cities = City::where("is_active", "=", 1)->get();

			foreach ($cities as $city) {

				if ($city->city_area != NULL) {

					$areas = DB::table('areas')
						->where('id', '=', $city->city_area)
						->limit(1)
						->get();

					$coords = explode(';', $areas[0]->coordinates);

					$poly = array();

					foreach ($coords as $coord) {

						if ($coord != '') {

							$latlon = explode(',', $coord);

							$poly[] = $latlon[0].' '.$latlon[1];

						}

					}

					$res = $this->pointInPolygon($points, $poly, true);

					switch ($res) {
						case 'inside':
							return $city->id;
							break;
						case 'outside':
							break;
						case 'vertex':
							return $city->id;
							break;
						case 'boundary':
							return $city->id;
							break;
						default:
							break;

					}

				}

			}

			return false;

		} catch (Exception $e) {

			return false;

		}

	}

	private function pointInPolygon($point, $polygon, $pointOnVertex = true) {

		$this->pointOnVertex = $pointOnVertex;

        // Transform string coordinates into arrays with x and y values
        $point = $this->pointStringToCoordinates($point);
        $vertices = array();
        foreach ($polygon as $vertex) {
            $vertices[] = $this->pointStringToCoordinates($vertex);
        }

        // Check if the point sits exactly on a vertex
        if ($this->pointOnVertex == true and $this->pointOnVertex($point, $vertices) == true) {
            return "vertex";
        }

        // Check if the point is inside the polygon or on the boundary
        $intersections = 0;
        $vertices_count = count($vertices);

        for ($i=1; $i < $vertices_count; $i++) {
            $vertex1 = $vertices[$i-1];
            $vertex2 = $vertices[$i];
            if ($vertex1['y'] == $vertex2['y'] and $vertex1['y'] == $point['y'] and $point['x'] > min($vertex1['x'], $vertex2['x']) and $point['x'] < max($vertex1['x'], $vertex2['x'])) { // Check if point is on an horizontal polygon boundary
                return "boundary";
            }
            if ($point['y'] > min($vertex1['y'], $vertex2['y']) and $point['y'] <= max($vertex1['y'], $vertex2['y']) and $point['x'] <= max($vertex1['x'], $vertex2['x']) and $vertex1['y'] != $vertex2['y']) {
                $xinters = ($point['y'] - $vertex1['y']) * ($vertex2['x'] - $vertex1['x']) / ($vertex2['y'] - $vertex1['y']) + $vertex1['x'];
                if ($xinters == $point['x']) { // Check if point is on the polygon boundary (other than horizontal)
                    return "boundary";
                }
                if ($vertex1['x'] == $vertex2['x'] || $point['x'] <= $xinters) {
                    $intersections++;
                }
            }
        }
        // If the number of edges we passed through is odd, then it's in the polygon.
        if ($intersections % 2 != 0) {
            return "inside";
        } else {
            return "outside";
        }

	}

	private function pointOnVertex($point, $vertices) {

		foreach($vertices as $vertex) {

            if ($point == $vertex) {

			    return true;

			}

		}

	}

	private function pointStringToCoordinates($pointString) {

		$coordinates = explode(" ", $pointString);

        return array("x" => $coordinates[0], "y" => $coordinates[1]);

	}

	public function checkCurrentCity($id, $lat, $lon) {

		$cityId = $this->checkCurrentCityPolygon($id, $lat, $lon);

		if ($cityId) {
            
			$city = City::find($cityId);
			$checkIfInsideActive = true;

		} else {

			/*$lat = 35.19203;
			$lon = 43.416595;*/
			$distances = $this->getCityId($lat, $lon);
			$cityId = 0;
			$br = 0;
			$checkIfInsideActive = false;

			foreach ($distances as $distance) {

				if ($distance['insideRadius']) {

					$cityId = $distance['id'];
					$city = City::find($cityId);
					$checkIfInsideActive = true;
					$br++;
					break;

				}

				//backup city ID
				if ($br == 0) {

					$city = City::find($cityId = $distance['id']);
					$checkIfInsideActive = false;

				}

				$br++;

			}

		}

		try {

			$cities_modules = '';

			if ($city) {

				$report_types = DB::table('communalservice_report_types_cities as rtc')
					->join('communalservice_report_types as rt', 'rt.id', '=', 'rtc.report_type_id')
					->select('rt.id', 'rt.name', 'rt.description')
					->where('rtc.city_id', '=', $cityId)
					->get();

				$cities_modules = DB::table('cities_modules')
					->select('module')
					->where('city', '=', $cityId)
					->get();

			} else {

				$report_types = DB::table('communalservice_report_types as rt')
					->select('rt.id', 'rt.name', 'rt.description')
					->where('rt.id', '=', 1)
					->get();

			}

			$index = 0;

			foreach ($report_types as $type) {

				$report_subtypes = DB::table('communalservice_report_subtypes as st')
					->select('st.id', 'st.type_id', 'st.description', 'st.name')
					->where('st.type_id', '=', $type->id)
					->get();

				if (count($report_subtypes)) {

					$type->subtypes = $report_subtypes;

				} else {

					unset($report_types[$index]);

				}

				$index++;

			}

			$modules = [];

			if (count($cities_modules)) {

				foreach ($cities_modules as $module) {

					$modules[] = $module->module;

				}

			}

			$city['report_types'] = $report_types;
			$city['inside_active'] = $checkIfInsideActive;
			$city['modules'] = $modules;

			return array('status' => 1, 'city' => $city);

		} catch (Exception $e) {

			return array('status' => 0, 'message' => $e->getMessage());

		}

	}

	protected function getCityId($lat, $lon) {

		$cities = City::all();
		$distances = [];

		foreach ($cities as $city) {

			$distance = $this->calculateDistance($lat, $lon, $city->city_center_latitude, $city->city_center_longitude);

			if ($city->radius_from_center >= $distance) {

				$insideRadius = 1;

			} else {

				$insideRadius = 0;

			}

			$distances[] = ['id' => $city->id, 'distance' => $distance, 'radius' => $city->radius_from_center, 'insideRadius' => $insideRadius];

		}

		usort($distances, function($a, $b) {

		    return $a['distance'] - $b['distance'];

		});

		return $distances;

	}

	protected function calculateDistance($lat1, $lon1, $lat2, $lon2) {

		$unit = "K";
		$radius = 6371.0090667;
		$dlon = $lon1 - $lon2;
		$distance = acos( sin(deg2rad((double)$lat1)) * sin(deg2rad((double)$lat2)) +  cos(deg2rad((double)$lat1)) * cos(deg2rad((double)$lat2)) * cos(deg2rad((double)$dlon))) * $radius;

		return ($distance);

	}

	public function getCities($city = false) {

		try {

			if ($city) {

				$country = DB::table('cities')
					->where('id', '=', $city)
					->take(1)
					->get();

				$countryId = $country[0]->country;

				$cities = DB::table('cities')
					->where('is_active', '=', 1)
					->where('country', '=', $countryId)
					->orderBy('name', 'ASC')
					->get();

			} else {

				$cities = DB::table('cities')
					->where('is_active', '=', 1)
					->orderBy('name', 'ASC')
					->get();

			}

			foreach ($cities as $city) {

				$modules = DB::table('cities_modules')
					->select('module as id')
					->where('city', '=', $city->id)
					->get();

				$mods = [];

				foreach ($modules as $module) {

					$mods[] = $module->id;

				}

				$city->modules = $mods;

			}

			return array('status' => 1, 'data' => $cities);

		} catch (Exception $e) {

			return array('status' => 0, 'message' => $e->getMessage());

		}

	}


}
