<?php

namespace App\Helpers;

use App\Models\Enquiry;
use App\Models\Insurance;
use App\Models\Procedure;
use App\Models\Specialty;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Spatie\Sitemap\SitemapGenerator;



class Utils
{
    //Sort By
    const sortBys = [
        [
            'id'        => '0',
            'name'      => 'Default sorting'
        ],[
            'id'        => '1',
            'name'      => 'Distance',
        ],[
            'id'        => '2',
            'name'      => 'Distance',
            'class'     => 'd-none'
        ],[
            'id'        => '3',
            'name'      => 'Waiting time',
            'class'     => 'd-none'
        ],[
            'id'        => '4',
            'name'      => 'Waiting time'
        ],[
            'id'        => '5',
            'name'      => 'User Rating',
            'class'     => 'd-none'
        ],[
            'id'        => '6',
            'name'      => 'User Rating'
        ],[
            'id'        => '7',
            'name'      => 'Operations Cancelled',
            'class'     => 'd-none'
        ],[
            'id'        => '8',
            'name'      => 'Operations Cancelled'
        ],[
            'id'        => '9',
            'name'      => 'Care Quality Rating',
            'class'     => 'd-none'
        ],[
            'id'        => '10',
            'name'      => 'Care Quality Rating'
        ],[
            'id'        => '11',
            'name'      => 'F&F Rating',
            'class'     => 'd-none'
        ],[
            'id'        => '12',
            'name'      => 'F&F Rating'
        ],
//        [
//            'id'        => '13',
//            'name'      => 'NHS Funded Work',
//            'class'     => 'd-none'
//        ],[
//            'id'        => '14',
//            'name'      => 'NHS Funded Work',
//            'class'     => 'd-none'
//        ],[
//            'id'        => '15',
//            'name'      => 'Private Self Pay',
//            'class'     => 'd-none'
//        ],[
//            'id'        => '16',
//            'name'      => 'Private Self Pay',
//            'class'     => 'd-none'
//        ]
    ];

    //Filter Waiting Times
    const waitingTimes = [
        [
            'id' => '0',
            'name'  => 'View All'
        ],[
            'id' => '10',
            'name'  => 'Up to 10 Weeks'
        ],[
            'id' => '18',
            'name'  => 'Up to 18 Weeks'
        ],[
            'id' => '21',
            'name'  => 'Up to 21 Weeks'
        ],[
            'id' => '24',
            'name'  => 'Up to 24 Weeks'
        ]
    ];

    //Filter User Ratings
    const userRatings = [
        [
            'id' => '0',
            'name'  => 'View All'
        ],[
            'id' => '5',
            'name'  => '5'
        ],[
            'id' => '4',
            'name'  => '4+'
        ],[
            'id' => '3',
            'name'  => '3+'
        ],[
            'id' => '2',
            'name'  => '2+'
        ],[
            'id' => '1',
            'name'  => '1+'
        ]
    ];

    //Filter Quality Ratings
    const qualityRatings = [
        [
            'id' => '0',
            'name'  => 'View All'
        ],[
            'id' => '1',
            'name'  => 'Outstanding Only'
        ],[
            'id' => '2',
            'name'  => 'Good or better'
        ],[
            'id' => '3',
            'name'  => 'Requires Improvement or better'
        ],[
            'id' => '4',
            'name'  => 'Inadequate or better'
        ]
    ];

    //Filter Quality Ratings
    const hospitalTypes = [
        [
            'id' => '0',
            'name'  => 'All Hospitals'
        ],[
            'id' => '1',
            'name'  => 'Private Hospitals'
        ],[
            'id' => '2',
            'name'  => 'NHS Hospitals'
        ]
    ];

    //Filter Distance Radius
    const radius = [
        [
            'id' => 1,
            'name'  => 'Up to 5 miles'
        ],[
            'id' => 2,
            'name'  => 'Up to 10 miles'
        ],[
            'id' => 3,
            'name'  => 'Up to 25 miles'
        ],[
            'id' => 4,
            'name'  => 'Up to 50 miles'
        ],[
            'id' => 5,
            'name'  => 'Up to 100 miles'
        ],[
            'id' => 6,
            'name'  => 'Up to 200 miles'
        ],[
            'id' => 7,
            'name'  => 'England'
        ]
    ];
    //Filter Distance Radius
    const sliderRange = [0, 5, 10, 25, 50, 100, 200, 600];

