  <!-- Optionally, you can add icons to the links -->
            <li class="{{ isActiveRoute('getDashboard') }}"><a href="{{ URL::route('getDashboard') }}"><i class="fa fa-2x fa-home"></i> <span>Dashboard</span></a></li>
            <li class="treeview {{ areActiveRoutes(['ClientGetAddEntry', 'clientLanding', 'ClientGetEditEntry', 'EventGetAddEvent', 'EventGetEditEvent']) }}">
              <a href="#"><i class="fa fa-2x fa-user"></i> <span>Clients</span> <i class="fa fa-angle-left pull-right"></i></a>
              <ul class="treeview-menu">
                <li class="{{ isActiveRoute('ClientGetAddEntry') }}"><a href="{{ URL::route('ClientGetAddEntry') }}">Add Client</a></li>
                <li class="{{ isActiveRoute('clientLanding') }}"><a href="{{ URL::route('clientLanding') }}">List Clients</a></li>
              </ul>
            </li>
             <li class="treeview {{ areActiveRoutes(['BoatsGetAddEntry', 'boatsLanding', 'BoatsGetAddHull', 'BoatsGetAddMake', 'BoatsGetEditEntry', 'BoatsGetEditHull', 'BoatsGetEditMake']) }}">
              <a href="#"><i class="fa fa-2x fa-ship"></i> <span>Boats</span> <i class="fa fa-angle-left pull-right"></i></a>
              <ul class="treeview-menu">
                <li class="{{ isActiveRoute('BoatsGetAddEntry') }}"><a href="{{ URL::route('BoatsGetAddEntry') }}">Add Boat</a></li>
               
                <li class="{{ isActiveRoute('boatsLanding') }}"><a href="{{ URL::route('boatsLanding') }}">List Boats</a></li>

                 <li class="{{ isActiveRoute('BoatsGetAddHull') }}"><a href="{{ URL::route('BoatsGetAddHull') }}">Add Hull</a></li>
                <li class="{{ isActiveRoute('BoatsGetAddMake') }}"><a href="{{ URL::route('BoatsGetAddMake') }}">Add Make</a></li>
              </ul>
            </li>
           <li class="treeview {{ areActiveRoutes(['MembershipGetAddEntry', 'membershipLanding', 'MembershipGetEditEntry']) }}">
              <a href="#"><i class="fa fa-2x fa-database"></i> <span>Membership</span> <i class="fa fa-angle-left pull-right"></i></a>
              <ul class="treeview-menu">
               
                <li class="{{ isActiveRoute('membershipLanding') }}"><a href="{{ URL::route('membershipLanding') }}">List Membersihps</a></li>
              </ul>
            </li>
             <li class="treeview {{ areActiveRoutes(['InvoiceGetAddEntry', 'invoiceLanding']) }}">
              <a href="#"><i class="fa fa-2x fa-credit-card"></i> <span>Billing</span> <i class="fa fa-angle-left pull-right"></i></a>
              <ul class="treeview-menu">
                <li class="{{ isActiveRoute('InvoiceGetAddEntry') }}"><a href="{{ URL::route('InvoiceGetAddEntry') }}">Add Invoice</a></li>
                <li class="{{ isActiveRoute('invoiceLanding') }}"><a href="{{ URL::route('invoiceLanding') }}">List Invoices</a></li>
              </ul>
            </li>
           </li>
             <li class="treeview {{ areActiveRoutes(['EmployeeGetAddEntry', 'employeeLanding', 'EmployeeGetEditEntry']) }}">
              <a href="#"><i class="fa fa-2x fa-group"></i> <span>Employee</span> <i class="fa fa-angle-left pull-right"></i></a>
              <ul class="treeview-menu">
             
                <li class="{{ isActiveRoute('employeeLanding') }}"><a href="{{ URL::route('employeeLanding') }}">List Employees</a></li>
              </ul>
            </li>
             <li class="treeview {{ areActiveRoutes(['FranchiseeGetAddEntry', 'franchiseeLanding', 'FranchiseeGetEditEntry']) }}">
              <a href="#"><i class="fa fa-2x fa-map"></i> <span>Franchisee</span> <i class="fa fa-angle-left pull-right"></i></a>
              <ul class="treeview-menu">
            
                <li class="{{ isActiveRoute('franchiseeLanding') }}"><a href="{{ URL::route('franchiseeLanding') }}">List Franchisee</a></li>
              </ul>
            </li>
            <li class="{{ areActiveRoutes(['messagesLanding', 'InboxMessages', 'TrashMessages', 'SentMessages', 'SingleView', 'SingleViewReplyAdd', 'SingleViewReplyPost']) }}"><a href="{{ URL::route('messagesLanding') }}"><i class="fa fa-2x fa-comment"></i> <span>Messages</span></a></li>
            <li class="{{ isActiveRoute('getProfile') }}"><a href="{{ URL::route('getProfile') }}"><i class="fa fa-2x fa-asterisk"></i> <span>My profile</span></a></li>
             <li class="{{ isActiveRoute('getOptions') }}"><a href="{{ URL::route('getOptions') }}"><i class="fa fa-2x fa-cog"></i> <span>Options</span></a></li>
              <li><a href="{{ URL::route('getSignOut') }}"><i class="fa fa-2x fa-sign-out"></i> <span>Logout</span></a></li>
              <!--IIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIII