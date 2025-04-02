<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
 <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
<style>
body {font-family: Arial, Helvetica, sans-serif;}
* {box-sizing: border-box;}

input[type=text], select, textarea {
  width: 100%;
  padding: 12px;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-sizing: border-box;
  margin-top: 6px;
  margin-bottom: 16px;
  resize: vertical;
}

input[type=submit] {
  background-color: #04AA6D;
  color: white;
  padding: 12px 20px;
  border: none;
  border-radius: 4px;
  cursor: pointer;
}

input[type=submit]:hover {
  background-color: #45a049;
}

.container {
  border-radius: 5px;
  background-color: #f2f2f2;
  padding: 20px;
}
</style>



<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

</head>
<body>

<h3>Contact Form</h3>

<div class="container">
  @include('admin/flash-message')
  <form action="{{route('store_contact')}}" method="post">
  @csrf
    <label for="fname">First Name</label>
    <input type="text" id="fname" name="firstname" placeholder="Your name.." required>

    <label for="lname">Last Name</label>
    <input type="text" id="lname" name="lastname" placeholder="Your last name.." required>
	
	<label for="email">Email</label>
    <input type="text" id="email" name="email" placeholder="Your email name.." required>
	
	<label for="contact">Contact</label>
    <input type="text" id="conntact" name="mobile" placeholder="Your mobile name.." required>
	
	<label for="pin">Pin</label>
	
    <input type="text" id="pin_code" name="pin_code" placeholder="Your area pin code.." required>

    <label for="country">Country</label>
    <select id="country" name="country" onchange="getState(this);" required>
	<option value="">Select Country</option>
	@foreach($countries as $country_row)
      <option value="{{$country_row->id}}">{{$country_row->name}}</option>
	@endforeach
    </select>
	
	<label for="state">State</label>
    <select id="state" name="state" onchange="getCity(this);" required>
       <option value="">Select State</option>
    </select>
	
	<label for="city">City</label>
    <select id="city" name="city" required>
        <option value="">Select City</option>
    </select>

   

    <input type="submit" value="Submit">
  </form>
</div>

</body>

<script>

function getState(select){
	
  var result = [];
  var options = select && select.options;
  var opt;

  for (var i=0, iLen=options.length; i<iLen; i++) {
    opt = options[i];

    if (opt.selected) {
      result.push(opt.value || opt.text);
    }
  }

	var country_id =  result;
	
    var token = "{{ csrf_token() }}";
    var url = "{{ route('get_state') }}";

	 $.ajax({
		url:url,
		type: 'POST',
		data: { _token :token,country_id:country_id },
		success:function(result){
			
		   $('#state').html('');
		   
		   $('#state').append('<option value="">select State</option>');
		   $.each(result.states, function(key, value) {
			  $('#state').append('<option value="'+value+'">'+key+'</option>');
			});
		}
	 });
 
}

function getCity(select){
	
  var result = [];
  var options = select && select.options;
  var opt;

  for (var i=0, iLen=options.length; i<iLen; i++) {
    opt = options[i];

    if (opt.selected) {
      result.push(opt.value || opt.text);
    }
  }

	var state_id =  result;
	
    var token = "{{ csrf_token() }}";
    var url = "{{ route('get_city') }}";

	 $.ajax({
		url:url,
		type: 'POST',
		data: { _token :token,state_id:state_id },
		success:function(result){
			console.log(result);
		   $('#city').html('');
		   
		   $('#city').append('<option value="">select City</option>');
		   $.each(result.city, function(key, value) {
			  $('#city').append('<option value="'+value+'">'+key+'</option>');
			});
		}
	 });
 
}

</script>

</html>