    public static function generateSitemap() {
        //Check if the file exists or create it
        return SitemapGenerator::create('http://hcstaging.co.uk')->writeToFile(resource_path('sitemap.xml'));
    }
    /**
     * Returns the list of Procedures with the first option as a placeholder
     *
     * @return array
     */
    public static function getProceduresForDropdown() {
        //Get all Specialties with Procedures ordered by name
        $procedures = Specialty::where('name', '<>','Total')->with(['procedures' => function($query) {
            $query->orderBy('name', 'ASC');
        }])->orderBy('name', 'ASC')->get()->toArray();

//        $procedures = Procedure::all()->sortBy('name')->toArray();
        //Add the option to view all procedures ( id = 0 )
        array_unshift($procedures, ['id' => '-1', 'name' => 'Not Known']);
        array_unshift($procedures, ['id' => 0, 'name' => 'Choose your treatment (if known)']);

        return $procedures;
    }

    /**
     * Returns the list of Procedures with the first option as a placeholder
     *
     * @return array
     */
    public static function getInsurancePoliciesForDropdown() {
        //Get all Specialties with Procedures ordered by name
        $policies = Insurance::with(['policies' => function($query) {
//            $query->orderBy('name', 'ASC');
        }])->orderBy('name', 'ASC')->get()->toArray();

//        $procedures = Procedure::all()->sortBy('name')->toArray();
        //Add the option to view all procedures ( id = 0 )
        array_unshift($policies, ['id' => 0, 'name' => 'View All']);

        return $policies;
    }

    public static function getSpecialties() {
        //Get all the Procedures
        $specialties = Specialty::all()->sortBy('id')->toArray();
        //Add the option to view all procedures ( id = 0 )

        return $specialties;
    }

    /**
     * Creates a file based on a given Base64 Image
     *
     * @param $image
     * @param $destinationDir
     * @return mixed
     */
    public static function createFileFromBase64Image($image, $destinationDir) {
        $result = [
            'message' => 'Unable to create the file',
            'success' => false
        ];

        try {
            //Decode the image and store it on the server under the user profile folder
            $img        = explode(',', $image);
            $ini        = substr($img[0], 11);
            $type       = explode(';', $ini);
            $extension  = $type[0];
            $img        = substr($image, strpos($image, ",") + 1);
            $content    = base64_decode($img);

            //Create the directory if it doesn't exists
            if (!is_dir( $destinationDir))
                mkdir($destinationDir, 0777, true);
            $filename = rand() . '.' . $extension;
            //Create the path to the new file
            $sourceFile = $destinationDir . '/'.$filename;
            //Create the file
            \File::put($sourceFile, $content);

            $result = [
                'message'   => 'File successfully created',
                'success'   => true,
                'filename'  => $filename
            ];
            return $result;

        } catch (\Exception $e) {
            //Get the error message and return it
            $result['message'] = $e->getMessage();
            return $result;
        }
    }

    /**
     * Plots a given CSV file to a multidimensional array
     *
     * @param string $filename
     * @param string $delimiter
     * @return array|string
     */
    public static function csvToArray($filename = '', $delimiter = ',') {

        if (!file_exists($filename) || !is_readable($filename))
            return 'Filename does not exists or is not readable';

        $header = null;
        $data = array();
        if (($handle = fopen($filename, 'r')) !== false)
        {
            while (($row = fgetcsv($handle, 100000, $delimiter)) !== false)
            {
                if (!$header)
                    $header = $row;
                else
                    $data[] = array_combine($header, $row);
            }
            fclose($handle);
        }

        return $data;
    }

