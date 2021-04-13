@extends('layouts.main')

@section('title','Dashboard Inventory')

@section('content')
<div class="content">

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
                    <th>Stock</th>
                  

                  </thead>
                  <tbody>
                    <?php $ctr=1; ?>
                    @foreach ($medicines as $item)
                    <tr>
                        <th>{{ $ctr++ }}</th>
                        <td>{{ $item->name }} </td>
                       
                        <?php $days_before_expiration = Carbon\Carbon::parse(Carbon\Carbon::now())->diffInDays($item->expiration); ?>

                        <td>
                           @if($item->quantity<=0)
                           <span class="text-danger">NO STOCK</span>
                           @elseif($days_before_expiration<=0)
                           <span class="text-danger">EXPIRED</span>
                           @elseif($days_before_expiration<=30)
                           <span class="text-danger">EXPIRATION NEAR</span>
                           
                           @else
                            {{ $item->quantity }}
                           @endif
                         

                        </td>

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