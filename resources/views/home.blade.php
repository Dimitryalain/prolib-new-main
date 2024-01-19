{{--@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

--}}

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Profession libérale</title>

    <!-- Custom fonts for this template-->
    <link href="/assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="/assets/css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" style="background:#00B98E;" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="">
                <div class="sidebar-brand-icon rotate-n-15">
                </div>
                <div class="sidebar-brand-text mx-3">
                    @foreach(auth()->user()->roles as $role)
                        {{$role->nom}}
                    @endforeach
                </div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <li class="nav-item active">
                <a class="nav-link" href="{{route("tdb")}}">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Tableau de Bord</span></a>
            </li>

             <li class="nav-item">
                <a class="nav-link" href="{{route("demande")}}">
                    <i class="fas fa-swatchbook"></i>
                    <span>Demande de RDV</span></a>
            </li>
            
             @can("Administrateur")
             <li class="nav-item">
                <a class="nav-link" href="{{route("audit")}}">
                    <i class="fas fa-eye"></i>
                    <span>Piste d'audit</span></a>
            </li>
            @endcan
    
            <li class="nav-item">
                <a class="nav-link" href="{{route("suivi")}}">
                    <i class="fas fa-calendar"></i>
                    <span>Suivi des RDV</span></a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="{{route("professionnel")}}">
                    <i class="fas fa-user-tie"></i>
                    <span>Professionnels</span></a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="{{route("clients")}}">
                    <i class="fas fa-fw fa-users"></i>
                    <span>Clients</span></a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="{{route("avis")}}">
                    <i class="fas fa-question"></i>
                    <span>Avis clientele</span></a>
            </li>
             @can("Administrateur")
            <li class="nav-item">
                <a class="nav-link" href="{{route("employe")}}">
                    <i class="fas fa-user-nurse"></i>
                    <span>Employés</span></a>
            </li>
            @endcan
            @can("Administrateur")
            <li class="nav-item">
                <a class="nav-link" href="{{route("notations")}}">
                    <i class="fas fa-pen"></i>
                    <span>Notation</span></a>
            </li>
            @endcan
        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Search -->
                    

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                                aria-labelledby="searchDropdown">
                                <form class="form-inline mr-auto w-100 navbar-search">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-light border-0 small"
                                            placeholder="Search for..." aria-label="Search"
                                            aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{ Auth::user()->nom }} {{ Auth::user()->prenom }}</span>
                                <img class="img-profile rounded-circle"
                                    src="{{ asset($user->photo) }}">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="{{ route('profil') }}">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profil
                                </a>
                                <a class="dropdown-item" href="{{ route('changerMotPasse') }}">
                                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Changer mot de passe
                                </a>
                    
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="{{ route('logout') }}"onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                                <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                        Déconnexion
                                </a>                        
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                </form>
                            </div>
                        </li>
                    </ul>
                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Tableau de Bord</h1>
                        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                                class="fas fa-download fa-sm text-white-50"></i> Générer un rapport</a>
                    </div>

                    <!-- Content Row -->
                    <div class="row">

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                Rendez-vous</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $countRDV }}</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-calendar fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                Clients</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $countVisiteur }}</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-users fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-info shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">PROFESSIONELS
                                            </div>
                                            <div class="row no-gutters align-items-center">
                                                <div class="col-auto">
                                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">{{$CountProfessionnels}}</div>
                                                </div>
                                                
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-user-tie fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Pending Requests Card Example -->
                         <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-warning shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                                MOYENNE DES NOTES PAR RDV</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ number_format($moyenneNotes, 1, '.', '') }} / 5</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-pen fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Content Row -->

                    <div class="row">

                        <!-- Area Chart -->
                        <div class="col-xl-7 col-lg-7">
                            <div class="card shadow mb-4">
                                <!-- Card Header - Dropdown -->
                                <div
                                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Nombre de rendez-vous par mois</h6>
                                    <div class="dropdown no-arrow">
                                        
                                    </div>
                                </div>
                                <!-- Card Body -->
                                <div class="card-body">
                                    <div class="chart-area">
                                        <div class="chart-container">
                                            <canvas id="rdvChart"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Pie Chart -->
                        <div class="col-xl-5 col-lg-5">
                            <div class="card shadow mb-4">
                                <!-- Card Header - Dropdown -->
                                <div
                                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Répartition des rendez-vous par catégorie</h6>
                                </div>
                                <!-- Card Body -->
                               <div class="card-body">
                                <div class="chart-area">
                                    <canvas id="statusChart"></canvas>
                                </div>
                              </div>
                            </div>
                        </div>
                    </div>

                    <!-- Content Row -->
                    <div class="row">

                        <!-- Content Column -->
                        <div class="col-lg-12 mb-4">

                            <!-- Project Card Example -->
                            <div class="card-body">
                            @foreach ($professions as $profession)
                                @php
                                    $colorClass = 'bg-primary'; // Par défaut, utilisez une couleur Bootstrap
                                    switch ($profession->profession) {
                                        case 'Avocat':
                                            $colorClass = 'bg-danger';
                                            break;
                                        case 'Architecte':
                                            $colorClass = 'bg-warning';
                                            break;
                                        case 'Expert Comptable':
                                            $colorClass = 'bg-secondary';
                                            break;
                                        case 'Géomètre':
                                            $colorClass = 'bg-success';
                                            break;
                                        case 'Coach':
                                            $colorClass = 'bg-infos';
                                            break;
                                        case 'Ingenieur Conseil':
                                            $colorClass = 'bg-dark';
                                            break;
                                        case 'Notaire':
                                            $colorClass = 'bg-body';
                                            break;
                                    }
                                @endphp

                                <h4 class="small font-weight-bold">{{ $profession->profession }}<span class="float-right">{{ $profession->percentage }}%</span></h4>
                                <div class="progress">
                                    <div class="progress-bar {{ $colorClass }}" role="progressbar" style="width: {{ $profession->percentage }}%" aria-valuenow="{{ $profession->percentage }}" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            @endforeach
                        </div>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Tous les droits sont réservés &copy; e-thik 2023</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="login.html">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="/assets/vendor/jquery/jquery.min.js"></script>
    <script src="/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="myapp/assets/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="/assets/js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="/assets/vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="/assets/js/demo/chart-area-demo.js"></script>
    <script src="/assets/js/demo/chart-pie-demo.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<!-- Insérez ce code à l'endroit où vous souhaitez afficher la courbe, par exemple, après la fin de votre tableau ou ailleurs dans votre vue -->
