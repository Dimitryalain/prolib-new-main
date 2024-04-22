<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

   <title>Profession libérale</title>

    <!-- Custom fonts for this template -->
    <link href="../assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="../assets/css/sb-admin-2.min.css" rel="stylesheet">

    <!-- Custom styles for this page -->
    <link href="../assets/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.css" />
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
                    {{ Auth::guard('professionnel')->user()->profession }}
                </div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <li class="nav-item">
                <a class="nav-link" href="{{route('professionnels')}}">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Tableau de Bord</span></a>
            </li>

             <li class="nav-item">
                <a class="nav-link" href="{{route('clientsP')}}">
                    <i class="fas fa-fw fa-users"></i>
                    <span>Mes clients</span></a>
            </li>
            
            <li class="nav-item active">
                <a class="nav-link" href="{{route('planifieP')}}">
                    <i class="fas fa-calendar"></i>
                    <span>Planifié des rendez-vous</span></a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="{{route('suiviP')}}">
                    <i class="fas fa-eye"></i>
                    <span>Suivi des rendez-vous</span></a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="{{route('paiementP')}}">
                    <i class="fas fa-credit-card"></i>
                    <span>Faire un paiement</span></a>
            </li>
                         
        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <form class="form-inline">
                        <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                            <i class="fa fa-bars"></i>
                        </button>
                    </form>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{ Auth::guard('professionnel')->user()->nom }} {{ Auth::guard('professionnel')->user()->prenom }} </span>
                                <img class="img-profile rounded-circle"
                                    src="{{ asset($professionnel->photo) }}">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="{{route('profilP')}}">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profil
                                </a>
                                <a class="dropdown-item" href="{{ route('changerMotPasseP') }}">
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

                    
                    @if(Session::has('success'))
                        <div class="alert alert-success">
                            {{ Session::get('success') }}
                        </div>
                    @endif

                    @if(Session::has('error'))
                        <div class="alert alert-danger">
                            {{ Session::get('error') }}
                        </div>
                    @endif
                <!-- Modal -->
                <div class="modal fade" id="emploisModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Mon planning</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form id="emploiForm" action="{{ route('emploi.sauvegarder') }}" method="POST">
                                    @csrf
                                    <label for="heure_debut">Heure de début :</label>
                                    <input type="time" class="form-control" name="heure_debut" id="heure_debut" required>
                                    <label for="heure_fin">Heure de fin :</label>
                                    <input type="time" class="form-control" name="heure_fin" id="heure_fin" required>
                                    <input type="hidden" name="date_jour" id="date_jour"><br>
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                                    <button type="submit" class="btn btn-primary" id="validerEmploi">Valider</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- fin modal -->
                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <div class="row">
                                <div class="col-md-6">
                                    <h6 class="m-0 font-weight-bold text-primary">Mon planning</h6>
                                </div>
                                <div class="col-md-6 text-right">
                                    
                                </div>
                            </div>
                    </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                
                                    <div id="calendar"></div>

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
    <script src="../assets/vendor/jquery/jquery.min.js"></script>
    <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="../assets/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="../assets/js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="../assets/vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="../assets/vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="../assets/js/demo/datatables-demo.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/locale/fr.js"></script>
    

    <script>
        document.addEventListener('DOMContentLoaded', function() {
    var emplois = [
        @foreach($emplois as $emploi)
            @php
                $startDateTime = $emploi->date_jour . ' ' . $emploi->heure_debut;
                $endDateTime = $emploi->date_jour . ' ' . $emploi->heure_fin;
                $description = \Carbon\Carbon::parse($startDateTime)->format('H\hi') . '-' . \Carbon\Carbon::parse($endDateTime)->format('H\hi');
            @endphp
            {
                id: '{{ $emploi->id }}',
                start: '{{ \Carbon\Carbon::parse($startDateTime)->format('Y-m-d\TH:i:s') }}',
                end: '{{ \Carbon\Carbon::parse($endDateTime)->format('Y-m-d\TH:i:s') }}',
                description: '{{ $description }}',
                title: '{{ $emploi->titre }}',
            },
        @endforeach
    ];

    $('#calendar').fullCalendar({
        header: {
            left: 'prev,next today',
            center: 'title',
            right: 'month,agendaWeek,agendaDay'
        },
        events: emplois,
        displayEventTime: true,
        eventRender: function(event, element) {
            element.find('.fc-time').each(function() {
                if ($(this).hasClass('fc-start')) {
                    $(this).find('.fc-time-text').remove();
                } else {
                    $(this).text(event.description);
                    $(this).before('<div class="fc-title">' + event.title + '</div>');
                }
            });
        },
        selectable: true,
        selectHelper: true,
        editable: true,
        select: function(start, end, allDay) {
            $('#date_jour').val(start.format('YYYY-MM-DD'));
            $('#emploisModal').modal('toggle');
        },
        locale: 'fr',
        dayRender: function(date, cell) {
            var today = date.format('YYYY-MM-DD');

            for (var i = 0; i < emplois.length; i++) {
                var event = emplois[i];
                if (today >= event.start && today <= event.end) {
                    cell.css('border-bottom', '2px solid blue');
                    break;
                }
            }
        },
        eventClick: function(calEvent, jsEvent, view) {
            if (confirm("Voulez-vous vraiment supprimer cet événement ?")) {
                $.ajax({
    url: '/supprimer-evenement/' + calEvent.id,
    type: 'DELETE',
    data: {
        _token: '{{ csrf_token() }}'
    },
    success: function(response) {
        $('#calendar').fullCalendar('removeEvents', calEvent.id);
    },
    error: function(xhr, status, error) {
        alert('Erreur lors de la suppression de l\'événement.');
    }
});

            }
        }
    });

    $('#emploiForm').submit(function(event) {
        var heureDebut = $('#heure_debut').val();
        var heureFin = $('#heure_fin').val();

        if (heureFin < heureDebut) {
            event.preventDefault();
            alert('L\'heure de fin doit être supérieure ou égale à l\'heure de début.');
        }
    });
});
    </script>
</body>

</html>