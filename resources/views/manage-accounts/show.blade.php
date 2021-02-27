@extends('layouts.main')

@section('title','Profile')

@section('content')

<div class="content">
    <div class="row">
        @include('layouts.notifications')
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              {{-- <h4 class="card-title"> Profile</h4> --}}
            </div>
            <div class="card-body">
                <form method="POST" action="/profile/{{ $account->id }}/update">
                    @method('PUT')
                    @csrf
                    <!-- Name -->
                    <div>
                        <x-label for="name" :value="__('Name')" />
        
                        <x-input id="name" class="form-control" type="text" name="name" value="{{ $account->name }}" required autofocus />
                    </div>
                    <br>
                    <div>
                        <x-label for="email" :value="__('Email')" />
        
                        <x-input id="email" class="form-control" type="email" name="email" value="{{ $account->email }}" required autofocus />
                    </div>
                    <br>
                    <div>
                        <x-label for="password" :value="__('Password')" />
        
                        <x-input id="password" class="form-control" type="password" name="password" autofocus />
                        <small class="text-danger">Changing your password will end your session.</small>
                    </div>
                    <br>
                    <p class="text-right"><button type="submit" class="btn btn-dark">Update</button></p>
                </form>
            </div>
          </div>
        </div>
      </div>
</div>
@endsection

