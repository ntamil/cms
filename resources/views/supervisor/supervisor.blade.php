@extends('layout.master')
@section('style')
<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.16/css/jquery.dataTables.css">
@endsection
@section('content')

<section class="content-header">
  <h1>
    SUPERVISOR
    <small>Control panel</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Supervisor</li>
  </ol>
</section>

<!-- Modal -->
<div class="modal modal-info fade" id="add-user" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" >Add Supervisor</h4>

      </div>
      <div class="modal-body">
        <!-- Custom Tabs (Pulled to the right) -->

        <form action="#" method="POST" id="frm-user-create" enctype ="multipart/form-data">
          {!! csrf_field() !!}
          <div class="row">

            <div class="form-group">
              <label for="role" class="col-sm-3 control-label">User Type: </label>
              <div class="col-sm-9">
                <select class="form-control" name="role" id="role" data-placeholder="Select">
                  <option value="">Select</option>
                  @foreach($roles as $role)
                  <option value="{{$role->id}}">{{$role->name}}</option>
                  @endforeach
                </select>
              </div>
            </div>

            <div class="form-group">
              <label for="state" class="col-sm-3 control-label">State: </label>
              <div class="col-sm-9">
              <select class="form-control" name="state" id="state" data-placeholder="Select">
                <option value="">Select</option>
                  @foreach($states as $state)
                  <option value="{{$state->state_id}}">{{$state->state_name}}</option>
                  @endforeach
                </select>
              </div>
            </div>

            <div class="form-group">
              <label for="branch" class="col-sm-3 control-label">Branch: </label>
              <div class="col-sm-9">
              <select class="form-control" name="branch" id="branch" data-placeholder="Select">
                <option value="">Select</option>
                  @foreach($branches as $branch)
                  <option value="{{$branch->branch_id}}">{{$branch->branch_name}}</option>
                  @endforeach
                </select>
              </div>
            </div>

            <div class="form-group">
              <label for="supervisor" class="col-sm-3 control-label">Supervisor: </label>
              <div class="col-sm-9">
                <input type="text" class="form-control" name="supervisor" id="supervisor">
              </div>
            </div>

            <div class="form-group">
              <label for="altuser_id" class="col-sm-3 control-label">User ID: </label>
              <div class="col-sm-9">
                <input type="text" class="form-control" name="altuser_id" id="altuser_id">
              </div>
            </div>

            <div class="form-group">
              <label for="name" class="col-sm-3 control-label">Name: </label>
              <div class="col-sm-9">
                <input type="text" class="form-control" name="name" id="name">
              </div>
            </div>

            <div class="form-group">
              <label for="ic_number" class="col-sm-3 control-label">Mykad: </label>
              <div class="col-sm-9">
                <input type="text" class="form-control" name="ic_number" id="ic_number">
              </div>
            </div>

            <div class="form-group">
              <label for="email" class="col-sm-3 control-label">Email: </label>
              <div class="col-sm-9">
                <input type="text" class="form-control" name="email" id="email">
              </div>
            </div>

            <div class="form-group">
              <label for="phonenumber" class="col-sm-3 control-label">Phone Number: </label>
              <div class="col-sm-9">
                <input type="text" class="form-control" name="phonenumber" id="phonenumber">
              </div>
            </div>

            <div class="form-group">
              <label for="address" class="col-sm-3 control-label">Address: </label>
              <div class="col-sm-9">
                <input type="text" class="form-control" name="address" id="address">
              </div>
            </div>  

            <div class="form-group">
              <label for="password" class="col-sm-3 control-label">Password: </label>
              <div class="col-sm-9">
                <input type="text" class="form-control" name="password" id="password">
              </div>
            </div>

            <div class="form-group">
              <label for="active" class="col-sm-3 control-label">Active: </label>
              <div class="col-sm-9">
              <select class="form-control" name="active" id="active" data-placeholder="Select">
                <option value="">Select</option>
                  @foreach($actives as $active)
                  <option value="{{$active->active_id}}">{{$active->status}}</option>
                  @endforeach
                </select>
              </div>
            </div>

          </div>

        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Save changes</button>
        </div>
      </form>
    </div>
  </div>
