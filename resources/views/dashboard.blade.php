@extends('layouts.main')

@section('title','Dashboard')

@section('content')
<div class="content">
    <div class="row">
      <div class="col-lg-3 col-md-6 col-sm-6">
        <div class="card card-stats">
          <div class="card-body ">
            <div class="row">
              <div class="col-5 col-md-4">
                <div class="icon-big text-center icon-warning">
                  <i class="fas fa-user-injured text-warning"></i>
                </div>
              </div>
              <div class="col-7 col-md-8">
                <div class="numbers">
                  <p class="card-category">Patients</p>
                  <p class="card-title">{{ $patients->count() }}<p>
                </div>
              </div>
            </div>
          </div>
          <div class="card-footer ">
            <hr>
            <div class="stats">
              <i class="fa fa-refresh"></i>
              Total Count
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-md-6 col-sm-6">
        <div class="card card-stats">
          <div class="card-body ">
            <div class="row">
              <div class="col-5 col-md-4">
                <div class="icon-big text-center icon-warning">
                  <i class="far fa-calendar-check text-success"></i>
                </div>
              </div>
              <div class="col-7 col-md-8">
                <div class="numbers">
                  <p class="card-category">Appointments</p>
                  <p class="card-title">{{ $pending_appointments }}<p>
                </div>
              </div>
            </div>
          </div>
          <div class="card-footer ">
            <hr>
            <div class="stats">
              <i class="fa fa-calendar-o"></i>
              Pending Appointments
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-md-6 col-sm-6">
        <div class="card card-stats">
          <div class="card-body ">
            <div class="row">
              <div class="col-5 col-md-4">
                <div class="icon-big text-center icon-warning">
                  <i class="fas fa-user-md text-danger"></i>
                </div>
              </div>
              <div class="col-7 col-md-8">
                <div class="numbers">
                  <p class="card-category">Doctors</p>
                  <p class="card-title">{{ $doctors->count() }}<p>
                </div>
              </div>
            </div>
          </div>
          <div class="card-footer ">
            <hr>
            <div class="stats">
              <i class="fa fa-clock-o"></i>
              As of {{ Carbon\Carbon::now()->format('M d, Y') }}
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-md-6 col-sm-6">
        <div class="card card-stats">
          <div class="card-body ">
            <div class="row">
              <div class="col-5 col-md-4">
                <div class="icon-big text-center icon-warning">
                  <i class="nc-icon nc-single-02"></i>
                </div>
              </div>
              <div class="col-7 col-md-8">
                <div class="numbers">
                  <p class="card-category">Users</p>
                  <p class="card-title">{{ $accounts->count() }}<p>
                </div>
              </div>
            </div>
          </div>
          <div class="card-footer ">
            <hr>
            <div class="stats">
              <i class="fa fa-refresh"></i>
              Total Count
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <h4 class="card-title"> Recent Appointments</h4>
          </div>
          <div class="card-body">
           @if($appointments->count() <=0 )
            <p class="text-danger text-center">No appointments found!</p>
           @else
           <div class="">
            <table class="table">
              <thead class="">
                <th>#</th>
                    <th>
                      Date
                    </th>
                    <th>
                      Patient
                    </th>
                    <th>
                      Doctor
                    </th>
                    <th>
                      Status
                    </th>
                    <th>
                        Purpose
                    </th>
                    <th></th>
              
              </thead>
              <tbody>
                    <?php $ctr=1; ?>
                    @foreach ($appointments as $item)
                    <tr>
                      <th>{{ $ctr++ }}</th>
                      <td>{{ Carbon\Carbon::parse($item->date)->format('M d, Y') }}</td>
                      <td>{{ $item->patient_name }}</td>
                      <td>{{ $item->doctor_name }}</td>
                      <td>{{ $item->status }}</td>
                      <td>{{ $item->desc }}</td>
                      
                      <th> 
                        <a title="view this appointment" href="/patient/{{ $item->patient_id }}/appointment/{{ $item->appointment_id }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-eye"></i></a>
                      </th>
                    </tr>
                    @endforeach
              </tbody>
            </table>
          </div>
           @endif
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-6">
        <div class="card">
          <div class="card-header">
            <h4 class="card-title"> Doctors</h4>
          </div>
          <div class="card-body">
           @if($doctors->count() <=0 )
            <p class="text-danger text-center">No doctors found!</p>
           @else
        
      
              <table class="table">
                <thead class="">
                    <th>#</th>
                  <th>
                    Name
                  </th>
                  <th>
                      Profession                  </th>
                </thead>
                <tbody>
                    <?php $ctr=1; ?>
                  @foreach ($doctors as $item)
                  <tr>
                      <th>{{ $ctr++ }}</th>
                      <td>{{ $item->name }}</td>
                      <td>{{ $item->profession }}</td>
                  @endforeach
                </tbody>
              </table>
     
           @endif
       
        </div>
        </div>
    </div>
    <div class="col-md-6">
      <div class="card">
        <div class="card-header">
          <h4 class="card-title"> Users</h4>
        </div>
        <div class="card-body">
         @if($accounts->count() <=0 )
          <p class="text-danger text-center">No users found!</p>
         @else
   
       
            <table class="table">
              <thead class="">
                <th>#</th>
                <th>
                  Name
                </th>
               
                <th>
                  Role
                </th>
                
              </thead>
              <tbody>
                  <?php $ctr=1; ?>
                @foreach ($accounts as $item)
                <tr>
                    <th>{{ $ctr++ }}</th>
                    <td>{{ $item->name }}</td>
                   
                    <td>{{ $item->account_type }}</td>
                   
                </tr>
                @endforeach
              </tbody>
            </table>
        
         @endif
  
      </div>
    </div>
  </div>
  </div>
</div>
@endsection

