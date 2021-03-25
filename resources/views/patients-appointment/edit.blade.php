@extends('layouts.main')

@section('title', 'Patients Record/'.$patient->name.'/Appointment/Edit')

@section('content')
<div class="content">
    @include('layouts.notifications')

    <p class="col-md-12 text-right">
     @if($diagnosis->count()>0)
     <a href="/patient/{{ $patient->patient_id }}/appointment/{{ $appointment->appointment_id }}/export" class="btn btn-dark text-white" ><i class="fas fa-download"></i> Export Diagnosis</a>
     <a href="#" class="btn btn-dark text-white" data-toggle="modal" data-target="#viewdiagnosismodal" data-whatever="@mdo"><i class="fas fa-eye"></i> View Diagnosis ({{ $diagnosis->count() }})</a>
     @endif
     @if($prescriptions->count()>0)
     <a href="#" class="btn btn-dark text-white" data-toggle="modal" data-target="#viewpresciptionsmodal" data-whatever="@mdo"><i class="fas fa-eye"></i> View Prescriptions ({{ $prescriptions->count() }})</a>
     @endif
        <a href="#" class="btn btn-dark text-white" data-toggle="modal" data-target="#adddiagnosismodal" data-whatever="@mdo"><i class="fas fa-plus"></i> Add New Diagnosis</a>
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
                       
                    <x-label for="address" :value="__('Purpose')" />
    
                    <textarea type="text" class="form-control" name="desc" required >{{ $appointment->desc }}</textarea>
                   
                </div>
              
             
 
                
                    <br>
                    <p class="text-right"><button type="submit" class="btn btn-dark"><i class="fas fa-check"></i> Update</button></p>
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
                {{-- <p><b>Date:</b> {{ Carbon\Carbon::now() }}</p>
                <p><b>Patient:</b> {{ $patient->name }}</p>
                <hr> --}}
                <div class="row">
                  <div class="col-md-1">

                  </div>
                <div class="col-md-5">
                <form id="diagnosisForm" action="/patient/{{ $appointment->patient_id_fk }}/appointment/{{ $appointment->appointment_id }}/diagnosis/store" method="POST">
                    @csrf
                </form>
      
                <div class="form-group">
                 <div class="row">
                    <div class="col-md-12">
                      <label>Symptoms</label>
                  <textarea form="diagnosisForm" type="text" class="form-control" name="symptoms" required></textarea>
                    </div>
                 </div>

              </div>
      
              <div class="form-group">
                <div class="row">
                  <div class="col-md-6">
                    <label>Temperature (C)</label>
                    <input form="diagnosisForm" type="number" step="0.001" class="form-control" name="temperature" required>
                   </div>
    
                    <div class="col-md-6">
                      <label>Blood pressure</label>
                      <input form="diagnosisForm" type="text" class="form-control" name="blood_pressure" required>
                    </div>
                </div>
            </div>
    
          
    
            <div class="form-group">
              <div class="row">
                <div class="col-md-4">
                  <label>Weight (Kg)</label>
                  <input form="diagnosisForm" type="number" step="0.001" class="form-control" name="weight" id="weight" oninput="autoComputeBMI()" required>
                  
                 </div>
                 <div class="col-md-4">
                  <label>Height (Ft)</label>
                  <input form="diagnosisForm" type="number" step="0.001" class="form-control" name="height"  id="height" oninput="autoComputeBMI()" required>
                 </div>

                 <div class="col-md-4">
                  <label>BMI (W/H)</label>
                  <input form="diagnosisForm" type="number" step="0.001" class="form-control" id="bmi" name="bmi" required readonly>
                 </div>
              </div>
            </div>
    
    

          <div class="form-group">
            <div class="row">
              <div class="col-md-6">
                <label>Cardiac Rate (CR)</label>
                <input form="diagnosisForm" type="number" step="0.001" class="form-control" name="cr" required>
              </div>
              <div class="col-md-6">
                <label>Respiratory Rate (RR)</label>
                <input form="diagnosisForm" type="number" step="0.001" class="form-control" name="rr" required>
            </div>
              </div>
            </div>
           
        </div>
        <div class="col-md-1">

        </div>
            <div class="col-md-4">
              
            @if($medicines->count()<=0)
              <p class="text-danger text-danger">No available medicines. <a href="/medicine-inventory">Add now</a></p>
            @else
            <div class="form-group">
              <div class="col">
                  <p class="">
                      Issue Medicine
                    <button id='delete_bill' class="btn btn-dark"><i class="fas fa-minus"></i> Remove</button>
                  <button id="add_bill" class="btn btn-dark"><i class="fas fa-plus"></i> Add</button>     
                  </p>
                </div>
              
              
                      <div class="row">
                      <table class = "table" id="table_bill">
                         <thead>
                          <tr>
                            <th>#</th>
                            <th>Medicine</th>
                            <th>Quantity</th>
                   
                            
                        </tr>
                         </thead>
                              <x-input form="diagnosisForm" type="hidden" id="no_of_bills" name="no_of_bills" />
                          <tr id='bill1'></tr>
                      </table>
                    </div>
                 
              
          
          </div>
            @endif
            </div>
            <div class="col-md-1">

            </div>
        </div>
        <div class="row">
          <div class="col-md-10 mx-auto">
            <div class="form-group">
              <label>Diagnosis</label>
              <textarea form="diagnosisForm" class="form-control" name="diagnosis" required></textarea>
          </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-10 mx-auto">
            <div class="form-group">
              <label>Note</label>
              <textarea form="diagnosisForm" class="form-control" name="note" placeholder ="e.g., 1 Mefenamic after every eating." required></textarea>
          </div>
          </div>
        </div>
  
        </div>
        <div class="modal-footer">
          
            <button form="diagnosisForm" type="submit" class="btn btn-dark text-white"onclick="return confirm('Are you sure you want perform this action?'); this.disabled = true;"><i class="fas fa-check"></i> Submit</button>
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
            <div class="row table-responsive">
              <div class="col-md-11 mx-auto">
                <table class="table table-bordered">
                    <thead class="">
                        <th>#</th>
                        <th width="120">Date</th>
                      <th>
                        Symptoms
                      </th>
                      <th width="60">
                        Tmp
                      </th>
                      <th width="60">
                        BP
                      </th>
                      <th width="60">
                        Wt
                      </th>
                      <th width="60">
                        Ht
                      </th>
                      <th width="60">
                        BMI
                      </th>
                      <th width="60">
                        CR
                      </th>
                      <th width="60">
                        RR
                      </th>
                      <th>
                          Diagnosis
                      </th>
                     
                    </thead>
                    <tbody>
                        <?php $ctr_diagnosis=1; ?>
                      @foreach ($diagnosis as $item)
                      <tr>
                          <th>{{ $ctr_diagnosis++ }}</th>
                          <td>{{ Carbon\Carbon::parse($item->created_at)->format('M d, Y') }}</td>
                          <td>{{ $item->symptoms }}</td>
                          <td>{{ $item->temperature }}C</td>
                          <td>{{ $item->blood_pressure }}</td>
                          <td>{{ $item->weight }}Kg</td>
                          <td>{{ $item->height }}Ft</td>
                          <td>{{ $item->bmi }}</td>
                          <td>{{ $item->rr }}</td>
                          <td>{{ $item->cr }}</td>
                          <td>{{ $item->diagnosis }}</td>
                      @endforeach
                    </tbody>
                </table>
            </div>
            </div>
        </div>
        <div class="modal-footer">
          
            <button type="button" class="btn-dark btn" data-dismiss="modal"><i class="fas fa-times"></i> Close</button>
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
              <div class="col-md-11 mx-auto">
                <table class="table table-bordered">
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
          
            <button type="button" class="btn-dark btn" data-dismiss="modal"><i class="fas fa-times"></i> Close</button>
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
        $('#bill'+k).html("<th>"+ (k) +"</th><td><select class='form-control' name='medicine"+k+"' form='diagnosisForm' id='medicine"+k+"' required><option value='' selected>Please select one</option>@foreach ($medicines as $item)@if($item->quantity<=0)<option value='{{ $item->medicine_id }}' disabled>{{ $item->name }} (<span class='text-danger'>Out of Stock</span>)</option> @else<option value='{{ $item->medicine_id }}'>{{ $item->name }} ({{ $item->quantity}})</option>@endif @endforeach</select>  <td><input  class='form-control'  form='diagnosisForm' name='qty"+k+"' id='qty"+k+"' type='number' min='1' value='1' required></td>");
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

<script>
  function autoComputeBMI(){
    var height = document.getElementById('height').value;
    var weight = document.getElementById('weight').value;

    document.getElementById('bmi').value = eval(weight)/eval(height);

   
  }
</script>
@endsection
