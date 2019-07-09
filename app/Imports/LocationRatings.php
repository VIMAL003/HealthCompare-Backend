<?php


namespace App\Imports;


use App\Helpers\Utils;
use App\Imports\DefaultImport;
use App\Models\Address;
use App\Models\Hospital;
use App\Models\HospitalRating;
use App\Models\HospitalType;
use App\Models\Trust;

/**
 * Populates the Hospitals OR Trusts with the related Rating
 */
class LocationRatings extends DefaultImport {

    public $requestedTypes = ['Independent', 'NHS', 'NHS*'];

    public function handle() {
        //Check if we have data
        if(!empty($this->data) && is_array($this->data)) {
            //Loop through the data
            foreach($this->data as $item) {


                //Check if we have the Hospital by Location ID
                $hospital = Hospital::where('location_id', $item['Location ID'])->orWhere('organisation_id', $item['Location ID'])->first();

                //If we have the Hospital we can update the User Ratings
                if(!empty($hospital)) {
                    //Check if we already have a rating for that Hospital and update it
                    $rating = HospitalRating::updateOrInsert([
                        'hospital_id'       => $hospital->id
                    ], [
                        'provider_rating'   => $item['Provider Rating'],
                        'latest_rating'     => $item['Latest Rating'],
                    ]);
                    $this->returnedData[] = $rating->first();
                } else {
                    //Add the item as excluded and skip the record
                    $this->excludedData[] = $item;
                    continue;
                }
            }
        }
        return ['excludedData' => $this->excludedData, 'returnedData' => $this->returnedData];
    }
}