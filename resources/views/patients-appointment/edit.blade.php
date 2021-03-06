@extends('layouts.main')

@section('title', $patient->name)

@section('content')
<div class="content">
    @include('layouts.notifications')

    <p class="col-md-12 text-right">
      <a href="/patient/{{ $patient->patient_id }}/appointment/{{ $appointment->appointment_id }}/export" class="btn btn-dark text-white" > Print All Diagnosis</a>
        <a href="#" class="btn btn-dark text-white" data-toggle="modal" data-target="#viewpresciptionsmodal" data-whatever="@mdo"> View All Prescriptions</a>
        <a href="#" class="btn btn-dark text-white" data-toggle="modal" data-target="#viewdiagnosismodal" data-whatever="@mdo"> View All Diagnosis</a>
        <a href="#" class="btn btn-dark text-white" data-toggle="modal" data-target="#adddiagnosismodal" data-whatever="@mdo"> Add New Diagnosis</a>
    </p>
    <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              {{-- <h4 class="card-title"> Patients Appointments</h4> --}}
            </div>
            <div class="card-body">
                <form method="POST" action="/patient/{{ $patient->patient_id }}/appointment/{{ $appointment->appointment_id }}/update">
                    @method('PUT')
                    @csrf

                    <div>
                        <x-label for="birthdate" :value="__('Date')" />
        
                        <x-input id="birthdate" class="form-control" type="date" name="date" value="{{ $appointment->date }}" required autofocus />
                    </div>
                    <br>
                    <!-- Name -->
                    <div>
                        <x-label for="name" :value="__('Doctor')" />
                        <select  class="form-control" id="gender" name="doctor_id" required />
                            @foreach ($appointment_info as $item)
                            <option value="{{ $item->doctor_id }}">Dr. {{ $item->name }} | {{ $item->profession }} (selected)</option>
                            @endforeach
                            @foreach ($doctors as $item)
                            <option value="{{ $item->doctor_id }}">Dr. {{ $item->name }} |  {{ $item->profession }}</option>
                            @endforeach
                        </select>

                    
                    </div>
                
       <br>
       <div>
                        <x-label for="name" :value="__('Status')" />
                        <select  class="form-control" id="gender" name="status" required />
                            <option value="{{ $appointment->status }}">{{ $appointment->status }} (selected)</option>
                            <option value="pending">pending</option>
                            <option value="active">active</option>
                            <option value="closed">closed</option>
                            
                           
                        </select>

                    
                    </div>
       
                   <br>
                   <div>
                       
                    <x-label for="address" :value="__('Description')" />
    
                    <textarea type="text" class="form-control" name="desc" required >{{ $appointment->desc }}</textarea>
                   
                </div>
              
             
 
                
                    <br>
                    <p class="text-right"><button type="submit" class="btn btn-dark">Update</button></p>
                </form>
            </div>
          </div>
        </div>
      </div>
</div>

<div class="modal fade" id="adddiagnosismodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"  data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-xl" role="document">
    <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel" >Patient Diagnosis</h5>
  
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>
        
            <div class="modal-body">
                <p><b>Date:</b> {{ Carbon\Carbon::now() }}</p>
                <p><b>Patient:</b> {{ $patient->name }}</p>
                <hr>
                <div class="row">
                <div class="col-md-6">
                <form id="diagnosisForm" action="/patient/{{ $appointment->patient_id_fk }}/appointment/{{ $appointment->appointment_id }}/diagnosis/store" method="POST">
                    @csrf
                </form>
      
                <div class="form-group">
                  <label>Symptoms</label>
                  <textarea form="diagnosisForm" type="text" class="form-control" name="symptoms" placeholder="Patient's condition is getting better." required></textarea>
              </div>
      
              <div class="form-group">
                <label>Temperature (C)</label>
                <input form="diagnosisForm" type="number" step="0.001" class="form-control" name="temperature" placeholder="36.1" required>
            </div>
    
            <div class="form-group">
                <label>Blood pressure</label>
                <input form="diagnosisForm" type="text" class="form-control" name="blood_pressure" placeholder="120/80" required>
            </div>
    
            <div class="form-group">
                <label>Weight (Kg)</label>
                <input form="diagnosisForm" type="number" step="0.001" class="form-control" name="weight" placeholder="80" required>
            </div>
    
            
            <div class="form-group">
                <label>Height (Ft)</label>
                <input form="diagnosisForm" type="number" step="0.001" class="form-control" name="height" placeholder ="6.2" required>
            </div>
        </div>
            <div class="col-md-6">
              
            <div class="form-group">
                <div class="col">
                    <p class="">
                        Issue Medicine
                      <span id='delete_bill' class="btn btn-danger"> Remove</span>
                    <span id="add_bill" class="btn btn-primary"> Add</span>     
                    </p>
                  </div>
                
                
                        <div class="">
                        <table class = "table" id="table_bill">
                           <thead>
                            <tr>
                              <th>#</th>
                              <th>Medicine</th>
                              <th>Qty</th>
                     
                              
                          </tr>
                           </thead>
                                <input form="diagnosisForm" type="hidden" id="no_of_bills" name="no_of_bills" >
                            <tr id='bill1'></tr>
                        </table>
                      </div>
                   
                
            <div class="form-group">
                <label>Note</label>
                <textarea form="diagnosisForm" class="form-control" name="note" placeholder ="e.g., 1 Mefenamic after every eating." required></textarea>
            </div>
            </div>
            </div>
        </div>
  
        </div>
        <div class="modal-footer">
          
            <button form="diagnosisForm" type="submit" class="btn btn-dark text-white"> Submit</button>
            </div>
    </div>
    </div>
  </div>

  
