@extends('layout.master')
@section('style')
@endsection
@section('content')

<section class="content-header">
  <h1>
    PRODUCT MANAGEMENT
    <small>Control Panel</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Product Management</li>
  </ol>
</section>

<section class="content">
  <div class="col-md-12">
    <!-- Custom Tabs (Pulled to the right) -->
    <div class="nav-tabs-custom">

      <ul class="nav nav-tabs ">
        <li class="active"><a href="#tab_1" data-toggle="tab">Active</a></li> 
      </ul>

      <div class="tab-content">
        <div class="tab-pane active" id="tab_1">
          <div class="box">

            <!-- /.box-header -->
            <div class="modal-body">
              <!-- Custom Tabs (Pulled to the right) -->
              <form action="#" method="POST" class="form-horizontal" id="frm-package-edit" enctype ="multipart/form-data">
                {!! csrf_field() !!}
                <div class="row">

                        <div class="form-group">
              <label for="internet_package" class="col-md-3 col-sm-3 control-label">Product Name</label>
              <div class="col-md-9 col-sm-9">
                <input type="text" class="form-control" name="internet_package" id="internet_package" value="{{$packages->internet_package}}">
              </div>
            </div>

            <div class="form-group">
              <label for="package_type" class="col-md-3 col-sm-3 control-label">Product Type</label>
              <div class="col-md-9 col-sm-9">
                <select class="form-control" name="package_type" id="package_type" data-placeholder="Select">
                  <option value="">Select</option>
                  @foreach($packtypes as $packtype)
                  <option value="{{$packtype->packtype_id}}" @if($packtype->packtype_id == $packages->package_type) selected @endif>{{$packtype->type}}</option>
                  @endforeach
                </select>
              </div>
            </div>
            <div class="form-group">
              <label for="status" class="col-md-3 col-sm-3 control-label">Status</label>
              <div class="col-md-9 col-sm-9">
                <select class="form-control" name="status" id="status" data-placeholder="Select">
                  <option value="">Select</option>
                  <option value="Active" @if($packages->status == 'Active') selected="true" @endif>Active</option>
                  <option value="Inactive" @if($packages->status == 'Inactive') selected="true" @endif>Inactive</option>
                </select>
              </div>
            </div>

                </div>
                <input type="hidden" name="intpackage_id" value="{{$packages->intpackage_id}}">
                <div class="box-footer">
                  <button type="submit" class="btn btn-primary">Save Changes</button>
                </div>
              </form>
            </div>
          </div>
          <!-- /.box-body -->
        </div>
        <!-- /.tab-pane -->

      </div>
      <!-- /.tab-content -->
    </div>
    <!-- nav-tabs-custom -->
  </div>
  <!-- Main content -->
</section>
@endsection

@section('script')

<script>
  $('#frm-package-edit').on('submit',function(e){
    e.preventDefault();
    //console.log('pressed');
    var data = $(this).serialize();
    //console.log(data);
    var formData = new FormData($(this)[0]);

    $.ajax({
      url:"{{route('updateIntPackage')}}", 
      type: "POST",
      data: formData,
      async: false,
      success: function(response){
        //console.log(response);
        $("[data-dismiss = modal]").trigger({type: "click"});
			swal('SUCCESS', 'Internet Package Updated', 'success').then(function() {
			window.location.replace("{{route('intpackage')}}");
         });

      },
      cache: false,
      contentType: false,
      processData: false
    });
  });

</script>
@endsection
