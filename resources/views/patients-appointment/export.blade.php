<!DOCTYPE html>
<html lang="en">

<head>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <style>
      body {
          font: 7px monospace;
          }
      .table-condensed>thead>tr>th, .table-condensed>tbody>tr>th, .table-condensed>tfoot>tr>th, .table-condensed>thead>tr>td, .table-condensed>tbody>tr>td, .table-condensed>tfoot>tr>td {
      padding: 3px;
      }
    </style>

</head>

<body>

    <!-- End of Topbar -->
    <div class="container-fluid">
        <p class="text-center">REPUBLIC OF THE PHILIPPINES
            <br>PROVINCE OF LA UNION
        </p>
          <h5 class="text-black-50 text-center">MUNICIPALITY OF SUDIPEN</h5>
          <p class="text-center">OFFICE OF THE MUNICIPAL HEALTH OFFICE</p>
      <div class="row">
        <div class="col-md-12">
            <b>Name:</b> {{ $patient->name }}
            <br>
            <b>Gender:</b> {{ $patient->gender }}
            <br>
            <b>Civil Status: </b>{{ $patient->civil_status }}
            <br>
            <b>Birthdate:</b> {{ Carbon\Carbon::parse($patient->birthdate)->format('M d, Y') }}
            <br>
            <b>Educational Attaintment:</b> {{ $patient->educational_attainment }}
            <br>
            <b>Address:</b> {{ $patient->address }}
            <br>
            <b>PhilHealth:</b> (Y) (N)
            <br>
            <b>No:</b> (M) (D) (LGU/SPONSORED) (Lifetime) (IPP)
            <br>
            <b>Father's Name:</b> {{ $patient->fathers_name }}
            <br>
            <b>Mother's Name:</b> {{ $patient->mothers_name }}

            </div>
        </div>
        <hr>
       <div class="row">
        <div class="col-md-12">
            @foreach ($diagnosis as $item)
            <span>Date: {{ Carbon\Carbon::parse($item->created_at)->format('M d, Y') }}, Age: {{ Carbon\Carbon::now()->year-Carbon\Carbon::parse($patient->birthdate)->year }},   A></span> 
            <br>
            <br>
            S> {{ $item->symptoms }}
            <br>
            <br>
            <br>
            <br>
            O> <span>Temp={{ $item->temperature }}, Weight={{ $item->weight }}</span>   
            <br>
            <span>BP={{ $item->blood_pressure }}, Height={{ $item->height }}</span>   
            <br>
            <span>PR=&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;, BMI=&nbsp;&nbsp;&nbsp;&nbsp;</span>
            <br>
            <span>RR=&nbsp;&nbsp;&nbsp;&nbsp;</span>      
              <hr>
            @endforeach
          
        </div>
       </div>
        
   

      
  
    </div>

</body>

</html>
