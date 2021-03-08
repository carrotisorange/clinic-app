<div class="sidebar" data-color="white" data-active-color="primary">
    <div class="logo">
      {{--<a href="/dashboard" class="simple-text logo-mini">
        <div class="logo-image-small">
           <img src="{{ asset('/paper-dashboard-master/assets/img/logo-small.png') }}"> 
        </div>
         <p>CT</p> 
      </a>
      --}}
      <a href="/dashboard" class="simple-text logo-normal">

          <p class="text-right text-dark">CLINIC APP &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img width=40px" src="{{ asset('/paper-dashboard-master/assets/img/sudipenrhulogo.png') }}" /></p>
   
      </a>
    </div>
    <div class="sidebar-wrapper">
      <ul class="nav">
        @if(Session::get('selected') === 'dashboard')
        <li class="active">
          <a href="/dashboard">
            <i class="fas fa-tachometer-alt"></i>
            <p>Dashboard</p>
          </a>
        </li>
        @else
        <li>
          <a href="/dashboard">
            <i class="fas fa-tachometer-alt"></i>
            <p>Dashboard</p>
          </a>
        </li>
        @endif
        
        @if(Session::get('selected') === 'patients-record')
        <li class="active">
          <a href="/patients-record">
            <i class="fas fa-user-injured"></i>
            <p>Patients Record</p>
          </a>
        </li>
        @else
        <li>
          <a href="/patients-record">
            <i class="fas fa-user-injured"></i>
            <p>Patients Record</p>
          </a>
        </li>
        @endif

        @if(Session::get('selected') === 'medicine-inventory')
        <li class="active">
          <a href="/medicine-inventory">
            <i class="fas fa-prescription"></i>
            <p>Medicine Inventory</p>
          </a>
        </li>
        @else
        <li>
          <a href="/medicine-inventory">
            <i class="fas fa-prescription"></i>
            <p>Medicine Inventory</p>
          </a>
        </li>
        @endif

        @if(Session::get('selected') === 'doctors')
        <li class="active">
          <a href="/doctors">
            <i class="fas fa-user-md"></i>
            <p>Doctors</p>
          </a>
        </li>
        @else
        <li>
          <a href="/doctors">
            <i class="fas fa-user-md"></i>
            <p>Doctors</p>
          </a>
        </li>
        @endif
        
        @if(Session::get('selected') === 'patients-appointment')
        <li class="active">
          <a href="/patients-appointments">
            <i class="far fa-calendar-check"></i>
            <p>Patients Appointments</p>
          </a>
        </li>
        @else
        <li>
          <a href="/patients-appointments">
            <i class="far fa-calendar-check"></i>
            <p>Patients Appointments</p>
          </a>
        </li>
        @endif
        
              
        @if(Session::get('selected') === 'manage-accounts')
        <li class="active">
          <a href="/manage-accounts">
            <i class="nc-icon nc-single-02"></i>
            <p>Manage Users</p>
          </a>
        </li>
        @else
        <li>
          <a href="/manage-accounts">
            <i class="nc-icon nc-single-02"></i>
            <p>Manage Users</p>
          </a>
        </li>
        @endif
       

      </ul>
    </div>
  </div>