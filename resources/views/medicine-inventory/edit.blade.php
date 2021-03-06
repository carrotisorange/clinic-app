@extends('layouts.main')

@section('title', $medicine->name)

@section('content')

<div class="content">
    @include('layouts.notifications')
    <p class="col-md-12 text-right">
      <a href="/medicine-inventory" class="btn btn-dark text-white"> Back</a>
    <a href="#" class="btn btn-dark text-white" data-toggle="modal" data-target="#viewinventorymodal" data-whatever="@mdo"> View Inventory</a>
    </p>
    <div class="row">
     
      
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              {{-- <h4 class="card-title"> Profile</h4> --}}
            </div>
            <div class="card-body">
                <form method="POST" action="/medicine/{{ $medicine->medicine_id }}/update">
                    @method('PUT')
                    @csrf
                    <!-- Name -->
                    <div>
                        <x-label for="name" :value="__('Name')" />
        
                        <x-input id="name" class="form-control" type="text" name="name" value="{{ $medicine->name }}" required autofocus />
                    </div>
                    <br>
                    <div>
                        <x-label for="brand" :value="__('Brand')" />
        
                        <x-input id="brand" class="form-control" type="text" name="brand" value="{{ $medicine->brand }}" required autofocus />
                    </div>
                    <br>
                    <div>
                        <x-label for="mg" :value="__('Mg')" />
        
                        <x-input id="mg" class="form-control" type="number" name="mg" step="0.001" value="{{ $medicine->mg }}" required autofocus />
                    </div>
                    <br>
                    <div>
                        <x-label for="qty" :value="__('Qty')" />
        
                        <x-input id="qty" class="form-control" type="number" name="qty" value="{{ $medicine->quantity }}" required autofocus />
                    </div>
                    <br>
                    <div>
                        <x-label for="expiration" :value="__('Expiration')" />
        
                        <x-input id="expiration" class="form-control" type="date" name="expiration" value="{{ $medicine->expiration }}" required autofocus />
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

  <div class="modal fade" id="viewinventorymodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"  data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel" >Inventory</h5>
  
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <div class="modal-body">
          <div class="">
            @if ($stocks->count() <= 0)
            <p class="text-danger text-center">No records found!</p>
           @else
           <table class="table">
             <th>Date</th>
             <th>Description</th>
             <th>User</th>
           @foreach ($stocks as $item)
         
            <tbody>
              <td>
                {{ Carbon\Carbon::parse($item->date)->format('M d, Y').', '.Carbon\Carbon::parse($item->date)->toTimeString() }}
              </td>
              <td>
                {{ $item->desc }}
              </td>
              <td>{{ $item->user }}</td>
            </tbody>
         
           @endforeach
          </table>
            @endif
          </div>
        </div>
        <div class="modal-footer">
          
          <button type="button" class="btn-dark btn" data-dismiss="modal"> Close</button>
            </div>
    </div>
    </div>
  </div>  
@endsection

