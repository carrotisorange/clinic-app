@extends('layouts.main')

@section('title','Patients Record')

@section('content')
<div class="content">
    <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              <h4 class="card-title"> Patients Record</h4>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table">
                  <thead class=" text-primary">
                      <th>#</th>
                    <th>
                      Name
                    </th>
                    <th>
                        Gender
                    </th>
                    <th>
                        Birthdate
                    </th>
                    <th>
                        Address
                    </th>
                    <th>
                        Mobile
                    </th>
                  </thead>
                  <tbody>
                      <?php $ctr=1; ?>
                    @foreach ($patients as $item)
                    <tr>
                        <th>{{ $ctr++ }}</th>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->gender }}</td>
                        <td>{{ $item->birthdate }}</td>
                        <td>{{ $item->address }}</td>
                        <td>{{ $item->contact_number }}</td>
                        <td>{{ Carbon\Carbon::parse($item->created_at)->format('M d, Y') }}</td>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
</div>
@endsection

