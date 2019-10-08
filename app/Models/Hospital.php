<?php


namespace App\Models;

use App\Helpers\Errors;
use App\Helpers\Utils;
use App\Services\Location;
use Illuminate\Database\Eloquent\Model;

class Hospital extends Model
{
    public $table = 'hospitals';
    public $timestamps = true;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'location_id', 'organisation_id','hospital_type_id', 'address_id', 'trust_id', 'ods_code', 'name', 'tel_number', 'url', 'special_offers', 'status'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'location_id'       => 'string',
        'organisation_id'   => 'string',
        'hospital_type_id'  => 'integer',
        'address_id'        => 'integer',
        'trust_id'          => 'integer',
        'ods_code'          => 'string',
        'name'              => 'string',
        'tel_number'        => 'string',
        'url'               => 'string',
        'special_offers'    => 'boolean',
        'status'            => 'string'
    ];

    /**
     * hospitalType() belongs to HospitalType
     * @return mixed
     */
    public function hospitalType() {
        return $this->belongsTo( '\App\Models\HospitalType', 'hospital_type_id');
    }

    /**
     * address() belongs to Address
     * @return mixed
     */
    public function address() {
        return $this->belongsTo( '\App\Models\Address', 'address_id');
    }

    /**
     * Trust() belongs to Trust
     * @return mixed
     */
    public function trust() {
        return $this->belongsTo( '\App\Models\Trust', 'trust_id');
    }

    /**
     * Admitted() belongs to HospitalAdmitted
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function admitted() {
        return $this->belongsTo( '\App\Models\HospitalAdmitted', 'id', 'hospital_id');
    }

    /**
     * cancelledOps() belongs to HospitalCancelledOps
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function cancelledOp() {
        return $this->belongsTo( '\App\Models\HospitalCancelledOp', 'id', 'hospital_id');
    }

    /**
     * emergency() belongs to HospitalEmergency
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function emergency() {
        return $this->belongsTo( '\App\Models\HospitalEmergency', 'id', 'hospital_id');
    }

    /**
     * maternity() belongs to HospitalMaternity
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function maternity() {
        return $this->belongsTo( '\App\Models\HospitalMaternity', 'id', 'hospital_id');
    }

    /**
     * outpatient() belongs to HospitalOutpatient
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function outpatient() {
        return $this->belongsTo( '\App\Models\HospitalOutpatient', 'id', 'hospital_id');
    }

    /**
     * rating() belongs to HospitalRating
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function rating() {
        return $this->belongsTo( '\App\Models\HospitalRating', 'id', 'hospital_id');
    }

    /**
     * waitingTime() belongs to HospitalWaitingTime
     * @return \Illuminate\Database\Eloquent\Relations\hasMany
     */
    public function waitingTime() {
        return $this->hasMany( '\App\Models\HospitalWaitingTime', 'hospital_id');
    }

    /**
     * policies() belongs to HospitalPolicy
     * @return \Illuminate\Database\Eloquent\Relations\hasMany
     */
    public function policies() {
        return $this->hasMany( '\App\Models\HospitalPolicy', 'hospital_id');
    }

    /**
     * Retrieves a list of hospitals based on the given inputs ( procedure_id, postcode, radius, waiting_time, user_rating, quality_rating, hospital_type )
     * Also applies the filters and sorting (if provided)
     *
     * @param string $postcode
     * @param string $procedureId
     * @param int $radius
     * @param string $waitingTime
     * @param string $userRating
     * @param string $qualityRating
     * @param string $hospitalType
     * @param string $policyId
     * @param string $sortBy
     *
     * @return array
     */
    public static function getHospitalsWithParams($postcode = '', $procedureId = '', $radius = 600, $waitingTime = '', $userRating = '', $qualityRating = '', $hospitalType = '', $policyId = '', $sortBy = '') {
        $hospitals = Hospital::with(['trust', 'hospitalType', 'admitted', 'cancelledOp', 'emergency', 'maternity', 'outpatient', 'rating', 'address', 'policies']);
        //$userRatings    = HospitalRating::selectRaw(\DB::raw("MIN(id) as id, avg_user_rating AS name"))->groupBy(['avg_user_rating'])->whereNotNull('avg_user_rating')->get()->toArray();
        $errors = [];
        $latitude = '';
        $longitude = '';

        //Check if we have the `postcode` and `procedure_id`
        if(!empty($postcode)) {
            //Retrieve the latitude and longitude from the postcode
            $location = new Location($postcode);
            try {
                $location = $location->getLocation();
                $latitude = (string)$location['data']->result->latitude;
                $longitude = (string)$location['data']->result->longitude;
            } catch (\GuzzleHttp\Exception\ClientException $e) {
                //Try to get the first latitude and longitude of the partial postcode
                try {
                    $location = $location->getLocationsByIncompletePostcode();
                    $latitude = (string)$location['data']->result[0]->latitude;
                    $longitude = (string)$location['data']->result[0]->longitude;
                } catch (\Exception $exception) {
                    $latitude = '';
                    $longitude = '';
                }
            }

            //If we don't have data for the Latitude or Longitude, throw an Error. We should always have the right postcode (we need Fronend Validations to make sure that this is the case)
            if(empty($latitude) || empty($longitude))
                $errors[] = ['postcode' => 'Please supply a valid Postcode'];
        }

        if(!empty($latitude) && !empty($longitude)) {
            //Left Join the address so we can sort by radius
            $hospitals = $hospitals->whereHas('address', function($q) use($latitude, $longitude, $radius) {
                $q->selectRaw(\DB::raw("get_distance({$latitude}, {$longitude}, latitude, longitude) AS radius"));
                $q->having('radius', '<', $radius);
            })->join('addresses', 'hospitals.address_id', '=', 'addresses.id')
                ->selectRaw(\DB::raw("hospitals.*, get_distance({$latitude}, {$longitude}, latitude, longitude) AS radius"));
        } else {
            //Left Join the address
            $hospitals = $hospitals->with('address')->join('addresses', 'hospitals.address_id', '=', 'addresses.id')
                ->selectRaw(\DB::raw("hospitals.*"));
        }

        //Check if we have the `procedure_id` and retrieve the relation Waiting Times
        if(!empty($procedureId)) {
            $procedure = Procedure::where('id', $procedureId)->first();
            $specialtyId = $procedure->specialty_id;

        } else {
            $specialty = Specialty::where('name', 'Total')->first();
            $specialtyId = $specialty->id;
        }

        $hospitals = $hospitals->whereHas('waitingTime', function($q) use($specialtyId) {
            $q->bySpecialty($specialtyId);
        });

        //Filter by the Waiting Time
        if(!empty($waitingTime)) {
            $hospitals = $hospitals->whereHas('waitingTime', function($q) use($waitingTime, $specialtyId) {
                $q->bySpecialty($specialtyId);
                $q->where('perc_waiting_weeks', '<=', $waitingTime);
            });
        }

        //Filter by the User Rating
        if(!empty($userRating)) {
            $hospitals = $hospitals->whereHas('rating', function($q) use($userRating) {
                $q->where('avg_user_rating', '>=', $userRating);
            });
        }

        //Filter by the Insurance Policy
        if(!empty($policyId)) {
            $hospitals = $hospitals->whereHas('policies', function($q) use($policyId) {
                $q->where('policy_id', $policyId);
            });
        }

        //Filter by the Quality Rating
        if(!empty($qualityRating)) {
            $hospitals = $hospitals->whereHas('rating', function($q) use($qualityRating) {
                if($qualityRating == 1)
                    $q->whereIn('latest_rating', ['Outstanding']);
                elseif($qualityRating == 2)
                    $q->whereIn('latest_rating', ['Outstanding', 'Good']);
                elseif($qualityRating == 3)
                    $q->whereIn('latest_rating', ['Outstanding', 'Good', 'Requires improvement']);
                elseif($qualityRating == 4)
                    $q->whereIn('latest_rating', ['Outstanding', 'Good', 'Requires improvement', 'Inadequate']);
            });
        }

        //Filter by Hospital Type ( if we have the input )
        if(!empty($hospitalType)) {
            if($hospitalType == 1) {
                $hospitals = $hospitals->whereHas('hospitalType', function($q) {
                    $q->where('name', '=', 'Independent');
                });
            } elseif($hospitalType == 2) {
                $hospitals = $hospitals->whereHas('hospitalType', function($q) {
                    $q->where('name', '=', 'NHS');
                });
            }
        }

//        Sorting the records
        $doctorSort = '';
        if(empty($sortBy)) {
            $hospitals = $hospitals->leftJoin('hospital_ratings', 'hospitals.id', '=', 'hospital_ratings.hospital_id');
            $hospitals = $hospitals->orderByRaw('ISNULL(hospital_ratings.latest_rating), case when hospital_ratings.latest_rating = "Outstanding" then 1 when hospital_ratings.latest_rating = "Good" then 2 when hospital_ratings.latest_rating = "Inadequate" then 3 when hospital_ratings.latest_rating = "Requires improvement" then 4 when hospital_ratings.latest_rating = "Not Yet Rated" then 5 end');
            if(!empty($postcode) && !empty($latitude) && !empty($longitude)) {
                $hospitals = $hospitals->orderBy('radius', 'ASC');
                $doctorSort = 'Care Quality Rating & Distance';
            } else {
                $hospitals = $hospitals->leftJoin('hospital_waiting_time', 'hospitals.id', '=', 'hospital_waiting_time.hospital_id');
                $hospitals = $hospitals->where('hospital_waiting_time.specialty_id', $specialtyId);
                $hospitals = $hospitals->orderByRaw('ISNULL(hospital_waiting_time.perc_waiting_weeks), hospital_waiting_time.perc_waiting_weeks ASC');
                $doctorSort = 'Care Quality Rating & Waiting Time';
            }
        } else {
            if(array_key_exists($sortBy, Utils::sortBys))
                $doctorSort = Utils::sortBys[$sortBy]['name'];
        }

        if(in_array($sortBy, [1, 2])) {
            if(!empty($postcode) && !empty($latitude) && !empty($longitude)) {
                if($sortBy == 1)
                    $hospitals = $hospitals->orderBy('radius', 'ASC');
                else
                    $hospitals = $hospitals->orderBy('radius', 'DESC');
            }
        } elseif (in_array($sortBy, [3, 4])) {
            $hospitals = $hospitals->leftJoin('hospital_waiting_time', 'hospitals.id', '=', 'hospital_waiting_time.hospital_id');
            $hospitals = $hospitals->where('hospital_waiting_time.specialty_id', $specialtyId);
            if($sortBy == 3)
                $hospitals = $hospitals->orderByRaw('ISNULL(hospital_waiting_time.perc_waiting_weeks), hospital_waiting_time.perc_waiting_weeks DESC');
            else
                $hospitals = $hospitals->orderByRaw('ISNULL(hospital_waiting_time.perc_waiting_weeks), hospital_waiting_time.perc_waiting_weeks ASC');

        } elseif (in_array($sortBy, [5, 6])) {
            $hospitals = $hospitals->leftJoin('hospital_ratings', 'hospitals.id', '=', 'hospital_ratings.hospital_id');
            if($sortBy == 5)
                $hospitals = $hospitals->orderByRaw('ISNULL(hospital_ratings.avg_user_rating), hospital_ratings.avg_user_rating ASC');
            else
                $hospitals = $hospitals->orderByRaw('ISNULL(hospital_ratings.avg_user_rating), hospital_ratings.avg_user_rating DESC');
        } elseif (in_array($sortBy, [7, 8])) {
            $hospitals = $hospitals->leftJoin('hospital_cancelled_ops', 'hospitals.id', '=', 'hospital_cancelled_ops.hospital_id');
            if($sortBy == 7)
                $hospitals = $hospitals->orderByRaw('ISNULL(hospital_cancelled_ops.perc_cancelled_ops), hospital_cancelled_ops.perc_cancelled_ops DESC');
            else
                $hospitals = $hospitals->orderByRaw('ISNULL(hospital_cancelled_ops.perc_cancelled_ops), hospital_cancelled_ops.perc_cancelled_ops ASC');
        } elseif (in_array($sortBy, [9, 10])) {
            $hospitals = $hospitals->leftJoin('hospital_ratings', 'hospitals.id', '=', 'hospital_ratings.hospital_id');
            if($sortBy == 9)
                $hospitals = $hospitals->orderByRaw('ISNULL(hospital_ratings.latest_rating), case when hospital_ratings.latest_rating = "Outstanding" then 5 when hospital_ratings.latest_rating = "Good" then 4 when hospital_ratings.latest_rating = "Inadequate" then 3 when hospital_ratings.latest_rating = "Requires improvement" then 2 when hospital_ratings.latest_rating = "Not Yet Rated" then 1 end');
            else
                $hospitals = $hospitals->orderByRaw('ISNULL(hospital_ratings.latest_rating), case when hospital_ratings.latest_rating = "Outstanding" then 1 when hospital_ratings.latest_rating = "Good" then 2 when hospital_ratings.latest_rating = "Inadequate" then 3 when hospital_ratings.latest_rating = "Requires improvement" then 4 when hospital_ratings.latest_rating = "Not Yet Rated" then 5 end');
        } elseif (in_array($sortBy, [11, 12])) {
            $hospitals = $hospitals->leftJoin('hospital_ratings', 'hospitals.id', '=', 'hospital_ratings.hospital_id');
            if($sortBy == 11)
                $hospitals = $hospitals->orderByRaw('ISNULL(hospital_ratings.friends_family_rating), hospital_ratings.friends_family_rating ASC');
            else
                $hospitals = $hospitals->orderByRaw('ISNULL(hospital_ratings.friends_family_rating), hospital_ratings.friends_family_rating DESC');
        } elseif (in_array($sortBy, [13, 14])) {
            if(!empty($specialtyId)) {
                $hospitals = $hospitals->leftJoin('hospital_waiting_time', 'hospitals.id', '=', 'hospital_waiting_time.hospital_id');
                $hospitals = $hospitals->where('hospital_waiting_time.specialty_id', $specialtyId);
                if ($sortBy == 13)
                    $hospitals = $hospitals->orderByRaw(' hospital_waiting_time.perc_waiting_weeks IS NOT NULL ASC, hospital_waiting_time.perc_waiting_weeks ASC');
                else
                    $hospitals = $hospitals->orderByRaw(' hospital_waiting_time.perc_waiting_weeks IS NULL ASC, hospital_waiting_time.perc_waiting_weeks ASC');
            }
        } elseif (in_array($sortBy, [15, 16])) {
            if($sortBy == 15)
                $hospitals = $hospitals->orderByRaw('hospitals.hospital_type_id DESC');
            else
                $hospitals = $hospitals->orderByRaw('hospitals.hospital_type_id ASC');
        }

        $hospitals = $hospitals->with(['waitingTime' => function ($query) use($specialtyId) {
            $query->bySpecialty($specialtyId);
        }]);

        $preHospitals =  $hospitals->get()->toArray();
        $hospitals = $hospitals->paginate(10);

        //Get the special Offers
        $radius = 50;
        do {
            $specialOffers = self::getSpecialOffers($latitude, $longitude, $radius, $specialtyId, $preHospitals);
            $radius += 20;
        } while (count($specialOffers['purple']) == 0 && count($specialOffers['pink']) == 0);

        //Generate text for Doctor Stevini
        $doctor = "<p>Your search returned " . "<strong>" .count($preHospitals). "</strong>" . " hospitals, currently sorted by ".$doctorSort.", with the best at the top.</p>";

        if(empty($latitude) || empty($longitude) || empty($postcode) || empty($procedureId))
            $doctor .= '<p>The most useful results will be achieved if you input a postcode (for postcode) / treatment (for treatment type).</p>';

        $doctor .= '<p>Next, you can either:</p>
            <ul class="highlight-page-elements">
                <li><span class="d-none highlight">#show_filters</span>Click the “Filter Results” to view all the ways in which you may wish to refine your search.</li> 
                <li><span class="d-none highlight">.sort-arrow</span>Click on one of the triangles (arrows?) on the header bar to change the sort order - for example click on the waiting time to view the shortest wait in your search results.</li>
                <li><span class="d-none highlight">.compare</span>Select one or more hospitals to shortlist by clicking the heart / compare logo then click on View shortlist.</li>
                <li><span class="d-none highlight">.enquiry</span>Make an enquiry of a particular hospital relating to NHS funded or self-pay treatment eg more information about consultants. This won’t cost you a penny and does not commit you to anything.</li>
                <li><span class="d-none highlight">.compare-hospitals-bar</span>View the various special offers and Hospital Compare selected best alternatives (the solutions bar).</li>
            </ul>';


        return [
            'data'              => [
                'hospitals'         => $hospitals,
                'special_offers'    => $specialOffers,
            ],
            'doctor'            => $doctor,
            'errors'            => $errors
        ];
    }

    /**
     * Special Offers Algorithm
     * PURPLE
     * IF enter postcode and IF no outstanding hospitals come up within search, show in the solutions bar the nearest outstanding hospital.
     * However, if there is one or more outstanding hospitals, then show hospital with the lowest waiting time within 50 miles regardless of CQC rating. If no results show the lowest within 75 miles…..
     * If no postcode entered, the algorithm should be lowest time in country. And if the same cqc and waiting time - ie part of multi site hospital group, choose main (AT flag).
     * PINK
     * Best Private hospital which satisfies the above (if it isn’t already the purple) or the second best private (if the purple offer is a private hospital)
     *
     * @param string $latitude
     * @param string $longitude
     * @param int $radius
     * @param int $specialtyId
     * @param array $hospitals
     *
     * @return array
     */
    public static function getSpecialOffers($latitude = '', $longitude = '', $radius = 50, $specialtyId = 0, $hospitals = []) {
        $specialOffers = Hospital::with(['trust', 'hospitalType', 'admitted', 'cancelledOp', 'emergency', 'maternity', 'outpatient', 'rating', 'address', 'policies']);
        $outstandingFlag = 0;

        //Parse the hospitals to check if there is an outstanding hospital
        if(!empty($hospitals)) {
            foreach($hospitals as $hospital) {
                if($hospital['rating']['latest_rating'] == 'Outstanding') {
                    $outstandingFlag = 1;
                    break;
                }
            }
        }

        //IF enter postcode and IF no outstanding hospitals come up within search, show in the solutions bar the nearest outstanding hospital.
        if(!empty($latitude) && !empty($longitude)) {
            //Get the nearest Hospital
            $specialOffers = $specialOffers->whereHas('address', function($q) use($latitude, $longitude, $radius) {
                $q->selectRaw(\DB::raw("get_distance({$latitude}, {$longitude}, latitude, longitude) AS radius"));
                $q->having('radius', '<=', $radius);
            })->join('addresses', 'hospitals.address_id', '=', 'addresses.id')
                ->selectRaw(\DB::raw("hospitals.*, get_distance({$latitude}, {$longitude}, latitude, longitude) AS radius"));

        }  else {
            //Left Join the address
            $specialOffers = $specialOffers->with('address')->join('addresses', 'hospitals.address_id', '=', 'addresses.id')
                ->selectRaw(\DB::raw("hospitals.*"));
        }

        //Filter the Special offers by Specialty
        $specialOffers = $specialOffers->whereHas('waitingTime', function($q) use($specialtyId) {
            $q->bySpecialty($specialtyId);
        });
        //Add the relationship based on the Specialty
        $specialOffers = $specialOffers->with(['waitingTime' => function ($query) use($specialtyId) {
            $query->bySpecialty($specialtyId);
        }]);

        if($outstandingFlag == 1) { // Retrieve the lowest waiting time
            $specialOffers = $specialOffers->leftJoin('hospital_waiting_time', 'hospitals.id', '=', 'hospital_waiting_time.hospital_id');
            $specialOffers = $specialOffers->where('hospital_waiting_time.specialty_id', $specialtyId);
            $specialOffers = $specialOffers->orderByRaw('ISNULL(hospital_waiting_time.perc_waiting_weeks), hospital_waiting_time.perc_waiting_weeks ASC');
        } else { // Retrieve the Outstanding
            $specialOffers = $specialOffers->leftJoin('hospital_ratings', 'hospitals.id', '=', 'hospital_ratings.hospital_id');
            $specialOffers = $specialOffers->orderByRaw('ISNULL(hospital_ratings.latest_rating), case when hospital_ratings.latest_rating = "Outstanding" then 1 when hospital_ratings.latest_rating = "Good" then 2 when hospital_ratings.latest_rating = "Inadequate" then 3 when hospital_ratings.latest_rating = "Requires improvement" then 4 when hospital_ratings.latest_rating = "Not Yet Rated" then 5 end');
        }

        if(!empty($latitude) && !empty($longitude)) {
            $specialOffers = $specialOffers->orderBy('radius', 'ASC');
        }

        $purple = $specialOffers->first();
        //Best Private hospital which satisfies the above (if it isn’t already the purple) or the second best private (if the purple offer is a private hospital)
        $prePink = $specialOffers->whereHas('hospitalType', function($q) {
            $q->where('name', '=', 'Independent');
        });
        $pink = $prePink->limit(1)->first();

        if($purple->count() > 0 && $pink->count() > 0) {
            if($purple->id == $pink->id)
                $pink = $prePink->limit(1)->offset(1)->first();
        }

        return [
            'purple'    => $purple->toArray(),
            'pink'      => $pink->toArray()
        ];
    }
}
