<?php

namespace App\Http\Controllers;

use App\Models\AboutContent;
use App\Models\CreateSection;
use App\Models\IndexContent;
use App\Models\RentStudio;
use App\Models\ShortsModel;
use App\Models\ShowAssignModel;
use App\Models\ShowModel;
use App\Models\ShowTypeModel;
use App\Models\TeamMember;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Mail;
use App\Models\RentEnquiry;
use App\Mail\SendMail;

class WebsiteController extends Controller
{
    public function index()
    {
        $currentRoute = Route::currentRouteName();
        if ($currentRoute == 'show') {
            $data['title'] = 'Our Shows';
        } elseif ($currentRoute == 'shorts') {
            $data['title'] = 'Our Shorts';
        } elseif ($currentRoute == 'contact') {
            $data['title'] = 'Contact Us';
        } else {
            $data['title'] = 'Basic Funde Clear';
        }
        // $data['shows'] = ShowModel::where('status', 1)->orderBy('position_by', 'asc')->get();
        $data['shows'] = ShowTypeModel::where('status', 1)
            ->orderBy('position_by', 'asc')->withCount('assignedShows')
            ->get();
        $data['indexcontent'] = IndexContent::where('status', 1)->orderBy('position_by', 'asc')->first();
        $data['metadata'] = IndexContent::where('status', 1)->orderBy('position_by', 'asc')->first();
        $data['showtypes'] = ShowTypeModel::where('status', 1)
            ->orderBy('position_by', 'asc')->limit(4)
            ->withCount('assignedShows') // Include count of assigned shows for each show type
            ->get();
            // dd($data['showtypes']);

        // Get the relevant showtype_ids from the showassign table
        $assignedShowTypeIds = ShowAssignModel::where('status', 1)->pluck('showtype_id');

        // Filter assignshowtypes based on the retrieved showtype_ids
        $data['assignshowtypes'] = ShowTypeModel::whereIn('id', $assignedShowTypeIds)
            ->where('status', 1)
            ->orderBy('position_by', 'asc')->limit(4)
            ->get();
        $data['showassigns'] = ShowAssignModel::where('status', 1)->with('showtype')->orderBy('position_by', 'asc')->get();
        $data['firstsectionsheadings'] = CreateSection::where(['status' => 1, 'id' => 1])->orderBy('position_by', 'asc')->first();
        $data['secondsectionsheadings'] = CreateSection::where(['status' => 1, 'id' => 2])->orderBy('position_by', 'asc')->first();
        $data['shortssectionsheadings'] = CreateSection::where(['status' => 1, 'id' => 3])->orderBy('position_by', 'asc')->first();

        $data['shorts'] = ShortsModel::where('status', 1)->orderBy('position_by', 'asc')->get();

        return view('website.index', $data);
    }

    public function about()
    {
        $data['title'] = 'About Page';
        $data['aboutcontent'] = AboutContent::where('status', 1)->orderBy('position_by', 'asc')->first();
        $data['metadata'] = AboutContent::where('status', 1)->orderBy('position_by', 'asc')->first();

        $data['teammembers'] = TeamMember::where('status', 1)->orderBy('position_by', 'asc')->get();
        return view('website.about', $data);
    }

    public function rentstudiodetails()
    {
        $data['title'] = 'Rent Studio';
        $data['metadata'] = IndexContent::where('status', 1)->orderBy('position_by', 'asc')->first();
        $data['rentstudios'] = RentStudio::where('status', 1)->orderBy('position_by', 'asc')->get();
        // dd($data['rentstudios']);
        return view('website.rentstudio', $data);
    }

    public function ShowDetails(Request $request, $title, $subtitle, $id)
    {

        $data['title'] = 'Show Details';
        if (!empty($id)) {
            $originalId = base64_decode($id);

            $allshowtypes = ShowTypeModel::where(['id' => $originalId, 'status' => 1])->orderBy('position_by', 'asc')->first();

            if (!empty($allshowtypes)) {
                $allshowdetails = ShowAssignModel::where(['showtype_id' => $originalId, 'status' => 1])->orderBy('position_by', 'asc')->get();
                $data['showtypes'] = $allshowtypes;
                $data['showdetails'] = $allshowdetails;

                if (empty($allshowtypes)) {
                    $data['showdetails'] = '';
                }

                return view('website.showdetails', $data);
            } else {
                return redirect()->back();
            }
        } else {
            return redirect()->back();
        }
    }
    public function privacypolicy()
    {
        $data['title'] = 'Privacy Policy';
        return view('website.privacypolicy', $data);
    }
    public function DPDP_Act()
    {
        $data['title'] = 'DPDP Act';
        return view('website.dpdp_act', $data);
    }
    public function termsandconditions()
    {
        $data['title'] = 'Terms and Conditions';
        return view('website.termsandconditions', $data);
    }


    public function rentenquiry(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'mobile' => 'required|digits:10',
            'start_date' => 'required',
            'end_date' => 'required',
            'message' => 'required',
        ]);

        // Store the rent enquiry data
        RentEnquiry::create($request->all());

        // Mail data for user
        $userMailData = [
            'title' => 'Thanks for your enquiry to Basic Funde Clear!',
            'body' => 'We have received your enquiry. Our team will get back to you shortly.'
        ];

        // Mail data for admin
        $adminMailData = [
            'name' => $request->name,
            'email' => $request->email,
            'mobile' => $request->mobile,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'info' => $request->message,
        ];

        try {
            // Send to user
            Mail::to($request->email)->send(new SendMail($userMailData, 'user'));

            // Send to admin
            Mail::to('info@basicfundeclear.com')->send(new SendMail($adminMailData, 'admin'));

            return response('success');
        } catch (\Exception $e) {
            // Optionally log error: Log::error($e->getMessage());
            return response('error');
        }
    }
}
