<?php

namespace App\Http\Controllers;
use App\Models\Job;
use App\Models\Faq;
use App\Models\User;
use App\Models\Location;
use App\Models\Company;
use App\Models\ApplyJob;
use App\Models\FaqCategory;
use App\Models\Skill;
use App\Models\Favorite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FrontController extends Controller
{
    //
    public function detailsjob(Request $request , $id){
        
        $data = Job::find($id);
        return view('Front-end.job-details',compact('data'));
    }

     public function addfav(Request $request , $id){
        if(session()->has('userlogin')){
            $user = session()->get('userid');
            $fav = new Favorite;
            $fav->user_id = $user;
            $fav->job_id = $id;
            $fav->save();
           return redirect()->back()->with('Message','Job Added To fav');
        }
        else{
            return redirect()->back()->with('Error', "Login First.");
        }
    }
     public function getfav(Request $request){
        if(session()->has('userlogin')){
            $user = session()->get('userid');
           $fav = Favorite::where('user_id',$user)->get();
           return view('Front-end.favourites',compact('fav'));
        }
        else{
            return redirect()->back()->with('Error', "Login First.");
        }
    }
     public function profile(Request $request){
        if(session()->has('userlogin')){
            $user = User::where('id',session()->get('userid'))->first();


           return view('Front-end.user-profile',compact('user'));
        }
        else{
            return redirect()->back()->with('Error', "Login First.");
        }
    }
         public function applyjob(Request $request){
        if(session()->has('userlogin')){
            $user = session()->get('userid');
            $userdata = User::where('id',$user)->first();
            $userdata->experience = $request->experience;
            $userdata->skills = implode(',',$request->skills);

            if ($request->hasfile('resume')) {

            $image = $request->file('resume');

            $ext = $image->getClientOriginalExtension();

            $image_name = date('y-m-d') . '-' . rand() . '.' . $ext;

            $image->move('uploads/resumes/', $image_name);

            $userdata->resume = $image_name;

        }
            $userdata->update();
            $apply = new ApplyJob;
            $apply->job_id = $request->id;
            $apply->user_id = session()->get('userid');
            $apply->save();
            return redirect()->back()->with('Message', "Applied !!.");
        }
        else{
            $user = new User;
            $user->skills = implode(',',$request->skills);;
            $user->experience = $request->experience;
             if ($request->hasfile('resume')) {

            $image = $request->file('resume');

            $ext = $image->getClientOriginalExtension();

            $image_name = date('y-m-d') . '-' . rand() . '.' . $ext;

            $image->move('uploads/resumes/', $image_name);

            $userdata->resume = $image_name;

        }
        $user->save();
            return redirect()->back()->with('Message', "Applied !!.");
        }
    }

    public function updateuser(Request $request){
        if(session()->has('userlogin')){
            $user = User::where('id', session()->get('userid'))->first();
            if($user){
                $user->name = $request->name;
                $user->email = $request->email;
                $user->phone = $request->phone;
                $user->experience = $request->experience;
                $user->languages = $request->languages;
                $user->country = $request->country;
                $user->update();
                return redirect()->back()->with('Message', "Updated !!.");
            }
        }
    }
    public function updateinfo(Request $request){
        if(session()->has('userlogin')){
            $user = User::where('id', session()->get('userid'))->first();
            if($user){
                $user->skills = implode(',',$request->skills);
                $user->dob= $request->dob;

                $user->gender = $request->gender;
                $user->hobbies = implode(',',$request->hobbies);

                $user->update();
                return redirect()->back()->with('Message', "Updated !!.");
            }
        }
    }
    public function joblist(){
        $jobdata = Job::paginate(8);
        return view('Front-end.job-list',compact('jobdata'));
    }
    public function jobbycat($id){
        $jobdata = Job::where('cat_id',$id)->paginate(8);
        return view('Front-end.job-list',compact('jobdata'));
    }
    public function jobbyloc($id){
        $location = Location::where('id',$id)->first();
        $jobdata = Job::where('location_available','LIKE','%'. $location->city.'%')->paginate(8);
        return view('Front-end.job-list',compact('jobdata'));
    }

    public function jobbycom($id){
        $jobdata = Job::where('company_id',$id)->paginate(8);
        return view('Front-end.job-list',compact('jobdata'));
    }
    public function jobbyskill($id){

        $jobdata = Job::where('skills','LIKE','%'. $id.'%')->paginate(8);
        return view('Front-end.job-list',compact('jobdata'));
    }

    public function companyprofile($id){

        $company = Company::where('id',$id)->first();
        return view('Front-end.profile',compact('company'));
    }

    public function jobsearch(Request $request){

        $jobdata = Job::orwhere('job_title','LIKE','%'. $request->search.'%')->orwhere('company_name','LIKE','%'. $request->search.'%')->orwhere('cat_name','LIKE','%'. $request->search.'%')->orwhere('job_description','LIKE','%'. $request->search.'%')->orwhere('location_available','LIKE','%'. $request->search.'%')->orwhere('salery','LIKE','%'. $request->search.'%')->orwhere('skills','LIKE','%'. $request->search.'%')->orwhere('experience','LIKE','%'. $request->search.'%')->orwhere('education','LIKE','%'. $request->search.'%')->paginate(8);
        return view('Front-end.job-list',compact('jobdata'));
    }

    public function faqcat(Request $request){

        $faq = FaqCategory::all();
        return view('Front-end.faq',compact('faq'));
    }
    public function faqsearch(Request $request){

        $faq = Faq::orwhere('question','LIKE','%'. $request->search.'%')->paginate(8);
        return view('Front-end.question',compact('faq'));
    }

    public function faqbycat($id){

        $faq = Faq::where('company_id',$id)->paginate(8);
        return view('Front-end.question',compact('faq'));
    }
}
