@extends('layouts.main')

@section('title', $patient->name)

@section('content')

<div class="content">
    <div class="row">
        @include('layouts.notifications')
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
@endsection

