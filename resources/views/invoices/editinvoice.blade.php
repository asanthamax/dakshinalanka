@extends('layouts.app')

@section('content')

    <section class="content-header">
        <h1>
            {{$status}} Invoice
            <small>Control panel</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">{{$status}} New Invoice</li>
        </ol>
    </section>
    <section class="content">
        <!-- Small boxes (Stat box) -->
        <div class="row">

            <div class="col-md-12">

                <div class="box box-info">

                    <div class="box-header with-border">

                        <h3 class="box-title">{{$status}} Invoice</h3>
                        <form class="form-horizontal" method="post" action="{{url(''.$action.'')}}">

                            {{ csrf_field() }}
                            <div class="box-body">

                                <div class="form-group">

                                    <label for="customer_name" class="col-sm-2 control-label">Select Customer</label>
                                    <div class="col-sm-10">
                                        {{Form::select('customer_name', $customers_list, old('customer_name',$invoice['customer']), array('id' => 'customer_name','class' => 'form-control',$disable => ''))}}
                                        @if ($errors->has('customer_name'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('customer_name') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group">

                                    <label for="date" class="col-sm-2 control-label">Date</label>
                                    <div class="col-sm-10">

                                        <input type="text" id="date" name="date" class="form-control" placeholder="Enter Date" value="<?php echo $invoice['date']; ?>" <?php echo $disable; ?>>
                                        @if ($errors->has('date'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('date') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <input type="hidden" name="invoice_id" value="<?php echo $invoice_id; ?>">
                                <hr>
                                <div class="form-group" id="print_records">
                                  <?php foreach($invoice_details as $details): ?>
                                    <div class="row">

                                        <div class="col-sm-2 col-md-2 col-xs-2">
                                          <label>Sheet Type</label>
                                          <br>
                                          {{Form::select('sheet_types[]', $sheet_types, old('sheet_types',$details['sheet_type']), array('class' => 'form-control sheet_types','onchange' => 'loadThickness($(this))',$disable => ''))}}
                                        </div>
                                        <div class="col-sm-2 col-md-2 col-xs-2">
                                          <label>Thickness</label>
                                          <br>
                                          <select class="thickness form-control" name="thickness[]" onload="initial_load('<?php echo $details['sheet_type']; ?>','<?php echo $details['thickness']; ?>',$(this))" <?php echo $disable; ?>></select>
                                        </div>
                                        <div class="col-sm-2 col-md-2 col-xs-2">
                                          <label>Size</label>
                                          <br>
                                            <select name="size[]" class="size form-control" <?php echo $disable; ?>>
                                              <?php if($details['size']=='sqft_price'){ ?>
                                                <option value="">Please Select the size</option>
                                                <option value="sqft_price" selected>Square Feet</option>
                                                <option value="price64">64 x 64</option>
                                                <option value="price84">84 x 84</option>
                                              <?php }else if($details['size']=='price64'){ ?>
                                                <option value="">Please Select the size</option>
                                                <option value="sqft_price">Square Feet</option>
                                                <option value="price64" selected>64 x 64</option>
                                                <option value="price84">84 x 84</option>
                                              <?php }else{ ?>
                                                <option value="">Please Select the size</option>
                                                <option value="sqft_price">Square Feet</option>
                                                <option value="price64">64 x 64</option>
                                                <option value="price84" selected>84 x 84</option>
                                              <?php } ?>
                                            </select>
                                        </div>
                                        <div class="col-sm-2 col-md-2 col-xs-2">
                                          <label>Quantity</label>
                                          <br>
                                            <input type="text" name="qty[]" class="form-control" placeholder="Enter Quantity" onchange="calculateAmount($(this))" value="<?php echo $details['quantity']; ?>" <?php echo $disable; ?>>
                                        </div>
                                        <div class="col-sm-2 col-md-2 col-xs-2">
                                          <label>Particulars</label>
                                          <br>
                                            <input type="text" name="particulars[]" class="form-control" placeholder="Enter Particulars" value="<?php echo $details['description']; ?>" <?php echo $disable; ?>>
                                        </div>
                                        <div class="col-sm-1 col-md-1 col-xs-1">
                                          <label>Amount</label>
                                          <br>
                                            <input type="text" name="amount[]"  class="form-control amount" placeholder="Enter amount" value="<?php echo $details['amount']; ?>" <?php echo $disable; ?>>
                                        </div>
                                        <?php if($status=='Update'): ?>
                                        <div class="col-md-1 col-sm-1 col-xs-1">
                                            <label></label>
                                            <br>
                                            <a class="btn btn-danger close_btn" href="javascript:void(0);">X</a>
                                        </div>
                                        <?php endif; ?>
                                    </div>
                                    <br>
                                    <?php endforeach; ?>
                                </div>
                                <hr>
                                <div class="form-group" id="laser_cutting">
                                    <?php foreach($invoice_details_laser as $laser): ?>
                                    <div class="row">

                                        <div class="col-sm-5 col-md-5 col-lg-5">
                                          <label>Laser Cutting Description</label>
                                          <br>
                                           <input type="text" name="laser_custting_description[]" class="form-control" placeholder="Enter Laser Cutting Description" value="<?php echo $laser['description']; ?>" <?php echo $disable; ?>>
                                        </div>
                                        <div class="col-sm-2 col-md-2 col-lg-2">
                                          <label>Duration</label>
                                          <br>
                                           <input type="text" name="laser_cutting_duration[]" class="form-control" placeholder="Enter duration" value="<?php echo $laser['duration']; ?>" <?php echo $disable; ?>>
                                        </div>
                                        <div class="col-sm-4 col-md-4 col-lg-4">
                                          <label>Amount</label>
                                          <br>
                                            <input type="text" name="laser_cutting_amount[]" class="form-control" placeholder="Enter Amount" value="<?php echo $laser['amount']; ?>" <?php echo $disable; ?>>
                                        </div>
                                        <?php if($status=='Update'): ?>
                                        <div class="col-md-1 col-sm-1 col-xs-1">
                                            <label></label>
                                            <br>
                                            <a class="btn btn-danger close_btn_laser" href="javascript:void(0);">X</a>
                                        </div>
                                       <?php endif; ?>
                                    </div>
                                    <br>
                                  <?php endforeach; ?>
                                </div>
                                <div class="box-footer">

                                    <button type="button" class="btn btn-success" id="new_laser"><i class="fa fa-plus"></i> Add Laser Cutting</button>
                                    <button type="button" class="btn btn-success" id="new_row"><i class="fa fa-plus"></i> Add New Row</button>
                                    <?php if($status=='View'): ?>
                                      <a class="btn btn-info pull-right" href="{{url('invoices')}}">OK</a>
                                    <?php else: ?>
                                      <button type="submit" class="btn btn-info pull-right">{{$status}} Invoice</button>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script>

        $(document).ready(function () {

            $('#new_row').click(function(){

                $('#print_records').append('<br><div class="row">'+

                    '<div class="col-sm-2 col-md-2 col-xs-2">'+

                      '{{Form::select('sheet_types[]', $sheet_types, old('sheet_types'), array('class' => 'form-control sheet_types','onchange' => 'loadThickness($(this))'))}}'+
                    '</div>'+
                    '<div class="col-sm-2 col-md-2 col-xs-2">'+

                      '<select class="thickness form-control" name="thickness[]"></select>'+
                    '</div>'+
                    '<div class="col-sm-2 col-md-2 col-xs-2">'+

                        '<select name="size[]" class="size form-control">'+
                            '<option value="">Please Select the size</option>'+
                            '<option value="sqft_price">Square Feet</option>'+
                            '<option value="price64">64 x 64</option>'+
                            '<option value="price84">84 x 84</option>'+
                        '</select>'+
                    '</div>'+
                    '<div class="col-sm-2 col-md-2 col-xs-2">'+

                        '<input type="text" name="qty[]" class="form-control" placeholder="Enter Quantity" onchange="calculateAmount($(this))">'+
                    '</div>'+
                    '<div class="col-sm-2 col-md-2 col-xs-2">'+

                        '<input type="text" name="particulars[]" class="form-control" placeholder="Enter Particulars">'+
                    '</div>'+
                    '<div class="col-sm-1 col-md-1 col-xs-1">'+

                        '<input type="text" name="amount[]"  class="form-control amount" placeholder="Enter amount">'+
                    '</div>'+
                    '<div class="col-md-1 col-sm-1 col-xs-1">'+
                        '<a class="btn btn-danger close_btn" href="javascript:void(0);">X</a>'+
                    '</div>'+
                '</div>')
            });


            $('#new_laser').click(function () {

               $('#laser_cutting').append('<br><div class="row">'+

                       '<div class="col-sm-5 col-md-5 col-lg-5">'+

                        '<input type="text" name="laser_custting_description[]" class="form-control" placeholder="Enter Laser Cutting Description">'+
                        '</div>'+
                        '<div class="col-sm-2 col-md-2 col-lg-2">'+

                        '<input type="text" name="laser_cutting_duration[]" class="form-control" placeholder="Enter duration">'+
                        '</div>'+
                        '<div class="col-sm-4 col-md-4 col-lg-4">'+

                        '<input type="text" name="laser_cutting_amount[]" class="form-control" placeholder="Enter Amount">'+
                        '</div>'+
                        '<div class="col-md-1 col-sm-1 col-xs-1">'+
                        '<a class="btn btn-danger close_btn_laser" href="javascript:void(0);">X</a>'+
                        '</div>'+
                        '</div>');
            });
            $(document).on('click','a.close_btn',function(){

                //  alert('sdasdad');
                $(this).closest('.row').remove();
            });
            $(document).on('click','a.close_btn_laser',function(){

                $(this).closest('.row').remove();
            })


          });

            function loadThickness(ele){

              var sheet_type = ele.val();
              var element = ele;
              $.ajax({

                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url:'{{url('gethickness')}}',
                type:'POST',
                dataType:'json',
                data: {sheet_type: sheet_type},
                success:function(data){

                  console.log(data);
                  $.each(data,function(index, el) {

                    console.log(element.hasClass('sheet_types'));
                    element.parent().next().find('.thickness').append('<option value="'+el+'">'+el+'</option>');
                  });

                },
                error:function(){

                  alert("Can't Connect to Server");
                }
              });
            }

            function initial_load(sheet_type,thickness,ele){

              console.log('here....');
              $.ajax({

                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url:'{{url('gethickness')}}',
                type:'POST',
                dataType:'json',
                data: {sheet_type: sheet_type},
                success:function(data){

                  console.log(data);
                  $.each(data,function(index, el) {

                    console.log(element.hasClass('sheet_types'));
                    if(thickness==el){

                      ele.append('<option value="'+el+'" selected>'+el+'</option>');
                    }else{

                      ele.append('<option value="'+el+'">'+el+'</option>');
                    }
                  });

                },
                error:function(){

                  alert("Can't Connect to Server");
                }
              });
            }

        function calculateAmount(amount) {

            var sheet_type = amount.parent().parent().find('.sheet_types').val();
            var thickness = amount.parent().parent().find('.thickness').val();
            var size = amount.parent().parent().find('.size').val();
            console.log(sheet_type);
            console.log(thickness);
            $.ajax({

                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: 'post',
                url: '{{url('getprice')}}',
                dataType: 'json',
                data: {sheet_type: sheet_type, thickness: thickness, size: size},
                success:function (data) {

                    //console.log(data.msg);
                    amount.parent().parent().find('.amount').val(data.msg*amount.val());
                },
                error:function(){

                    alert("Can't connect to server");
                }
            })
        }
    </script>
@endsection
