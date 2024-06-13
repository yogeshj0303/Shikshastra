<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Models\Job;
use App\Models\Admin;
use App\Models\Skill;
use App\Models\Category;
use App\Models\EmployerNotification;
use App\Models\Location;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;
use Carbon\Carbon;
class JobPostController extends Controller
{

 public function indexNear(Request $request)
    {
         $selectedLocation = $request->input('location', []);
          $query = Job::query();
             if (!empty($selectedLocation)) {
        $query->whereIn('location', $selectedLocation);
    }
          $jobss = $query->orderBy('id','DESC')->get();
         if(Session::get('user_id')){
          foreach($jobss as $temp){
            $temp->apply_job_status=0;
              $wish = DB::table('apply_jobs')->where('user_id',Session::get('user_id'))->where('job_id',$temp->id)->count();
               
              if($wish > 0){
                  $temp->apply_job_status = 1;
              }
          }
          foreach($jobss as $new){
                          $new->saved_job_status=0;
              $save = DB::table('saved_jobs')->where('user_id',Session::get('user_id'))->where('job_id',$new->id)->count();
               
              if($save > 0){
                  $new->saved_job_status = 1;
              }
              
          }
}

  return view('Front-end.search_nearby_jobs',compact('jobss'));       
    }


    public function indexShow(Request $request)
    {
        
    
       
   
      
      
          //   get all filter variable data
   
          $selectedCategories = $request->input('job_type', []);
          $selectedLocation = $request->input('location', []);
          $selectedPrices = $request->input('salary', []);
          $selectedsalary = $request->input('salary1',[]);
        
          $query = Job::query();
          // ... (Your existing query building code)
  
    // category filter from t-shirt page
    
      if (!empty($selectedLocation)) {
        $query->whereIn('location', $selectedLocation);
    }
    if (!empty($selectedCategories)) {
        $query->orWhere('job_type', $selectedCategories);
    }
 
    if (!empty($selectedsalary)) {
        $query->orWhere('salary', $selectedsalary);
    }

    if (!empty($selectedPrices)) {
          $priceConditions = [];
          foreach ($selectedPrices as $selectedPrice) {
              [$minPrice, $maxPrice] = explode('-', $selectedPrice);
              $priceConditions[] = [(int) $minPrice, (int) $maxPrice];
          }
          $query->where(function ($query) use ($priceConditions) {
              foreach ($priceConditions as $condition) {
                  $query->orWhereBetween('salary', $condition);
              }
          });
      }
       
   
  
          $jobss = $query->orderBy('id', 'DESC')->get();
         if(Session::get('user_id')){
          foreach($jobss as $temp){
            $temp->apply_job_status=0;
              $wish = DB::table('apply_jobs')->where('user_id',Session::get('user_id'))->where('job_id',$temp->id)->count();
               
              if($wish > 0){
                  $temp->apply_job_status = 1;
              }
          }
          
                foreach($jobss as $new){
                          $new->saved_job_status=0;
              $save = DB::table('saved_jobs')->where('user_id',Session::get('user_id'))->where('job_id',$new->id)->count();
               
              if($save > 0){
                  $new->saved_job_status = 1;
              }
              
          }
}
       
        return view('Front-end.find_jobs',compact('jobss'));
   
        
    }


   
 public function index()
{
    if(Session::get('adminId')){
       
        $user=DB::table('admins')->where('id',Session::get('adminId'))->orderBy('id', 'DESC')->first();
      
        if(($user->is_admin) != 1){
    $data = Job::leftJoin('categories', 'jobs.category_id', '=', 'categories.id')->select('jobs.*', 'categories.name as category_name')->where('jobs.post_user_id',$user->id)
        ->paginate(5);
        }
        else{
           $data = Job::leftJoin('categories', 'jobs.category_id', '=', 'categories.id')->select('jobs.*', 'categories.name as category_name')
        ->paginate(5);
          
        }

    return view('admin.job.index', compact('data'));
    }
    else{
       return redirect('/admin-login')->with('Error', 'Login first');  
    }
}

