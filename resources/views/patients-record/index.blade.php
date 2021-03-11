@extends('layouts.main')

@section('title','Patients Record')

@section('content')
<div class="content">
  <div class="row">
    <div class="col-md-12 text-right">
     
      <a href="#" class="btn btn-dark text-white" data-toggle="modal" data-target="#patientmodal" data-whatever="@mdo"> Add New Patient</a>
  
  </div>
  </div>
  <div class="row">
    <div class="col-md-12">
      <form  action="/patients-record" method="GET" >
        @csrf
        <div class="input-group">
            <x-input type="text" class="form-control"  name="search" placeholder="Search name, mobile, address..." value="{{ Session::get('search') }}" required autofocus/>
            {{-- <div class="input-group-append">
              <button class="btn btn-dark" type="submit">
               Search
              </button>
            </div> --}}
        </div>
    </form>
    
    </div>
   
  </div>

  @if(Session::get('search'))
<p class="text-left"> <b><span class="">  Showing </span> <span class="text-primary">{{ $patients->count() }}</span> patient/s.</b></p>
@endif
    <div class="row">
        <div class="col-md-12">
       
          <div class="card">
            <div class="card-header">
              {{-- <h4 class="card-title"> Patients Record</h4> --}}
            </div>
            
            <div class="card-body">
           
              <div class="">
                @if ($patients->count() <= 0)
                  <p class="text-danger text-center">No patients found!</p>
                @else
                <table class="table">
                  <thead class="">
                      <th>#</th>
                    <th>
                      Name
                    </th>
                    <th>
                        Gender
                    </th>
                    <th>
                        Birthdate
                    </th>
                    <th>
                        Address
                    </th>
                    <th>
                        Mobile
                    </th>
                    <th></th>
                  </thead>
                  <tbody>
                      <?php $ctr=1; ?>
                    @foreach ($patients as $item)
                    <tr>
                        <th>{{ $ctr++ }}</th>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->gender }}</td>
                        <td>{{ Carbon\Carbon::parse($item->birthdate)->format('M d, Y') }}</td>
                        <td>{{ $item->address }}</td>
                        <td>{{ $item->contact_number }}</td>
                        <th> <a href="/patient/{{ $item->patient_id }}" class="btn btn-dark text-white" > View</a></th>
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

<div class="modal fade" id="patientmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"  data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog modal-md" role="document">
  <div class="modal-content">
      <div class="modal-header">
      <h5 class="modal-title" id="exampleModalLabel" >Patient Information</h5>

      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
      </button>
      </div>
      <div class="modal-body">
          <form id="patientForm" action="/patient/store" method="POST">
              @csrf
          </form>

          <div class="form-group">
            <label>Name</label>
            <input form="patientForm" type="text" class="form-control" name="name" required>
        </div>

        <div class="form-group">
          <label>Gender</label>
          <select class="form-control" form="patientForm" name="gender" id="gender" required>
                              <option value="" selected>Please select one</option>
                              <option value="female">female</option>
                              <option value="male">male</option>
          </select>
      </div>

      <div class="form-group">
        <label>Civil status</label>
        <select class="form-control" form="patientForm" name="civil_status" id="civil_status" required>
                            <option value="" selected>Please select one</option>
                            <option value="married">married</option>
                            <option value="single">single</option>
        </select>
    </div>

          <div class="form-group">
              <label >Birthdate</label>
              <input form="patientForm" type="date" class="form-control" name="birthdate">
              
          </div>

          <div class="form-group">
            <label>Address</label>
            <input form="patientForm" type="text" class="form-control" name="address" required>
        </div>

        <div class="form-group">
          <label>Mobile</label>
          <input form="patientForm" type="number" class="form-control" name="contact_number" required>
      </div>
          
      <div class="form-group">
        <label>Educational attainment</label>
        <select class="form-control" form="patientForm" name="educational_attainment" id="educational_attainment" required>
                            <option value="" selected>Please select one</option>
                            <option value="Vocational">Vocational</option>
                            <option value="Bachelor Degree">Bachelor Degree</option>
                            <option value="Masters Degree">Masters Degree</option>
                            <option value="Doctorate Degree">Doctorate Degree</option>
                            <option value="None">None</option>
        </select>
    </div>

    <div class="form-group">
      <label>Father's name</label>
      <input form="patientForm" type="text" class="form-control" name="fathers_name" required>
  </div>

  <div class="form-group">
    <label>Mother's name</label>
    <input form="patientForm" type="text" class="form-control" name="mothers_name" required>
</div>
          

      </div>
      <div class="modal-footer">
        
          <button form="patientForm" type="submit" class="btn btn-dark text-white" onclick="return confirm('Are you sure you want perform this action?'); this.disabled = true;"> Submit</button>
          </div>
  </div>
  </div>
</div>
@endsection

