@extends('layouts.main')

@section('title','Medicine Inventory')

@section('content')
<div class="content">
  @include('layouts.notifications')

  <p class="col-md-12 text-right">
    <a href="/medicine/inventory/month/{{ Carbon\Carbon::now()->month }}/year/{{ Carbon\Carbon::now()->year }}" class="btn btn-dark"><i class="fas fa-eye"></i>  View Current Inventory</a>
      <a href="#" class="btn btn-dark" data-toggle="modal" data-target="#addmedicinemodal" data-whatever="@mdo"><i class="fas fa-plus"></i> Add New Drug</a>
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
                    <th>Drug</th>
                    <th>Batch No</th>
                    
                  
                    <th>Expiry Date</th>
                    <th></th>
                  </thead>
                  <tbody>
                    <?php $ctr=1; ?>
                    @foreach ($medicines as $item)
                    <tr>
                        <th>{{ $ctr++ }}</th>
                        <td>{{ $item->name }} &nbsp;&nbsp;&nbsp;&nbsp;{{ $item->mg }}mg 
                           @if($item->quantity <= 0)
                          <span class="text-danger"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Out of Stock</span>
                          @else
                          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;({{ $item->quantity }})
                          @endif
                        </td>
                        <td>{{ $item->brand }}</td>
                     
                   
                        <td>{{ Carbon\Carbon::parse($item->expiration)->format('M d, Y') }}</td>
                        <th> 
                          <a title="edit this drug this appointment" href="/medicine/{{ $item->medicine_id }}/edit" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-edit"></i></a>
                        </th>
                       
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
      <h5 class="modal-title" id="exampleModalLabel" >Enter Drug Information</h5>

      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
      </button>
      </div>
      <div class="modal-body">
          <form id="medicineForm" action="/medicine/store" method="POST">
              @csrf
          </form>

          <div class="form-group">
            <label>Drug</label>
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

 
@endsection