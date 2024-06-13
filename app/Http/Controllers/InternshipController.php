<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Models\Location;
use App\Models\Skill;
use App\Models\Admin;
use App\Models\Category;
use App\Models\EmployerNotification;
use App\Models\Internship;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;

class InternshipController extends Controller
{
   
    public function indexShow(Request $request)
    {
          //   get all filter variable data
   
          $selectedCategories = $request->input('internship_type', []);
          $selectedLocation = $request->input('location', []);
          $selectedPrices = $request->input('stipend', []);
          $selectedsalary = $request->input('stipend1');
        
          $query = Internship::query();
          // ... (Your existing query building code)
  
    // category filter from t-shirt page
    
      if (!empty($selectedLocation)) {
        $query->whereIn('location', $selectedLocation);
    }
    
    if (!empty($selectedCategories)) {
        $query->orWhere('internship_type', $selectedCategories);
    }
    if (!empty($selectedsalary)) {
        $query->orWhere('stipend', $selectedsalary);
    }
 

    if (!empty($selectedPrices)) {
          $priceConditions = [];
          foreach ($selectedPrices as $selectedPrice) {
              [$minPrice, $maxPrice] = explode('-', $selectedPrice);
              $priceConditions[] = [(int) $minPrice, (int) $maxPrice];
          }
          $query->where(function ($query) use ($priceConditions) {
              foreach ($priceConditions as $condition) {
                  $query->orWhereBetween('stipend', $condition);
              }
          });
      }
   
  
          $jobss = $query->orderBy('id', 'DESC')->get();
        
   if(Session::get('user_id')){
          foreach($jobss as $temp){
            $temp->apply_intern_status=0;
              $wish = DB::table('apply_internships')->where('user_id',Session::get('user_id'))->where('internship_id',$temp->id)->count();
               
              if($wish > 0){
                  $temp->apply_intern_status = 1;
              }
          }
          foreach($jobss as $new){
                          $new->saved_intern_status=0;
              $save = DB::table('saved_internships')->where('user_id',Session::get('user_id'))->where('internship_id',$new->id)->count();
               
              if($save > 0){
                  $new->saved_intern_status = 1;
              }
              
          }
}
      
        return view('Front-end.find_internship',compact('jobss'));
        
    }

  public function searchInternship(Request $request)
    {
        
            $searchTerm = $request->input('search');

    // Perform the database query to search for subcategories
    $jobss = Internship::where('internship_title', 'LIKE', $searchTerm . '%')->get();
   if(Session::get('user_id')){
          foreach($jobss as $temp){
            $temp->apply_intern_status=0;
              $wish = DB::table('apply_internships')->where('user_id',Session::get('user_id'))->where('internship_id',$temp->id)->count();
               
              if($wish > 0){
                  $temp->apply_intern_status = 1;
              }
          }
}
      
        return view('Front-end.find_search_internship',compact('jobss'));
        
    }

 public function index()
{  if(Session::get('adminId')){ 
     $user=DB::table('admins')->where('id',Session::get('adminId'))->first();
      
        if(($user->is_admin) != 1){
              $data = Internship::leftJoin('categories', 'internships.category_id', '=', 'categories.id')
        ->select('internships.*', 'categories.name as category_name')->where('internships.post_user_id',$user->id)
        ->paginate(5);
            
        }else{
              $data = Internship::leftJoin('categories', 'internships.category_id', '=', 'categories.id')
        ->select('internships.*', 'categories.name as category_name')
        ->paginate(5);
        }
  

    return view('admin.internship.index', compact('data'));
}
    else{
       return redirect('/admin-login')->with('Error', 'Session failed');  
    }
}

 public function employerInternship()
    { 
       $data = Internship::all();
       $skills=Skill::all();
       $categories = Category::all();
       $locations = Location::all();
        return view('Front-end.post_internship',compact('data','categories','locations','skills'));
    

}
 public function employerInternshipedit(Request $request)
    { 
       $data = Internship::find($request->intern_id);
       $skills=Skill::all();
       $categories = Category::all();
       $locations = Location::all();
        return view('Front-end.post_intern_edit',compact('data','categories','locations','skills'));
    

}

