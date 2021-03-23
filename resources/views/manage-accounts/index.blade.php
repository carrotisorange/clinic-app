@extends('layouts.main')

@section('title','Manage Accounts')

@section('content')
<div class="content">
  @include('layouts.notifications')
    <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              <h4 class="card-title"> Manage Accounts</h4>
            </div>
            <div class="card-body">
              <div class="">
                <table class="table">
                  <thead class="">
                    <th>#</th>
                    <th>
                      Name
                    </th>
                    <th>
                      Email
                    </th>
                    <th>
                      Profession
                    </th>
                    <th>
                      Role
                    </th>
                    <th>
                        Created on
                    </th>
                    <th>Actions</th>
                  </thead>
                  <tbody>
                      <?php $ctr=1; ?>
                    @foreach ($users as $item)
                    <tr>
                        <th>{{ $ctr++ }}</th>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->email }}</td>
                        <td>{{ $item->profession }}</td>
                        <td>{{ $item->account_type }}</td>
                        <td>{{ Carbon\Carbon::parse($item->created_at)->format('M d, Y') }} </td>
                        <td>
                         @if(Auth::user()->account_type === 'admin')
                         <form action="/user/{{ $item->id }}" method="POST">
                          @csrf
                          @method('DELETE')
                          <a title="edit user info" href="user/{{ $item->id }}/edit" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-edit"></i></a>
                          <button title="delete this user" type="submit" class="d-none d-sm-inline-block btn btn-sm btn-danger shadow-sm"  onclick="return confirm('Are you sure you want perform this action?');"><i class="fas fa-trash fa-sm text-white-50"></i></button>
                        </form>
                         @else
                        
                         @endif
                        </td>
                    </tr>
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