    /**
     * Calls an API with the given $url, Bearer $token and $data
     * If $data is not supplied, it is a GET request, otherwise it's a POST
     *
     * @param $url
     * @param $token
     * @param bool $data
     * @return mixed|string
     */
    public static function callAPI($url, $token, $data = false) {

        if(empty($token))
            return 'Please supply a Bearer Token';

        $curl = curl_init();

        curl_setopt($curl, CURLOPT_HTTPHEADER, array("Authorization: Bearer {$token}"));

        if(!empty($data)) {
            curl_setopt($curl, CURLOPT_POST, 1);
            if (is_array($data) || is_object($data)) {
                curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));
            } else {
                curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
                curl_setopt($curl, CURLOPT_HTTPHEADER, [
                        'Content-Type: application/json',
                        'Content-Length: ' . strlen($data),
                        "Authorization: Bearer {$token}"
                    ]
                );
            }
        }

        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

        $result = curl_exec($curl);

        curl_close($curl);

        return $result;
    }

    /**
     * Generates HTML code based on a given rating ( between 0 - 5 )
     * NB: Make sure that if this function is changed, the equivalent JQuery function is changed as well ( resultspage.js )
     *
     * @param $rating
     * @return string
     */
    public static function getHtmlStars($rating) {
        //Validation for an empty rating or greater than 5
        if(empty($rating) || $rating > 5 )
            return '';

        // Round down to get number of whole stars needed
        $wholeStars = floor($rating);

        // This will be 1 if you have a half-rating, 0 if not.
        $halfStar = round($rating * 2) % 2;

        // Get the number of empty stars
        $emptyStars = 5 - $wholeStars - $halfStar;

        // This will hold your html markup
        $html = "";

        // write img tags for each whole star
        if($wholeStars > 0) {
            for ($i = 0; $i < $wholeStars; $i++) {
                $html .= "<img class='star-icon' src='images/icons/star-full.svg' alt='Whole Star'>";
            }
        }

        // write img tag for half star if needed
        if ($halfStar) {
            $html .= "<img class='star-icon' src='images/icons/star-half.svg' alt='Half Star'>";
        }

        //Check if we need to add empty stars as image
        if(!empty($emptyStars) && $emptyStars > 0) {
            for ($i = 0; $i < $emptyStars; $i++) {
                $html .= "<img class='star-icon' src='../images/icons/star-outline.svg' alt='Empty Star'>";
            }
        }

        return $html;
    }


    /**
     * Generates HTML code based on a given rating ( CQC ratings )
     *
     * @param $rating
     * @return string
     */
    public static function getDiscOrStar($rating) {
        //Validation for an empty rating
        if(empty($rating) || $rating > 5 )
            return '';

        $html = '';

        $html = ($rating == 'Outstanding') ? '<span class="bg-cqc-star"></span>' : '<span class="cqc-colour bg-'. str_slug($rating) . '"></span>';

        return $html;
    }

    /**
     * Create a CSV with Enquiries on a given period of time
     *
     * @param string $startDate
     * @param string $endDate
     * @return array
     */
    public static function createEnquiriesCsv($startDate = '', $endDate = '') {
        //Check if we have the Directory
        $path = public_path().'/enquiries';
        \File::isDirectory($path) or \File::makeDirectory($path, 0777, true, true);

        //Check if the file has already been created
        if(empty($startDate))
            $filename = 'All_'.date('d-m-Y').'.csv';
        else
            $filename = substr($startDate, 0 , 10).'_'.substr($endDate, 0 , 10).'.csv';

        $file = $path.'/'.$filename;
        //Check if the file exists
        if(\File::exists($file))
            return [
                'path'      => $file,
                'filename'  => $filename,
                'external_link'     => url('/enquiries/'.$filename)
            ];

        $result = [];

        //Get the Enquiries
        if(empty($startDate))
            $enquiries = Enquiry::with('specialty', 'hospital')->get();
        else
            $enquiries = Enquiry::whereBetween('created_at', [$startDate , $endDate])->with('specialty', 'hospital')->get();

        if(!empty($enquiries)) {
            $result[] = [
                'Id',
                'Specialty',
                'Hospital Name',
                'Hospital URL',
                'Title',
                'First Name',
                'Last Name',
                'Email',
                'Phone Number',
                'Postcode',
                'Reason',
                'Additional Information',
                'Created At'
            ];
            //Loop through Enquiries and write them to disk
            foreach($enquiries as $enquiry) {
                $result[] = [
                    $enquiry->id,
                    $enquiry->specialty->name,
                    $enquiry->hospital->name,
                    $enquiry->hospital->url,
                    $enquiry->title,
                    $enquiry->first_name,
                    $enquiry->last_name,
                    $enquiry->email,
                    $enquiry->phone_number,
                    $enquiry->postcode,
                    $enquiry->reason,
                    $enquiry->additional_information,
                    $enquiry->created_at
                ];
            }
        }

        if(!empty($result)) {
            $fp = fopen($file, 'w');
            foreach ($result as $fields) {
                fputcsv($fp, $fields);
            }
            fclose($fp);
        }

        return [
            'path'              => $file,
            'filename'          => $filename,
            'external_link'     => url('/enquiries/'.$filename)
        ];
    }

    /**
     * Gets the position of an array based on a Hospital ID given
     *
     * @param $ranking
     * @param $hospitalId
     * @return false|int|string
     */
    public static function getRankingPosition($ranking, $hospitalId) {
        return array_search($hospitalId, array_column($ranking, 'hospital_id')) + 1;
    }

    /**
     * Replaces asset path substring with another substring
     *
     * @param string $url
     * @param string $toReplace
     * @param string $replaceWith
     * @return string
     */
    public static function convertAssetBaseUrl( $url, $toReplace = '../images', $replaceWith = 'images/rcd' ){
        $returnedString = asset(str_replace( $toReplace, $replaceWith, $url ));
        return $returnedString;
    }

    /**
     * Retrieves and decodes json files
     * from storage/app/data as a key/value pair
     * where the key is the filename and
     * value is the decoded json file k/v pair
     *
     * @return array Key Value pairs
     */
    public static function getStaticJSONData(){
        $dataPath = storage_path('app/data/');
        $returnedData = [];
        foreach (glob("$dataPath*.json") as $file) {
            if ( ! File::exists($file) ){
                continue;
            }
            $fileKey = str_replace( '.json', '', basename($file));
            $fileDecoded = json_decode(file_get_contents($file), true);
            $returnedData[$fileKey] = $fileDecoded;

        }
        return $returnedData;
    }

}