 public function indexEmployerjob()
    {
        
        $skills=Skill::all();
        $categories = Category::all();
       $job = Job::all();
       $locations = Location::all();
       $adminWebsites = Admin::pluck('website', 'id');
       
        return view('Front-end.post_job',compact('job','categories','locations','skills','adminWebsites'));
    }


    public function create()
    {
        $skills=Skill::all();
        $categories = Category::all();
       $job = Job::all();
       $locations = Location::all();
       $adminWebsites = Admin::pluck('website', 'id');
        return view('admin.job.create',compact('job','categories','locations','skills','adminWebsites'));
    }

    
    public function store(Request $request)
    {
if(Session::get('adminId')){
$request->validate([
    'category_id' => 'required', 
    'job_title' => 'required',
    'job_type' => 'required|string',
    
    'experience' => 'required', 
    'last_date' => 'required|date|after_or_equal:today',
    'openings' => 'required',
    'selected_skills' => 'required', 
    'probation_salary' => 'required',
    'about_job' => 'required',
    'salary' => 'required',
    'probation_duration' => 'required', 
    'website' => ['required', 'regex:/^www\..+/i'],
    'location' => 'required',
]);
     
      $data= new Job;
      
      
        $data->post_user_id=Session::get('adminId');
        
       $data->category_id= $request->category_id;
      $data->job_title= $request->job_title;
      $data->job_type= $request->job_type;
      $data->experience= $request->experience;
     $data->last_date = $request->last_date;
      $data->skills= $request->selected_skills;
       $data->openings= $request->openings;
       $data->probation_salary= $request->probation_salary;
      $data->about_job= $request->about_job;
       $data->salary= $request->salary;
        $data->probation_duration= $request->probation_duration;
        $data->website= $request->website;
      $data->location= $request->location;
       
       
       $data->post_date = Carbon::now()->format("j F Y");
    //   $data->last_date = Carbon::now()->format("j F Y");
      $data->save();
     
if($data){

                 $eve = Admin::where('id',session()->get('adminId'))->first();
                 $eve->job_post_noti = 1;
                 if($eve->update()){
                       $adminNoti = new EmployerNotification;
                       $adminNoti->user_id = session()->get('adminId');
                       $adminNoti->is_admin=$eve->is_admin;
                       $adminNoti->job_id=$data->id;
                       $adminNoti->type = "Job Posted";
                       $adminNoti->date = Carbon::now()->format("Y-m-d");
                       $adminNoti->message = " $eve->username Job posted";
                       $adminNoti->save();
                         }

        return redirect()->route('job.index')->with('Message', 'Job posted successfully!');
    }
    }
    else{
       return redirect('/admin-login')->with('Error', 'Login first');  
    }
}

     public function edit($id)
{
     if(Session::get('adminId')){
    $data = Job::find($id);
    $skills=Skill::all();
    $categories = Category::all();
    $locations = Location::all();
    
    return view('admin.job.edit', compact('data','categories','skills','locations'));
    
     }
    else{
       return redirect('/admin-login')->with('Error', 'Login first');  
    }
}




    
public function update(Request $request, $id)
{
      if(Session::get('adminId')){
          
          $request->validate([
    'category_id' => 'required', 
    'job_title' => 'required',
    'job_type' => 'required|string',
    'experience' => 'required', 
    'last_date' => 'required|date|after_or_equal:today',
    'openings' => 'required',
    'selected_skills' => 'required', 
    'probation_salary' => 'required',
    'about_job' => 'required',
    'salary' => 'required',
    'probation_duration' => 'required', 
    'website' => ['required', 'regex:/^www\..+/i'],
    'location' => 'required',
]);
    $data = Job::find($id);
    $originalValues = $data->toArray(); // Corrected from $row to $data

    $data->category_id = $request->get('category_id');
    $data->job_title = $request->get('job_title');
    $data->job_type = $request->get('job_type');
    // $data->post_date = $request->get('post_date');
    $data->experience = $request->get('experience');
    $data->about_job = $request->get('about_job');
    $data->website = $request->get('website');
    $data->location = $request->get('location');
    $data->salary = $request->get('salary');
    $data->skills = $request->get('selected_skills');
     $data->openings = $request->get('openings');
      $data->probation_salary = $request->get('probation_salary');
       $data->probation_duration = $request->get('probation_duration');
        $data->last_date = $request->get('last_date');
         
 


  

    $updatedFields = array_diff_assoc($data->toArray(), $originalValues);

    if (empty($updatedFields)) {
        return redirect()->route('job.index')->with('Message', 'No changes were made.');
    }

    if ($data->save()) {
        return redirect()->route('job.index')->with('Message', 'Job Updated Successfully');
   

}
 }
    else{
       return redirect('/admin-login')->with('Error', 'Login first');  
    }
}

 
    public function destroy($id)
    {
        if(Session::get('adminId')){
        $data = Job::find($id);
        if ($data->delete()){
         return redirect()->back()->with('Message', "Job deleted successfully.");
        }
        else{
         return redirect()->back()->with('Error', "Something went wrong.");
        }
}
    else{
       return redirect('/admin-login')->with('Error', 'Login first');  
    }
    }
    
