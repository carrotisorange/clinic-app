@extends('layouts.main')

@section('title','Inventory of the stocks')

@section('content')
<div class="content">
  <table class="table table-condensed table-bordered table-hover">
    <thead>
    <tr>
    
      <th>#</th>
      <th>Drug</th>
      <th>Quantity</th>
      <th>Description</th>
    </tr>
  </thead>
    @foreach ($stocks as $day => $stock)


  <tr>
    <th colspan="4" class="text-center">{{ Carbon\Carbon::parse($day)->addDay()->format('M d Y') }} ({{ $stock->count() }}) </th>
</tr>
<?php $ctr=1;?>

      @foreach ($stock as $item)
     <tr>
       <td>{{ $ctr++ }}</td>
        <td>{{ $item->name }}</td>
        <td>{{ $item->qty_changed }}</td>
        <td>{{ $item->desc }}</td>
    </tr>
      @endforeach
     
        
    @endforeach
  
  </table>
</div>
 
@endsection

@section('js-scripts')

@endsection