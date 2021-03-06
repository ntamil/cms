@extends('layout.master')
@section('style')
@endsection
@section('content')

<section class="content-header">
  <h1>
    User
    <small>Control panel</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{route('welcome')}}"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">User</li>
  </ol>
</section>

<section class="content">
  <div class="col-md-12">
    <!-- Custom Tabs (Pulled to the right) -->
    <div class="nav-tabs-custom">
      <ul class="nav nav-tabs ">
        <li class="active"><a href="#tab_1" data-toggle="tab">Active</a></li>
		<li style="float:right"><a href="{{route('user')}}" style="display:inline-block"><b><i class="fa fa-arrow-left"></i>&nbsp;Back</b></a></li>
      </ul>
      <div class="tab-content">
        <div class="tab-pane active" id="tab_1">
          <div class="box">

            <!-- /.box-header -->
            <div class="modal-body">
              <!-- Custom Tabs (Pulled to the right) -->

              <form action="#" method="POST" id="frm-user-edit" class="form-horizontal" enctype ="multipart/form-data">
                {!! csrf_field() !!}
                <div class="row">

                  <div class="form-group">
                    <label for="role" class="col-sm-3 cold-md-3 col-lg-3 control-label">User Type</label>
                    <div class="col-sm-9 col-md-9 col-lg-9">
                      <input type="text" class="form-control" name="role" id="role" value="{{$users->roles()->pluck('name')->implode(' ') }}" disabled>
                    </div>
                  </div>

                  <div class="form-group">
              <label for="state" class="col-sm-3 cold-md-3 col-lg-3 control-label">State</label>
              <div class="col-sm-9 col-md-9 col-lg-9">
              <select class="form-control" name="state" id="state" data-placeholder="Select">
				  <option value="">Select</option>
                  @foreach($states as $state)
                  <option value="{{$state->state_id}}" @if($state->state_id == $users->state) selected @endif>{{$state->state_name}}</option>
                  @endforeach
                </select>
              </div>
            </div>

            <div class="form-group">
              <label for="branch" class="col-sm-3 cold-md-3 col-lg-3 control-label">Branch</label>
              <div class="col-sm-9 col-md-9 col-lg-9">
              <select class="form-control" name="branch" id="branch" data-placeholder="Select">
				  <option value="">Select</option>
                  @foreach($branches as $branch)
					<option value="{{$branch->branch_id}}" @if($branch->branch_id == $users->branch) selected @endif>{{$branch->branch_name}}</option>
                  @endforeach
                </select>
              </div>
            </div>

                  <div class="form-group">
                    <label for="supervisor" class="col-sm-3 cold-md-3 col-lg-3 control-label">Supervisor</label>
                    <div class="col-sm-9 col-md-9 col-lg-9">
                      <input type="text" class="form-control" name="supervisor" id="supervisor" value="{{$users->supervisor}}">
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="altuser_id" class="col-sm-3 cold-md-3 col-lg-3 control-label">User ID</label>
                    <div class="col-sm-9 col-md-9 col-lg-9">
                      <input type="text" class="form-control" name="altuser_id" id="altuser_id" value="{{$users->altuser_id}}" disabled>
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="name" class="col-sm-3 cold-md-3 col-lg-3 control-label">Name</label>
                    <div class="col-sm-9 col-md-9 col-lg-9">
                      <input type="text" class="form-control" name="name" id="name" value="{{$users->name}}">
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="ic_number" class="col-sm-3 cold-md-3 col-lg-3 control-label">IC</label>
                    <div class="col-sm-9 col-md-9 col-lg-9">
                      <input type="text" class="form-control" name="ic_number" id="ic_number" value="{{$users->ic_number}}" disabled>
                    </div>
                  </div>

				<div class="form-group">
				  <label for="ic_number" class="col-sm-3 control-label">Country of issue: </label>
				  <div class="col-sm-9">
					<select class="form-control" name="country_of_issue" id="country_of_issue" data-placeholder="Select">
						<option value="">Select</option>
						  @foreach($countries as $country)
						  <option value="{{$country->id}}" @if($country->id == $users->country_of_issue) selected @endif>{{$country->country_name}}</option>
						  @endforeach
					</select>
				  </div>
				</div>

				<div class="form-group">
				  <label for="ic_number" class="col-sm-3 control-label">End. Date: </label>
				  <div class="col-sm-9">
					<input type="date" class="form-control" name="expiry_date" id="expiry_date" required value="{{date('Y-m-d', strtotime($users->expiry_date))}}">
				  </div>
				</div>

				<div class="form-group">
				  <label for="ic_number" class="col-sm-3 control-label">D.O.B: </label>
				  <div class="col-sm-9">
					<input type="date" class="form-control" name="dob" id="dob" required value="{{date('Y-m-d', strtotime($users->dob))}}">
				  </div>
				</div>

                  <div class="form-group">
                    <label for="email" class="col-sm-3 cold-md-3 col-lg-3 control-label">Email</label>
                    <div class="col-sm-9 col-md-9 col-lg-9">
                      <input type="email" class="form-control" name="email" id="email" value="{{$users->email}}">
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="phonenumber" class="col-sm-3 cold-md-3 col-lg-3 control-label">Phone Number</label>
                    <div class="col-sm-9 col-md-9 col-lg-9">
					  <div class="input-group" style="width: 100%">
						<select class="form-control" name="phonecode" id="phonecode" data-placeholder="Select" style="width: 25%">
							<option value="">Select</option>
							@for ($i = 0; $i < 10; $i++)
								<option value="01{{$i}}" @if($users->phonecode == "01".$i) selected @endif>01{{$i}}</option>
							@endfor
						</select>
						@if($users->phonecode == '011')
							<?php $len = 8; ?>
						@else
							<?php $len = 7; ?>
						@endif
						<input type="text" class="form-control" name="phonenumber" maxlength="{{$len}}" minlength="{{$len}}" id="phonenumber" required  style="width: 75%" value="{{$users->phonenumber}}">
					  </div>
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="address" class="col-sm-3 cold-md-3 col-lg-3 control-label">Address</label>
                    <div class="col-sm-9 col-md-9 col-lg-9">
                    <textarea class="form-control" name="address" id="address">{{$users->address}}</textarea>
                    </div>
                  </div> 

                  <div class="form-group">
              <label for="active" class="col-sm-3 cold-md-3 col-lg-3 control-label">Active</label>
              <div class="col-sm-9 col-md-9 col-lg-9">
              <select class="form-control" name="active" id="active" data-placeholder="Select">
                  @foreach($actives as $active)
                  <option value="{{$active->active_id}}" @if($active->active_id == $users->active) selected @endif>{{$active->status}}</option>
                  @endforeach
                </select>
              </div>
            </div>

                </div>
              </div>
              <input type="hidden" name="user_id" value="{{$users->user_id}}">
              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Save Change</button>
              </form>
            </div>

          </div>
          <!-- /.box-body -->
        </div>
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
  $(document).ready(function(){
    $('#phonecode').on("change",function(e) {
		$('#phonenumber').val('');
		if($('#phonecode').val() == '011') {
			$('#phonenumber').attr('minlength','8');
			$('#phonenumber').attr('maxlength','8');
		} else {
			$('#phonenumber').attr('minlength','7');
			$('#phonenumber').attr('maxlength','7');
		}
	})
  });
  $('#frm-user-edit').on('submit',function(e){
    e.preventDefault();
    //console.log('pressed');
    var data = $(this).serialize();
    //console.log(data);
    var formData = new FormData($(this)[0]);

    $.ajax({
      url:"{{route('updateUser')}}",
      type: "POST",
      data: formData,
      async: false,
      success: function(response){
        //console.log(response);
        $("[data-dismiss = modal]").trigger({type: "click"});
        swal('SUCCESS', 'User Updated', 'success').then(function() {
          window.location.replace("{{route('user')}}");
        });
      },
      cache: false,
      contentType: false,
      processData: false,
    });
  });

</script>
@endsection