     public function getJobCount()
    {
        $jobCount = DB::table('jobs')->count();

        return response()->json(['jobCount' => $jobCount]);
    }
    
        public function showDetails($job_id)
    {
        $job = Job::findOrFail($job_id);
        
            
        $company = Admin::where('website', $job->website)->first();
     
     
          if(session::get('user_id')){
         
              
            $job->apply_job_status=0;
              $wish = DB::table('apply_jobs')->where('user_id',session::get('user_id'))->where('job_id',$job->id)->count();
               
              if($wish > 0){
                  $job->apply_job_status = 1;
              }
          
}

        return view('Front-end.job_description', compact('job', 'company'));
    }
    



   public function searchJobs(Request $request)
{
    $location = $request->input('location');
        
    $jobs = Job::where('location', 'LIKE', "%$location%")->get();
        
    return back()->with(compact('location', 'jobs'));
}

    
public function showJobDetails($job_id)

{
    $company = Job::find($job_id);

    if (!$company) {
        abort(404); // Handle job not found scenario
    }

   

   

    return view('Front-end.Job_details', compact( 'company'));
}



    
    
    
public function filter(Request $request)
{
    $categoryFilter = $request->input('category_id');
    
    $query = Job::query();
    
    if ($categoryFilter) {
        $query->whereHas('category', function ($q) use ($categoryFilter) {
            $q->where('name', $categoryFilter);
        });
    }

    $jobs = $query->get();
    

    // Pass the filtered $jobs and $categoryFilter to the view
   return view('admin.job.index', compact('jobs', 'categoryFilter'));
}

    
public function newapply(Request $request,$user_id)
{
   
  $apply_user_data=DB::table('users')
 ->where('users.id',$user_id)->first();
 
   $exp = DB::table('experiences')->where('user_id',$apply_user_data->id)->get();
    $apply_user_data->exp_data=$exp;
    
    $quality = DB::table('qualities')->where('user_id',$apply_user_data->id)->get();
    $apply_user_data->quality_data=$quality;
    
       $educ = DB::table('education')->where('user_id',$apply_user_data->id)->get();
    $apply_user_data->education_data=$educ;
    
     $doc = DB::table('documents')->where('user_id',$apply_user_data->id)->get();
    $apply_user_data->document_data=$doc;
  
    return view('Front-end.show_candidate',compact('apply_user_data'));  
}

 public function status(Request $request)
    {
        dd($request);
         if(Session::get('Employer_id')){
             $user_id=$request->user_id;
       $job_id=$request->job_id;
        $model =DB::table('apply_jobs')-> where('user_id','=',$user_id)->where('job_id',$job_id)->first();

   
        return redirect()->back()->with('success', 'Candidate status changed');

 
   }
    
 
    else{
      return redirect('admin-login')->with('error', 'Login First');

}
} 
// front end job post