    public function create()
    { if(Session::get('adminId')){ 
       $data = Internship::all();
       $skills=Skill::all();
       $categories = Category::all();
       $locations = Location::all();
        return view('admin.internship.add',compact('data','categories','locations','skills'));
    }
 else{
       return redirect('/admin-login')->with('Error', 'Session failed');  
    }
}
    
   public function store_data(Request $request)
    {
   if(Session::get('adminId')){     
        

    $request->validate([
    'category_id' => 'required', 
    'internship_title' => 'required|regex:/^[A-Za-z\s\-]+$/',
    'internship_type' => 'required|string',
    
    'duration' => 'required|numeric|min:0', 
    'stipend' => 'required|numeric|min:0',
    'last_date' => 'required|date|after_or_equal:today',
    'openings' => 'required|integer|min:1',
    'selected_skills' => 'required', 
    'about_internship' => 'required',
    'who_can_apply' => 'required',
    'perks' => 'required|regex:/^[A-Za-z\s\-]+$/',
     
    'website' => 'required| regex:/^www\..+/i',
    'location' => 'required',
]);
     
      
       
       $internship = new Internship();
        $internship->post_user_id=Session::get('adminId');
       $internship->category_id = $request['category_id'];
    $internship->internship_title = $request['internship_title'];
    $internship->internship_type = $request['internship_type'];
    $internship->duration = $request['duration'];
    $internship->stipend = $request['stipend'];
    // $internship->last_date = $request['last_date'];
     $internship->openings = $request['openings'];
      $internship->skill = $request['selected_skills'];
       $internship->about_internship = $request['about_internship'];
        $internship->who_can_apply = $request['who_can_apply'];
         $internship->perks = $request['perks'];
          $internship->information = $request['information'];
           $internship->website = $request['website'];
            $internship->location = $request['location'];
            
         
            $internship->start_from = Carbon::now()->format("j F Y");
            $internship->last_date = Carbon::now()->format("j F Y");
    
$internship->save();
  
     if( $internship){
  
                 $eve = Admin::where('id',session()->get('adminId'))->first();
                 $eve->job_intern_noti = 1;
                 if($eve->update()){
                       $adminNoti = new EmployerNotification;
                       $adminNoti->user_id = session()->get('adminId');
                       $adminNoti->is_admin=$eve->is_admin;
                       $adminNoti->intern_id=$internship->id;
                       $adminNoti->type = "Internship Posted";
                       $adminNoti->date = Carbon::now()->format("Y-m-d");
                       $adminNoti->message = " $eve->username Internship posted";
                       $adminNoti->save();
                         }

        return redirect()->route('internship.index')->with('Message', 'Internship posted successfully!');
    }
     
       return redirect()->route('internship.index')->with('Message', 'Internship posted successfully!');
    }
    else{
       return redirect('/admin-login')->with('Error', 'Session failed');  
    } }


public function edit($id)
{
      if(Session::get('adminId')){ 
    $data = Internship::find($id);
       $skills=Skill::all();
    $categories = Category::all();
    $locations = Location::all();
    
    // Set default value for start_from if not provided
    if (empty($data->start_from)) {
        $data->start_from = now()->format('Y-m-d');
    }

    // Set default value for last_date if not provided
    if (empty($data->last_date)) {
        $data->last_date = now()->addDays(7)->format('Y-m-d'); // Default to 7 days from today
    }

    // Fetch the category associated with the internship
    $selectedCategory = Category::find($data->category_id);

    return view('admin.internship.edit', compact('data', 'categories', 'selectedCategory','locations','skills'));

}
    else{
       return redirect('/admin-login')->with('Error', 'Session failed');  
    }
}


    

public function update(Request $request, $id)
{
    if(Session::get('adminId')){ 
       
            $request->validate([
    'category_id' => 'required', 
    'internship_title' => 'required|regex:/^[A-Za-z\s\-]+$/',
    'internship_type' => 'required|string',
    'duration' => 'required|numeric|min:0', 
    'stipend' => 'required|numeric|min:0',
    'last_date' => 'required|date|after_or_equal:today',
    'openings' => 'required|integer|min:1',
    'selected_skills' => 'required', 
    
    'who_can_apply' => 'required',
    'perks' => 'required|regex:/^[A-Za-z\s\-]+$/',
    'information' => 'required', 
    'website' => 'required| regex:/^www\..+/i',
    'location' => 'required',
]);
    $data = Internship::find($id);
    $originalValues = $data->toArray();

    // Define validation rules and custom error messages
    $rules = [
        'start_from' => 'nullable|date|after_or_equal:today',
        'last_date' => 'nullable|date|after_or_equal:today',
        // Add other validation rules for your fields here
    ];

    $customMessages = [
        'start_from.after_or_equal' => 'Start date cannot be before today.',
        'last_date.after_or_equal' => 'Last date cannot be before today.',
        // Add custom error messages for other fields here
    ];

    $validatedData = $request->validate($rules, $customMessages);
  $data->who_can_apply = $request->input('who_can_apply');
    $data->information = $request->input('information');
    $data->location = $request->input('location');
        $data->perks = $request->input('perks');
      $data->website = $request->input('website');
    // Update the fields
    $data->internship_title = $request->input('internship_title');
    $data->internship_type = $request->input('internship_type');
    $data->openings = $request->input('openings');
    $data->duration = $request->input('duration');
    $data->stipend = $request->input('stipend');
      $data->skill = $request->input('selected_skills');
    // Update the rest of your fields...

    // Update the category_id
    $data->category_id = $request->input('category_id');

    $updatedFields = array_diff_assoc($data->toArray(), $originalValues);

    if (empty($updatedFields)) {
        return redirect()->route('internship.index')->with('Message', 'No changes were made.');
    }

    if ($data->save()) {
        return redirect()->route('internship.index')->with('Message', 'Internship Updated Successfully');
    }
    }
    else{
       return redirect('/admin-login')->with('Error', 'Session failed');  
    }
}



public function updateEmployer(Request $request, $id)
{
    
   if(Session::get('Employer_id')){       
            $request->validate([
    'category_id' => 'required', 
    'internship_title' => 'required|regex:/^[A-Za-z\s\-]+$/',
    'internship_type' => 'required|string',
    'duration' => 'required|numeric|min:0', 
    'stipend' => 'required|numeric|min:0',
    'last_date' => 'required|date|after_or_equal:today',
    'openings' => 'required|integer|min:1',
    'selected_skills' => 'required', 
    
    'who_can_apply' => 'required',
    'perks' => 'required|regex:/^[A-Za-z\s\-]+$/',
    'information' => 'required', 
    'website' => 'required| regex:/^www\..+/i',
    'location' => 'required',
]);
    $data = Internship::find($id);
    // $originalValues = $data->toArray();

    // Define validation rules and custom error messages
    $rules = [
        'start_from' => 'nullable|date|after_or_equal:today',
        'last_date' => 'nullable|date|after_or_equal:today',
        // Add other validation rules for your fields here
    ];

    $customMessages = [
        'start_from.after_or_equal' => 'Start date cannot be before today.',
        'last_date.after_or_equal' => 'Last date cannot be before today.',
        // Add custom error messages for other fields here
    ];

    $validatedData = $request->validate($rules, $customMessages);
  $data->who_can_apply = $request->input('who_can_apply');
    $data->information = $request->input('information');
    $data->location = $request->input('location');
        $data->perks = $request->input('perks');
      $data->website = $request->input('website');
    // Update the fields
    $data->internship_title = $request->input('internship_title');
    $data->internship_type = $request->input('internship_type');
    $data->openings = $request->input('openings');
    $data->duration = $request->input('duration');
    $data->stipend = $request->input('stipend');
      $data->skill = $request->input('selected_skills');
    // Update the rest of your fields...

    // Update the category_id
    $data->category_id = $request->input('category_id');

    // $updatedFields = array_diff_assoc($data->toArray(), $originalValues);

    // if (empty($updatedFields)) {
    //     return redirect()->route('internship.index')->with('Message', 'No changes were made.');
    // }

    if ($data->save()) {
         return redirect('Employer_dashboard')->with('Message', 'Internship posted successfully!');
    }
   }
    else{
       return redirect('Employer_login')->with('Error', 'Login first');  
    }
    }
    








 
    public function destroy($id)
    {
        if(Session::get('adminId')){ 
        $data = Internship::find($id);
        if ($data->delete()){
         return redirect()->back()->with('Message', "Internship deleted successfully.");
        }
        else{
         return redirect()->back()->with('Error', "Something went wrong.");
        }
}
    else{
       return redirect('/admin-login')->with('Error', 'Session failed');  
    }
    }
    
