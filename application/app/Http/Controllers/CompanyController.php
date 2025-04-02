<?php
    
namespace App\Http\Controllers;
    
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Lead;
use App\Models\Company;
use Spatie\Permission\Models\Role;
use Illuminate\Database\Eloquent\Builder;
use Auth;
use DB;
use Hash;
use Illuminate\Support\Arr;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\LeadsExport;
use App\Imports\LeadsImport;
use Mail;
use App\Mail\RegisterMail;

    
class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
	 
	function __construct()
    {
         $this->middleware('permission:company-list|company-create|company-edit|company-delete', ['only' => ['index','store']]);
         $this->middleware('permission:company-create', ['only' => ['create','store']]);
         $this->middleware('permission:company-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:company-delete', ['only' => ['destroy']]);
    }
	
	 /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
	 
    public function index(Request $request): View
    {
        //$data = Company::latest()->paginate(2);
		
	    $per_page = 10;
		$data = Company::when($request->q,function (Builder $builder) use ($request) {
							$builder->where('first_name', 'like', "%{$request->q}%")
							->orWhere('last_name', 'like', "%{$request->q}%")
							->orWhere('email', 'like', "%{$request->q}%")
							->orWhere('mobile', 'like', "%{$request->q}%")
							->orWhere('pin_code', 'like', "%{$request->q}%")
							->orWhere('country', 'like', "%{$request->q}%")
							->orWhere('state', 'like', "%{$request->q}%")
							->orWhere('city', 'like', "%{$request->q}%");
					       }
					    )
					->orderBy('id','DESC')->paginate($per_page);
  
        return view('companies.index',compact('data'))
            ->with('i', ($request->input('page', 1) - 1) * $per_page);
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(): View
    {
        $status = ['0'=>'Deactive','1'=>'Active'];
		
        return view('companies.create',compact('status'));
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request): RedirectResponse
    {
        $this->validate($request, [
            // 'first_name' => 'required',
            //  'last_name'  => 'required',
            //'company_email'      => 'required|company_email|unique:companies,company_email',
            //'password' => 'required|same:confirm-password',
            //'roles' => 'required'
        ]);
    
        $input = $request->all();
		
		//dd($input);
		
	    $auth_user=Auth::user();
		
        $input['created_by'] = $auth_user->id;
		
        if($request->hasfile('coi')){
			
		$fileName_coi_img = time() . '.'. $request->coi->extension();  
//dd($fileName_coi_img);
			//$request->coi->move(public_path('uploads/company/coi'), $fileName_coi_img);
			
			$input['coi'] = $fileName_coi_img;
		}
		if($request->hasfile('mca_llp')){
			
			$fileName_mca_llp = time().'.'.$request->mca_llp->extension();  

			//$request->mca_llp->move(public_path('uploads/company/mca_llp'), $fileName_mca_llp);
			
			$input['mca_llp'] = $fileName_mca_llp;
		}	
		
		if($request->hasfile('pan_card')){
			
			$fileName_pan_card = time().'.'.$request->pan_card->extension();  

			//$request->pan_card->move(public_path('uploads/company/pan_card'), $fileName_pan_card);
			
			$input['pan_card'] = $fileName_pan_card;
		}	
		
		if($request->hasfile('gst_certificate')){
			
			$fileName_gst_certificate = time().'.'.$request->gst_certificate->extension();  

			//$request->gst_certificate->move(public_path('uploads/company/gst_certificate'), $fileName_gst_certificate);
			
			$input['gst_certificate'] = $fileName_gst_certificate;
		}	
		
		if($request->hasfile('rent_agrement')){
			
			$fileName_rent_agrement = time().'.'.$request->rent_agrement->extension();  

			//$request->rent_agrement->move(public_path('uploads/company/rent_agrement'), $fileName_rent_agrement);
			
			$input['rent_agrement'] = $fileName_rent_agrement;
		}	
		
		if($request->hasfile('moa')){
			
			$fileName_moa = time().'.'.$request->moa->extension();  

			//$request->moa->move(public_path('uploads/company/moa'), $fileName_moa);
			
			$input['moa'] = $fileName_moa;
		}	
		
		if($request->hasfile('msme_certificate')){
			
			$fileName_msme_certificate = time().'.'.$request->msme_certificate->extension();  

			//$request->msme_certificate->move(public_path('uploads/company/msme_certificate'), $fileName_msme_certificate);
			
			$input['msme_certificate'] = $fileName_msme_certificate;
		}	
		
		if($request->hasfile('aoa')){
			
			$fileName_aoa = time().'.'.$request->aoa->extension();  

			//$request->aoa->move(public_path('uploads/company/aoa'), $fileName_aoa);
			
			$input['aoa'] = $fileName_aoa;
		}	
		
		if($request->hasfile('tan_no')){
			
			$fileName_tan_no = time().'.'.$request->tan_no->extension();  

			//$request->tan_no->move(public_path('uploads/company/tan_no'), $fileName_tan_no);
			
			$input['tan_no'] = $fileName_tan_no;
		}	
		
		if($request->hasfile('pf_no')){
			
			$fileName_pf_no = time().'.'.$request->pf_no->extension();  

			//$request->pf_no->move(public_path('uploads/company/pf_no'), $fileName_pf_no);
			
			$input['pf_no'] = $fileName_pf_no;
		}	
		
		if($request->hasfile('esi_no')){
			
			$fileName_esi_no = time().'.'.$request->esi_no->extension();  

			//$request->esi_no->move(public_path('uploads/company/esi_no'), $fileName_esi_no);
			
			$input['esi_no'] = $fileName_esi_no;
		}	
		
		if($request->hasfile('ngo_darpan')){
			
			$fileName_ngo_darpan = time().'.'.$request->ngo_darpan->extension();  

			//$request->ngo_darpan->move(public_path('uploads/company/ngo_darpan'), $fileName_ngo_darpan);
			
			$input['ngo_darpan'] = $fileName_ngo_darpan;
		}	
		
		if($request->hasfile('iso_certificate')){
			
			$fileName_iso_certificate = time().'.'.$request->iso_certificate->extension();  

			//$request->iso_certificate->move(public_path('uploads/company/iso_certificate'), $fileName_iso_certificate);
			
			$input['iso_certificate'] = $fileName_iso_certificate;
		}	
		
		if($request->hasfile('dipp')){
			
			$fileName_dipp = time().'.'.$request->dipp->extension();  

//$request->dipp->move(public_path('uploads/company/dipp'), $fileName_dipp);
			
			$input['dipp'] = $fileName_dipp;
		}
		
		if($request->hasfile('cheque_copy')){
			
			$fileName_cheque_copy = time().'.'.$request->cheque_copy->extension();  

			//$request->cheque_copy->move(public_path('uploads/company/cheque_copy'), $fileName_cheque_copy);
			
			$input['cheque_copy'] = $fileName_cheque_copy;
		}	
			
			//dd($input);
        $company = Company::create($input);
		
	//mail send 12-09-2023
	 
	    $mailData = [
            'title' => 'Thank You for Visiting Our Website',
            'body' => "I hope this message finds you well. We want to express our gratitude for visiting our website. Your interest in our product means a lot to us, and we're excited to have the opportunity to connect with you.' ",
			
            'user_id' => $input['company_email'],
			
            'password' => $input['mobile'],
        ];
         
        Mail::to($input['company_email'])->send(new RegisterMail($mailData));
			
	//mail send End
		
		//$company_password = bycrpt(rand());
		$company_password = Hash::make(rand());
		
		$user_arr = [
					  'created_by'=>$input['created_by'],
					  'company_id'=>$company->id,
					  'email'=>$input['company_email'],
					  'password'=>$company_password,
					  'for'=>'company',
					];
					
		$user = User::create($user_arr);	

        $user->assignRole(['Company']);		

       if($request->hasfile('coi')){

			$request->coi->move(public_path('uploads/company/'.$company->id.'/coi'), $fileName_coi_img);

		}
		
		if($request->hasfile('mca_llp')){ 

			$request->mca_llp->move(public_path('uploads/company/'.$company->id.'/mca_llp'), $fileName_mca_llp);
			
			
		}	
		
		if($request->hasfile('pan_card')){

			$request->pan_card->move(public_path('uploads/company/'.$company->id.'/pan_card'), $fileName_pan_card);
			
			
		}	
		
		if($request->hasfile('gst_certificate')){  

			$request->gst_certificate->move(public_path('uploads/company/'.$company->id.'/gst_certificate'), $fileName_gst_certificate);
			
			
		}	
		
		if($request->hasfile('rent_agrement')){
			
			$request->rent_agrement->move(public_path('uploads/company/'.$company->id.'/rent_agrement'), $fileName_rent_agrement);
			
			
		}	
		
		if($request->hasfile('moa')){
			
			
			$request->moa->move(public_path('uploads/company/'.$company->id.'/moa'), $fileName_moa);
		
		}	
		
		if($request->hasfile('msme_certificate')){ 

			$request->msme_certificate->move(public_path('uploads/company/'.$company->id.'/msme_certificate'), $fileName_msme_certificate);
			
			
		}	
		
		if($request->hasfile('aoa')){

			$request->aoa->move(public_path('uploads/company/'.$company->id.'/aoa'), $fileName_aoa);
			
		}	
		
		if($request->hasfile('tan_no')){
			
			$request->tan_no->move(public_path('uploads/company/'.$company->id.'/tan_no'), $fileName_tan_no);
			
		}	
		
		if($request->hasfile('pf_no')){
			
			
			$request->pf_no->move(public_path('uploads/company/'.$company->id.'/pf_no'), $fileName_pf_no);
			
		}	
		
		if($request->hasfile('esi_no')){
			  

			$request->esi_no->move(public_path('uploads/company/'.$company->id.'/esi_no'), $fileName_esi_no);
		
		}	
		
		if($request->hasfile('ngo_darpan')){
			
			$request->ngo_darpan->move(public_path('uploads/company/'.$company->id.'/ngo_darpan'), $fileName_ngo_darpan);	
		
		}	
		
		if($request->hasfile('iso_certificate')){
			
			$request->iso_certificate->move(public_path('uploads/company/'.$company->id.'/iso_certificate'), $fileName_iso_certificate);
			
		}	
		
		if($request->hasfile('dipp')){
			
			$request->dipp->move(public_path('uploads/company/'.$company->id.'/dipp'), $fileName_dipp);
				
		}
		
		if($request->hasfile('cheque_copy')){
			  
			$request->cheque_copy->move(public_path('uploads/company/'.$company->id.'/cheque_copy'), $fileName_cheque_copy);
			
			
		}


        return redirect()->route('companies.index')
                        ->with('success','Company created successfully');
    }
    
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
   public function show($id)
    {
        $auth_user = Auth::user();
		
		$request = request();
		

		//dd(request()->all());
			
		
		$emp = Company::find($id);
		
		if($request->has('action') && $request->action == 'delete_img'){
			
			$emp->update([$request->column=>'']);
			
			unlink($request->img_val);
			
			return back()->with('success','Company image deleted successfully!!');
		}
        $company = Company::find($id);
        return view('companies.show',compact('company'));
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id): View
    {
        $company = Company::find($id);
		
		$status  = ['0'=>'Deactive','1'=>'Active'];
    
        return view('companies.edit',compact('company','status'));
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id): RedirectResponse
    {

	   $this->validate($request, [
            //'name' => 'required',
           // 'email' => 'required|email|unique:leads,email',
            //'password' => 'required|same:confirm-password',
            //'roles' => 'required'
        ]);
    
        $input = $request->all();
		
		//dd($input);
		
	    $auth_user=Auth::user();
		
        $input['created_by'] = $auth_user->id;
		
        if($request->hasfile('coi')){
			
		$fileName_coi_img = time() . '.'. $request->coi->extension();  

			//$request->coi->move(public_path('uploads/company/coi'), $fileName_coi_img);
			
			$input['coi'] = $fileName_coi_img;
		}
		if($request->hasfile('mca_llp')){
			
			$fileName_mca_llp = time().'.'.$request->mca_llp->extension();  

			//$request->mca_llp->move(public_path('uploads/company/mca_llp'), $fileName_mca_llp);
			
			$input['mca_llp'] = $fileName_mca_llp;
		}	
		
		if($request->hasfile('pan_card')){
			
			$fileName_pan_card = time().'.'.$request->pan_card->extension();  

			//$request->pan_card->move(public_path('uploads/company/pan_card'), $fileName_pan_card);
			
			$input['pan_card'] = $fileName_pan_card;
		}	
		
		if($request->hasfile('gst_certificate')){
			
			$fileName_gst_certificate = time().'.'.$request->gst_certificate->extension();  

			//$request->gst_certificate->move(public_path('uploads/company/gst_certificate'), $fileName_gst_certificate);
			
			$input['gst_certificate'] = $fileName_gst_certificate;
		}	
		
		if($request->hasfile('rent_agrement')){
			
			$fileName_rent_agrement = time().'.'.$request->rent_agrement->extension();  

			//$request->rent_agrement->move(public_path('uploads/company/rent_agrement'), $fileName_rent_agrement);
			
			$input['rent_agrement'] = $fileName_rent_agrement;
		}	
		
		if($request->hasfile('moa')){
			
			$fileName_moa = time().'.'.$request->moa->extension();  

			//$request->moa->move(public_path('uploads/company/moa'), $fileName_moa);
			
			$input['moa'] = $fileName_moa;
		}	
		
		if($request->hasfile('msme_certificate')){
			
			$fileName_msme_certificate = time().'.'.$request->msme_certificate->extension();  

			//$request->msme_certificate->move(public_path('uploads/company/msme_certificate'), $fileName_msme_certificate);
			
			$input['msme_certificate'] = $fileName_msme_certificate;
		}	
		
		if($request->hasfile('aoa')){
			
			$fileName_aoa = time().'.'.$request->aoa->extension();  

			//$request->aoa->move(public_path('uploads/company/aoa'), $fileName_aoa);
			
			$input['aoa'] = $fileName_aoa;
		}	
		
		if($request->hasfile('tan_no')){
			
			$fileName_tan_no = time().'.'.$request->tan_no->extension();  

			//$request->tan_no->move(public_path('uploads/company/tan_no'), $fileName_tan_no);
			
			$input['tan_no'] = $fileName_tan_no;
		}	
		
		if($request->hasfile('pf_no')){
			
			$fileName_pf_no = time().'.'.$request->pf_no->extension();  

			//$request->pf_no->move(public_path('uploads/company/pf_no'), $fileName_pf_no);
			
			$input['pf_no'] = $fileName_pf_no;
		}	
		
		if($request->hasfile('esi_no')){
			
			$fileName_esi_no = time().'.'.$request->esi_no->extension();  

			//$request->esi_no->move(public_path('uploads/company/esi_no'), $fileName_esi_no);
			
			$input['esi_no'] = $fileName_esi_no;
		}	
		
		if($request->hasfile('ngo_darpan')){
			
			$fileName_ngo_darpan = time().'.'.$request->ngo_darpan->extension();  

			//$request->ngo_darpan->move(public_path('uploads/company/ngo_darpan'), $fileName_ngo_darpan);
			
			$input['ngo_darpan'] = $fileName_ngo_darpan;
		}	
		
		if($request->hasfile('iso_certificate')){
			
			$fileName_iso_certificate = time().'.'.$request->iso_certificate->extension();  

			//$request->iso_certificate->move(public_path('uploads/company/iso_certificate'), $fileName_iso_certificate);
			
			$input['iso_certificate'] = $fileName_iso_certificate;
		}	
		
		if($request->hasfile('dipp')){
			
			$fileName_dipp = time().'.'.$request->dipp->extension();  

//$request->dipp->move(public_path('uploads/company/dipp'), $fileName_dipp);
			
			$input['dipp'] = $fileName_dipp;
		}
		
		if($request->hasfile('cheque_copy')){
			
			$fileName_cheque_copy = time().'.'.$request->cheque_copy->extension();  

			//$request->cheque_copy->move(public_path('uploads/company/cheque_copy'), $fileName_cheque_copy);
			
			$input['cheque_copy'] = $fileName_cheque_copy;
		}	
			
	    $company = Company::find($id);
        $company->update($input);
		
		$user = User::where('for','=','company')->where('company_id','=',$company->id)->first();
       
			//dd($input);
       // $company = Company::create($input);
		
		//$company_password = bycrpt(rand());
		$company_password = Hash::make(rand());
		
		$user_arr = [
					  'created_by'=>$input['created_by'],
					  'company_id'=>$company->id,
					  'email'=>$input['company_email'],
					  //'password'=>$company_password,
					  'for'=>'company',
					];
					
		$user->update($user_arr);
		
        DB::table('model_has_roles')->where('model_id',$user->id)->delete();
    
        $user->assignRole(['Company']);
					
		//$user = User::create($user_arr);			

       if($request->hasfile('coi')){

			$request->coi->move(public_path('uploads/company/'.$company->id.'/coi'), $fileName_coi_img);

		}
		
		if($request->hasfile('mca_llp')){ 

			$request->mca_llp->move(public_path('uploads/company/'.$company->id.'/mca_llp'), $fileName_mca_llp);
			
			
		}	
		
		if($request->hasfile('pan_card')){

			$request->pan_card->move(public_path('uploads/company/'.$company->id.'/pan_card'), $fileName_pan_card);
			
			
		}	
		
		if($request->hasfile('gst_certificate')){  

			$request->gst_certificate->move(public_path('uploads/company/'.$company->id.'/gst_certificate'), $fileName_gst_certificate);
			
			
		}	
		
		if($request->hasfile('rent_agrement')){
			
			$request->rent_agrement->move(public_path('uploads/company/'.$company->id.'/rent_agrement'), $fileName_rent_agrement);
			
			
		}	
		
		if($request->hasfile('moa')){
			
			
			$request->moa->move(public_path('uploads/company/'.$company->id.'/moa'), $fileName_moa);
		
		}	
		
		if($request->hasfile('msme_certificate')){ 

			$request->msme_certificate->move(public_path('uploads/company/'.$company->id.'/msme_certificate'), $fileName_msme_certificate);
			
			
		}	
		
		if($request->hasfile('aoa')){

			$request->aoa->move(public_path('uploads/company/'.$company->id.'/aoa'), $fileName_aoa);
			
		}	
		
		if($request->hasfile('tan_no')){
			
			$request->tan_no->move(public_path('uploads/company/'.$company->id.'/tan_no'), $fileName_tan_no);
			
		}	
		
		if($request->hasfile('pf_no')){
			
			
			$request->pf_no->move(public_path('uploads/company/'.$company->id.'/pf_no'), $fileName_pf_no);
			
		}	
		
		if($request->hasfile('esi_no')){
			  

			$request->esi_no->move(public_path('uploads/company/'.$company->id.'/esi_no'), $fileName_esi_no);
		
		}	
		
		if($request->hasfile('ngo_darpan')){
			
			$request->ngo_darpan->move(public_path('uploads/company/'.$company->id.'/ngo_darpan'), $fileName_ngo_darpan);	
		
		}	
		
		if($request->hasfile('iso_certificate')){
			
			$request->iso_certificate->move(public_path('uploads/company/'.$company->id.'/iso_certificate'), $fileName_iso_certificate);
			
		}	
		
		if($request->hasfile('dipp')){
			
			$request->dipp->move(public_path('uploads/company/'.$company->id.'/dipp'), $fileName_dipp);
				
		}
		
		if($request->hasfile('cheque_copy')){
			  
			$request->cheque_copy->move(public_path('uploads/company/'.$company->id.'/cheque_copy'), $fileName_cheque_copy);
			
			
		}

        return redirect()->route('companies.index')
                        ->with('success','Company updated successfully');
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id): RedirectResponse
    {
        Company::find($id)->delete();
        User::where('for','=','company')->where('company_id','=',$id)->delete();
		
        return redirect()->route('companies.index')
                        ->with('success','Company deleted successfully');
    }
	
	
	//Company  05.09.23
	
	public function company_profile()
     {
       $auth_user = Auth::User();

	   $company = Company::find($auth_user->company_id);
	   
        return view('companies.view_company_profile',compact('company'));
        
     } 

    public function edit_company_profile()
     {
       $auth_user = Auth::User();
	    
	   $company = Company::find($auth_user->company_id);

         return view('companies.company_profile',compact('company'));
        
     } 
	 
	 //06.09.23//
   public function update_company_profile(Request $request, $id)
      {
		$input = $request->all();
        
		$company = Company::find($id);
		
		if($request->hasfile('profile_img')){
			
			$fileName_profile_img = time().'.'.$request->profile_img->extension();  
           
			$request->profile_img->move(public_path('uploads/company/'.$company->id.'/profile_img'), $fileName_profile_img);
			
			$input['profile_img'] = $fileName_profile_img;
			
		}else{
			unset($input['profile_img']);			
		}
		//dd($company);
		
	    if($request->hasfile('cheque_copy')){
			
			$fileName_cheque_copy = time().'.'.$request->cheque_copy->extension();  

			$request->cheque_copy->move(public_path('uploads/company/'.$company->id.'/cheque_copy'), $fileName_cheque_copy);
			
			$input['cheque_copy'] = $fileName_cheque_copy;
			
		}else{
			unset($input['cheque_copy']);			
		}
                   //COI//
		if($request->hasfile('coi')){
			
			$fileName_coi = time().'.'.$request->coi->extension();  

			$request->coi->move(public_path('uploads/company/'.$company->id.'/coi'), $fileName_coi);
			
			$input['coi'] = $fileName_coi;
			
		}else{
			unset($input['coi']);			
		}

		 //MCA LLP//
		if($request->hasfile('mca_llp')){
			
			$fileName_mca_llp = time().'.'.$request->mca_llp->extension();  

			$request->mca_llp->move(public_path('uploads/company/'.$company->id.'/mca_llp'), $fileName_mca_llp);
			
			$input['mca_llp'] = $fileName_mca_llp;
			
		}else{
			unset($input['mca_llp']);			
		}
		//Pan Card//
		if($request->hasfile('pan_card')){
			
			$fileName_pan_card = time().'.'.$request->pan_card->extension();  

			$request->pan_card->move(public_path('uploads/company/'.$company->id.'/pan_card'), $fileName_pan_card);
			
			$input['pan_card'] = $fileName_pan_card;
			
		}else{
			unset($input['pan_card']);			
		}
		//GST Certificate//
		if($request->hasfile('gst_certificate')){
			
			$fileName_gst_certificate = time().'.'.$request->gst_certificate->extension();  

			$request->gst_certificate->move(public_path('uploads/company/'.$company->id.'/gst_certificate'), $fileName_gst_certificate);
			
			$input['gst_certificate'] = $fileName_gst_certificate;
			
		}else{
			unset($input['gst_certificate']);			
		}
        
		//Rent Agrement//
		if($request->hasfile('rent_agrement')){
			
			$fileName_rent_agrement = time().'.'.$request->rent_agrement->extension();  

			$request->rent_agrement->move(public_path('uploads/company/'.$company->id.'/rent_agrement'), $fileName_rent_agrement);
			
			$input['rent_agrement'] = $fileName_rent_agrement;
			
		}else{
			unset($input['rent_agrement']);			
		}

		//MOA//
		if($request->hasfile('moa')){
			
			$fileName_moa = time().'.'.$request->moa->extension();  

			$request->moa->move(public_path('uploads/company/'.$company->id.'/moa'), $fileName_moa);
			
			$input['moa'] = $fileName_moa;
			
		}else{
			unset($input['moa']);			
		}

          //MSME Certificate//
		if($request->hasfile('msme_certificate')){
			
			$fileName_msme_certificate = time().'.'.$request->msme_certificate->extension();  

			$request->msme_certificate->move(public_path('uploads/company/'.$company->id.'/msme_certificate'), $fileName_msme_certificate);
			
			$input['msme_certificate'] = $fileName_msme_certificate;
			
		}else{
			unset($input['msme_certificate']);			
		}

            //AOA//
		if($request->hasfile('aoa')){
			
			$fileName_aoa = time().'.'.$request->aoa->extension();  

			$request->aoa->move(public_path('uploads/company/'.$company->id.'/aoa'), $fileName_aoa);
			
			$input['aoa'] = $fileName_aoa;
			
		}else{
			unset($input['aoa']);			
		}

		 //TAN No//
		if($request->hasfile('tan_no')){
			
			$fileName_tan_no = time().'.'.$request->tan_no->extension();  

			$request->tan_no->move(public_path('uploads/company/'.$company->id.'/tan_no'), $fileName_tan_no);
			
			$input['tan_no'] = $fileName_tan_no;
			
		}else{
			unset($input['tan_no']);			
		}
          
           //PF No//
		if($request->hasfile('pf_no')){
			
			$fileName_pf_no = time().'.'.$request->pf_no->extension();  

			$request->pf_no->move(public_path('uploads/company/'.$company->id.'/pf_no'), $fileName_pf_no);
			
			$input['pf_no'] = $fileName_pf_no;
			
		}else{
			unset($input['pf_no']);			
		}



           //ESI No//
		if($request->hasfile('esi_no')){
			
			$fileName_esi_no = time().'.'.$request->esi_no->extension();  

			$request->esi_no->move(public_path('uploads/company/'.$company->id.'/esi_no'), $fileName_esi_no);
			
			$input['esi_no'] = $fileName_esi_no;
			
		}else{
			unset($input['esi_no']);			
		}

         //NGO Darpan//
		if($request->hasfile('ngo_darpan')){
			
			$fileName_ngo_darpan = time().'.'.$request->ngo_darpan->extension();  

			$request->ngo_darpan->move(public_path('uploads/company/'.$company->id.'/ngo_darpan'), $fileName_ngo_darpan);
			
			$input['ngo_darpan'] = $fileName_ngo_darpan;
			
		}else{
			unset($input['ngo_darpan']);			
		}

		//ISO Certificate//
		if($request->hasfile('iso_certificate')){
			
			$fileName_iso_certificate = time().'.'.$request->iso_certificate->extension();  

			$request->iso_certificate->move(public_path('uploads/company/'.$company->id.'/iso_certificate'), $fileName_iso_certificate);
			
			$input['iso_certificate'] = $fileName_iso_certificate;
			
		}else{
			unset($input['iso_certificate']);			
		}

		//DIPP//
		if($request->hasfile('dipp')){
			
			$fileName_dipp = time().'.'.$request->dipp->extension();  

			$request->dipp->move(public_path('uploads/company/'.$company->id.'/dipp'), $fileName_dipp);
			
			$input['dipp'] = $fileName_dipp;
			
		}else{
			unset($input['dipp']);			
		}

		//$user = User::where('for','=','company')->where('company_id','=',$company->id)->first();
       
		//dd($user);
		
		//$user_arr = ['profile_img'=>$input['profile_img'],];
					
		//$user->update($user_arr);

		
        //$company = Company::find($id);
        $company->update($input);

        return redirect()->route('company_profile')
                        ->with('success','Profile updated successfully');
    }
	
}