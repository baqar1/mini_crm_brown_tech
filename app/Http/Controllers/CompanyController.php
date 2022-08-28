<?php

namespace App\Http\Controllers;

use App\Mail\WelcomeMail;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image as Image;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $records = Company::paginate(10);
        return view('admin.companies.company_index',compact('records'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Company $company)
    {
        return view('admin.companies.company_view',compact('company'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|min:3',
            'email' => 'email|unique:companies,email',
            'logo' => 'mimes:jpg,jpeg,png|max:2048',
        ]);
        $fileName =null;
        if ($request->hasFile('logo')) {
            $image      = $request->file('logo');
            $fileName   = time() . '.' . $image->getClientOriginalExtension();

            $img = Image::make($image->getRealPath());
            $img->resize(100, 100, function ($constraint) {
                $constraint->aspectRatio();                 
            });

            $img->stream(); // <-- Key point

            //dd();
            Storage::disk('public')->put('company'.'/'.$fileName, $img, 'public');
        }
        $company = new Company();
        $company->name = $request->name;
        $company->email = $request->email;
        $company->logo = $fileName;
        $email = $company->save();
        //send email when new company register
        //because i dont need test email account server
        // if($email){
        //     Mail::to($company->email)->send(new WelcomeMail($company));
        // }
        return redirect()->route('company.index')->with('message','Record Created Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function show(Company $company)
    {
        dd('hello in show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function edit(Company $company)
    {
        return view('admin.companies.company_view',compact('company'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Company $company)
    {
        $request->validate([
            'name' => 'required|min:6',
            'email' => 'email',
            'logo' => 'mimes:jpg,jpeg,png|max:2048',
        ]);
        $fileName =null;
        if ($request->hasFile('logo')) {
            $image      = $request->file('logo');
            $fileName   = time() . '.' . $image->getClientOriginalExtension();

            $img = Image::make($image->getRealPath());
            $img->resize(100, 100, function ($constraint) {
                $constraint->aspectRatio();                 
            });

            $img->stream(); // <-- Key point

            //dd();
            Storage::disk('public')->put('company'.'/'.$fileName, $img, 'public');
        }
        $company->name = $request->name;
        $company->email = ($request->email!=null)?$request->email:$company->email;
        $company->logo = ($fileName==null)?$company->logo:$fileName;
        $company->save();
        return redirect()->route('company.index')->with('message','Record Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function destroy(Company $company)
    {
        $company->delete();
        return redirect()->route('company.index')->with('message','Record Deleted Successfully');
    }
}
