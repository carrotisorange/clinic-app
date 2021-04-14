@extends('layouts.main')

@section('title','Inventory of the stocks')

@section('content')
<div class="content">
  <div class="row">
    <div class="col-md-6">
      <p class="text-center"><b>As of {{ Carbon\Carbon::now()->format('M d,Y') }}</b></p>
      <table class="table table-condensed table-bordered table-hover">
    
        {{-- @foreach ($stocks as $day => $stock) --}}
    
    <thead>
    
    
      {{-- <tr>
        <th colspan="4" class="text-center">{{ Carbon\Carbon::parse($day)->addDay()->format('M d Y') }} ({{ $stock->count() }}) </th>
    </tr> --}}
    <tr>
      
      <th>#</th>
      <th>Drug</th>
      <th>pulled out</th>
      <th>Remaining</th>
    </tr>
    
    </thead>
    
    <?php $ctr=1;?>
    
          @foreach ($stocks as $item)
         <tr>
           <td>{{ $ctr++ }}</td>
            <td>{{ $item->name }}</td>
            <td>{{ $item->pulled_out }}</td>
            <td>{{ $item->quantity }}</td>
        </tr>
          {{-- @endforeach --}}
        
            
        @endforeach
      
      </table>
    </div>
    <div class="col-md-6">
      <p class="text-center"><b>Medicine Transactions</b></p>
      <table class="table table-condensed table-bordered table-hover">
    
        @foreach ($transactions as $day => $transaction)
    
    <thead>
    
    
      <tr>
        <th colspan="4" class="text-center">{{ Carbon\Carbon::parse($day)->addDay()->format('M d, Y') }} ({{ $transaction->count() }}) </th>
    </tr>
    <tr>
      
      <th>#</th>
      <th>Drug</th>
      <th>quantity</th>
      <th>Description</th>
    </tr>
    
    </thead>
    
    <?php $ctr=1;?>
    
          @foreach ($transaction as $item)
         <tr>
           <td>{{ $ctr++ }}</td>
            <td>{{ $item->name }}</td>
            <td>{{ $item->pulled_out }}</td>
            <td>{{ $item->desc }}</td>
        </tr>
          @endforeach
        
            
        @endforeach
      
      </table>
    </div>
  </div>
</div>
 
@endsection

@section('js-scripts')

@endsection