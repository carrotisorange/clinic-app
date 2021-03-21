@extends('layouts.main')

@section('title','Medicine Inventory')

@section('content')
<div class="content">
  @include('layouts.notifications')

  <p class="col-md-12 text-right">
    <a href="#" class="btn btn-dark text-white" data-toggle="modal" data-target="#viewinventorymodal" data-whatever="@mdo"> View Current Inventory</a>
      <a href="#" class="btn btn-dark text-whit" data-toggle="modal" data-target="#addmedicinemodal" data-whatever="@mdo"> Add New Medicine</a>
  </p>
    <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              {{-- <h4 class="card-title"> Medicine Inventory</h4> --}}
            </div>
            <div class="card-body">
              <div class="">
                @if ($medicines->count() <= 0)
                <p class="text-danger text-center">No medicines found!</p>
               @else
                <table class="table">
                  <thead class="">
                    <th>#</th>
                    <th>Drugs</th>
                    <th>Batch No</th>
                    
                  
                    <th>Expiry Date</th>
                    <th></th>
                  </thead>
                  <tbody>
                    <?php $ctr=1; ?>
                    @foreach ($medicines as $item)
                    <tr>
                        <th>{{ $ctr++ }}</th>
                        <td>{{ $item->name.' '.$item->mg }}mg 
                           @if($item->quantity <= 0)
                          <span class="text-danger"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Out of Stock</span>
                          @else
                          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;({{ $item->quantity }})
                          @endif
                        </td>
                        <td>{{ $item->brand }}</td>
                     
                   
                        <td>{{ Carbon\Carbon::parse($item->expiration)->format('M d, Y') }}</td>
                        <th> <a href="/medicine/{{ $item->medicine_id }}/edit" class="btn btn-dark text-whit" > View</a></th>
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

<div class="modal fade" id="addmedicinemodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"  data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog modal-md" role="document">
  <div class="modal-content">
      <div class="modal-header">
      <h5 class="modal-title" id="exampleModalLabel" >Medicine Information</h5>

      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
      </button>
      </div>
      <div class="modal-body">
          <form id="medicineForm" action="/medicine/store" method="POST">
              @csrf
          </form>

          <div class="form-group">
            <label>Name</label>
            <input form="medicineForm" type="text" class="form-control" name="name" required>
        </div>
        <div class="form-group">
          <label>Batch No</label>
          <input form="medicineForm" type="text" class="form-control" name="brand" required>
      </div>

        <div class="form-group">
          <label>Mg</label>
          <input form="medicineForm" type="number" step="0.001" min="1" class="form-control" name="mg" required>
      </div>

      <div class="form-group">
        <label>Quantity</label>
        <input form="medicineForm"  type="number" class="form-control" min="1" name="quantity" required>
    </div>

    <div class="form-group">
      <label>Expiration Date</label>
      <input form="medicineForm" type="date" class="form-control" name="expiration" required>
  </div>

      </div>
      <div class="modal-footer">
        
          <button form="medicineForm" type="submit" class="btn btn-dark text-white" onclick="return confirm('Are you sure you want perform this action?'); this.disabled = true;"> Submit</button>
          </div>
  </div>
  </div>
</div>

<div class="modal fade" id="viewinventorymodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"  data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog modal-xl" role="document">
  <div class="modal-content">
      <div class="modal-header">
      <h5 class="modal-title" id="exampleModalLabel" >Current Inventory ({{ Carbon\Carbon::now()->format('M, Y') }})</h5>

      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
      </button>
      </div>
      <div class="modal-body">
       
        <div class="row">
           <div class="col-md-12 mx-auto">
            <table class="table table-bordered">
              <tr>
          
                <th>Drug</th>
                <th>Expiry Date</th>
                <th>Dates</th>
              
              </tr>
             <tbody>
               @foreach ($medicines as $medicine)
               <tr>
                <td>
                  {{ $medicine->name }} {{ $medicine->mg }}mg 
                  @if($medicine->quantity <= 0)
                  <span class="text-danger">(Out of Stock)</span>
                  @else
                  ({{ $medicine->quantity }})
                  @endif
                </td>
                <td>
                  {{ Carbon\Carbon::parse($medicine->expiration)->format('M-d') }} 
                </td>
                @foreach ($stocks as $stock)
                @if($medicine->medicine_id === $stock->medicine_id)
                 <td>{{ Carbon\Carbon::parse($stock->date)->format('M/d') }} ({{ $stock->qty }})</td>
               
                @endif
               
              @endforeach
             
               </tr>
               @endforeach
             </tbody>
            </table>
           </div>
        </div>
      </div>
      <div class="modal-footer">
        
        <button type="button" class="btn-dark btn" data-dismiss="modal"> Close</button>
          </div>
  </div>
  </div>
</div>  
@endsection