<script>
    // Récupérez les données du contrôleur
    var months = @json($months);
    var counts = @json($counts);

    var ctx = document.getElementById('rdvChart').getContext('2d');

    var myAreaChart = new Chart(ctx, {
        type: 'line', // Utilisez 'line' pour une courbe lissée
        data: {
            labels: months,
            datasets: [{
                label: 'Nombre de RDV',
                data: counts,
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1,
                tension: 0.4 // Ajustez cette valeur pour contrôler le lissage de la courbe
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>


<script>
    // Récupérez les données du contrôleur
    var statusCounts = @json($statusCounts);

    // Créez un tableau de couleurs pour correspondre à vos statuts
    var statusColors = {
    0: 'rgba(255, 255, 0, 0.5)',    // en_attente (jaune)
    1: 'rgba(255, 165, 0, 0.5)',    // annulé (orange)
    2: 'rgba(255, 0, 0, 0.5)',       // rejeté (rouge)
    3: 'rgba(173, 216, 230, 0.5)',  // accepté (vert ciel)
    4: 'rgba(0, 128, 0, 0.5)',      // honoré (vert pur)
};
    

    var ctx = document.getElementById('statusChart').getContext('2d');

    var statusData = {
        labels: Object.values(statusCounts).map(item => getStatusLabel(item.statut)),  // Utilisez une fonction pour obtenir les labels
        datasets: [{
            data: Object.values(statusCounts).map(item => item.count),
            backgroundColor: Object.values(statusCounts).map(item => statusColors[item.statut]),
        }]
    };

    var myPieChart = new Chart(ctx, {
        type: 'doughnut',
        data: statusData,
    });

    // Fonction pour obtenir les labels de statut en fonction du code
    function getStatusLabel(statusCode) {
        switch (statusCode) {
            case 0: return 'en_attente';
            case 1: return 'annulé';
            case 2: return 'rejeté';
            case 3: return 'accepté';
            case 4: return 'honoré';
            default: return 'Inconnu';
        }
    }
</script>


</body>

</html>