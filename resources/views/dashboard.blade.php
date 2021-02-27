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
              {{-- <i class="fa fa-refresh"></i>
              Update Now --}}
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
                  <p class="card-title">{{ $appointments->count() }}<p>
                </div>
              </div>
            </div>
          </div>
          <div class="card-footer ">
            <hr>
            <div class="stats">
              {{-- <i class="fa fa-calendar-o"></i>
              Last day --}}
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
              {{-- <i class="fa fa-clock-o"></i>
              In the last hour --}}
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
                  <i class="nc-icon nc-single-02 text-primary"></i>
                </div>
              </div>
              <div class="col-7 col-md-8">
                <div class="numbers">
                  <p class="card-category">Accounts</p>
                  <p class="card-title">{{ $accounts->count() }}<p>
                </div>
              </div>
            </div>
          </div>
          <div class="card-footer ">
            <hr>
            <div class="stats">
              {{-- <i class="fa fa-refresh"></i>
              Update now --}}
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
           <div class="table-responsive">
            <table class="table">
              <thead class=" text-primary">
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
                    Description
                </th>
              
              </thead>
              <tbody>
                  <?php $ctr=1; ?>
                @foreach ($appointments as $item)
                <tr>
                    <th>{{ $ctr++ }}</th>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->email }}</td>
                    <td>{{ $item->profession }}</td>
                    <td>{{ $item->account_type }}</td>
                    <td>{{ Carbon\Carbon::parse($item->created_at)->format('M d, Y') }}</td>
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
           <div class="table-responsive">
      
              <table class="table">
                <thead class=" text-primary">
                    <th>#</th>
                  <th>
                    Name
                  </th>
                  <th>
                      Created at
                  </th>
                </thead>
                <tbody>
                    <?php $ctr=1; ?>
                  @foreach ($doctors as $item)
                  <tr>
                      <th>{{ $ctr++ }}</th>
                      <td>{{ $item->name }}</td>
                      <td>{{ Carbon\Carbon::parse($item->created_at)->format('M d, Y') }}</td>
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
          <h4 class="card-title"> Accounts</h4>
        </div>
        <div class="card-body">
         @if($accounts->count() <=0 )
          <p class="text-danger text-center">No accounts found!</p>
         @else
   
          <div class="table-responsive">
            <table class="table">
              <thead class=" text-primary">
                <th>#</th>
                <th>
                  Name
                </th>
               
                <th>
                  Profession
                </th>
                
              </thead>
              <tbody>
                  <?php $ctr=1; ?>
                @foreach ($accounts as $item)
                <tr>
                    <th>{{ $ctr++ }}</th>
                    <td>{{ $item->name }}</td>
                   
                    <td>{{ $item->profession }}</td>
                   
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
</div>
@endsection

