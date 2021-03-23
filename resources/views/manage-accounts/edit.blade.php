@extends('layouts.main')

@section('title', $user->name)

@section('content')

<div class="content">
    @include('layouts.notifications')

    <div class="row">
     
      
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              {{-- <h4 class="card-title"> Profile</h4> --}}
            </div>
            <div class="card-body">
                <form method="POST" action="/user/{{ $user->id }}/update">
                    @method('PUT')
                    @csrf
                    <!-- Name -->
                    <div>
                        <x-label for="name" :value="__('Name')" />
        
                        <x-input id="name" class="form-control" type="text" name="name" value="{{ $user->name }}" required autofocus />
                    </div>
                    <br>
                    <div>
                        <x-label for="email" :value="__('Email')" />
        
                        <x-input id="brand" class="form-control" type="email" name="email" value="{{ $user->email }}" required autofocus />
                    </div>
                    <br>
                    <div>
                        <x-label for="account_type" :value="__('Role')" required autofocus/>
                        <select class="form-control" name="account_type" id="">
                            <option value="{{ $user->account_type }}" selected>{{ $user->account_type }} (selected)</option>
                            <option value="admin">admin</option>
                            <option value="user">user</option>
                        </select>
                      
                    </div>
                    <br>
                    <div>
                        <x-label for="qty" :value="__('Password')" />
        
                        <x-input id="qty" class="form-control" type="password" name="password" value="" autofocus />
                    </div>
                  
                  
                
                
                    <br>
                    <p class="text-right"><button type="submit" class="btn btn-dark">Update</button></p>
                </form>
            </div>
          </div>
        </div>
      </div>
</div>
  </div>  
@endsection

