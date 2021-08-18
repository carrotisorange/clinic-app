@extends('layouts.main')

@section('title', 'Patients Record/'.$patient->name.'/Edit')

@section('content')

<div class="content">
    @include('layouts.notifications')

        <p class="col-md-12 text-right">
           @if($appointments->count() > 0)
           <a href="/patient/{{ $patient->patient_id }}/appointments" class="btn btn-dark text-whit" > VIew All Appointments ({{ $appointments->count() }})</a>
           @endif
           <a href="/patient/{{ $patient->patient_id }}/export" class="btn btn-dark text-white" ><i class="fas fa-download"></i> Export Diagnosis</a>
            <a href="#" class="btn btn-dark text-whit" data-toggle="modal" data-target="#appointmentmodal" data-whatever="@mdo"> Add New Appointment</a>
        </p>
  
    <div class="row">
     
      
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              {{-- <h4 class="card-title"> Profile</h4> --}}
            </div>
            <div class="card-body">
                <form method="POST" action="/patient/{{ $patient->patient_id }}/update">
                    @method('PUT')
                    @csrf
                    <!-- Name -->
                    <div>
                        <x-label for="name" :value="__('Name')" />
        
                        <x-input id="name" class="form-control" type="text" name="name" value="{{ $patient->name }}" required autofocus />
                    </div>
                
                    <div class="mt-4">
                        <x-label for="gender" :value="__('Gender')" />
                        <select  class="form-control" id="gender" name="gender" required />
                            <option value="{{ $patient->gender }}">{{  $patient->gender  }}</option>
                            <option value="female">female</option>
                            <option value="male">male</option>
                        </select>
                    </div>
                    <br>
                    <div>
                        <x-label for="birthdate" :value="__('Birthdate')" />
        
                        <x-input id="birthdate" class="form-control" type="date" name="birthdate" value="{{ $patient->birthdate }}" required autofocus />
                    </div>
                   <br>
                   <div>
                    <x-label for="address" :value="__('Address')" />
    
                    <x-input id="address" class="form-control" type="text" name="address" value="{{ $patient->address }}" required autofocus />
                </div>
                 <br>
                   <div>
                    <x-label for="mobile" :value="__('Mobile')" />
    
                    <x-input id="mobile" class="form-control" type="number" name="contact_number" value="{{ $patient->contact_number }}" required autofocus />
                </div>
                <br>
                <div>
                 <x-label for="civil_status" :value="__('Civil status')" />
 
                 <x-input id="civil_status" class="form-control" type="text" name="civil_status" value="{{ $patient->civil_status }}" required autofocus />
             </div>
             
             <div class="mt-4">
                <x-label for="educational_attainment" :value="__('Educational attainment')" />
                <select  class="form-control" id="educational_attainment" name="educational_attainment" required />
                    <option value="{{ $patient->educational_attainment }}" selected>{{ $patient->educational_attainment }}</option>
                    <option value="Vocational">Vocational</option>
                    <option value="Bachelor Degree">Bachelor Degree</option>
                    <option value="Masters Degree">Masters Degree</option>
                    <option value="Doctorate Degree">Doctorate Degree</option>
                    <option value="None">None</option>
                </select>
            </div>
            <br>
            <div>
                <x-label for="fathers_name" :value="__('Fathers name')" />

                <x-input id="fathers_name" class="form-control" type="text" name="fathers_name" value="{{ $patient->fathers_name }}" required autofocus />
            </div>
            <br>
            <div>
                <x-label for="mothers_name" :value="__('Mothers name')" />

                <x-input id="mothers_name" class="form-control" type="text" name="mothers_name" value="{{ $patient->mothers_name }}" required autofocus />
            </div>
                
                    <br>
                    <p class="text-right"><button type="submit" class="btn btn-dark">Update</button></p>
                </form>
            </div>
          </div>
        </div>
      </div>
</div>

<div class="modal fade" id="appointmentmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"  data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel" >Appointment Information</h5>
  
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <div class="modal-body">
            <form id="appointmentForm" action="/patient/{{ $patient->patient_id }}/appointment/store" method="POST">
                @csrf
            </form>
            
            <div class="form-group">
                <label>Date</label>
                <input form="appointmentForm" type="date" class="form-control" name="date" value="{{ Carbon\Carbon::now()->format('Y-m-d') }}" required>
            </div>
    
  
            <div class="form-group">
              <label>Patient</label>
              <input form="appointmentForm" type="text" class="form-control" name="name" value="{{ $patient->name }}" required readonly>
          </div>
  
         
          <div class="form-group">
            <label>Select a doctor</label><small class="text-danger">@if($doctors->count()<=0) (No available doctors) <a href="/doctors">Add now</a> @endif</small>
            <select class="form-control" form="appointmentForm" name="doctor_id" required>
               @foreach ($doctors as $item)
                <option value="{{ $item->doctor_id }}">Dr. {{ $item->name }} | {{ $item->profession }}</option>
               @endforeach
            </select>
        </div>

        
        <div class="form-group">
            <label>Purpose</label>
            <textarea form="appointmentForm" type="text" class="form-control" name="desc" value="" required ></textarea>
        </div>
    
            
  
        </div>
        <div class="modal-footer">
          
            <button form="appointmentForm" type="submit" class="btn btn-dark text-white" onclick="return confirm('Are you sure you want perform this action?'); this.disabled = true;"> Submit</button>
            </div>
    </div>
    </div>
  </div>
@endsection

