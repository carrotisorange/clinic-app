@extends('layouts.main')

@section('title','Patients Appointments')

@section('content')
<div class="content">
    <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              {{-- <h4 class="card-title"> Patients Appointments</h4> --}}
            </div>
            <div class="card-body">
              <div class="table-responsive">
                @if ($appointments->count() <= 0)
                <p class="text-danger text-center">No appointments found!</p>
               @else
                <table class="table">
                  <thead class="">
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
                @endif
              </div>
            </div>
          </div>
        </div>
      </div>
</div>
@endsection

