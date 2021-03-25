@extends('layouts.main')

@section('title','Doctors')

@section('content')
<div class="content">
  @include('layouts.notifications')

  <p class="col-md-12 text-right">
      <a href="#" class="btn btn-dark" data-toggle="modal" data-target="#adddoctormodal" data-whatever="@mdo"><i class="fas fa-plus"></i> Add New Doctor</a>
  </p>
    <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              {{-- <h4 class="card-title"> Doctors</h4> --}}
            </div>
            <div class="card-body">
              <div class="">
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
                      Profession
                    </th>
                    <th>
                        Added on
                    </th>
                  </thead>
                  <tbody>
                      <?php $ctr=1; ?>
                    @foreach ($doctors as $item)
                    <tr>
                        <th>{{ $ctr++ }}</th>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->profession }}</td>
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

<div class="modal fade" id="adddoctormodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"  data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog modal-md" role="document">
  <div class="modal-content">
      <div class="modal-header">
      <h5 class="modal-title" id="exampleModalLabel" >Doctor Information</h5>

      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
      </button>
      </div>
      <div class="modal-body">
          <form id="doctorForm" action="/doctor/store" method="POST">
              @csrf
          </form>

          <div class="form-group">
            <label>Name</label>
            <input form="doctorForm" type="text" class="form-control" name="name" required>
        </div>

        <div class="form-group">
          <label>Profession</label>
          <input form="doctorForm" type="text" class="form-control" name="profession" required>
      </div>

      </div>
      <div class="modal-footer">
        
          <button form="doctorForm" type="submit" class="btn btn-dark text-white" onclick="return confirm('Are you sure you want perform this action?'); this.disabled = true;"> Submit</button>
          </div>
  </div>
  </div>
</div>
@endsection

