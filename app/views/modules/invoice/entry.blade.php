

   <?php
          // If no mode is selected, default to add
          if (!isset($mode))
          {
            $mode = 'add';
          }

          ?>
            <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
          Add Invoice <button class="btn btn-success pull-right"> <i class="fa fa-floppy-o"> Save </i></button>
          </h1>
          
        </section>
        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-md-4">
              <div class="box box-black">
                <div class="box-header with-border">
                  <h3 class="box-title">Employee</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <form role="form">
                  
                  <div class="box-body">
                    
                    <div class="form-group">
                      
                      <select class="form-control hidden-search select2 select2-hidden-accessible" style="width: 100%;" tabindex="-1" aria-hidden="true">
                        <option selected="selected">Tomas Jani</option>
                        <option>Roni Hustler</option>
                        <option>Dedo Hruka</option>
                      </select>
                    </div>
                  </div>
                </form>
              </div>
              
            </div>
            <div class="col-md-4">
              <div class="box box-black">
                <div class="box-header with-border">
                  <h3 class="box-title">Client:</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <form role="form">
                  
                  <div class="box-body">
                    <div class="form-group">
                      
                      <select class="form-control hidden-search select2 select2-hidden-accessible" style="width: 100%;" tabindex="-1" aria-hidden="true">
                        <option selected="selected">Ivan Rakic</option>
                        <option>Maja Sisak</option>
                        <option>Ivana Laki</option>
                        <option>Saki Babic</option>
                      </select>
                    </div>
                  </div>
                </form>
              </div>
              
            </div>
            
            <div class="col-md-4">
              <div class="box box-black">
                <div class="box-header with-border">
                  <h3 class="box-title">Payment Due:</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->

                <form role="form">
                  
                  <div class="box-body">
                    <div class="form-group">
                      
                      <div class="input-group">
                        <div class="input-group-addon">
                          <i class="fa fa-calendar"></i>
                        </div>
                        <input type="text" class="form-control pull-right active" id="reservation">
                      </div>
                    </div>
                    
                    
                    
                  </div>
                </form>
              </div>
              
            </div>
            
          </div>
          <div class="row">
            <div class="col-md-6">
            <div class="row">
              <div class="col-md-5">
                <div class="form-group">
                  <label>Product:</label>
                  <select class="form-control select2 select2-hidden-accessible" style="width: 100%;" tabindex="-1" aria-hidden="true">
                    <option selected="selected">Membership Towing</option>
                    <option>Another Towing</option>
                    <option>Etc</option>
                  </select>
                </div>
              </div>
              <div class="col-md-2">
                <label>TAX:</label>
                <select class="form-control select2 select2-hidden-accessible" style="width: 100%;" tabindex="-1" aria-hidden="true">
                  <option selected="selected">25%</option>
                  <option>0%</option>
                  <option>5%</option>
                  <option>10%</option>
                  <option>15%</option>
                  <option>20%</option>
                  <option>23%</option>
                </select>
              </div>
              <div class="col-md-4">
                <label>Price:</label>
                <div class="form-group">
                  <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Enter Price in Euro">
                </div>
              </div>
              <div class="col-md-1">
                <button type="button" class="btn btn-success mt-25 pull-right">
                <i class="fa fa-plus"></i> ADD
                </button>
              </div>
            </div>
            </div>
            <div class="col-md-6">
            <div class="row">
              <div class="col-md-11">
                
                <div class="form-group">
                  <label>Membership:</label>
                  <select class="form-control select2 select2-hidden-accessible" style="width: 100%;" tabindex="-1" aria-hidden="true">
                    <option selected="selected">Gold Card</option>
                    <option>Charter Pass</option>
                    <option>Trailer Pass</option>
                  </select>
                </div>
              </div>
              <div class="col-md-1">
                <button type="buttonpull-right" class="btn btn-success mt-25 pull-right">
                <i class="fa fa-plus"></i> ADD
                </button>
              </div>
            </div>
            </div>
          </div>
           <div class="row">
            <div class="col-md-12">
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                 <textarea class="form-control" rows="5" placeholder="">Gass missing, towed to nearest gas station.
                  </textarea>
                </div>
              </div>
            </div>
            </div>
            <div class="col-md-6">
            <div class="row">
              
            
            </div>
            </div>
          </div>
          </section><!-- /.content -->
          <section class="content invoice">
            
            <!-- title row -->
            <div class="row">
              <div class="col-xs-12">
                <h2 class="page-header">
                <img src="dist/img/seatow-logo-invoice.png"></i> Sea Tow Europe Operations Ltd.
                <small class="pull-right">Date: 2/10/2014</small>
                </h2>
              </div>
              <!-- /.col -->
            </div>
            <!-- info row -->
            <div class="row invoice-info">
              <div class="col-sm-4 invoice-col">
                From
                <address>
                  <strong>Tomas Jani</strong><br>
                  Jadranska 12, <br>
                  Croatia, CA 94107<br>
                  Phone: (804) 123-5432<br>
                  Email: info@seatow.com
                </address>
              </div>
              <!-- /.col -->
              <div class="col-sm-4 invoice-col">
                To
                <address>
                  <strong>Ivan Rakic</strong><br>
                  Bilogosrka 123<br>
                  Osijek, 32155<br>
                  Phone: (055) 958-85-85<br>
                  Email: ivan.rakic@myself.com
                </address>
              </div>
              <!-- /.col -->
              <div class="col-sm-4 invoice-col">
                <b>Invoice #007612</b><br>
                <br>
                <b>Mebership ID:</b> 152<br>
                <b>Order ID:</b> 4F3S8J<br>
                <b>Payment Due:</b> 2/22/2015<br>
                <b>Account:</b> 968-34567
              </div>
              <!-- /.col -->
            </div>
            <!-- /.row -->
            <!-- Table row -->
            <div class="row">
              <div class="col-xs-12 table-responsive">
                <table class="table table-striped">
                  <thead>
                    <tr>
                      <th>Qty</th>
                      <th>Product</th>
                      <th>Serial #</th>
                      <th>Description</th>
                      <th>Subtotal</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>1</td>
                      <td>Gold Card</td>
                      <td>001</td>
                      <td>GOLD CARD MEMBERSHIP*</td>
                      <td>100€</td>
                    </tr>
                     <tr>
                      <td>1</td>
                      <td>Membership Towing</td>
                      <td>025</td>
                      <td>Gass missing, towed to nearest gas station.</td>
                      <td>50€</td>
                    </tr>
                    
                  </tbody>
                </table>
              </div>
              <!-- /.col -->
            </div>
            <!-- /.row -->
            <div class="row">
              <!-- accepted payments column -->
              <div class="col-xs-6">
                <p class="lead">Payment Methods:</p>
                 <div class="form-group">
                      
                      <select class="form-control hidden-search select2 select2-hidden-accessible" style="width: 100%;" tabindex="-1" aria-hidden="true">
                        <option selected="selected">SEPA</option>
                        <option>BANK TRANSFER</option>
                        <option>CREDIT CARD</option>
                      </select>
                    </div>
                <p class="text-muted well well-sm no-shadow" style="margin-top: 10px;">
                  Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles, weebly ning heekya handango imeem plugg
                  dopplr jibjab, movity jajah plickers sifteo edmodo ifttt zimbra.
                </p>
              </div>
              <!-- /.col -->
              <div class="col-xs-6">
                <p class="lead">Amount Due 2/22/2014</p>
                <div class="table-responsive">
                  <table class="table">
                    <tbody><tr>
                      <th style="width:50%">Subtotal:</th>
                      <td>150€</td>
                    </tr>
                    <tr>
                      <th>
                        <div class="row">
                          <div class="col-md-2">
                            Tax:
                          </div>
                          <div class="col-md-3">
                            <div class="form-group">
                              <select class="form-control hidden-search select2 select2-hidden-accessible" style="width: 100%;" tabindex="-1" aria-hidden="true">
                                <option selected="selected">25%</option>
                                <option>0%</option>
                                <option>5%</option>
                                <option>10%</option>
                                <option>15%</option>
                                <option>20%</option>
                                <option>23%</option>
                              </select>
                            </div>
                          </div>
                        </div>
                      </th>
                      <td>25€</td>
                    </tr>
                    <tr>
                      <th>Total:</th>
                      <td>187,5€</td>
                    </tr>
                  </tbody></table>
                </div>
              </div>
              <!-- /.col -->
            </div>
            <!-- /.row -->
            <!-- this row will not appear when printing -->
            <div class="row no-print">
              <div class="col-xs-12">
                <a href="invoice-print.html" target="_blank" class="btn btn-default"><i class="fa fa-print"></i> Print</a>
                
                <button type="button" class="btn btn-primary pull-right" style="margin-right: 5px;">
                <i class="fa fa-download"></i> Save
                </button>
              </div>
            </div>
          </section>