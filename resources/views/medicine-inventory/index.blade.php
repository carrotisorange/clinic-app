@extends('layouts.main')

@section('title','Medicine Inventory')

@section('content')
<div class="content">
    <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              {{-- <h4 class="card-title"> Medicine Inventory</h4> --}}
            </div>
            <div class="card-body">
              <div class="table-responsive">
                @if ($medicines->count() <= 0)
                <p class="text-danger text-center">No medicines found!</p>
               @else
                <table class="table">
                  <thead class="">
                    <th>#</th>
                    <th>
                      Name
                    </th>
                    <th>
                      Mg
                    </th>
                    <th>
                      Qty
                    </th>
                    <th>
                      Expiration
                    </th>
                  
                  </thead>
                  <tbody>
                      <?php $ctr=1; ?>
                    @foreach ($medicines as $item)
                    <tr>
                        <th>{{ $ctr++ }}</th>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->mg }}</td>
                        <td>{{ $item->quantity }}</td>
                        <td>{{ Carbon\Carbon::parse($item->expiration)->format('M d, Y') }}</td>
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

