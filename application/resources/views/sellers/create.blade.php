@extends('admin.layouts.app')
@section('title','Add Seller')
@section('content')

<div x-data="form">
   <ul class="flex space-x-2 rtl:space-x-reverse">
      <li>
         <a href="{{route('sellers.index')}}" class="text-primary hover:underline">Seller</a>
      </li>
      <li class="before:content-['/'] ltr:before:mr-1 rtl:before:ml-1">
         <span>Add Seller</span>
      </li>
   </ul>
</div>

<div class="grid grid-cols-1 gap-6 pt-5 lg:grid-cols-1">
   <div class="panel" >
      <div class="mb-5">
         @if (count($errors) > 0)
         <div class="flex items-center p-3.5 rounded text-danger bg-danger-light dark:bg-danger-dark-light">
            <span class="ltr:pr-2 rtl:pl-2">
               <strong class="ltr:mr-1 rtl:ml-1">Whoops!</strong>There were some problems with your input.
               <ul>
                  @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
                  @endforeach
               </ul>
            </span>
            <button type="button" class="ltr:ml-auto rtl:mr-auto hover:opacity-80">
               <svg> ... </svg>
            </button>
         </div>
         @endif
         {!! Form::open(array('route' => 'sellers.store','method'=>'POST','class'=>'space-y-5', 'enctype'=>'multipart/form-data')) !!}
         <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
            <div>
               <label for="date_of_enrollment"><i class="fa fa-asterisk" style="font-size:6px;color:red"></i> Date Of Enrollment</label>
               {!! Form::date('date_of_enrollment', date('Y-m-d'), array('placeholder' => 'Date Of Enrollment','class' => 'form-input','id'=>'inputdate','required' => 'required')) !!}
            </div>
          
			<div>
                <label for="category_id"><i class="fa fa-asterisk" style="font-size:6px;color:red"></i>Category</label>
                  <select class="form-select" id="choices-multiple-remove-button"  placeholder="Select Category" multiple name="category_id[]"  required="required"/>
				    <option value="">--Select Category--</option>
                    @foreach($categoryData as $category) 
                    <option value="{{$category->id}}">{{$category->category_name}}</option>
                    @endforeach
                    </select>
                   
      
            </div>
			 
            <div>
               <label for="business_name "><i class="fa fa-asterisk" style="font-size:6px;color:red"></i>Business Name</label>
               {!! Form::text('business_name', null, array('placeholder' => 'Business Name','class' => 'form-input','id'=>'business_name','required' => 'required')) !!}
            </div>
            <div>
               <label for="brand_name "><i class="fa fa-asterisk" style="font-size:6px;color:red"></i>Brand Name</label>
               {!! Form::text('brand_name', null, array('placeholder' => 'Brand Name','class' => 'form-input','id'=>'brand_name','required' => 'required')) !!}
            </div>
            <div>
               <label for="brand_registration_upload"><i class="fa fa-asterisk" style="font-size:6px;color:red"></i>Upload Brand Registration</label>
               {!! Form::file('brand_registration_upload', array('placeholder' => 'Upload Aadhar Card Certificate','class' => 'form-input','id'=>'brand_registration_upload','required' => 'required')) !!}
            </div>
            <div>
               <label for="seller_brand_logo"><i class="fa fa-asterisk" style="font-size:6px;color:red"></i>Upload Seller Brand Logo</label>
               {!! Form::file('seller_brand_logo', array('placeholder' => 'Upload Seller Brand Logo','class' => 'form-input','id'=>'seller_brand_logo','required' => 'required')) !!}
            </div>
            <div>
               <label for="Name"><i class="fa fa-asterisk" style="font-size:6px;color:red"></i>First Name</label>
               {!! Form::text('first_name', null, array('placeholder' => 'Enter First Name','class' => 'form-input','id'=>'Name','required' => 'required')) !!}
            </div>
            <div>
               <label for="last_name"><i class="fa fa-asterisk" style="font-size:6px;color:red"></i>Last Name</label>
               {!! Form::text('last_name', null, array('placeholder' => 'Enter Last Name','class' => 'form-input','id'=>'last_name','required' => 'required')) !!}
            </div>
            <div>
               <label for="Mobile"><i class="fa fa-asterisk" style="font-size:6px;color:red"></i>Contact</label>
               {!! Form::text('mobile', null, array('placeholder' => 'Enter Mobile No','class' => 'form-input','id'=>'Mobile','required' => 'required')) !!}
            </div>
            <div>
               <label for="Email"><i class="fa fa-asterisk" style="font-size:6px;color:red"></i>Email:</label>
               {!! Form::text('email', null, array('placeholder' => 'Enter Email','class' => 'form-input','id'=>'Email','required' => 'required')) !!}
            </div>
			
            <div class="">
               <label for="managed_by"><i class="fa fa-asterisk" style="font-size:6px;color:red"></i>Managed By</label>             
               <select class="form-select" name="managed_by" id="managed_by" required="required">
                  <option value="">--Select Managed--</option>
                 {{-- <option value="{{Auth::user()->id}}">Self</option>--}}
                  <option value="1">Self</option>
                  @foreach($employeeData as $emp)
                  <option value="{{ $emp->id }}">{{ $emp->first_name.' '.$emp->last_name}} ({{$emp->email}})</option>
                  @endforeach
               </select>
            </div>
			
		<?php /* <div class="" >
				  <label for="designation"><i class="fa fa-asterisk" style="font-size:6px;color:red"></i>Designation</label>
                  <select class="form-input" name="designation" id="designation" required="">
                  <option value="">--Select Designation--</option> 
				  
                  @foreach($designationData as $empdesignation)
				  
                  <option value="{{ $empdesignation->id }}">{{ $empdesignation->designation_name }}</option>
                 
				 @endforeach
				 
                 </select>
			  </div> */?>
			
            <div class="flex justify-around pt-5">
               <label for="name"><i class="fa fa-asterisk" style="font-size:6px;color:red"></i>Gender :</label>
               <label class="inline-flex cursor-pointer">Male</label>
               <input class="form-radio cursor-pointer ltr:mr-4 rtl:ml-4" type="radio" name="gender" value="Male" checked>
               <label class="inline-flex cursor-pointer">Female</label>
               <input class="form-radio cursor-pointer ltr:mr-4 rtl:ml-4" type="radio" name="gender" value="Female"/>
            </div>
            <div>
               <label for="present_address"><i class="fa fa-asterisk" style="font-size:6px;color:red"></i>Present Address</label>
               {!! Form::text('present_address', null, array('placeholder' => 'Enter Present Address','class' => 'form-input','id'=>'present_address','required' => 'required')) !!}
            </div>
            <div>
               <label for="pin_code"><i class="fa fa-asterisk" style="font-size:6px;color:red"></i>Pin Code</label>
               {!! Form::number('pin_code', null, array('placeholder' => 'Enter Pin Code','class' => 'form-input','id'=>'pin_code', 'onkeyup'=>'getStateCity(this);', 'maxlength'=>'6')) !!}
            </div>
            <!--<div>
               <label for="Country"><i class="fa fa-asterisk" style="font-size:6px;color:red"></i>Country</label>
               {!! Form::text('country', null, array('placeholder' => 'Country','class' => 'form-input','id'=>'Country')) !!}
            </div>-->
            <div>
               <label for="state">State</label>
               {!! Form::select('state', [''=>'Select State'],[], array('class' => 'form-select text-white-dark','id'=>'state')) !!}
            </div>
			
		    <div>
               <label for="name_district ">District </label>
               {!! Form::select('district', [''=>'Select District'],[], array('class' => 'form-select text-white-dark','id'=>'district')) !!}
            </div>
			
            <div>
               <label for="city">City</label>
               {!! Form::select('city', [''=>'Select City'],[], array('class' => 'form-select text-white-dark','id'=>'city')) !!}
            </div><br>
          
           
            <div>
               <label for="aadhar_no"><i class="fa fa-asterisk" style="font-size:6px;color:red"></i>Aadhar No</label>
               {!! Form::text('aadhar_no', null, array('placeholder' => 'Enter Aadhar Number','class' => 'form-input','id'=>'aadhar_no')) !!}
            </div>
            <div>
               <label for="upload_aadhar_no"><i class="fa fa-asterisk" style="font-size:6px;color:red"></i>Upload Aadhar Card</label>
               {!! Form::file('upload_aadhar_no', array('placeholder' => 'Upload Aadhar Card Certificate','class' => 'form-input','id'=>'upload_aadhar_no')) !!}
            </div>
            <div>
               <label for="pan_no">PAN Number</label>
               {!! Form::text('pan_no', null, array('placeholder' => 'Enter PAN Number','class' => 'form-input','id'=>'pan_no')) !!}
            </div>
            <div>
               <label for="upload_pan_no">Upload Pan Card</label>
               {!! Form::file('upload_pan_no', array('placeholder' => 'Upload GST Certificate','class' => 'form-input','id'=>'upload_pan_no')) !!}
            </div>
            <div>
               <label for="gst_no">GST</label>
               {!! Form::text('gst_no', null, array('placeholder' => 'Enter GST','class' => 'form-input','id'=>'gst_no')) !!}
            </div>
            <div>
               <label for="upload_gst_no">Upload GST</label>
               {!! Form::file('upload_gst_no', array('placeholder' => 'Upload GST Certificate','class' => 'form-input','id'=>'upload_gst_no')) !!}
            </div>
         </div>
         <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
            <div>
               <label for="bank_name">Bank Name</label>
               {!! Form::text('bank_name', null, array('placeholder' => 'Enter Bank Name','class' => 'form-input','id'=>'bank_name')) !!}
            </div>
            <div>
               <label for="ifsc_code">IFSC Code</label>
               {!! Form::text('ifsc_code' , null, array('placeholder' => 'Enter IFSC Code','class' => 'form-input','id'=>'ifsc_code')) !!}
            </div>
            <div>
               <label for="account_no">Bank Account No</label>
               {!! Form::text('account_no', null , array('placeholder' => 'Enter Bank Account No','class' => 'form-input','id'=>'account_no')) !!}
            </div>
            <div>
               <label for="cheque_copy">Upload Cheque Copy</label>
               {!! Form::file('cheque_copy' , array('placeholder' => 'select cheque copy','class' => 'form-input','id'=>'cheque_copy')) !!}
            </div>
            <div>
               <label for="contract_img">Upload Contract File</label>
               {!! Form::file('contract_img' , array('placeholder' => 'Select contract file','class' => 'form-input','id'=>'contract_img')) !!}
            </div>
		   <!-- date 09-08-2024  -->
		    <?php  /*   <div>
                    <label for="gridPassword">Black Listed District</label>
                      <select class="form-input" id="choices-multiple-remove-button"  placeholder="Select Black Listed District" multiple name="black_listed_district[]" id="black_listed_district" />
                        <option value="ALLURI SITHARAMA RAJU">ALLURI SITHARAMA RAJU</option>
                        <option value="ANAKAPALLI">ANAKAPALLI</option>
                        <option value="ANANTHAPURAMU">ANANTHAPURAMU</option>
                        <option value="ANNAMAYYA">ANNAMAYYA</option>
                        <option value="BAPATLA">BAPATLA</option>
                        <option value="CHITTOOR">CHITTOOR</option>
                        <option value="Dr.B.R.AMBEDKAR KONASEEMA">Dr.B.R.AMBEDKAR KONASEEMA</option>
                        <option value="EAST GODAVARI">EAST GODAVARI</option>
                        <option value="ELURU">ELURU</option>
                        <option value="GUNTUR">GUNTUR</option>
                        <option value="KAKINADA">KAKINADA</option>
                        <option value="KRISHNA">KRISHNA</option>
                        <option value="KURNOOL">KURNOOL</option>
                        <option value="NANDYAL">NANDYAL</option>
                        <option value="NELLORE">NELLORE</option>
                        <option value="NTR">NTR</option>
                        <option value="PALNADU">PALNADU</option>
                        <option value="PARVATHIPURAM MANYAM">PARVATHIPURAM MANYAM</option>
                        <option value="PRAKASAM">PRAKASAM</option>
                        <option value="SRIKAKULAM">SRIKAKULAM</option>
                        <option value="SATHYA SAI">SATHYA SAI</option>
                        <option value="TIRUPATI">TIRUPATI</option>
                        <option value="VISAKHAPATNAM">VISAKHAPATNAM</option>
                        <option value="VIZIANAGARAM">VIZIANAGARAM</option>
                        <option value="WEST GODAVARI">WEST GODAVARI</option>
                        <option value="YSR KADAPA">YSR KADAPA</option>
                        <option value="ANJAW">ANJAW</option>
                        <option value="CHANGLANG">CHANGLANG</option>
                        <option value="EAST KAMENG">EAST KAMENG</option>
                        <option value="EAST SIANG">EAST SIANG</option>
                        <option value="ITANAGAR CAPITAL COMPLEX">ITANAGAR CAPITAL COMPLEX</option>
                        <option value="KAMLE">KAMLE</option>
                        <option value="KRA DAADI">KRA DAADI</option>
                        <option value="KURUNG KUMEY KURUNG">KURUNG KUMEY KURUNG</option>
                        <option value="LEPA RADA">LEPA RADA</option>
                        <option value="LOHIT">LOHIT</option>
                        <option value="LONGDING">LONGDING</option>
                        <option value="LOWER DIBANG VALLEY">LOWER DIBANG VALLEY</option>
                        <option value="LOWER SIANG">LOWER SIANG</option>
                        <option value="LOWER SUBANSIRI">LOWER SUBANSIRI</option>
                        <option value="NAMSAI">NAMSAI</option>
                        <option value="PAKKE-KESSANG">PAKKE-KESSANG</option>
                        <option value="PAPUM PARE">PAPUM PARE</option>
                        <option value="SHI YOMI">SHI YOMI</option>
                        <option value="SIANG">SIANG</option>
                        <option value="TAWANG">TAWANG</option>
                        <option value="TIRAP">TIRAP</option>
                        <option value="UPPER DIBANG VALLEY">UPPER DIBANG VALLEY</option>
                        <option value="UPPER SIANG">UPPER SIANG</option>
                        <option value="UPPER SUBANSIRI">UPPER SUBANSIRI</option>
                        <option value="WEST KAMENG">WEST KAMENG</option>
                        <option value="WEST SIANG">WEST SIANG</option>
                        <option value="BAKSA">BAKSA</option>
                        <option value="BARPETA">BARPETA</option>
                        <option value="BONGAIGAON">BONGAIGAON</option>
                        <option value="CACHAR">CACHAR</option>
                        <option value="CHARAIDEO">CHARAIDEO</option>
                        <option value="CHIRANG">CHIRANG</option>
                        <option value="DARRANGA">DARRANGA</option>
                        <option value="DHEMAJI">DHEMAJI</option>
                        <option value="DHUBRI">DHUBRI</option>
                        <option value="DIBRUGARH">DIBRUGARH</option>
                        <option value="DIMA HASAO">DIMA HASAO</option>
                        <option value="GOALPARA">GOALPARA</option>
                        <option value="GOLAGHAT">GOLAGHAT</option>
                        <option value="HAILAKANDI">HAILAKANDI</option>
                        <option value="JORHAT">JORHAT</option>
                        <option value="KAMRUP">KAMRUP</option>
                        <option value="KAMRUP METROPOLITAN">KAMRUP METROPOLITAN</option>
                        <option value="KARBI ANGLONG">KARBI ANGLONG</option>
                        <option value="KARIMGANJ">KARIMGANJ</option>
                        <option value="KOKRAJHAR">KOKRAJHAR</option>
                        <option value="LAKHIMPUR">LAKHIMPUR</option>
                        <option value="MAJULI">MAJULI</option>
                        <option value="MORIGAON">MORIGAON</option>
                        <option value="NAGAON">NAGAON</option>
                        <option value="NALBARI">NALBARI</option>
                        <option value="SIVASAGAR">SIVASAGAR</option>
                        <option value="SONITPUR">SONITPUR</option>
                        <option value="SOUTH SALMARA-MANKACHAR">SOUTH SALMARA-MANKACHAR</option>
                        <option value="TINSUKIA">TINSUKIA</option>
                        <option value="UDALGURI">UDALGURI</option>
                        <option value="WEST KARBI ANGLONG">WEST KARBI ANGLONG</option>
                        <option value="ARARIA">ARARIA</option>
                        <option value="ARWAL">ARWAL</option>
                        <option value="AURANGABAD">AURANGABAD</option>
                        <option value="BANKA">BANKA</option>
                        <option value="BEGUSARAI">BEGUSARAI</option>
                        <option value="BHAGALPUR">BHAGALPUR</option>
                        <option value="BHOJPUR">BHOJPUR</option>
                        <option value="BUXAR">BUXAR</option>
                        <option value="DARBHANGA">DARBHANGA</option>
                        <option value="GAYA">GAYA</option>
                        <option value="GOPALGANJ">GOPALGANJ</option>
                        <option value="JAMUI">JAMUI</option>
                        <option value="JEHANABAD">JEHANABAD</option>
                        <option value="KAIMUR (BHABUA)">KAIMUR (BHABUA)</option>
                        <option value="KATIHAR">KATIHAR</option>
                        <option value="KHAGARIA">KHAGARIA</option>
                        <option value="KISHANGANJ">KISHANGANJ</option>
                        <option value="LAKHISARAI">LAKHISARAI</option>
                        <option value="MADHEPURA">MADHEPURA</option>
                        <option value="MADHUBANI">MADHUBANI</option>
                        <option value="MUNGER">MUNGER</option>
                        <option value="MUZAFFARPUR">MUZAFFARPUR</option>
                        <option value="NALANDA">NALANDA</option>
                        <option value="NAWADA">NAWADA</option>
                        <option value="PASHCHIM CHAMPARAN">PASHCHIM CHAMPARAN</option>
                        <option value="PATNA">PATNA</option>
                        <option value="PURBI CHAMPARAN">PURBI CHAMPARAN</option>
                        <option value="PURNIA">PURNIA</option>
                        <option value="ROHTAS">ROHTAS</option>
                        <option value="SAHARSA">SAHARSA</option>
                        <option value="SAMASTIPUR">SAMASTIPUR</option>
                        <option value="SARAN">SARAN</option>
                        <option value="SHEIKHPURA">SHEIKHPURA</option>
                        <option value="SHEOHAR">SHEOHAR</option>
                        <option value="SITAMARHI">SITAMARHI</option>
                        <option value="SIWAN">SIWAN</option>
                        <option value="SUPAUL">SUPAUL</option>
                        <option value="VAISHALI">VAISHALI</option>
                        <option value="BALOD">BALOD</option>
                        <option value="BALODA BAZAR">BALODA BAZAR</option>
                        <option value="BALRAMPUR">BALRAMPUR</option>
                        <option value="BASTAR">BASTAR</option>
                        <option value="BEMETARA">BEMETARA</option>
                        <option value="BIJAPUR">BIJAPUR</option>
                        <option value="BILASPUR">BILASPUR</option>
                        <option value="DANTEWADA">DANTEWADA</option>
                        <option value="DHAMTARI">DHAMTARI</option>
                        <option value="DURG">DURG</option>
                        <option value="GARIYABAND">GARIYABAND</option>
                        <option value="GAURELLA PENDRA MARWAHI">GAURELLA PENDRA MARWAHI</option>
                        <option value="JANJGIR-CHAMPA">JANJGIR-CHAMPA</option>
                        <option value="JASHPUR">JASHPUR</option>
                        <option value="KABIRDHAM">KABIRDHAM</option>
                        <option value="KANKER">KANKER</option>
                        <option value="KONDAGAON">KONDAGAON</option>
                        <option value="KORBA">KORBA</option>
                        <option value="KOREA">KOREA</option>
                        <option value="MAHASAMUND">MAHASAMUND</option>
                        <option value="MUNGELI">MUNGELI</option>
                        <option value="NARAYANPUR">NARAYANPUR</option>
                        <option value="RAIGARH">RAIGARH</option>
                        <option value="RAIPUR">RAIPUR</option>
                        <option value="RAJNANDGAON">RAJNANDGAON</option>
                        <option value="SUKMA">SUKMA</option>
                        <option value="SURAJPUR">SURAJPUR</option>
                        <option value="SURGUJA">SURGUJA</option>
                        <option value="NORTH GAO">NORTH GAO</option>
                        <option value="SORTH GAO">SORTH GAO</option>
                        <option value="AHMADABAD">AHMADABAD</option>
                        <option value="AMRELI">AMRELI</option>
                        <option value="ANAND">ANAND</option>
                        <option value="ARVALLI">ARVALLI</option>
                        <option value="BANAS KANTHA">BANAS KANTHA</option>
                        <option value="BHARUCH">BHARUCH</option>
                        <option value="BHAVNAGAR">BHAVNAGAR</option>
                        <option value="BOTAD">BOTAD</option>
                        <option value="CHHOTAUDEPUR">CHHOTAUDEPUR</option>
                        <option value="DANG">DANG</option>
                        <option value="DEVBHUMI DWARKA">DEVBHUMI DWARKA</option>
                        <option value="DOHAD">DOHAD</option>
                        <option value="GANDHINAGAR">GANDHINAGAR</option>
                        <option value="GIR SOMNATH">GIR SOMNATH</option>
                        <option value="JAMNAGAR">JAMNAGAR</option>
                        <option value="JUNAGADH">JUNAGADH</option>
                        <option value="KACHCHH">KACHCHH</option>
                        <option value="KHEDA">KHEDA</option>
                        <option value="MAHESANA">MAHESANA</option>
                        <option value="MAHISAGAR">MAHISAGAR</option>
                        <option value="MORBI">MORBI</option>
                        <option value="NARMADA">NARMADA</option>
                        <option value="NAVSARI">NAVSARI</option>
                        <option value="PANCH MAHALS">PANCH MAHALS</option>
                        <option value="PATAN">PATAN</option>
                        <option value="PORBANDAR">PORBANDAR</option>
                        <option value="RAJKOT">RAJKOT</option>
                        <option value="SABAR KANTHA">SABAR KANTHA</option>
                        <option value="SURAT">SURAT</option>
                        <option value="SURENDRANAGAR">SURENDRANAGAR</option>
                        <option value="TAPI">TAPI</option>
                        <option value="VADODARA">VADODARA</option>
                        <option value="VALSAD">VALSAD</option>
                        <option value="AMBALA">AMBALA</option>
                        <option value="BHIWANI">BHIWANI</option>
                        <option value="CHARKI DADRI">CHARKI DADRI</option>
                        <option value="FARIDABAD">FARIDABAD</option>
                        <option value="FATEHABAD">FATEHABAD</option>
                        <option value="GURUGRAM">GURUGRAM</option>
                        <option value="HISAR">HISAR</option>
                        <option value="JHAJJAR">JHAJJAR</option>
                        <option value="JIND">JIND</option>
                        <option value="KAITHAL">KAITHAL</option>
                        <option value="KARNAL">KARNAL</option>
                        <option value="KURUKSHETRA">KURUKSHETRA</option>
                        <option value="MAHENDRAGARH">MAHENDRAGARH</option>
                        <option value="NUH">NUH</option>
                        <option value="PALWAL">PALWAL</option>
                        <option value="PANCHKULA">PANCHKULA</option>
                        <option value="PANIPAT">PANIPAT</option>
                        <option value="REWARI">REWARI</option>
                        <option value="ROHTAK">ROHTAK</option>
                        <option value="SIRSA">SIRSA</option>
                        <option value="SONIPAT">SONIPAT</option>
                        <option value="YAMUNANAGAR">YAMUNANAGAR</option>
                        <option value="BILASPUR">BILASPUR</option>
                        <option value="CHAMBA">CHAMBA</option>
                        <option value="HAMIRPUR">HAMIRPUR</option>
                        <option value="KANGRA">KANGRA</option>
                        <option value="KINNAUR">KINNAUR</option>
                        <option value="KULLU">KULLU</option>
                        <option value="LAHUL AND SPITI">LAHUL AND SPITI</option>
                        <option value="MANDI">MANDI</option>
                        <option value="SHIMLA">SHIMLA</option>
                        <option value="SIRMAUR">SIRMAUR</option>
                        <option value="SOLAN">SOLAN</option>
                        <option value="UNA">UNA</option>
                        <option value="BOKARO">BOKARO</option>
                        <option value="CHATRA">CHATRA</option>
                        <option value="DEOGHAR">DEOGHAR</option>
                        <option value="DHANBAD">DHANBAD</option>
                        <option value="DUMKA">DUMKA</option>
                        <option value="EAST SINGHBUM">EAST SINGHBUM</option>
                        <option value="GARHWA">GARHWA</option>
                        <option value="GIRIDIH">GIRIDIH</option>
                        <option value="GODDA">GODDA</option>
                        <option value="GUMLA">GUMLA</option>
                        <option value="HAZARIBAGH">HAZARIBAGH</option>
                        <option value="JAMTARA">JAMTARA</option>
                        <option value="KHUNTI">KHUNTI</option>
                        <option value="KODERMA">KODERMA</option>
                        <option value="LATEHAR">LATEHAR</option>
                        <option value="LOHARDAGA">LOHARDAGA</option>
                        <option value="PAKUR">PAKUR</option>
                        <option value="PALAMU">PALAMU</option>
                        <option value="RAMGARH">RAMGARH</option>
                        <option value="RANCHI">RANCHI</option>
                        <option value="SAHEBGANJ">SAHEBGANJ</option>
                        <option value="SARAIKELA KHARSAWAN">SARAIKELA KHARSAWAN</option>
                        <option value="SIMDEGA">SIMDEGA</option>
                        <option value="WEST SINGHBHUM">WEST SINGHBHUM</option>
                        <option value="BAGALKOTE">BAGALKOTE</option>
                        <option value="BALLARI">BALLARI</option>
                        <option value="BELAGAVI">BELAGAVI</option>
                        <option value="BENGALURU RURAL">BENGALURU RURAL</option>
                        <option value="BENGALURU URBAN">BENGALURU URBAN</option>
                        <option value="BIDAR">BIDAR</option>
                        <option value="CHAMARAJANAGARA">CHAMARAJANAGARA</option>
                        <option value="CHIKKABALLAPURA">CHIKKABALLAPURA</option>
                        <option value="CHIKKAMAGALURU">CHIKKAMAGALURU</option>
                        <option value="CHITRADURGA">CHITRADURGA</option>
                        <option value="DAKSHINA KANNADA">DAKSHINA KANNADA</option>
                        <option value="DAVANGERE">DAVANGERE</option>
                        <option value="DHARWAD">DHARWAD</option>
                        <option value="GADAG">GADAG</option>
                        <option value="HASSAN">HASSAN</option>
                        <option value="HAVERI">HAVERI</option>
                        <option value="KALABURAGI">KALABURAGI</option>
                        <option value="KODAGU">KODAGU</option>
                        <option value="KOLAR">KOLAR</option>
                        <option value="KOPPAL">KOPPAL</option>
                        <option value="MANDYA">MANDYA</option>
                        <option value="MYSURU">MYSURU</option>
                        <option value="RAICHUR">RAICHUR</option>
                        <option value="RAMANAGARA">RAMANAGARA</option>
                        <option value="SHIVAMOGGA">SHIVAMOGGA</option>
                        <option value="TUMAKURU">TUMAKURU</option>
                        <option value="UDUPI">UDUPI</option>
                        <option value="UTTARA KANNADA">UTTARA KANNADA</option>
                        <option value="VIJAYAPURA">VIJAYAPURA</option>
                        <option value="YADGIR">YADGIR</option>
                        <option value="ALAPPUZHA">ALAPPUZHA</option>
                        <option value="ERNAKULAM">ERNAKULAM</option>
                        <option value="IDUKKI">IDUKKI</option>
                        <option value="KANNUR">KANNUR</option>
                        <option value="KASARAGOD">KASARAGOD</option>
                        <option value="KOLLAM">KOLLAM</option>
                        <option value="KOTTAYAM">KOTTAYAM</option>
                        <option value="KOZHIKODE">KOZHIKODE</option>
                        <option value="MALAPPURAM">MALAPPURAM</option>
                        <option value="PALAKKAD">PALAKKAD</option>
                        <option value="PATHANAMTHITTA">PATHANAMTHITTA</option>
                        <option value="THIRUVANANTHAPURAM">THIRUVANANTHAPURAM</option>
                        <option value="THRISSUR">THRISSUR</option>
                        <option value="WAYANAD">WAYANAD</option>
                        <option value="AGAR MALWA">AGAR MALWA</option>
                        <option value="ALIRAJPUR">ALIRAJPUR</option>
                        <option value="ANUPPUR">ANUPPUR</option>
                        <option value="ASHOKNAGAR">ASHOKNAGAR</option>
                        <option value="BALAGHAT">BALAGHAT</option>
                        <option value="BARWANI">BARWANI</option>
                        <option value="BETUL">BETUL</option>
                        <option value="BHIND">BHIND</option>
                        <option value="BHOPAL">BHOPAL</option>
                        <option value="BURHANPUR">BURHANPUR</option>
                        <option value="CHHATARPUR">CHHATARPUR</option>
                        <option value="CHHINDWARA">CHHINDWARA</option>
                        <option value="DAMOH">DAMOH</option>
                        <option value="DATIA">DATIA</option>
                        <option value="DEWAS">DEWAS</option>
                        <option value="DHAR">DHAR</option>
                        <option value="DINDORI">DINDORI</option>
                        <option value="EAST NIMAR">EAST NIMAR</option>
                        <option value="GUNA">GUNA</option>
                        <option value="GWALIOR">GWALIOR</option>
                        <option value="HARDA">HARDA</option>
                        <option value="HOSHANGABAD">HOSHANGABAD</option>
                        <option value="INDORE">INDORE</option>
                        <option value="JABALPUR">JABALPUR</option>
                        <option value="JHABUA">JHABUA</option>
                        <option value="KATNI">KATNI</option>
                        <option value="KHARGONE">KHARGONE</option>
                        <option value="MANDLA">MANDLA</option>
                        <option value="MANDSAUR">MANDSAUR</option>
                        <option value="MORENA">MORENA</option>
                        <option value="NARSINGHPUR">NARSINGHPUR</option>
                        <option value="NEEMUCH">NEEMUCH</option>
                        <option value="NIWARI">NIWARI</option>
                        <option value="PANNA">PANNA</option>
                        <option value="RAISEN">RAISEN</option>
                        <option value="RAJGARH">RAJGARH</option>
                        <option value="RATLAM">RATLAM</option>
                        <option value="REWA">REWA</option>
                        <option value="SAGAR">SAGAR</option>
                        <option value="SATNA">SATNA</option>
                        <option value="SEHORE">SEHORE</option>
                        <option value="SEONI">SEONI</option>
                        <option value="SHAHDOL">SHAHDOL</option>
                        <option value="SHAJAPUR">SHAJAPUR</option>
                        <option value="SHEOPUR">SHEOPUR</option>
                        <option value="SHIVPURI">SHIVPURI</option>
                        <option value="SIDHI">SIDHI</option>
                        <option value="SINGRAULI">SINGRAULI</option>
                        <option value="TIKAMGARH">TIKAMGARH</option>
                        <option value="UJJAIN">UJJAIN</option>
                        <option value="UMARIA">UMARIA</option>
                        <option value="VIDISHA">VIDISHA</option>
                        <option value="AHMEDNAGAR">AHMEDNAGAR</option>
                        <option value="AKOLA">AKOLA</option>
                        <option value="AMRAVATI">AMRAVATI</option>
                        <option value="AURANGABAD">AURANGABAD</option>
                        <option value="BEED">BEED</option>
                        <option value="BHANDARA">BHANDARA</option>
                        <option value="BULDHANA">BULDHANA</option>
                        <option value="CHANDRAPUR">CHANDRAPUR</option>
                        <option value="DHULE">DHULE</option>
                        <option value="GADCHIROLI">GADCHIROLI</option>
                        <option value="GONDIA">GONDIA</option>
                        <option value="HINGOLI">HINGOLI</option>
                        <option value="JALGAON">JALGAON</option>
                        <option value="JALNA">JALNA</option>
                        <option value="KOLHAPUR">KOLHAPUR</option>
                        <option value="LATUR">LATUR</option>
                        <option value="MUMBAI">MUMBAI</option>
                        <option value="MUMBAI SUBURBAN">MUMBAI SUBURBAN</option>
                        <option value="NAGPUR">NAGPUR</option>
                        <option value="NANDED">NANDED</option>
                        <option value="NANDURBAR">NANDURBAR</option>
                        <option value="NASHIK">NASHIK</option>
                        <option value="OSMANABAD">OSMANABAD</option>
                        <option value="PALGHAR">PALGHAR</option>
                        <option value="PARBHANI">PARBHANI</option>
                        <option value="PUNE">PUNE</option>
                        <option value="RAIGAD">RAIGAD</option>
                        <option value="RATNAGIRI">RATNAGIRI</option>
                        <option value="SANGLI">SANGLI</option>
                        <option value="SATARA">SATARA</option>
                        <option value="SINDHUDURG">SINDHUDURG</option>
                        <option value="SOLAPUR">SOLAPUR</option>
                        <option value="THANE">THANE</option>
                        <option value="WARDHA">WARDHA</option>
                        <option value="WASHIM">WASHIM</option>
                        <option value="YAVATMAL">YAVATMAL</option>
                        <option value="BISHNUPUR">BISHNUPUR</option>
                        <option value="CHANDEL">CHANDEL</option>
                        <option value="CHURACHANDPUR">CHURACHANDPUR</option>
                        <option value="IMPHAL EAST">IMPHAL EAST</option>
                        <option value="IMPHAL WEST">IMPHAL WEST</option>
                        <option value="JIRIBAM">JIRIBAM</option>
                        <option value="KAKCHING">KAKCHING</option>
                        <option value="KAMJONG">KAMJONG</option>
                        <option value="KANGPOKPI">KANGPOKPI</option>
                        <option value="NONEY">NONEY</option>
                        <option value="PHERZAWL">PHERZAWL</option>
                        <option value="SENAPATI">SENAPATI</option>
                        <option value="TAMENGLONG">TAMENGLONG</option>
                        <option value="TENGNOUPAL">TENGNOUPAL</option>
                        <option value="THOUBAL">THOUBAL</option>
                        <option value="UKHRUL">UKHRUL</option>
                        <option value="EAST GARO HILLS">EAST GARO HILLS</option>
                        <option value="EAST JAINTIA HILLS">EAST JAINTIA HILLS</option>
                        <option value="EAST KHASI HILLS">EAST KHASI HILLS</option>
                        <option value="NORTH GARO HILLS">NORTH GARO HILLS</option>
                        <option value="RI BHOI">RI BHOI</option>
                        <option value="SOUTH GARO HILLS">SOUTH GARO HILLS</option>
                        <option value="SOUTH WEST GARO HILLS">SOUTH WEST GARO HILLS</option>
                        <option value="SOUTH WEST KHASI HILLS">SOUTH WEST KHASI HILLS</option>
                        <option value="WEST GARO HILLS">WEST GARO HILLS</option>
                        <option value="WEST JAINTIA HILLS">WEST JAINTIA HILLS</option>
                        <option value="WEST KHASI HILLS">WEST KHASI HILLS</option>
                        <option value="AIZAWL">AIZAWL</option>
                        <option value="CHAMPHAI">CHAMPHAI</option>
                        <option value="HNAHTHIAL">HNAHTHIAL</option>
                        <option value="KHAWZAWL">KHAWZAWL</option>
                        <option value="KOLASIB">KOLASIB</option>
                        <option value="LAWNGTLAI">LAWNGTLAI</option>
                        <option value="LUNGLEI">LUNGLEI</option>
                        <option value="MAMIT">MAMIT</option>
                        <option value="SAIHA">SAIHA</option>
                        <option value="SAITUAL">SAITUAL</option>
                        <option value="SERCHHIP">SERCHHIP</option>
                        <option value="DIMAPUR">DIMAPUR</option>
                        <option value="KIPHIRE">KIPHIRE</option>
                        <option value="KOHIMA">KOHIMA</option>
                        <option value="LONGLENG">LONGLENG</option>
                        <option value="MOKOKCHUNG">MOKOKCHUNG</option>
                        <option value="MON">MON</option>
                        <option value="PEREN">PEREN</option>
                        <option value="PHEK">PHEK</option>
                        <option value="TUENSANG">TUENSANG</option>
                        <option value="WOKHA">WOKHA</option>
                        <option value="ZUNHEBOTO">ZUNHEBOTO</option>
                        <option value="ANUGUL">ANUGUL</option>
                        <option value="BALANGIR">BALANGIR</option>
                        <option value="BALESHWAR">BALESHWAR</option>
                        <option value="BARGARH">BARGARH</option>
                        <option value="BHADRAK">BHADRAK</option>
                        <option value="BOUDH">BOUDH</option>
                        <option value="CUTTACK">CUTTACK</option>
                        <option value="DEOGARH">DEOGARH</option>
                        <option value="DHENKANAL">DHENKANAL</option>
                        <option value="GAJAPATI">GAJAPATI</option>
                        <option value="GANJAM">GANJAM</option>
                        <option value="JAGATSINGHAPUR">JAGATSINGHAPUR</option>
                        <option value="JAJAPUR">JAJAPUR</option>
                        <option value="JHARSUGUDA">JHARSUGUDA</option>
                        <option value="KALAHANDI">KALAHANDI</option>
                        <option value="KANDHAMAL">KANDHAMAL</option>
                        <option value="KENDRAPARA">KENDRAPARA</option>
                        <option value="KENDUJHAR">KENDUJHAR</option>
                        <option value="KHORDHA">KHORDHA</option>
                        <option value="KORAPUT">KORAPUT</option>
                        <option value="MALKANGIRI">MALKANGIRI</option>
                        <option value="MAYURBHANJ">MAYURBHANJ</option>
                        <option value="NABARANGPUR">NABARANGPUR</option>
                        <option value="NAYAGARH">NAYAGARH</option>
                        <option value="NUAPADA">NUAPADA</option>
                        <option value="PURI">PURI</option>
                        <option value="RAYAGADA">RAYAGADA</option>
                        <option value="SAMBALPUR">SAMBALPUR</option>
                        <option value="SONEPUR">SONEPUR</option>
                        <option value="SUNDARGARH">SUNDARGARH</option>
                        <option value="AMRITSAR">AMRITSAR</option>
                        <option value="BARNALA">BARNALA</option>
                        <option value="BATHINDA">BATHINDA</option>
                        <option value="FARIDKOT">FARIDKOT</option>
                        <option value="FATEHGARH SAHIB">FATEHGARH SAHIB</option>
                        <option value="FAZILKA">FAZILKA</option>
                        <option value="FIROZEPUR">FIROZEPUR</option>
                        <option value="GURDASPUR">GURDASPUR</option>
                        <option value="HOSHIARPUR">HOSHIARPUR</option>
                        <option value="JALANDHAR">JALANDHAR</option>
                        <option value="KAPURTHALA">KAPURTHALA</option>
                        <option value="LUDHIANA">LUDHIANA</option>
                        <option value="MANSA">MANSA</option>
                        <option value="MOGA">MOGA</option>
                        <option value="PATHANKOT">PATHANKOT</option>
                        <option value="PATIALA">PATIALA</option>
                        <option value="RUPNAGAR">RUPNAGAR</option>
                        <option value="S.A.S NAGAR">S.A.S NAGAR</option>
                        <option value="SANGRUR">SANGRUR</option>
                        <option value="SHAHID BHAGAT SINGH NAGAR">SHAHID BHAGAT SINGH NAGAR</option>
                        <option value="SRI MUKTSAR SAHIB">SRI MUKTSAR SAHIB</option>
                        <option value="TARN TARAN">TARN TARAN</option>
                        <option value="AJMER">AJMER</option>
                        <option value="ALWAR">ALWAR</option>
                        <option value="BANSWARA">BANSWARA</option>
                        <option value="BARAN">BARAN</option>
                        <option value="BARMER">BARMER</option>
                        <option value="BHARATPUR">BHARATPUR</option>
                        <option value="BHILWARA">BHILWARA</option>
                        <option value="BIKANER">BIKANER</option>
                        <option value="BUNDI">BUNDI</option>
                        <option value="CHITTORGARH">CHITTORGARH</option>
                        <option value="CHURU">CHURU</option>
                        <option value="DAUSA">DAUSA</option>
                        <option value="DHOLPUR">DHOLPUR</option>
                        <option value="DUNGARPUR">DUNGARPUR</option>
                        <option value="GANGANAGAR">GANGANAGAR</option>
                        <option value="HANUMANGARH">HANUMANGARH</option>
                        <option value="JAIPUR">JAIPUR</option>
                        <option value="JAISALMER">JAISALMER</option>
                        <option value="JALORE">JALORE</option>
                        <option value="JHALAWAR">JHALAWAR</option>
                        <option value="JHUNJHUNU">JHUNJHUNU</option>
                        <option value="JODHPUR">JODHPUR</option>
                        <option value="KARAULI">KARAULI</option>
                        <option value="KOTA">KOTA</option>
                        <option value="NAGAUR">NAGAUR</option>
                        <option value="PALI">PALI</option>
                        <option value="PRATAPGARH">PRATAPGARH</option>
                        <option value="RAJSAMAND">RAJSAMAND</option>
                        <option value="SAWAI MADHOPUR">SAWAI MADHOPUR</option>
                        <option value="SIKAR">SIKAR</option>
                        <option value="SIROHI">SIROHI</option>
                        <option value="TONK">TONK</option>
                        <option value="UDAIPUR">UDAIPUR</option>
                        <option value="EAST DISTRICT">EAST DISTRICT</option>
                        <option value="NORTH DISTRICT">NORTH DISTRICT</option>
                        <option value="SOUTH DISTRICT">SOUTH DISTRICT</option>
                        <option value="WEST DISTRICT">WEST DISTRICT</option>
                        <option value="ARIYALUR">ARIYALUR</option>
                        <option value="CHENGALPATTU">CHENGALPATTU</option>
                        <option value="CHENNAI">CHENNAI</option>
                        <option value="COIMBATORE">COIMBATORE</option>
                        <option value="CUDDALORE">CUDDALORE</option>
                        <option value="DHARMAPURI">DHARMAPURI</option>
                        <option value="DINDIGUL">DINDIGUL</option>
                        <option value="ERODE">ERODE</option>
                        <option value="KALLAKURICHI">KALLAKURICHI</option>
                        <option value="KANCHIPURAM">KANCHIPURAM</option>
                        <option value="KANNIYAKUMARI">KANNIYAKUMARI</option>
                        <option value="KARUR">KARUR</option>
                        <option value="KRISHNAGIRI">KRISHNAGIRI</option>
                        <option value="MADURAI">MADURAI</option>
                        <option value="NAGAPATTINAM">NAGAPATTINAM</option>
                        <option value="NAMAKKAL">NAMAKKAL</option>
                        <option value="PERAMBALUR">PERAMBALUR</option>
                        <option value="PUDUKKOTTAI">PUDUKKOTTAI</option>
                        <option value="RAMANATHAPURAM">RAMANATHAPURAM</option>
                        <option value="RANIPET">RANIPET</option>
                        <option value="SALEM">SALEM</option>
                        <option value="SIVAGANGA">SIVAGANGA</option>
                        <option value="TENKASI">TENKASI</option>
                        <option value="THANJAVUR">THANJAVUR</option>
                        <option value="THE NILGIRIS">THE NILGIRIS</option>
                        <option value="THENI">THENI</option>
                        <option value="THIRUVALLUR">THIRUVALLUR</option>
                        <option value="THIRUVARUR">THIRUVARUR</option>
                        <option value="TIRUCHIRAPPALLI">TIRUCHIRAPPALLI</option>
                        <option value="TIRUNELVELI">TIRUNELVELI</option>
                        <option value="TIRUPATHUR">TIRUPATHUR</option>
                        <option value="TIRUPPUR">TIRUPPUR</option>
                        <option value="TIRUVANNAMALAI">TIRUVANNAMALAI</option>
                        <option value="TUTICORIN">TUTICORIN</option>
                        <option value="VELLORE">VELLORE</option>
                        <option value="VILLUPURAM">VILLUPURAM</option>
                        <option value="VIRUDHUNAGAR">VIRUDHUNAGAR</option>
                        <option value="ADILABAD">ADILABAD</option>
                        <option value="BHADRADRI KOTHAGUDEM">BHADRADRI KOTHAGUDEM</option>
                        <option value="HYDERABAD">HYDERABAD</option>
                        <option value="JAGITIAL">JAGITIAL</option>
                        <option value="JANGOAN">JANGOAN</option>
                        <option value="JAYASHANKAR BHUPALAPALLY">JAYASHANKAR BHUPALAPALLY</option>
                        <option value="JOGULAMBA GADWAL">JOGULAMBA GADWAL</option>
                        <option value="KAMAREDDY">KAMAREDDY</option>
                        <option value="KARIMNAGAR">KARIMNAGAR</option>
                        <option value="KHAMMAM">KHAMMAM</option>
                        <option value="KUMURAM BHEEM ASIFABAD">KUMURAM BHEEM ASIFABAD</option>
                        <option value="MAHABUBABAD">MAHABUBABAD</option>
                        <option value="MAHABUBNAGAR">MAHABUBNAGAR</option>
                        <option value="MANCHERIAL">MANCHERIAL</option>
                        <option value="MEDAK">MEDAK</option>
                        <option value="MEDCHAL MALKAJGIRI">MEDCHAL MALKAJGIRI</option>
                        <option value="MULUGU">MULUGU</option>
                        <option value="NAGARKURNOOL">NAGARKURNOOL</option>
                        <option value="NALGONDA">NALGONDA</option>
                        <option value="NARAYANPET">NARAYANPET</option>
                        <option value="NIRMAL">NIRMAL</option>
                        <option value="NIZAMABAD">NIZAMABAD</option>
                        <option value="PEDDAPALLI">PEDDAPALLI</option>
                        <option value="RAJANNA SIRCILLA">RAJANNA SIRCILLA</option>
                        <option value="RANGA REDDY">RANGA REDDY</option>
                        <option value="SANGAREDDY">SANGAREDDY</option>
                        <option value="SIDDIPET">SIDDIPET</option>
                        <option value="SURYAPET">SURYAPET</option>
                        <option value="VIKARABAD">VIKARABAD</option>
                        <option value="WANAPARTHY">WANAPARTHY</option>
                        <option value="WARANGAL RURAL">WARANGAL RURAL</option>
                        <option value="WARANGAL URBAN">WARANGAL URBAN</option>
                        <option value="YADADRI BHUVANAGIRI">YADADRI BHUVANAGIRI</option>
                        <option value="DHALAI">DHALAI</option>
                        <option value="GOMATI">GOMATI</option>
                        <option value="KHOWAI">KHOWAI</option>
                        <option value="NORTH TRIPURA">NORTH TRIPURA</option>
                        <option value="SEPAHIJALA">SEPAHIJALA</option>
                        <option value="SOUTH TRIPURA">SOUTH TRIPURA</option>
                        <option value="UNAKOTI">UNAKOTI</option>
                        <option value="WEST TRIPURA">WEST TRIPURA</option>
                        <option value="AGRA">AGRA</option>
                        <option value="ALIGARH">ALIGARH</option>
                        <option value="AMBEDKAR NAGAR">AMBEDKAR NAGAR</option>
                        <option value="AMETHI">AMETHI</option>
                        <option value="AMROHA">AMROHA</option>
                        <option value="AURAIYA">AURAIYA</option>
                        <option value="AYODHYA">AYODHYA</option>
                        <option value="AZAMGARH">AZAMGARH</option>
                        <option value="BAGHPAT">BAGHPAT</option>
                        <option value="BAHRAICH">BAHRAICH</option>
                        <option value="BALLIA">BALLIA</option>
                        <option value="BALRAMPUR">BALRAMPUR</option>
                        <option value="BANDA">BANDA</option>
                        <option value="BARABANKI">BARABANKI</option>
                        <option value="BAREILLY">BAREILLY</option>
                        <option value="BASTI">BASTI</option>
                        <option value="BHADOHI">BHADOHI</option>
                        <option value="BIJNOR">BIJNOR</option>
                        <option value="BUDAUN">BUDAUN</option>
                        <option value="BULANDSHAHR">BULANDSHAHR</option>
                        <option value="CHANDAULI">CHANDAULI</option>
                        <option value="CHITRAKOOT">CHITRAKOOT</option>
                        <option value="DEORIA">DEORIA</option>
                        <option value="ETAH">ETAH</option>
                        <option value="ETAWAH">ETAWAH</option>
                        <option value="FARRUKHABAD">FARRUKHABAD</option>
                        <option value="FATEHPUR">FATEHPUR</option>
                        <option value="FIROZABAD">FIROZABAD</option>
                        <option value="GAUTAM BUDDHA NAGAR">GAUTAM BUDDHA NAGAR</option>
                        <option value="GHAZIABAD">GHAZIABAD</option>
                        <option value="GHAZIPUR">GHAZIPUR</option>
                        <option value="GONDA">GONDA</option>
                        <option value="GORAKHPUR">GORAKHPUR</option>
                        <option value="HAMIRPUR">HAMIRPUR</option>
                        <option value="HAPUR">HAPUR</option>
                        <option value="HARDOI">HARDOI</option>
                        <option value="HATHRAS">HATHRAS</option>
                        <option value="JALAUN">JALAUN</option>
                        <option value="JAUNPUR">JAUNPUR</option>
                        <option value="JHANSI">JHANSI</option>
                        <option value="KANNAUJ">KANNAUJ</option>
                        <option value="KANPUR DEHAT">KANPUR DEHAT</option>
                        <option value="KANPUR NAGAR">KANPUR NAGAR</option>
                        <option value="KASGANJ">KASGANJ</option>
                        <option value="KAUSHAMBI">KAUSHAMBI</option>
                        <option value="KHERI">KHERI</option>
                        <option value="KUSHI NAGAR">KUSHI NAGAR</option>
                        <option value="LALITPUR">LALITPUR</option>
                        <option value="LUCKNOW">LUCKNOW</option>
                        <option value="MAHARAJGANJ">MAHARAJGANJ</option>
                        <option value="MAHOBA">MAHOBA</option>
                        <option value="MAINPURI">MAINPURI</option>
                        <option value="MATHURA">MATHURA</option>
                        <option value="MAU">MAU</option>
                        <option value="MEERUT">MEERUT</option>
                        <option value="MIRZAPUR">MIRZAPUR</option>
                        <option value="MORADABAD">MORADABAD</option>
                        <option value="MUZAFFARNAGAR">MUZAFFARNAGAR</option>
                        <option value="PILIBHIT">PILIBHIT</option>
                        <option value="PRATAPGARH">PRATAPGARH</option>
                        <option value="PRAYAGRAJ">PRAYAGRAJ</option>
                        <option value="RAE BARELI">RAE BARELI</option>
                        <option value="SAHARANPUR">SAHARANPUR</option>
                        <option value="SAMBHAL">SAMBHAL</option>
                        <option value="SANT KABEER NAGAR">SANT KABEER NAGAR</option>
                        <option value="SHAHJAHANPUR">SHAHJAHANPUR</option>
                        <option value="SHAMLI">SHAMLI</option>
                        <option value="SHRAVASTI">SHRAVASTI</option>
                        <option value="SIDDHARTH NAGAR">SIDDHARTH NAGAR</option>
                        <option value="SITAPUR">SITAPUR</option>
                        <option value="SONBHADRA">SONBHADRA</option>
                        <option value="SULTANPUR">SULTANPUR</option>
                        <option value="UNNAO">UNNAO</option>
                        <option value="VARANASI">VARANASI</option>
                        <option value="CHANDIGARH">CHANDIGARH</option>
                        <option value="DADRA AND NAGAR HAVELI">DADRA AND NAGAR HAVELI</option>
                        <option value="DAMAN">DAMAN</option>
                        <option value="DIU">DIU</option>
                        <option value="ANANTNAG">ANANTNAG</option>
                        <option value="BANDIPORA">BANDIPORA</option>
                        <option value="BARAMULLA">BARAMULLA</option>
                        <option value="BUDGAM">BUDGAM</option>
                        <option value="DODA">DODA</option>
                        <option value="GANDERBAL">GANDERBAL</option>
                        <option value="JAMMU">JAMMU</option>
                        <option value="KATHUA">KATHUA</option>
                        <option value="KISHTWAR">KISHTWAR</option>
                        <option value="KULGAM">KULGAM</option>
                        <option value="KUPWARA">KUPWARA</option>
                        <option value="POONCH">POONCH</option>
                        <option value="PULWAMA">PULWAMA</option>
                        <option value="RAJOURI">RAJOURI</option>
                        <option value="RAMBAN">RAMBAN</option>
                        <option value="REASI">REASI</option>
                        <option value="SAMBA">SAMBA</option>
                        <option value="SHOPIAN">SHOPIAN</option>
                        <option value="SRINAGAR">SRINAGAR</option>
                        <option value="UDHAMPUR">UDHAMPUR</option>
                        <option value="ALMORA">ALMORA</option>
                        <option value="BAGESHWAR">BAGESHWAR</option>
                        <option value="CHAMOLI">CHAMOLI</option>
                        <option value="CHAMPAWAT">CHAMPAWAT</option>
                        <option value="DEHRADUN">DEHRADUN</option>
                        <option value="HARIDWAR">HARIDWAR</option>
                        <option value="NAINITAL">NAINITAL</option>
                        <option value="PAURI GARHWAL">PAURI GARHWAL</option>
                        <option value="PITHORAGARH">PITHORAGARH</option>
                        <option value="RUDRA PRAYAG">RUDRA PRAYAG</option>
                        <option value="TEHRI GARHWAL">TEHRI GARHWAL</option>
                        <option value="UDAM SINGH NAGAR">UDAM SINGH NAGAR</option>
                        <option value="UTTAR KASHI">UTTAR KASHI</option>
                        <option value="NORTH 24 PARGANAS">NORTH 24 PARGANAS</option>
                        <option value="SOUTH 24 PARGANAS">SOUTH 24 PARGANAS</option>
                        <option value="ALIPURDUAR">ALIPURDUAR</option>
                        <option value="BANKURA">BANKURA</option>
                        <option value="BIRBHUM">BIRBHUM</option>
                        <option value="COOCHBEHAR">COOCHBEHAR</option>
                        <option value="DARJEELING">DARJEELING</option>
                        <option value="DINAJPUR DAKSHIN">DINAJPUR DAKSHIN</option>
                        <option value="DINAJPUR UTTAR">DINAJPUR UTTAR</option>
                        <option value="HOOGHLY">HOOGHLY</option>
                        <option value="HOWRAH">HOWRAH</option>
                        <option value="JALPAIGURI">JALPAIGURI</option>
                        <option value="JHARGRAM">JHARGRAM</option>
                        <option value="KALIMPONG">KALIMPONG</option>
                        <option value="KOLKATA">KOLKATA</option>
                        <option value="MALDAH">MALDAH</option>
                        <option value="MEDINIPUR EAST">MEDINIPUR EAST</option>
                        <option value="MEDINIPUR WEST">MEDINIPUR WEST</option>
                        <option value="MURSHIDABAD">MURSHIDABAD</option>
                        <option value="NADIA">NADIA</option>
                        <option value="PASCHIM BARDHAMAN">PASCHIM BARDHAMAN</option>
                        <option value="PURBA BARDHAMAN">PURBA BARDHAMAN</option>
                        <option value="PURULIA">PURULIA</option>
                        <option value="NICOBARS">NICOBARS</option>
                        <option value="NORTH AND MIDDLE ANDAMAN">NORTH AND MIDDLE ANDAMAN</option>
                        <option value="SOUTH ANDAMANS">SOUTH ANDAMANS</option>
                        <option value="KARGIL">KARGIL</option>
                        <option value="LEH">LEH</option>
                        <option value="LAKSHADWEEP">LAKSHADWEEP</option>
                        <option value="CENTRAL">CENTRAL</option>
                        <option value="EAST">EAST</option>
                        <option value="NEW DELHI">NEW DELHI</option>
                        <option value="NORTH">NORTH</option>
                        <option value="NORTH EAST">NORTH EAST</option>
                        <option value="NORTH WEST">NORTH WEST</option>
                        <option value="SHAHDARA">SHAHDARA</option>
                        <option value="SOUTH">SOUTH</option>
                        <option value="SOUTH EAST">SOUTH EAST</option>
                        <option value="SOUTH WEST">SOUTH WEST</option>
                        <option value="WEST">WEST</option>
                        <option value="KARAIKAL">KARAIKAL</option>
                        <option value="PUDUCHERRY">PUDUCHERRY</option>
                        <option value="MAHE">MAHE</option>
                        <option value="YANAM">YANAM</option>
                       
                  </select>
            </div>*/?>
           <!-- date 09-08-2024  -->
            <input id="status" type="hidden" name="status" placeholder="" value="1" class="form-input" />
			
         </div>

         <button type="submit" class="btn btn-primary !mt-6">Submit</button>
         {!! Form::close() !!}
      </div>
	  
   </div>
