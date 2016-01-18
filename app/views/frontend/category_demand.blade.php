<div class="color-line"></div>
<div class="row">
	   <div class="col-md-8 text-left">
			 <div class="logo">
				<a href="{{ route('getFrontendLanding') }}"><img class="img-circle" src="{{ URL::asset('favicon.png') }}" width="100" height="100" alt="img"></a>
			 </div>
		</div>

		<div class="col-md-4 mt30 text-right">
			@if (!Auth::guest()) 
			<ul class="user-menu-fromtend">
				<li><span>Pozdrav, {{ Auth::user()->first_name . ' ' . Auth::user()->last_name }}</span></li>
				<li><a href="{{ URL::route('getDashboard') }}"><i class="dropdown-icon fa fa-cogs"></i>&nbsp;&nbsp;Administracija</a></li>
				<li><a href="{{ URL::route('getSignOut') }}"><i class="dropdown-icon fa fa-power-off"></i>&nbsp;&nbsp;Odjava</a></li>
			</ul>
			@else 
			<ul class="user-menu-fromtend"> 
				<li><a href="{{ URL::route('getSignIn') }}"><i class="dropdown-icon fa fa-cogs"></i>&nbsp;&nbsp;Prijavite se</a></li>
				<li><a href="{{ URL::route('getRegister') }}"><i class="dropdown-icon fa fa-power-off"></i>&nbsp;&nbsp;Registrirajte se</a></li>
			</ul>
 			@endif
 
		</div>
		<div class="clearfix"></div>
</div>

   <div class="banner">
   	  <div class="container_wrap">
   		<h1>Tražiš inspiraciju?</h1> 
   	       	<div class="dropdown-buttons">   
            	<div class="dropdown-button">  
            		<select name="myList" id="ddlMyList">
       		  			@foreach($allcategories['categories'] as $singlecategory)
							<option value="{{ URL::route('getOfferCategoryEntries', array('id' => $singlecategory->category_id)) }}">{{ $singlecategory->category_name }}</option>	
				 		@endforeach	
   		  			</select>
				</div> 
			</div>  
 	     	<label class="btn btn-primary btn-flat"><input name="submit" type="submit" id="submit" value="Pretraži"  onclick="NavigateToSite()"></label> 
	 		<script type="text/javascript">
			 			function NavigateToSite(){
						var ddl = document.getElementById("ddlMyList");
						var selectedVal = ddl.options[ddl.selectedIndex].value; 
						window.location = selectedVal;
					} 
		 	</script>   		
   		    <div class="clearfix"></div>
         </div>
   </div>
 

   <div class="content_middle">
   	  <div class="container">
	   	    <div class="content_middle_box">


	   	    	<div class="row">
	   	    		
	   	    		<div class="col-lg-12">
		   	    		<h3 class="orange-bold-uppercase">Ponude iz kategorije: </h3>
	   	    		</div>

	   	    	</div>



 	   			
	   		<div class="clearfix"> </div>


			</div>


			<div class="content_middle_box">
				


				<div class="row">

					<div class="top_grid offers">
		           	 @if (count($categoryclassifieds['category']) > 0)  

							@foreach($categoryclassifieds['category'] as $classifiedsdemand)
				   			<div class="col-md-3">
				   			  <div class="grid1">
				   				<div class="view view-first">
				                  	<div class="index_img">
				                  	 @if ($classifiedsdemand->image != '' || $classifiedsdemand->image != null)
	                         			 <img src="{{ url('/') }}/uploads/modules/classifieddemand/{{ $classifiedsdemand->image }}" class="img-responsive">
	                          		@endif  
	                         		</div>
				   				   <!-- <div class="sale">$2.980</div>  -->
			   			          	<div class="mask"> 
			                        	<div class="info"><a href="{{ URL::route('getSingleDemandEntry', array('id' => $classifiedsdemand->entry_id)) }}"><i class="search"> </i>Detaljnjije</a></div>
			                       	</div>
				                   </div> 
				                   <i class="home"></i>
				   				 <div class="inner_wrap">
				   				 	<h3>{{ $classifiedsdemand->title }}</h3>
				   				 	<ul class="star1">
				   				 	  <h4 class="green">{{ $classifiedsdemand->category_name }}</h4> 
				   				 	</ul>
				   				 </div>
				   			   </div>
				   			</div>
	 						@endforeach

		   				 @else  
			           	 <div class="row">
			                <div class="col-xs-12">
			                  <div class="box"> 
			                    <div class="box-body">
			                    	<div class="col-lg-12">
			                    		<h3>Nije ponuđen niti jedan proizvod.</h3>
		    						</div> 
			                    </div>
			                  </div>
			                </div>
			              </div> 
	           			@endif
	 	   			</div> 
				</div>
 



			</div>
	   		  <div class="offering">
	   		  	  <h2>Što je to Mrkva+ ?</h2>
	   		 
	   		  	  <div class="real">
	   		  	  	<h4>O servisu</h4>
	   		  	  	<div class="col-sm-12">
	   		  	  	  <ul class="service_grid">
	   	   				<i class="s1"> </i>
	   	   				 <li class="desc1 wow fadeInRight" data-wow-delay="0.4s">
	   	   				   <p>Nam liber tempor cum soluta nobis eleifend option congue nihil imperdiet doming id quod mazim placerat facer possim assum. Typi non habent claritatem insitam; est usus legentis in iis qui facit eorum</p>
	   	   				 </li>
	   	   				 <div class="clearfix"> </div>
	   	   			   </ul>
	   	   			 </div> 
	   	   			 <div class="clearfix"> </div>
	   	   		</div>
   		  	  </div>
   		  </div>
   	  </div>



			<div class="footer">
			   	<div class="container">
			   	 <div class="footer_top">
			   	   <h3>Pretplatite se na newsletter</h3>
			   	   <form>
					<span> 
						<i><i class="fa fa-mail"></i>
					    <input type="text" value="Enter your email" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Enter your email';}">
					    <label class="btn1 btn2 btn-2 btn-2g"> <input name="submit" type="submit" id="submit" value="Pretplata"> </label>
					    <div class="clearfix"> </div>
					</span>			 	    
				   </form>
				  </div>
				  <div class="footer_grids">
				  	<div class="row">
					  		
					  	<div class="col-md-6">
						  		
							<h3>Poveznice</h3>
							<ul class="list1">
								<li><a href="#">Kontakt</a></li>
								<li><a href="#">O projektu</a></li>
	 						</ul>

					  	</div>
					  	<div class="col-md-6">
					  		 <div class="logo">
								<a href="{{ route('getFrontendLanding') }}"><img class="img-circle" src="{{ URL::asset('favicon.png') }}" width="100" height="100" alt="img"></a>
						 	</div>
						  	<div class="clearfix"></div>
					    </div>
				        	 
 
					  	<div class="clearfix"></div>

					  	<div class="col-lg-12">
					  		
 							<div class="copy wow fadeInRight animated" data-wow-delay="0.4s" style="visibility: visible; animation-delay: 0.4s; animation-name: fadeInRight;">
			             	 <p> Developed @ 2015 by <br /> Nikola Papratović & Vojislav Pavasović. </p>
				      		</div>

					  	</div>	
				  	</div>
				 
			  
					  <div class="clearfix"> </div>
				   </div>
			      </div>
			   </div>

 