<section class="content-header">
          <h1>
          Options <button class="btn btn-success pull-right"> <i class="fa fa-floppy-o"> Save </i></button>
          </h1>
          
        </section>
        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-md-4">
              <div class="box box-black">
                <div class="box-header with-border">
                  <h3 class="box-title">Basic Information</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <form role="form">
                  
                  <div class="box-body">
                    {{ Form::open(array('route' => 'postOptions', 'role' => 'form', 'class' => 'form-horizontal', 'autocomplete' => 'off')) }}
                    <div class="form-group">
                      <label>Landing Page:</label>
                      <select class="form-control hidden-search select2-hidden-accessible" style="width: 100%;" tabindex="-1" aria-hidden="true">
                        <option selected="selected">Dashboard</option>
                        <option>Add Client</option>
                        <option>List Clients</option>
                        <option>Add Boat</option>
                        <option>List Boats</option>
                        <option>Add Membership</option>
                        <option>List Memberships</option>
                        <option>Add Invoice</option>
                        <option>List Invoices</option>
                        <option>Add Franchisee</option>
                        <option>List Franchisees</option>
                      </select>
                    </div>
                    <div class="form-group">
                      <label>Language:</label>
                      <select class="form-control hidden-search select2-hidden-accessible" style="width: 100%;" tabindex="-1" aria-hidden="true">
                        <option selected="selected">English</option>
                        <option>German</option>
                        <option>Croatian</option>
                      </select>
                    </div>
                    
                  </div>
                
              </div>
              {{ Form::close() }}
            </div>
            
            
            
          </div>
          </section><!-- /.content -->