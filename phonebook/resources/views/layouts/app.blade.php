<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>{{ config('app.name', 'Contacts apps') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
	<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">
  
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <a class="navbar-brand" href="{{ url('/') }}">
                        {{ config('app.name', 'Contacts apps') }}
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        &nbsp;
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @if (Auth::guest())
                            <li><a href="{{ route('login') }}">Login</a></li>
                            <li><a href="{{ route('register') }}">Register</a></li>
                        @else
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu" role="menu">
                                    <li>
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
									<li><a href ="{{route('myaccount')}}">My account</a></li>
									
                                </ul>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </nav>
        <div class="container">
			@yield('content')
		</div>
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
   <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script>
  $(document).ready(function() {
    var availableTags = [
      "ActionScript",
      "AppleScript",
      "Asp",
      "BASIC",
      "C",
      "C++",
      "Clojure",
      "COBOL",
      "ColdFusion",
      "Erlang",
      "Fortran",
      "Groovy",
      "Haskell",
      "Java",
      "JavaScript",
      "Lisp",
      "Perl",
      "PHP",
      "Python",
      "Ruby",
      "Scala",
      "Scheme"
    ];
    $( "#tags" ).autocomplete({
      source: availableTags
    });
  } );
  </script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/signature_pad/1.5.3/signature_pad.min.js"></script>
	<script type="text/javascript">
      $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });
	</script>
	<script>
		$(document).ready(function() {
		
		    //setup before functions
			var typingTimer; 
			var doneTypingInterval = 1000;  //time in ms, 5 second for example
			//var $input = $('#searchString');

			//on keyup, start the countdown
			$('#searchString').keyup(function () {
			    //var stringLength = $(this).val().length;
				//if(stringLength > 2){
				    clearTimeout(typingTimer);
					typingTimer = setTimeout(doneTyping , doneTypingInterval);
				//}
			  
			});
			$('select#sorting').on('change', function () {
			  clearTimeout(typingTimer);
			  typingTimer = setTimeout(doneTyping , doneTypingInterval);
			});


			//user is "finished typing," do something
			var doneTyping  = function () {
			
				var searchText = $('#searchString').val();
				$.ajax({
						url:"http://localhost/phonebook/public/contactSearch",
						type:"POST",
						headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
						data: {
							"_token": "{{ csrf_token() }}",
							"searchString": searchText,
							"order_by": "name",
							"order": "DESC",
							},
						success: function(data){
							//console.log(data);
							$("#search-form").submit();
							
							//alert(data);
						}
				  });
			};
			
		//Delete All Functionality
			
		$("#checkAll").change(function () {
			$("input:checkbox").prop('checked', $(this).prop("checked"));
		});
		
		$('.delete_all').on('click', function(e) {

            var allVals = [];  
            $(".cb:checked").each(function() {  
                allVals.push($(this).attr('data-id'));
            });  

            if(allVals.length <=0)  
            {  
                alert("Please select row.");  
            }  else {  

                var check = confirm("Are you sure you want to delete this row?");  
                if(check == true){  

                    var join_selected_values = allVals.join(","); 

                    $.ajax({
                        url: $(this).data('url'),
                        type: 'DELETE',
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        data: 'ids='+join_selected_values,
                        success: function (data) {
                            if (data['success']) {
                                $(".cb:checked").each(function() {  
                                    $(this).parents("tr").remove();
                                });
                                alert(data['success']);
                            } else if (data['error']) {
                                alert(data['error']);
                            } else {
                                alert('Whoops Something went wrong!!');
                            }
                        },
                        error: function (data) {
                            alert(data.responseText);
                        }
                    });

                  $.each(allVals, function( index, value ) {
                      $('table tr').filter("[data-row-id='" + value + "']").remove();
                  });
                }  
            }  
        });

        
			
		});
	    
	</script>
	
	<script>
	
	$(function () {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            var signaturePad = new SignaturePad(document.getElementById('signature-pad'), {
                backgroundColor: 'rgba(255, 255, 255, 0)',
                penColor: 'rgb(0, 0, 0)'
            });
            var saveButton = document.getElementById('save');
            var cancelButton = document.getElementById('clear');


            saveButton.addEventListener('click', function (event) {
                if (signaturePad.isEmpty()) {
                    sweetAlert("Oops...", "Please provide signature first.", "error");
                } else {

                    // do ajax to post it
                    $.ajax({
                        url : 'http://localhost/phonebook/public/signatureupload',
                        type: 'POST',
                        data : {
                            signature: signaturePad.toDataURL('image/png'),
                            //position: $('#position').val()
                        },
                        success: function(response)
                        {
                            alert("Successfuly Added your signature");
                        },
                        error: function(response)
                        {
                            sweetAlert("Oops...", "Sorry, something went wrong! We will investigate as soon as possible.", "error");
                            console.log(response);
                        }
                    });
                }

            });

            cancelButton.addEventListener('click', function (event) {
                signaturePad.clear();
            });
			

        });
</script>

</body>
</html>
