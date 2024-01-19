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

            <li class="nav-item active">
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

                <!-- Begin Page Content -->
<div class="container-fluid">
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="row">
                <div class="col-md-6">
                    <h6 class="m-0 font-weight-bold text-primary">Liste des professionnels</h6>
                </div>
                <div class="col-md-6 text-right">
                    <a href="{{ route('generePDFProfessionnel') }}" class="d-none d-sm-inline-block btn btn-sm btn-danger shadow-sm"><i
                        class="fas fa-download fa-sm text-white-50"></i> Générer un rapport</a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th style="width:20%;" class="text-center">Nom & Prénom</th>
                            <th style="width:10%;" class="text-center">Adresse</th>
                            <th style="width:10%;" class="text-center">E-mail</th>
                            <th style="width:10%;" class="text-center">Profession</th>
                            <th style="width:10%;" class="text-center">Téléphone</th>
                            <th style="width:10%;" class="text-center">Etat</th>
                            <th style="width:30%;" class="text-center">Action</th>
                        </tr>
                    </thead>
                    @foreach ($professionnels as $professionnel)
                        <tr>
                            <td class="text-center">{{ $professionnel->nom }} {{ $professionnel->prenom }}</td>
                            <td class="text-center">{{ $professionnel->adresse }}</td>
                            <td class="text-center">{{ $professionnel->adresse_email }}</td>
                            <td class="text-center">{{ $professionnel->profession }}</td>
                            <td class="text-center">{{ $professionnel->telephone }}</td>
                            <td class="text-center">
                                @if ($professionnel->action =='0')
                                    <label class="py-2 px-3 badge btn-danger" style="color:#fff;">Désactiver</label>
                                @elseif ($professionnel->action =='1')
                                    <label class="py-2 px-3 badge btn-success" style="color:#fff;">Activer</label>
                                @endif
                            </td>
                            <td class="text-center">
                                <button type="button" class="btn btn-dark" data-toggle="modal" data-target="#professionnelModal{{ $professionnel->id }}">
                                    Voir plus
                                </button>
                                <a class="btn bg-success" href="{{ route('activate-professionnels', $professionnel->id) }}" class="btn btn-link" style="color:#fff;">Activer</a>
                                <a class="btn bg-danger" href="{{ route('deactivate-professionnels', $professionnel->id) }}" class="btn btn-link" style="color:#fff;">Désactiver</a>
                            </td>
                        </tr>

                        <!-- Modal pour ce professionnel spécifique -->
                        <div class="modal fade" id="professionnelModal{{ $professionnel->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLongTitle">Détails du professionnel</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <!-- Affichez les données du professionnel ici -->
                                        <p><strong>Nom :</strong> {{ $professionnel->nom }}</p>
                                        <p><strong>Prénom :</strong> {{ $professionnel->prenom }}</p>
                                        <p><strong>Adresse :</strong> {{ $professionnel->adresse }}</p>
                                        <p><strong>E-mail :</strong> {{ $professionnel->adresse_email }}</p>
                                        <p><strong>Entreprise / Cabinet :</strong> {{ $professionnel->entreprise_cabinet }}</p>
                                        <p><strong>Site web :</strong> {{ $professionnel->site_web }}</p>
                                        <p><strong>Domaine d'expertise :</strong> {{ $professionnel->domaine_expertise }}</p>
                                        <p><strong>Date de début d'exercice :</strong> {{ $professionnel->date_debut_exercice }}</p>
                                        <p><strong>Education / Formation :</strong> {{ $professionnel->education_formation }}</p>
                                        <p><strong>Téléphone :</strong> {{ $professionnel->telephone }}</p>
                                        <p><strong>Profession :</strong> {{ $professionnel->profession }}</p>
                                        <!-- Affichez des champs spécifiques en fonction de la profession -->
                                            @if ($professionnel->profession === 'Avocat')
                                                <p><strong>Spécialité juridique :</strong> {{ $professionnel->specialite_juridique }}</p>
                                                <p><strong>Barreau :</strong> {{ $professionnel->barreau }}</p>
                                                <p><strong>Numéro de licence d'avocat :</strong> {{ $professionnel->numero_licence_avocat }}</p>
                                            @elseif ($professionnel->profession === 'Architecte')
                                                <p><strong>Type de projets :</strong> {{ $professionnel->type_projets }}</p>
                                                <p><strong>Numéro d'inscription à l'ordre des architectes :</strong> {{ $professionnel->numero_inscription_ordre_architectes }}</p>
                                            @elseif ($professionnel->profession === 'Expert Comptable')
                                                <p><strong>Services offerts :</strong> {{ $professionnel->services_offerts }}</p>
                                                <p><strong>Numero agrement :</strong> {{ $professionnel->numero_agrement }}</p>
                                            @elseif ($professionnel->profession === 'Géomètre')
                                                <p><strong>Type de relevés :</strong> {{ $professionnel->type_releves }}</p>
                                                <p><strong>Licence géomètre :</strong> {{ $professionnel->licence_geometre }}</p>
                                            @elseif ($professionnel->profession === 'Coach')
                                                <p><strong>Domaine de coaching :</strong> {{ $professionnel->domaine_coaching }}</p>
                                                <p><strong>Certification coaching :</strong> {{ $professionnel->certification_coaching }}</p>
                                            @elseif ($professionnel->profession === 'Ingenieur Conseil')
                                                <p><strong>Domaine ingenierie :</strong> {{ $professionnel->domaine_ingenierie }}</p>
                                                <p><strong>Certifications d'accreditations :</strong> {{ $professionnel->certifications_accreditations }}</p>
                                            @elseif ($professionnel->profession === 'Notaire')
                                                <p><strong>Spécialité notariale :</strong> {{ $professionnel->specialite_notariale }}</p>
                                                <p><strong>Numero notaire :</strong> {{ $professionnel->numero_notaire }}</p>
                                            @endif
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-dark" data-dismiss="modal">Fermer</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </table>
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

</body>

</html>