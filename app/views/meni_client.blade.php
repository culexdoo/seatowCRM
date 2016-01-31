  <!-- Optionally, you can add icons to the links -->
            <li class="{{ isActiveRoute('getDashboard') }}"><a href="{{ URL::route('getDashboard') }}"><i class="fa fa-2x fa-home"></i> <span>Dashboard</span></a></li>
        
            
         
            
            <li class="{{ isActiveRoute('getProfile') }}"><a href="{{ URL::route('getProfile') }}"><i class="fa fa-2x fa-asterisk"></i> <span>My profile</span></a></li>
             <li class="{{ isActiveRoute('getOptions') }}"><a href="{{ URL::route('getOptions') }}"><i class="fa fa-2x fa-cog"></i> <span>Options</span></a></li>
              <li><a href="{{ URL::route('getSignOut') }}"><i class="fa fa-2x fa-sign-out"></i> <span>Logout</span></a></li>
              <!--IIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIII