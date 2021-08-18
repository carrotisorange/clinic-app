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
            <table class="table table-condensed table-borderless">
            <tr>
                <th>Name: {{ $patient->name }} </th>
           
                <th>Gender: {{ $patient->gender }}</th>
              
                <th>Birthdate: {{ Carbon\Carbon::parse($patient->birthdate)->format('M d, Y') }}</th>
            
            </tr>
            <tr>
                <th>Address: {{ $patient->address }}</th>
                <th></th>
                <th>Father's Name: {{ $patient->fathers_name }}</th>
            </tr>
            <tr>
                <th>PhilHealth: (Y) (N) (NHTS)</th>
                <th></th>
                <th>Mother's Name: {{ $patient->mothers_name }}</th>
            </tr>
            <tr>
                <th>No: (M) (D) (LGU/SPONSORED) (Lifetime) (IPP)</th>
                <th>Education Attainment: {{ $patient->educational_attainment }}</th>
                <th>Civill Status: {{ $patient->civil_status }}</th>
            </tr>
            </table>
           

            </div>
        </div>
        <hr>
       <div class="row">
        <div class="col-md-12">
            @foreach ($appointments as $item)
            <table class="table table-condensed table-borderless">
                <tr>
                    <th>Date: {{ Carbon\Carbon::parse($item->created_at)->format('M d, Y') }}</th>
                    <th>Age: {{ Carbon\Carbon::now()->year-Carbon\Carbon::parse($patient->birthdate)->year }}</th>
                    <th></th>
                    <th>A></th>
                </tr>
                <tr>
                 <th> S> {{ $item->symptoms }}</th>
                </tr>
                <tr>
                    <th></th>
                </tr>
                <tr>
                    <th></th>
                </tr>
                <tr>
                    <th></th>
                </tr>
                <tr>
                    <th>O> Temp={{ $item->temperature }}, Weight={{ $item->weight }}</th>
                </tr>
                <tr>
                    <th>BP={{ $item->blood_pressure }}, Height={{ $item->height }}</th>
                </tr>
                <tr>
                    <th>CR={{ $item->cr }}, RR={{ $item->rr }}</th>
                </tr>
                <tr>
                    <th>BMI={{ $item->bmi }}</th>
                </tr>
                <tr>
                    <th>Findings: {{ $item->desc }}</th>
                </tr>
            </table>
    
              <hr>
            @endforeach
          
        </div>
       </div>
        
   

      
  
    </div>

</body>

</html>
