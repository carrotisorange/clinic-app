@extends('layouts.main')

@section('title','Doctors')

@section('content')
<div class="content">
    <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              {{-- <h4 class="card-title"> Doctors</h4> --}}
            </div>
            <div class="card-body">
              <div class="table-responsive">
                @if ($doctors->count() <= 0)
                <p class="text-danger text-center">No doctors found!</p>
               @else
                <table class="table">
                  <thead class="">
                      <th>#</th>
                    <th>
                      Name
                    </th>
                    <th>
                        Created at
                    </th>
                  </thead>
                  <tbody>
                      <?php $ctr=1; ?>
                    @foreach ($doctors as $item)
                    <tr>
                        <th>{{ $ctr++ }}</th>
                        <td>{{ $item->name }}</td>
                        <td>{{ Carbon\Carbon::parse($item->created_at)->format('M d, Y') }}</td>
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

