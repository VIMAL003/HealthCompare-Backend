<?php

namespace App\Http\Controllers;

use App\Helpers\Utils;
use App\Helpers\Validate;
use App\Models\Blog;
use App\Models\BlogCategory;
use App\Models\Faq;
use App\Models\Hospital;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Log;
use Jenssegers\Agent\Facades\Agent;

class WebController extends BaseController
{
    protected $returnedData = [
        'success'   => false,
        'data'      => []
    ];

    /**
     * Returns a list of Procedures ( at the moment these will be specialties because we don't have the actual list of Procedures)
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function homepage() {
        //Get the request and load it as variables
        $request        = \Request::all();
        $dynamicLocation    = !empty($request['loc'])           ? Validate::escapeString($request['loc'])               : '';
        $dynamicProcedure   = !empty($request['prc'])           ? Validate::escapeString($request['prc'])               : '';
        $dynamicHospital    = !empty($request['hn'])            ? Validate::escapeString($request['hn'])                : '';

        //Dynamic Keyword Insertion Logic
        $dynamicKeywordInsertion                = [
            'location'      => $dynamicLocation,
            'procedure'     => $dynamicProcedure,
            'hospitalName'  => $dynamicHospital
        ];

        $dynamicKeywordText = 'Find the best hospitals';
        if(!empty($dynamicKeywordInsertion['hospitalName']))
            $dynamicKeywordText = 'Compare '.$dynamicKeywordInsertion['hospitalName'].' with others';
        if(!empty($dynamicKeywordInsertion['procedure']))
            $dynamicKeywordText .= ' for '.$dynamicKeywordInsertion['procedure'];
        if(!empty($dynamicKeywordInsertion['location']))
            $dynamicKeywordText .= ' in '.$dynamicKeywordInsertion['location'];

        //Retrieve the list of Procedures sorted by name ASC
        $procedures = Utils::getProceduresForDropdown();
        //Get all the FAQs from DB
        $faqs  = Faq::with('category')->get()->take(3);


        // Get JSON files until data in DB
        $this->returnedData = array_merge($this->returnedData, Utils::getStaticJSONData());
        // Setup Data
        $this->returnedData['success']                          = true;
        $this->returnedData['data']['faqs']                     = $faqs;
        $this->returnedData['data']['dynamicKeywordText']       = $dynamicKeywordText;
        $this->returnedData['data']['procedures']               = $procedures;

        //For Live environment just show the work in progress page
        if(env('APP_ENV') == 'live')
            return view('pages.workInProgress', $this->returnedData);
        return view('pages.homepage', $this->returnedData);
    }

    /**
     * Returns a list of Procedures ( at the moment these will be specialties because we don't have the actual list of Procedures)
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function landingPage() {
        //Get the request and load it as variables
        $request        = \Request::all();
        $dynamicLocation    = !empty($request['loc'])           ? Validate::escapeString($request['loc'])               : '';
        $dynamicProcedure   = !empty($request['prc'])           ? Validate::escapeString($request['prc'])               : '';
        $dynamicHospital    = !empty($request['hn'])            ? Validate::escapeString($request['hn'])                : '';

        //Dynamic Keyword Insertion Logic
        $dynamicKeywordInsertion                = [
            'location'      => $dynamicLocation,
            'procedure'     => $dynamicProcedure,
            'hospitalName'  => $dynamicHospital
        ];

        $dynamicKeywordText = 'Find the best hospitals';
        if(!empty($dynamicKeywordInsertion['hospitalName']))
            $dynamicKeywordText = 'Compare '.$dynamicKeywordInsertion['hospitalName'].' with others';
        if(!empty($dynamicKeywordInsertion['procedure']))
            $dynamicKeywordText .= ' for '.$dynamicKeywordInsertion['procedure'];
        if(!empty($dynamicKeywordInsertion['location']))
            $dynamicKeywordText .= ' in '.$dynamicKeywordInsertion['location'];

        // Get JSON files until data in DB
        $this->returnedData = array_merge($this->returnedData, Utils::getStaticJSONData());
        // Setup Data
        $this->returnedData['success']                          = true;
        $this->returnedData['data']['dynamicKeywordText']       = $dynamicKeywordText;

        //For Live environment just show the work in progress page
        if(env('APP_ENV') == 'live')
            return view('pages.workInProgress', $this->returnedData);
        return view('pages.landing', $this->returnedData);
    }

    /**
     * Retrieves a list of hospitals based on the given inputs ( procedure_id, postcode and radius )
     * Also applies the filters and sorting (if provided)
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function resultsPage() {
        //Get the request and load it as variables
        $request        = \Request::all();
        $postcode       = !empty($request['postcode'])          ? Validate::escapeString($request['postcode'])          : '';
        $procedureId    = !empty($request['procedure_id'])      ? Validate::escapeString($request['procedure_id'])      : '';
        $radius         = !empty($request['radius'])            ? Validate::escapeString($request['radius'])            : 4; //50 miles as default
        $waitingTime    = !empty($request['waiting_time'])      ? Validate::escapeString($request['waiting_time'])      : '';
        $userRating     = !empty($request['user_rating'])       ? Validate::escapeString($request['user_rating'])       : '';
        $qualityRating  = !empty($request['quality_rating'])    ? Validate::escapeString($request['quality_rating'])    : '';
        $hospitalType   = !empty($request['hospital_type'])     ? Validate::escapeString($request['hospital_type'])     : '';
        $policyId       = !empty($request['policy_id'])         ? Validate::escapeString($request['policy_id'])         : '';
        $sortBy         = !empty($request['sort_by'])           ? Validate::escapeString($request['sort_by'])           : '';
        $page           = !empty($request['page'])              ? Validate::escapeString($request['page'])              : '';

        //Set procedure_id to 0 if it's -1
        if($procedureId == '-1')
            $procedureId = 0;

        //Set policy_id to 0 if it's -1
        if($policyId == '-1')
            $policyId = 0;

        //Format the radius with the correct distance
        $radiusSelection = Utils::sliderRange;
        if(array_key_exists($radius, $radiusSelection))
            $radius = $radiusSelection[$radius];
        else
            $radius = 50;

        $hospitals              = Hospital::getHospitalsWithParams($postcode, $procedureId, $radius, $waitingTime, $userRating, $qualityRating, $hospitalType, $policyId, $sortBy, $page);
        $errors                 = $hospitals['errors'];
        $doctor                 = $hospitals['doctor']['text'];
        $delay                  = $hospitals['doctor']['delay'];
        $specialOffers          = $hospitals['data']['special_offers']['items'];
        $outstanding            = $hospitals['data']['special_offers']['outstanding'];
        $outpatientRankings     = $hospitals['data']['outpatientRankings'];
        $inpatientRankings      = $hospitals['data']['inpatientRankings'];
        $waitingTimeRankings    = $hospitals['data']['waitingTimeRanking'];
        $diagnosticRankings     = $hospitals['data']['diagnosticRankings'];
        $hospitals              = $hospitals['data']['hospitals'];

        $sortBys    = Utils::sortBys;
        $procedures = Utils::getProceduresForDropdown();
        $policies   = Utils::getInsurancePoliciesForDropdown();

        $this->returnedData['success']                                  = true;
        $this->returnedData['data']['hospitals']                        = $hospitals;
        $this->returnedData['data']['outpatientRankings']               = $outpatientRankings;
        $this->returnedData['data']['inpatientRankings']                = $inpatientRankings;
        $this->returnedData['data']['waitingTimeRankings']              = $waitingTimeRankings;
        $this->returnedData['data']['diagnosticRankings']               = $diagnosticRankings;
        $this->returnedData['data']['special_offers']                   = $specialOffers;
        $this->returnedData['data']['outstanding']                      = $outstanding;
        $this->returnedData['data']['filters']['procedures']            = $procedures;
        $this->returnedData['data']['filters']['waitingTimes']          = Utils::waitingTimes;
        $this->returnedData['data']['filters']['userRatings']           = Utils::userRatings;
        $this->returnedData['data']['filters']['qualityRatings']        = Utils::qualityRatings;
        $this->returnedData['data']['filters']['hospitalTypes']         = Utils::hospitalTypes;
        $this->returnedData['data']['filters']['policies']              = $policies;
        $this->returnedData['data']['sortBy']                           = $sortBys;
        $this->returnedData['doctor']                                   = $doctor;
        $this->returnedData['delay']                                    = $delay;
        $this->returnedData['hc_errors']                                = $errors;

        //For Live environment just show the work in progress page
        if(env('APP_ENV') == 'live')
            return view('pages.workInProgress', $this->returnedData);

        //If we want to set the headers only for mobile ( dev only )
//        Agent::setUserAgent('Mozilla/5.0 (iPhone; CPU iPhone OS 12_2 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Mobile/15E148');

        //Returning different views for Desktop, Mobile or Tablet
        if(Agent::isDesktop())
            return view('pages.resultspage', $this->returnedData);
        else
            return view('mobile.pages.resultspagemobile', $this->returnedData);
    }

    // Return generic view for pages without specific route
    public function contentPage($slug) {
        return view('pages.contentpage')->with(['slug' => $slug]);
    }

    // Stacking page for components etc
    public function testPage() {
        //Get the request and load it as variables
        $request        = \Request::all();
        $postcode       = !empty($request['postcode'])          ? Validate::escapeString($request['postcode'])          : '';
        $procedureId    = !empty($request['procedure_id'])      ? Validate::escapeString($request['procedure_id'])      : '';
        $radius         = !empty($request['radius'])            ? Validate::escapeString($request['radius'])            : 4; //50 miles as default
        $waitingTime    = !empty($request['waiting_time'])      ? Validate::escapeString($request['waiting_time'])      : '';
        $userRating     = !empty($request['user_rating'])       ? Validate::escapeString($request['user_rating'])       : '';
        $qualityRating  = !empty($request['quality_rating'])    ? Validate::escapeString($request['quality_rating'])    : '';
        $hospitalType   = !empty($request['hospital_type'])     ? Validate::escapeString($request['hospital_type'])     : '';
        $policyId       = !empty($request['policy_id'])         ? Validate::escapeString($request['policy_id'])         : '';
        $sortBy         = !empty($request['sort_by'])           ? Validate::escapeString($request['sort_by'])           : '';

        //Set procedure_id to 0 if it's -1
        if($procedureId == '-1')
            $procedureId = 0;

        //Set policy_id to 0 if it's -1
        if($policyId == '-1')
            $policyId = 0;

        //Format the radius with the correct distance
        $radiusSelection = Utils::sliderRange;
        if(array_key_exists($radius, $radiusSelection))
            $radius = $radiusSelection[$radius];
        else
            $radius = 50;

        $hospitals      = Hospital::getHospitalsWithParams($postcode, $procedureId, $radius, $waitingTime, $userRating, $qualityRating, $hospitalType, $policyId, $sortBy);
        $errors         = $hospitals['errors'];
        $doctor         = $hospitals['doctor'];
        $specialOffers  = $hospitals['data']['special_offers'];
        $hospitals      = $hospitals['data']['hospitals'];

        $sortBys    = Utils::sortBys;
        $procedures = Utils::getProceduresForDropdown();
        $policies   = Utils::getInsurancePoliciesForDropdown();

        $this->returnedData['success']                              = true;
        $this->returnedData['data']['hospitals']                    = $hospitals;
        $this->returnedData['data']['special_offers']               = $specialOffers;
        $this->returnedData['data']['filters']['procedures']        = $procedures;
        $this->returnedData['data']['filters']['waitingTimes']      = Utils::waitingTimes;
        $this->returnedData['data']['filters']['userRatings']       = Utils::userRatings;
        $this->returnedData['data']['filters']['qualityRatings']    = Utils::qualityRatings;
        $this->returnedData['data']['filters']['hospitalTypes']     = Utils::hospitalTypes;
        $this->returnedData['data']['filters']['policies']          = $policies;
        $this->returnedData['data']['sortBy']                       = $sortBys;
        $this->returnedData['doctor']                               = $doctor;
        $this->returnedData['hc_errors']                            = $errors;

        if(env('APP_ENV') != 'live')
            return view('pages.testpage', $this->returnedData);
        return redirect('/');
    }

    // test page just for ajax form
    public function ajaxForm() {
        $procedures = Utils::getProceduresForDropdown();

        $this->returnedData['success']              = true;
        $this->returnedData['data']['procedures']   = $procedures;

        if(env('APP_ENV') != 'live')
            return view('pages.ajaxformpage', $this->returnedData);
        return redirect('/');
    }

    // Cookie policy
    public function cookiePage() {
        return view('pages.cookiepage');
    }

    // Privacy policy
    public function privacyPage() {
        return view('pages.privacypage');
    }

    // Terms and Conditions
    public function termsAndConditionsPage() {
        return view('pages.termsandconditionspage');
    }

    // Your rights
    public function yourRightsPage() {
        //Retrieve the list of Procedures sorted by name ASC
        $procedures = Utils::getProceduresForDropdown();

        $this->returnedData['success']              = true;
        $this->returnedData['data']['procedures']   = $procedures;
        return view('pages.yourrightspage', $this->returnedData);
    }

    // How to use Page
    public function howToUsePage() {
        //Retrieve the list of Procedures sorted by name ASC
        $procedures = Utils::getProceduresForDropdown();
        $policies   = Utils::getInsurancePoliciesForDropdown();

        $this->returnedData['data']['filters']['policies']          = $policies;

        $this->returnedData['success']              = true;
        $this->returnedData['data']['procedures']   = $procedures;

        return view('pages.howtousepage', $this->returnedData);
    }

    // FAQS Page
    public function faqsPage() {
        //Get all the FAQs from DB
        $faqs  = Faq::with('category')->get();
        $this->returnedData['success']      = true;
        $this->returnedData['data']['faqs'] = $faqs;

        return view('pages.faqspage', $this->returnedData);
    }

    // Downloads

    public function download($file_name) {
        $file_path = public_path('downloads/'.$file_name);
        return response()->download($file_path);
    }

    // About us page
    public function aboutUs() {
        //Retrieve the list of Procedures sorted by name ASC
        $procedures = Utils::getProceduresForDropdown();

        $this->returnedData['success']              = true;
        $this->returnedData['data']['procedures']   = $procedures;

        return view('pages.aboutus', $this->returnedData);
    }

    // COVID information page
    public function covidPage() {
        return view('pages.covid', $this->returnedData);
    }

    // Blogs page
    public function blogs() {
        //Retrieve the Blog Categories
        $categories = BlogCategory::all();

        //Retrieve all the Blogs
        $blogs = Blog::orderBy('created_at', 'DESC')->with('category');
        $blogs = $blogs->paginate(12)->onEachSide(1);

        //Return Data
        $this->returnedData['success']              = true;
        $this->returnedData['data']['categories']   = $categories;
        $this->returnedData['data']['blogs']        = $blogs;

        return view('pages.blogarchive', $this->returnedData);
    }

    // Blog Category page
    public function blogCategory($categoryId) {
        if(empty($categoryId))
            return \Redirect::to('/blogs');
        //Retrieve the Blog Categories
        $categories = BlogCategory::all();
        //Retrieve all the Blogs
        $blogs = Blog::where('blog_category_id', $categoryId)->orderBy('created_at', 'DESC')->with('category');
        $blogs = $blogs->paginate(12)->onEachSide(1);

        $this->returnedData['success']              = true;
        $this->returnedData['data']['blogs']        = $blogs;
        $this->returnedData['data']['categories']   = $categories;
        $this->returnedData['data']['categoryId']   = $categoryId;

        return view('pages.blogarchive', $this->returnedData);
    }

    // Blog item page
    public function blogItem($id) {

        $blog = Blog::where('id', $id)->with('author', 'category')->first();
        //If we don't have the Blog, redirect to Blogs ( for the moment )
        if(empty($blog))
            return \Redirect::to('/blogs');
        //Get the latest blogs created excluding the one that the user is reading
        $latestBlogs = Blog::where('id', '!=', $blog->id)->orderBy('created_at', 'DESC')->with('author', 'category')->limit(3)->get()->toArray();

        $this->returnedData['success']      = true;
        $this->returnedData['data']['blog'] = $blog;
        $this->returnedData['data']['latestBlogs'] = $latestBlogs;

        return view('pages.blogitem', $this->returnedData);
    }

    // Attributions page
    public function attributionsPage() {
        return view('pages.attributionspage');
    }
}
