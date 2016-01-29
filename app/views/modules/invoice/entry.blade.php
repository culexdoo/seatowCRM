

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
          {{ Lang::get('invoice.add_invoice') }}<button class="btn btn-success pull-right"> <i class="fa fa-floppy-o"> Save </i></button>
          </h1>
          
        </section>
        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-md-4">
              <div class="box box-black">
                <div class="box-header with-border">
                  <h3 class="box-title">{{ Lang::get('invoice.employee') }}</h3>
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
                  <h3 class="box-title">{{ Lang::get('invoice.client') }}:</h3>
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
                  <h3 class="box-title">{{ Lang::get('invoice.payment_due') }}:</h3>
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
                  <label>{{ Lang::get('invoice.product') }}:</label>
                  <select class="form-control select2 select2-hidden-accessible" style="width: 100%;" tabindex="-1" aria-hidden="true">
                    <option selected="selected">Membership Towing</option>
                    <option>Another Towing</option>
                    <option>Etc</option>
                  </select>
                </div>
              </div>
              <div class="col-md-2">
                <label>{{ Lang::get('invoice.tax') }}:</label>
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
                <label>{{ Lang::get('invoice.price') }}:</label>
                <div class="form-group">
                  <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Enter Price in Euro">
                </div>
              </div>
              <div class="col-md-1">
                <button type="button" class="btn btn-success mt-25 pull-right">
                <i class="fa fa-plus"></i> {{ Lang::get('invoice.add') }}
                </button>
              </div>
            </div>
            </div>
            <div class="col-md-6">
            <div class="row">
              <div class="col-md-11">
                
                <div class="form-group">
                  <label>{{ Lang::get('invoice.membership') }}:</label>
                  <select class="form-control select2 select2-hidden-accessible" style="width: 100%;" tabindex="-1" aria-hidden="true">
                    <option selected="selected">Gold Card</option>
                    <option>Charter Pass</option>
                    <option>Trailer Pass</option>
                  </select>
                </div>
              </div>
              <div class="col-md-1">
                <button type="buttonpull-right" class="btn btn-success mt-25 pull-right">
                <i class="fa fa-plus"></i> {{ Lang::get('invoice.add') }}
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
                <img src="{{ URL::asset('img/core/seatow-logo-invoice.png') }}"></i> Sea Tow Europe Operations Ltd.
                <small class="pull-right">{{ Lang::get('invoice.date') }}: 2/10/2014</small>
                </h2>
              </div>
              <!-- /.col -->
            </div>
            <!-- info row -->
            <div class="row invoice-info">
              <div class="col-sm-4 invoice-col">
               {{ Lang::get('invoice.from') }}
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
                {{ Lang::get('invoice.to') }}
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
                <b>{{ Lang::get('invoice.invoice') }} #007612</b><br>
                <br>
                <b>{{ Lang::get('invoice.membership_id') }}:</b> 152<br>
                <b>{{ Lang::get('invoice.order_id') }}:</b> 4F3S8J<br>
                <b>{{ Lang::get('invoice.payment_due') }}:</b> 2/22/2015<br>
                <b>{{ Lang::get('invoice.account') }}:</b> 968-34567
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
                      <th>{{ Lang::get('invoice.qty') }}</th>
                      <th>{{ Lang::get('invoice.product') }}</th>
                      <th>{{ Lang::get('invoice.serial') }}</th>
                      <th>{{ Lang::get('invoice.description') }}</th>
                      <th>{{ Lang::get('invoice.subtotal') }}</th>
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
                <p class="lead">{{ Lang::get('invoice.payment_method') }}:</p>
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
                <p class="lead">{{ Lang::get('invoice.amount_due') }} 2/22/2014</p>
                <div class="table-responsive">
                  <table class="table">
                    <tbody><tr>
                      <th style="width:50%">{{ Lang::get('invoice.subtotal') }}:</th>
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
                      <th>{{ Lang::get('invoice.total') }}:</th>
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
                <a href="invoice-print.html" target="_blank" class="btn btn-default"><i class="fa fa-print"></i>{{ Lang::get('invoice.print') }}</a>
                
                <button type="button" class="btn btn-primary pull-right" style="margin-right: 5px;">
                <i class="fa fa-download"></i> {{ Lang::get('invoice.save') }}
                </button>
              </div>
            </div>
          </section>