  public function jobPost(Request $request)
    {
if(Session::get('Employer_id')){
$request->validate([
    'category_id' => 'required', 
    'job_title' => 'required',
    'job_type' => 'required|string',
    
    'experience' => 'required', 
    'last_date' => 'required|date|after_or_equal:today',
    'openings' => 'required',
    'selected_skills' => 'required', 
    'probation_salary' => 'required',
    'about_job' => 'required',
    'salary' => 'required',
    'probation_duration' => 'required', 
    'website' => ['required', 'regex:/^www\..+/i'],
    'location' => 'required',
]);
     
      $data= new Job;
      
      
        $data->post_user_id=Session::get('Employer_id');
        
       $data->category_id= $request->category_id;
      $data->job_title= $request->job_title;
      $data->job_type= $request->job_type;
      $data->experience= $request->experience;
     $data->last_date = $request->last_date;
      $data->skills= $request->selected_skills;
       $data->openings= $request->openings;
       $data->probation_salary= $request->probation_salary;
      $data->about_job= $request->about_job;
       $data->salary= $request->salary;
        $data->probation_duration= $request->probation_duration;
        $data->website= $request->website;
      $data->location= $request->location;
       
       
      $data->post_date = Carbon::now()->format("j F Y");
    //   $data->last_date = Carbon::now()->format("j F Y");
      $data->save();
     
if($data){

                 $eve = Admin::where('id',session()->get('Employer_id'))->first();
                 $eve->job_post_noti = 1;
                 if($eve->update()){
                       $adminNoti = new EmployerNotification;
                       $adminNoti->user_id = session()->get('Employer_id');
                       $adminNoti->is_admin=$eve->is_admin;
                       $adminNoti->job_id=$data->id;
                       $adminNoti->type = "Job Posted";
                       $adminNoti->date = Carbon::now()->format("Y-m-d");
                       $adminNoti->message = " $eve->username Job posted";
                       $adminNoti->save();
                         }

        return redirect('Employer_dashboard')->with('Message', 'Job posted successfully!');
    }
    }
    else{
       return redirect('/')->with('Error', 'Login first');  
    }
}

public function updataEmployer(Request $request)
{
if(Session::get('Employer_id')){
          
          $request->validate([
    'category_id' => 'required', 
    'job_title' => 'required',
    'job_type' => 'required|string',
    'experience' => 'required', 
    'last_date' => 'required|date|after_or_equal:today',
    'openings' => 'required',
    'selected_skills' => 'required', 
    'probation_salary' => 'required',
    'about_job' => 'required',
    'salary' => 'required',
    'probation_duration' => 'required', 
    'website' => ['required', 'regex:/^www\..+/i'],
    'location' => 'required',
]);
    $data = Job::find($request->id);
    // $originalValues = $data->toArray(); // Corrected from $row to $data

    $data->category_id = $request->get('category_id');
    $data->job_title = $request->get('job_title');
    $data->job_type = $request->get('job_type');
    // $data->post_date = $request->get('post_date');
    $data->experience = $request->get('experience');
    $data->about_job = $request->get('about_job');
    $data->website = $request->get('website');
    $data->location = $request->get('location');
    $data->salary = $request->get('salary');
    $data->skills = $request->get('selected_skills');
     $data->openings = $request->get('openings');
      $data->probation_salary = $request->get('probation_salary');
       $data->probation_duration = $request->get('probation_duration');
        $data->last_date = $request->get('last_date');
         


    if ($data->save()) {
        return redirect('Employer_dashboard')->with('Message', 'Job Updated successfully!');
 

   }
    
}
    
    else{
       return redirect('Employer_login')->with('Error', 'Login first');  
    }


}
public function indexEmployerjobEdit (Request $request)
{
   
    $data=Job::find($request->job_id);
 $skills=Skill::all();
        $categories = Category::all();
     
       $locations = Location::all();
       $adminWebsites = Admin::pluck('website', 'id');
     
    return view('Front-end.edit_job',compact('data','skills','categories','locations','adminWebsites'));
}

}
