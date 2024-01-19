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

            <li class="nav-item">
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
                    <span>Avis clientel</span></a>
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
                    <div id="alert-container"></div>

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
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Changer votre mot de passe</h6>
                        </div>
                        <div class="card-body">
                            <form action="{{route('updatePassword')}}" id="change_password_form" method="post">
                                    @csrf
                                    <div class="form-group">
                                        <label for="Actuel_password">Ancien mot de passe</label>
                                        <input type="password" class="form-control" id="Actuel_password" name="Actuel_password" required>
                                    </div>
                                    @if($errors->any('Actuel_password'))
                                        <span class="text-danger">{{ $errors->first('Actuel_password') }}</span>
                                    @endif
                                    <div class="form-group">
                                        <label for="Nouveau_password">Nouveau mot de passe</label>
                                        <input type="password" name="Nouveau_password" class="form-control" id="Nouveau_password" required>
                                    </div>
                                    @if($errors->any('Nouveau_password'))
                                        <span class="text-danger">{{ $errors->first('Nouveau_password') }}</span>
                                    @endif
                                    <div class="form-group">
                                        <label for="Confirm_password">Confirmer mot de passe</label>
                                        <input type="password" name="Confirm_password" class="form-control" id="Confirm_password" required>
                                    </div>
                                    @if($errors->any('Confirm_password'))
                                        <span class="text-danger">{{ $errors->first('Confirm_password') }}</span>
                                    @endif

                                   <center><button type="submit" class="btn btn-primary  userMdpbtn"> Modifier</button></center>
                                </form>

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

</body>

</html>