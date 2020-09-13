<?php

namespace App\Http\Controllers;

use App\Application;
use App\Classes;
use App\Document;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;
use Intervention\Image\Facades\Image;
use Session;
use Purifier;

use App\Http\Requests;

class ApplicationController extends Controller
{
    public function __construct()
    {
        //$this->middleware('auth');
        //$this->middleware('role:admin')
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $applications = Application::orderBy('id', 'desc')->paginate(10);
        return view('applications.index')->withApplications($applications);
    }

    public function search(Request $request)
    {
        $applications = Application::where('application_ref', 'like', '%' . $request->application_ref . '%')
            ->orderBy('lastname')->paginate(10);
        return view('applications.index')->withApplications($applications);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('applications.create');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function prospect()
    {
        return view('applications.prospect');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'teller_number' => 'required|max:255',
        ]);

        $application_ref = $random = time() . rand(10*45, 100*98);
        $app_exist = Application::where('teller_number', '=', $request->teller_number )->first();
        if ($app_exist) {
            Session::flash('danger', ' Teller No already Exists in our system');
            return redirect()->route('application.create');
        } else {

            $application = new Application();
            $application->application_ref = $application_ref;
            $application->teller_number = $request->teller_number;
            $application->status = '1';
            $application->save();

            Session::flash('success', ' Application Created Successfully');
            return redirect()->route('application.edit', $application->id);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $application = Application::find($id);

        $documents = Document::where([
            ['class_id','=',$application->entry_class],
            ['document_type_id','=', 1] // Document Type Past Questions
        ])->get();


        $data = $this->getApplicationEnums();
        return view('applications.show')->withApplication($application)->with($data)->withDocuments($documents);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function retrieve(Request $request)
    {
        //
        $this->validate($request, [
            'application_ref' => 'required|max:255',
        ]);

        $app = Application::where('application_ref', '=', $request->application_ref )->first();
        if (!$app) {
            Session::flash('danger', ' Invalid Application Reference No.');
            return redirect()->route('application.prospect');
        } else {
            $route = $app->status == '2' ? "viewapplication/$app->id" : "editapplication/$app->id";
            return redirect($route);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function postRetrieve(Request $request)
    {
        //
        $this->validate($request, [
            'application_ref' => 'required|max:255',
        ]);

        $application = Application::where('application_ref', '=', $request->application_ref )->first();
        if (!$application) {
            Session::flash('danger', ' Invalid Reference No.');
            return redirect()->route('application.prospect');
        } else {
            $view = $application->status == '2' ? 'applications.show' : 'applications.edit';
            $data = $this->getApplicationEnums();
            return view($view)->withApplication($application)->with($data);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $application = Application::find($id);
        if(Auth::user() && Auth::user()->hasRole('admin')) {
            $view = 'applications.edit';
        }else {
            $view = $application->status == '2' ? 'applications.show' : 'applications.edit';
        }
        $data = $this->getApplicationEnums();
        return view($view)->withApplication($application)->with($data);
    }

    private function getApplicationEnums()
    {
        return [
            'entry_classes' => Classes::all(),
            'enrollment_centres' => [
                '' => '-- Select Centre--',
                'abuja' => 'Abuja',
                'ilorin' => 'Ilorin',
                'lagos' => 'Lagos',
                'port-harcourt' => 'Port-Harcourt',
                'warri' => 'Warri'
            ],
            'enrollment_types' => [
                '' => '-- Select Enrollment Type --',
                'boarding' => 'BOARDING SCHOOL',
                'day' => 'DAY SCHOOL',
            ],
            'genders' => [
                '' => '-- Select Gender--',
                'f' => 'FEMALE',
                'm' => 'MALE',
            ],
            'remarks' => [
                '' => '-- Select Remarks --',
                'admitted' => 'ADMITTED',
                'admitted_with_concession' => 'ADMITTED_WITH_CONCESSION',
                'not_admitted' => 'NOT_ADMITTED'
            ]
        ];
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $application = Application::find($id);

        $this->validatesRequest($request, true);
        $this->setApplicationData($application, $request);

        // Save Applicant's image
        $image = $request->file('image');
        if($image) {
            $filePath = 'img/admission/' . $application->application_ref . '/';
            if (!File::exists(public_path($filePath))) {
                // path does not exist
                File::makeDirectory(public_path($filePath), 0777, true);
            }
            $filename = $image->getClientOriginalName();
            $filenamethumb = 'thumbnail' . $filename;
            Image::make($image)->save(public_path($filePath . $filename));
            Image::make($image)->resize(60, 40)->save(public_path($filePath . $filenamethumb));


            $application->image_name = $filename;
        }
        $application->status = '2';
        $application->save();

        Session::flash('success', ' Application Submitted  Successfully!');
        return redirect()->route('application.viewapp');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $application = Application::find($id);
        $application->delete();

        Session::flash('success',' Application successfully deleted!');
        return redirect()->route('application.index');
    }

    private function validatesRequest(Request $request, $is_update = false)
    {
        $validation_config = [
            'entry_class' => 'required',
            'enrollment_centre' => 'required',
            'enrollment_type' => 'required',
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'gender' => 'required',
            'date_of_birth' => 'required',
            'place_of_birth' => 'required',
            'image' => 'required|image',
            'father_first_name' => 'required',
            'father_last_name' => 'required',
            'father_contact_address' => 'required',
            'father_contact_number_1' => 'required',
            'mother_first_name' => 'required',
            'mother_last_name' => 'required',
            'mother_contact_address' => 'required',
            'mother_contact_number_1' => 'required',
            'sponsor_first_name' => 'required',
            'sponsor_last_name' => 'required',
            'sponsor_contact_address' => 'required',
            'sponsor_contact_number_1' => 'required',
            'sponsor_relationship' => 'required',
        ];

        if($is_update) {
            $validation_config['image'] = 'sometimes|image';
        }

        $this->validate($request, $validation_config);
    }

    private function setApplicationData($application, Request $request)
    {
        $application->entry_class = $request->entry_class;
        $application->enrollment_centre = $request->enrollment_centre;
        $application->enrollment_type = $request->enrollment_type;

        $application->first_name = $request->first_name;
        $application->last_name = $request->last_name;
        $application->other_names = $request->other_names;
        $application->email = $request->email;
        $application->gender = $request->gender;
        $application->date_of_birth = $request->date_of_birth;
        $application->place_of_birth = $request->place_of_birth;
        $application->previous_school = $request->previous_school;
        $application->reason_for_leaving = $request->reason_for_leaving;
        $application->individual_peculiarity = $request->individual_peculiarity;

        $application->father_first_name = $request->father_first_name;
        $application->father_last_name = $request->father_last_name;
        $application->father_other_names = $request->father_other_names;
        $application->father_email = $request->father_email;
        $application->father_contact_address = $request->father_contact_address;
        $application->father_postal_address = $request->father_postal_address;
        $application->father_contact_number_1 = $request->father_contact_number_1;
        $application->father_contact_number_2 = $request->father_contact_number_2;

        $application->mother_first_name = $request->mother_first_name;
        $application->mother_last_name = $request->mother_last_name;
        $application->mother_other_names = $request->mother_other_names;
        $application->mother_email = $request->mother_email;
        $application->mother_contact_address = $request->mother_contact_address;
        $application->mother_postal_address = $request->mother_postal_address;
        $application->mother_contact_number_1 = $request->mother_contact_number_1;
        $application->mother_contact_number_2 = $request->mother_contact_number_2;

        $application->sponsor_first_name = $request->sponsor_first_name;
        $application->sponsor_last_name = $request->sponsor_last_name;
        $application->sponsor_other_names = $request->sponsor_other_names;
        $application->sponsor_email = $request->sponsor_email;
        $application->sponsor_contact_address = $request->sponsor_contact_address;
        $application->sponsor_postal_address = $request->sponsor_postal_address;
        $application->sponsor_contact_number_1 = $request->sponsor_contact_number_1;
        $application->sponsor_contact_number_2 = $request->sponsor_contact_number_2;
        $application->sponsor_relationship = $request->sponsor_relationship;

        $application->score = $request->score;
        $application->remark = $request->remark;
    }
}