      public function getInternshipCount()
    {
        $jobCount = DB::table('internships')->count();

        return response()->json(['jobCount' => $jobCount]);
    }
    
     public function showDetails($internship_id)
    {
        $internship = Internship::findOrFail($internship_id);
        
        // Fetch the company information using the website field from the internship
        $company = Admin::where('website', $internship->website)->first();

 if(session::get('user_id')){
     
         
         
              
            $internship->apply_intern_status=0;
              $wish = DB::table('apply_internships')->where('user_id',session::get('user_id'))->where('internship_id',$internship->id)->count();
               
              if($wish > 0){
                  $internship->apply_intern_status = 1;
              }
          
}
        return view('Front-end.Internship_description', compact('internship', 'company'));
    }
    
       public function empInten(Request $request)
    {
   if(Session::get('Employer_id')){     
        

    $request->validate([
    'category_id' => 'required', 
    'internship_title' => 'required|regex:/^[A-Za-z\s\-]+$/',
    'internship_type' => 'required|string',
    
    'duration' => 'required|numeric|min:0', 
    'stipend' => 'required|numeric|min:0',
    'last_date' => 'required|date|after_or_equal:today',
    'openings' => 'required|integer|min:1',
    'selected_skills' => 'required', 
    'about_internship' => 'required',
    'who_can_apply' => 'required',
    'perks' => 'required',
    'information' => 'required', 
    'website' => 'required| regex:/^www\..+/i',
    'location' => 'required',
]);
     
      
       
       $internship = new Internship();
        $internship->post_user_id=Session::get('Employer_id');
       $internship->category_id = $request['category_id'];
    $internship->internship_title = $request['internship_title'];
    $internship->internship_type = $request['internship_type'];
    $internship->duration = $request['duration'];
    $internship->stipend = $request['stipend'];
    $internship->last_date = $request['last_date'];
     $internship->openings = $request['openings'];
      $internship->skill = $request['selected_skills'];
       $internship->about_internship = $request['about_internship'];
        $internship->who_can_apply = $request['who_can_apply'];
         $internship->perks = $request['perks'];
          $internship->information = $request['information'];
           $internship->website = $request['website'];
            $internship->location = $request['location'];
            
            $internship->start_from = now();
    
$internship->save();
  
     if( $internship){
  
                 $eve = Admin::where('id',Session::get('Employer_id'))->first();
                 $eve->job_intern_noti = 1;
                 if($eve->update()){
                       $adminNoti = new EmployerNotification;
                       $adminNoti->user_id =Session::get('Employer_id');
                       $adminNoti->is_admin=$eve->is_admin;
                       $adminNoti->intern_id=$internship->id;
                       $adminNoti->type = "Internship Posted";
                       $adminNoti->date = Carbon::now()->format("Y-m-d");
                       $adminNoti->message = " $eve->username Internship posted";
                       $adminNoti->save();
                         }

        return redirect('Employer_dashboard')->with('Message', 'Internship posted successfully!');
    }
     
       return redirect('Employer_dashboard')->with('Message', 'Internship posted successfully!');
    }
    else{
       return redirect('/')->with('Error', 'Session failed');  
    } }
    
       public function updataEployerIntern(Request $request)
{
    $data = Internship::find($request->id);
 

    $data->who_can_apply = $request->who_can_apply;
    $data->information = $request->information;
    $data->location = $request->location;
    $data->perks = $request->perks;
    $data->website = $request->website;
    $data->internship_title = $request->internship_title;
    $data->internship_type = $request->internship_type;
    $data->openings = $request->openings;
    $data->duration = $request->duration;
    $data->stipend = $request->stipend;
    $data->skill = $request->skill;
 
    $data->category_id = $request->category_id;
    $data->save();
} 
    
}
    