</div>
@endsection

@push('script')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>


<!-- <!-- Multiple dropdown Select and search Start28-11-2023 
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/bbbootstrap/libraries@main/choices.min.css">
<script src="https://cdn.jsdelivr.net/gh/bbbootstrap/libraries@main/choices.min.js"></script> -->

<script>
   $(document).ready(function(){
      
       var multipleCancelButton = new Choices('#choices-multiple-remove-button', {
          removeItemButton: true,
          maxItemCount:50,
          searchResultLimit:50,
          renderChoiceLimit:50
        }); 
       
       
   });
   
</script>
<!-- search bar and district data -->


<script>
   $(function(){
       var dtToday = new Date();
       var month = dtToday.getMonth() + 1;
       var day = dtToday.getDate();
       var year = dtToday.getFullYear();
       if(month < 10)
           month = '0' + month.toString();
       if(day < 10)
           day = '0' + day.toString();
       
       var maxDate = year + '-' + month + '-' + day;
      $('#inputdate').attr('min', maxDate);
   });
</script>

<!-- Date Picker End-->
<script>
   function getStateCity(element){
    
    var pincode = element.value;
    
       var token = "{{ csrf_token() }}";
       var url = "{{ route('get_state_city') }}";
   
     $.ajax({
      url:url,
      type: 'POST',
      data: { _token :token,pincode:pincode },
      success:function(result){
    
        if(result.state_city_data.length > 0){
   
          $('#state').html('');
          $('#city').html('');
          $('#district').html('');
          const district = result.state_city_data[0].district;
		 
          $.each(result.state_city_data, function(key, value) {
          
          $('#state').append('<option value="'+value.state+'">'+value.state+'</option>');
          
          $('#city').append('<option value="'+value.post_office+'">'+value.post_office+'</option>');
		  
          }); 
		
         $('#district').append('<option value="'+district+'">'+district+'</option>');
       }
   
      }
     });
    
   }
 
</script>

@endpush