</div>

<section class="content">
  <div class="col-md-12">
    <!-- Custom Tabs (Pulled to the right) -->
    <div class="nav-tabs-custom">
      <ul class="nav nav-tabs ">
        <li class="active"><a href="#tab_1" data-toggle="tab">Active</a></li>
        <li class="pull-right"> 
          <!-- <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#add-user">Add Supervisor</button></li> -->
        </ul>
        <div class="tab-content">
          <div class="tab-pane active" id="tab_1">
            <div class="box">

              <!-- /.box-header -->
              <div class="box-body no-padding">
                <div class="mailbox-controls">

                </div>
                <div class="table-responsive mailbox-messages">
                  <table class="table table-striped" id="user-table">
                    <thead>
                      <tr class="info bg-black">
                        <th class="mailbox-star"><center>State</center></th>
                        <th class="mailbox-star"><center>Branch</center></th>
                        <th class="mailbox-star"><center>User Type</center></th>
                        <th class="mailbox-star"><center>User Id</center></th>
                        <th class="mailbox-star"><center>Name</center></th>
                        <th class="mailbox-star"><center>Mykad</center></th>
                        <th class="mailbox-star"><center>Email</center></th>
                        <th class="mailbox-star"><center>Active</center></th>
                        <th class="mailbox-star"><center>Operation</center></th>
                      </tr>
                    </thead>

                    <tbody>        
                     @foreach($users as $user)
                     <tr class="info">
                      <td class="mailbox-name"><center>{{$user->states->state_name}}</center></td>
                      <td class="mailbox-name"><center>{{$user->branches->branch_name}}</center></td>
                      <td class="mailbox-name"><center>{{$user->roles()->pluck('name')->implode(' ') }}</center></td> 
                      <td class="mailbox-name"><center>{{$user->altuser_id}}</center></td>
                      <td class="mailbox-name"><center>{{$user->name}}</center></td>
                      <td class="mailbox-name"><center>{{$user->ic_number}}</center></td>
                      <td class="mailbox-name"><center>{{$user->email}}</center></td>
                      <td class="mailbox-name"><center>{{$user->actives->status}}</center></td>
                      <td class="mailbox-name"><center><div class="btn-group">
                        <a class="button btn btn-success btn-sm" href="{{route('editSupervisor', ['user_id'=> $user->user_id])}}"><i class="fa fa-gear"></i>Edit</a>
                        {{ Form::open(array('url' => 'user/' . $user->user_id, 'class' => 'pull-right')) }}
                        {{ Form::hidden('_method', 'DELETE') }}
                        {{ Form::submit('Delete', array('class' => 'button btn btn-warning btn-sm')) }}
                        {{ Form::close() }}
                      </center>
                    </td>
                  </tr>
                  @endforeach
                </tbody>

              </table>
              <!-- /.table -->
            </div>
            <!-- /.mail-box-messages -->
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
<script type="text/javascript" charset="utf8" src="//cdn.datatables.net/1.10.16/js/jquery.dataTables.js"></script>

<script>
  $(document).ready(function(){
    $('#user-table').DataTable();
    $('#frm-user-create').on('submit',function(e)
    {
      e.preventDefault();
      console.log('pressed');
      var data = $(this).serialize();
      console.log(data);
      var formData = new FormData($(this)[0]);

      $.ajax(
      {
        url:"{{route('createSupervisor')}}", 
        type: "POST",
        data: formData,
        async: false,
        success: function(response)
        {
          console.log(response);
          $("[data-dismiss = modal]").trigger({type: "click"});;
          swal('SUCCESS', 'User Added', 'success').then(function() {
           window.location.reload();
         });
        },
        cache: false,
        contentType: false,
        processData: false,
      });
    });
  });

</script>
@endsection
