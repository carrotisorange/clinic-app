@extends('layouts.main')

@section('title', $patient->name)

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
                    <th></th>
                  
                  </thead>
                  <tbody>
                      <?php $ctr=1; ?>
                    @foreach ($appointments as $item)
                    <tr>
                        <th>{{ $ctr++ }}</th>
                        <td>{{ Carbon\Carbon::parse($item->date)->format('M d, Y') }}</td>
                        <td>{{ $item->patient_name }}</td>
                        <td>{{ $item->doctor_name }}</td>
                        <td>{{ $item->status }}</td>
                        <td>{{ $item->desc }}</td>
                        <th> <a href="/patient/{{ $item->patient_id }}/appointment/{{ $item->appointment_id }}" class="btn btn-dark text-whit" > View</a></th>
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

