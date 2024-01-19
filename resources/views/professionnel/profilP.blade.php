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
    <link href="../assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="../assets/css/sb-admin-2.min.css" rel="stylesheet">

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
            
            <li class="nav-item">
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
                                <a class="dropdown-item" href="{{route('changerMotPasseP')}}">
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

        <style>
            img {
                height: 150px;
                width: 150px;
                border: 2px solid #00B98E; /* Bordure verte de 2px */
                border-radius:  2%; /* Pour obtenir un effet de bordure circulaire */
                object-fit: cover;
            }

        </style>

    <!-- Message d'alerte -->
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
        <!-- /Message d'alerte -->
        <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Mon profil</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('update_profilP') }}" method="POST" enctype="multipart/form-data">
                    {!! method_field('PUT') !!}
                    {{ csrf_field() }}
                <div class="">
                    <img src="{{ asset($professionnel->photo) }}">
                </div>
                <br>
                <input type="file" id="photo" name="photo">
                 <br><br>
                 <div class="form-group row">
                        <div class="col-md-6">
                            <label for="nom">Nom :</label>
                            <input type="text" class="form-control" id="nom" name="nom" value="{{ Auth::guard('professionnel')->user()->nom }}">
                        </div>
                        <div class="col-md-6">
                            <label for="prenom">Prénom :</label>
                            <input type="text" class="form-control" id="prenom" name="prenom" value="{{ Auth::guard('professionnel')->user()->prenom }}">
                        </div>
                </div>

                <div class="form-group row">
                        <div class="col-md-6">
                            <label for="adresse">Ville / Commune :</label>
                            <input type="adresse" class="form-control" id="adresse" name="adresse" value="{{ Auth::guard('professionnel')->user()->adresse }}">
                        </div>
                        <div class="col-md-6">
                            <label for="adresse_email">Email :</label>
                            <input type="email" class="form-control" id="adresse_email" name="adresse_email" value="{{ Auth::guard('professionnel')->user()->adresse_email }}">
                        </div>
                </div>

                <div class="form-group row">
                        <div class="col-md-6">
                            <label for="entreprise_cabinet">Entreprise / Cabinet :</label>
                            <input type="text" class="form-control" id="entreprise_cabinet" name="entreprise_cabinet" value="{{ Auth::guard('professionnel')->user()->entreprise_cabinet }}">
                        </div>
                        <div class="col-md-6">
                            <label for="site_web">Site web :</label>
                            <input type="text" class="form-control" id="site_web" name="site_web" value="{{ Auth::guard('professionnel')->user()->site_web }}">
                        </div>
                </div>

                <div class="form-group row">
                        <div class="col-md-6">
                            <label for="domaine_expertise">Domaine d'expertise :</label>
                            <input type="text" class="form-control" id="domaine_expertise" name="domaine_expertise" value="{{ Auth::guard('professionnel')->user()->domaine_expertise }}">
                        </div>
                        <div class="col-md-6">
                            <label for="date_debut_exercice">Date de debut exercice :</label>
                            <input type="date" class="form-control" id="date_debut_exercice" name="date_debut_exercice" value="{{ Auth::guard('professionnel')->user()->date_debut_exercice }}">
                        </div>
                </div>

                <div class="form-group row">
            
                        <div class="col-md-6">
                            <label for="education_formation">Education / Formation :</label>
                            <input type="text" class="form-control" id="education_formation" name="education_formation" value="{{ Auth::guard('professionnel')->user()->education_formation }}">
                        </div>
                        <div class="col-md-6">
                            <label for="profession">Profession :</label>
                            <input type="text" class="form-control" id="profession" name="profession" value="{{ Auth::guard('professionnel')->user()->profession }}">
                        </div>
                </div>

                <div class="form-group row">
            
                        <div class="col-md-6">
                            <label for="telephone">Téléphone:</label>
                            <input type="tel" class="form-control" id="telephone" name="telephone" value="{{ Auth::guard('professionnel')->user()->telephone }}">
                        </div>
                        <div class="col-md-6">
                            <label for="description">Description :</label>
                            <textarea class="form-control" id="description" name="description" rows="4">{{ Auth::guard('professionnel')->user()->description }}</textarea>
                        </div>
                        @if(Auth::guard('professionnel')->user()->profession == 'Avocat')
                        <div class="form-group row">
                            <div class="col-md-6">
                                <label for="specialite_juridique">Spécialité Juridique :</label>
                                <input type="text" class="form-control" id="specialite_juridique" name="specialite_juridique" value="{{ Auth::guard('professionnel')->user()->specialite_juridique }}" required>
                            </div>
                            <div class="col-md-6">
                                <label for="barreau">Barreau :</label>
                                <input type="text" class="form-control" id="barreau" name="barreau" value="{{ Auth::guard('professionnel')->user()->barreau }}">
                            </div>
                            <div class="col-md-6">
                                <label for="numero_licence_avocat">Numéro de Licence Avocat :</label>
                                <input type="text" class="form-control" id="numero_licence_avocat" name="numero_licence_avocat" value="{{ Auth::guard('professionnel')->user()->numero_licence_avocat }}" required>
                            </div>
                        </div>
                    @elseif(Auth::guard('professionnel')->user()->profession == 'Architecte')
                        <!-- Fields for Architecte -->
                        <div class="col-md-6">
                            <label for="type_projets">Type de Projets :</label>
                            <input type="text" class="form-control" id="type_projets" name="type_projets" value="{{ Auth::guard('professionnel')->user()->type_projets }}" required>
                        </div>
                        <div class="col-md-6">
                            <label for="numero_inscription_ordre_architectes">Numéro d'Inscription à l'Ordre des Architectes :</label>
                            <input type="text" class="form-control" id="numero_inscription_ordre_architectes" name="numero_inscription_ordre_architectes" value="{{ Auth::guard('professionnel')->user()->numero_inscription_ordre_architectes }}" required>
                        </div>
                    @elseif(Auth::guard('professionnel')->user()->profession == 'Expert Comptable')
                        <!-- Fields for Expert Comptable -->
                        <div class="col-md-6">
                            <label for="services_offerts">Services offerts:</label>
                            <input type="text" class="form-control" id="services_offerts" name="services_offerts" value="{{ Auth::guard('professionnel')->user()->services_offerts }}" required>
                        </div>
                        <div class="col-md-6">
                            <label for="numero_agrement">Numéro d'agrement:</label>
                            <input type="text" class="form-control" id="numero_agrement" name="numero_agrement" value="{{ Auth::guard('professionnel')->user()->numero_agrement }}" required>
                        </div>
                    @elseif(Auth::guard('professionnel')->user()->profession == 'Géomètre')
                        <!-- Fields for Géomètre -->
                        <div class="col-md-6">
                            <label for="type_releves">Type de Projets :</label>
                            <input type="text" class="form-control" id="type_releves" name="type_releves" value="{{ Auth::guard('professionnel')->user()->type_releves }}" required>
                        </div>
                        <div class="col-md-6">
                            <label for="licence_geometre">Licence du Géomètre :</label>
                            <input type="text" class="form-control" id="licence_geometre" name="licence_geometre" value="{{ Auth::guard('professionnel')->user()->licence_geometre }}" required>
                        </div>
                    @elseif(Auth::guard('professionnel')->user()->profession == 'Coach')
                        <!-- Fields for Coach -->
                        <div class="col-md-6">
                            <label for="domaine_coaching">Domaine de coaching:</label>
                            <input type="text" class="form-control" id="domaine_coaching" name="domaine_coaching" value="{{ Auth::guard('professionnel')->user()->domaine_coaching }}" required>
                        </div>
                        <div class="col-md-6">
                            <label for="certification_coaching">Certification du coaching:</label>
                            <input type="text" class="form-control" id="certification_coaching" name="certification_coaching" value="{{ Auth::guard('professionnel')->user()->certification_coaching }}" required>
                        </div>
                    @elseif(Auth::guard('professionnel')->user()->profession == 'Ingenieur Conseil')
                        <!-- Fields for Ingenieur Conseil -->
                        <div class="col-md-6">
                            <label for="domaine_ingenierie">Domaine d'ingenierie :</label>
                            <input type="text" class="form-control" id="domaine_ingenierie" name="domaine_ingenierie" value="{{ Auth::guard('professionnel')->user()->domaine_ingenierie }}" required>
                        </div>
                        <div class="col-md-6">
                            <label for="certifications_accreditations">Certification d(accreditation):</label>
                            <input type="text" class="form-control" id="certifications_accreditations" name="certifications_accreditations" value="{{ Auth::guard('professionnel')->user()->certifications_accreditations }}" required>
                        </div>

                        @elseif(Auth::guard('professionnel')->user()->profession == 'Dentiste')
                        <!-- Fields for Ingenieur Conseil -->
                        <div class="col-md-6">
                            <label for="licence">Numéro de licence :</label>
                            <input type="text" class="form-control" id="licence" name="licence" value="{{ Auth::guard('professionnel')->user()->domaine_ingenierie }}" required>
                        </div>
                        <div class="col-md-6">
                            <label for="annees_etudes">Nombre d'année d'étude:</label>
                            <input type="number" class="form-control" id="annees_etudes" name="annees_etudes" value="{{ Auth::guard('professionnel')->user()->certifications_accreditations }}" required>
                        </div>

                        @elseif(Auth::guard('professionnel')->user()->profession == 'Huissier')
                        <!-- Fields for Ingenieur Conseil -->
                        <div class="col-md-6">
                            <label for="num_conseil">Numéro du conseil :</label>
                            <input type="text" class="form-control" id="num_conseil" name="num_conseil" value="{{ Auth::guard('professionnel')->user()->domaine_ingenierie }}" required>
                        </div>
                        <div class="col-md-6">
                            <label for="tribunal">Tribunal:</label>
                            <input type="text" class="form-control" id="tribunal" name="tribunal" value="{{ Auth::guard('professionnel')->user()->certifications_accreditations }}" required>
                        </div>

                        @elseif(Auth::guard('professionnel')->user()->profession == 'Orthophoniste')
                        <!-- Fields for Ingenieur Conseil -->
                        <div class="col-md-6">
                            <label for="certification">Certification:</label>
                            <input type="text" class="form-control" id="certification" name="certification" value="{{ Auth::guard('professionnel')->user()->domaine_ingenierie }}" required>
                        </div>
                        <div class="col-md-6">
                            <label for="type_patientele">Type de type_patient:</label>
                            <input type="text" class="form-control" id="type_patientele" name="type_patientele" value="{{ Auth::guard('professionnel')->user()->certifications_accreditations }}" required>
                        </div>


                    @elseif(Auth::guard('professionnel')->user()->profession == 'Notaire')
                        <!-- Fields for Notaire -->
                        <div class="col-md-6">
                            <label for="specialite_notariale">Spécialité du notaire:</label>
                            <input type="text" class="form-control" id="specialite_notariale" name="specialite_notariale" value="{{ Auth::guard('professionnel')->user()->specialite_notariale }}" required>
                        </div>
                        <div class="col-md-6">
                            <label for="numero_notaire">Numéro du notaire:</label>
                            <input type="text" class="form-control" id="numero_notaire" name="numero_notaire" value="{{ Auth::guard('professionnel')->user()->numero_notaire }}" required>
                        </div>
                    @endif
                        </div>
                        </div>
                </div>
                <center><button type="submit" class="btn btn-primary">Enregistrer les modifications</button></center>
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