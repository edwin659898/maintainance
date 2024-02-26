<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title>BGF | Maintainance-App</title>
  <link rel="icon" type="img/ico" href="{{asset('/storage/logo.png')}}">

  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
  <meta name="apple-mobile-web-app-capable" content="yes">
  <script src="//ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet">
  <link href="{{asset('css/bootstrap-responsive.min.css')}}" rel="stylesheet">
  <link href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600" rel="stylesheet">
  <link href="{{asset('css/font-awesome.css')}}" rel="stylesheet">
  <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
  <link href="{{asset('css/style.css')}}" rel="stylesheet">
  <link href="{{asset('css/app.css')}}" rel="stylesheet">
  @livewireStyles


</head>

<body class="font-mono">
  <div class="min-h-screen">
    <div class="flex w-full justify-between px-4 py-2 bg-gradient-to-r from-blue-600 via-green-300 to-green-600 text-white">
      <a href="#" class="flex justify-between">
        <span class="logo"><img src="{{asset('/storage/logo.png')}}" alt="Logo Image" height="40" width="40"></span>
        <span class="p-2 text-white"><b>BETTER GLOBE FORESTRY</b> </span>
      </a>
      <div class="flex px-4 mt-2">
        <div class="dropdown"><a href="#" class="dropdown-toggle text-white" data-toggle="dropdown"><i class="icon-user"></i> {{ Auth::user()->name }}</a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                     document.getElementById('logout-form').submit();">
                {{ __('Logout') }} </a>
            </li>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
              @csrf
            </form>
          </ul>
        </div>
      </div>
    </div>
    <!-- /navbar -->
    <div class="subnavbar">
      <div class="subnavbar-inner bg-white">
        <div class="container">
          <ul class="mainnav">
            <li><a href="{{route('home')}}"><i class="icon-dashboard"></i><span>Dashboard</span> </a>
            </li>
            <li class="dropdown"><a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown">
                <i class="icon-medium icon-pencil"></i><span>Prepare Schedule</span> <b class="caret"></b></a>
              <ul class="dropdown-menu">
                <li><a href="{{route('daily.schedule')}}">Daily</a></li>
                <li><a href="{{route('weekly.schedule')}}">Weekly</a></li>
              </ul>
            </li>
            </li>
            <li class="dropdown"><a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown">
                <i class="icon-medium icon-calendar"></i><span>My Schedule</span> <b class="caret"></b></a>
              <ul class="dropdown-menu">
                <li><a href="{{route('daily.plan')}}">Daily</a></li>
                <li><a href="{{route('weekly.plan')}}">Weekly</a></li>
                <li><a href="{{route('hourly.plan')}}">Hourly/KM</a></li>
              </ul>
            </li>
            @if(auth()->user()->role)
            <li class="dropdown"><a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown">
                <i class="icon-list-alt"></i><span>Machines</span> <b class="caret"></b></a>
              <ul class="dropdown-menu">
                <li><a href="{{route('machine')}}">Add Machine</a></li>
                <li><a href="{{route('machine.view')}}">View Machines</a></li>
              </ul>
            </li>
            <li class="dropdown"><a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown">
                <i class="icon-list-alt"></i><span>Maintainance checklist</span> <b class="caret"></b></a>
              <ul class="dropdown-menu">
                <li><a href="{{route('add.list')}}">Add New Checklist</a></li>
                <li><a href="{{route('show.list')}}">View Available Checklists</a></li>
              </ul>
            </li>
            <li><a href="{{route('approve.plan')}}"><i class="icon-medium icon-ok"></i><span>Approve Schedules</span>
              </a></li>
              <li><a href="{{route('report.view')}}"><i class="icon-list-alt "></i><span>Received Reports</span>
              </a></li>
              <li class="dropdown"><a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown">
                <i class="icon-list-alt"></i><span>Reports</span> <b class="caret"></b></a>
              <ul class="dropdown-menu">
                <li><a href="{{route('report.final')}}">Approved Reports</a></li>
                <li><a href="{{route('calendar.nyongoro')}}">Nyongoro Calendar</a></li>
                <li><a href="{{route('calendar.dokolo')}}">Dokolo Calendar</a></li>
                <li><a href="{{route('calendar.kiambere')}}">Kiambere Calendar</a></li>
                <li><a href="{{route('calendar.forks')}}">7 forks Calendar</a></li>
                <li><a href="{{route('calendar.HO')}}">Head Office Calendar</a></li>
              </ul>
            </li>
              @endif
          </ul>
        </div>
        <!-- /container -->
      </div>
      <!-- /subnavbar-inner -->
    </div>
    <!-- /subnavbar -->

    <main class="py-4">
      @yield('content')
    </main>
    <!-- /row -->

    <!-- /container -->

    <!-- /main-inner -->
  </div>
  <!-- /main -->
  <footer class="bg-gradient-to-r from-green-600 via-green-300 to-blue-600 p-3 text-white text-center px-4 py-1">
    Copyright &copy; Better Globe Forestry
  </footer>
  <!-- /footer -->
  <!-- Le javascript
================================================== -->
  <!-- Placed at the end of the document so the pages load faster -->
  @livewireScripts
  @stack('scripts')
  <script src="{{asset('js/jquery-1.7.2.min.js')}}"></script>
  <script src="{{asset('js/bootstrap.js')}}"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.0.1/fullcalendar.min.js"></script>

  <script src="js/base.js"></script>

</body>

</html>