<div class="modal fade" id="viewdiagnosismodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"  data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-xl" role="document">
    <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel" >Patient Diagnosis</h5>
  
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>
        
            <div class="modal-body">
            <div class="">
                <table class="table">
                    <thead class="">
                        <th>#</th>
                      <th>
                        Symptoms
                      </th>
                      <th>
                        Temperature
                      </th>
                      <th>
                        Blood pressure
                      </th>
                      <th>
                        Weight
                      </th>
                      <th>
                        Height
                      </th>
                      <th>
                          Diagnosed on
                      </th>
                    </thead>
                    <tbody>
                        <?php $ctr_diagnosis=1; ?>
                      @foreach ($diagnosis as $item)
                      <tr>
                          <th>{{ $ctr_diagnosis++ }}</th>
                          <td>{{ $item->symptoms }}</td>
                          <td>{{ $item->temperature }}C</td>
                          <td>{{ $item->blood_pressure }}</td>
                          <td>{{ $item->weight }}Kg</td>
                          <td>{{ $item->height }}Ft</td>
                          <td>{{ Carbon\Carbon::parse($item->created_at)->format('M d, Y') }}</td>
                      @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="modal-footer">
          
            <button type="button" class="btn-dark btn" data-dismiss="modal"> Close</button>
            </div>
    </div>
    </div>
  </div>

  <div class="modal fade" id="viewpresciptionsmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"  data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-xl" role="document">
    <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel" >Patient Prescriptions</h5>
  
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>
        
            <div class="modal-body">
            <div class="">
                <table class="table">
                    <thead class="">
                        <th>#</th>
                      <th>
                        Medicine ID
                      </th>
                      <th>
                        Qty
                      </th>
                      <th>
                        Note
                      </th>
                      <th>
                          Prescribed on
                      </th>
                    </thead>
                    <tbody>
                        <?php $ctr_prescriptions=1; ?>
                      @foreach ($prescriptions as $item)
                      <tr>
                          <th>{{ $ctr_prescriptions++ }}</th>
                          <td>{{ $item->medicine_id_fk }}</td>
                          <td>{{ $item->qty }}</td>
                          <td>{{ $item->note }}</td>
                        
                          <td>{{ Carbon\Carbon::parse($item->created_at)->format('M d, Y') }}</td>
                      @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="modal-footer">
          
            <button type="button" class="btn-dark btn" data-dismiss="modal"> Close</button>
            </div>
    </div>
    </div>
  </div>
@endsection
@section('js-scripts')
<script type="text/javascript">
    //adding moveout charges upon moveout
      $(document).ready(function(){
      var k=1;
      $("#add_bill").click(function(){
        $('#bill'+k).html("<th>"+ (k) +"</th><td><select class='form-control' name='medicine"+k+"' form='diagnosisForm' id='medicine"+k+"' required><option value='' selected>Please select one</option>@foreach ($medicines as $item)<option value='{{ $item->medicine_id }}'>{{ $item->name }} ({{ $item->quantity}})</option>@endforeach</select>  <td><input  class='form-control'  form='diagnosisForm' name='qty"+k+"' id='qty"+k+"' type='number' min='1' value='1' required></td>");
       $('#table_bill').append('<tr id="bill'+(k+1)+'"></tr>');
       k++;
       
          document.getElementById('no_of_bills').value = k;
   });
      $("#delete_bill").click(function(){
          if(k>1){
          $("#bill"+(k-1)).html('');
          k--;
          
          document.getElementById('no_of_bills').value = k;
          }
      });
  });
  </script>
@endsection

