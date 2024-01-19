<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <title>profession libérale</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600&family=Inter:wght@700;800&display=swap" rel="stylesheet">
    
    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/animate/animate.min.css" rel="stylesheet">
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
</head>

<body>
    <div class="container-xxl bg-white p-0">
        <!-- Spinner Start -->
        <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <!-- Spinner End -->


        <!-- Navbar Start -->
        <div class="container-fluid nav-bar bg-transparent">
            <nav class="navbar navbar-expand-lg bg-white navbar-light py-0 px-4">
                <a href="index.html" class="navbar-brand d-flex align-items-center text-center">
                    <div class="icon p-2 me-2">
                        <img class="img-fluid" src="img/icon-deal.png" alt="Icon" style="width: 30px; height: 30px;">
                    </div>
                    <h1 class="m-0 text-primary">Profession libérale</h1>
                </a>
                <button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarCollapse">
                    <div class="navbar-nav ms-auto">
                        <a href="{{ route("welcome") }}" class="nav-item nav-link active">Accueil</a>
                        <a href="{{ route("contact") }}" class="nav-item nav-link">Nous contacter</a>
                        <div class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Se connecter</a>
                            <div class="dropdown-menu rounded-0 m-0">
                                <a href="{{route("login-professionnel")}}" class="dropdown-item">Je suis un professionel</a>
                                <a href="{{route("login-visiteur")}}" class="dropdown-item">Je suis un Client</a>
                            </div>
                        </div>
                    </div>
                </div>
            </nav>
        </div>
        <!-- Navbar End -->

        <!-- Header Start -->
        <div class="container-fluid header bg-white p-0">
            <div class="row g-0 align-items-center flex-column-reverse flex-md-row">
                <div class="col-md-6 p-5 mt-lg-5">
                    <p class="animated fadeIn mb-4 pb-2">Les professions libérales sont des métiers exercés principalement par des individus qui offrent des services intellectuels ou techniques spécialisés. Ces professionnels exercent souvent de manière indépendante et sont généralement soumis à des règlements et à des normes de déontologie professionnelle. 
                        Ils fournissent des conseils, des expertises ou des services personnalisés à leurs clients.</p>
                    
                </div>
                <div class="col-md-6 animated fadeIn">
                    <div class="owl-carousel header-carousel">
                        <div class="owl-carousel-item">
                            <img class="img-fluid" src="img/archi2.jpg" alt="">
                        </div>
                        <div class="owl-carousel-item">
                            <img class="img-fluid" src="img/avocat2.jpg" alt="">
                        </div>
                        <div class="owl-carousel-item">
                            <img class="img-fluid" src="img/coach1.jpg" alt="">
                        </div>
                        <div class="owl-carousel-item">
                            <img class="img-fluid" src="img/coach2.jpg" alt="">
                        </div>
                        <div class="owl-carousel-item">
                            <img class="img-fluid" src="img/compt1.jpg" alt="">
                        </div>
                        <div class="owl-carousel-item">
                            <img class="img-fluid" src="img/geo.jpg" alt="">
                        </div>
                        <div class="owl-carousel-item">
                            <img class="img-fluid" src="img/notaire.jpg" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Header End -->

        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <!-- Search Start -->
        <!-- Vue : recherche-professionel.blade.php -->
        <form action="{{ route('recherche') }}" method="POST">
        @csrf
    <div class="container-fluid bg-primary mb-5 wow fadeIn" data-wow-delay="0.1s" style="padding: 35px;">
        <div class="container">
        <center><h4>TROUVEZ UN RENDEZ-VOUS AVEC UN : <span style="color: #fff;" id="profession">AVOCAT</span></h4></center>
            <div class="row g-2">
                <div class="col-md-10">
                    <div class="row g-2">
                        <div class="col-md-4">
                                <select name="profession" class="form-select border-0 py-3" required>
                                    <option selected disabled>Selectionner une profession</option>
                                    <option value="Avocat">Avocat</option>
                                    <option value="Architecte">Architecte</option>
                                    <option value="Expert">Expert Comptable</option>
                                    <option value="Géomètre">Géomètre</option>
                                    <option value="Coach">Coach</option>
                                    <option value="Ingenieur conseil">Ingenieur conseil</option>
                                    <option value="Notaire">Notaire</option>
                                    <option value="Dentiste">Dentiste</option>
                                    <option value="Huissier">Huissier</option>
                                    <option value="Orthophoniste">Orthophoniste</option>
                                </select>
                        </div>
                        <div class="col-md-8">
                            <input type="text" name="search" class="form-control border-0 py-3" placeholder="Rechercher par nom, commune, ville, quartier" required>
                        </div>
                    </div>
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-dark border-0 w-100 py-3">Rechercher</button>
                </div>
            </div>
        </div>
    </div>
</form>



        <!-- Search End -->


        <!-- Category Start -->
        <div class="container-xxl py-5">
            <div class="container">
                <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">
                    <h1 class="mb-3">Quelques statistiques</h1>
                    
                </div>
                <div class="row g-4">
                    <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.1s">
                        <a class="cat-item d-block bg-light text-center rounded p-3" href="">
                            <div class="rounded p-4">
                                <div class="icon mb-3">
                                    <img class="img-fluid" src="img/icon-apartment.png" alt="Icon">
                                </div>
                                <h6>Professionels</h6>
                                <span>{{ $CountProfessionnels }}</span>
                            </div>
                        </a>
                    </div>
                    
                    
                    <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.1s">
                        <a class="cat-item d-block bg-light text-center rounded p-3" href="">
                            <div class="rounded p-4">
                                <div class="icon mb-3">
                                    <img class="img-fluid" src="img/icon-building.png" alt="Icon">
                                </div>
                                <h6>Clients</h6>
                                <span>{{ $countVisiteur }}</span>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.5s">
                        <a class="cat-item d-block bg-light text-center rounded p-3" href="">
                            <div class="rounded p-4">
                                <div class="icon mb-3">
                                    <img class="img-fluid" src="img/icon-condominium.png" alt="Icon">
                                </div>
                                <h6>Rendez-Vous</h6>
                                <span>{{$countRDV }}</span>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.7s">
                        <a class="cat-item d-block bg-light text-center rounded p-3" href="">
                            <div class="rounded p-4">
                                <div class="icon mb-3">
                                    <img class="img-fluid" src="img/icon-luxury.png" alt="Icon">
                                </div>
                                <h6> Visiteurs</h6>
                                <!-- Afficher le compteur depuis la base de données -->
                                <span>{{ \App\Models\SearchStatistic::value('search_count') }}</span>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <!-- Category End -->        
        <!-- Footer Start -->
        <div class="container-fluid bg-dark text-white-50 footer pt-5 mt-5 wow fadeIn" data-wow-delay="0.1s">
            <div class="container py-5">
                <div class="copyright">
                    <div class="row">
                    <center> 
                        <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                           &copy; <a class="border-bottom" href="#"></a>Tous les droits sont réservés .  
							
							<!--/*** This template is free as long as you keep the footer author’s credit link/attribution link/backlink. If you'd like to use the template without the footer author’s credit link/attribution link/backlink, you can purchase the Credit Removal License from "https://htmlcodex.com/credit-removal". Thank you for your support. ***/-->
							Conçu par <a class="border-bottom" href="https://alainbazan25@gmail.com/">alain bazan /e-thik 2023</a>
                        </div>
                        </center>
                        <div class="col-md-6 text-center text-md-end">
                            <div class="footer-menu">
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Footer End -->


        <!-- Back to Top -->
        <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
    </div>

   <!-- JavaScript Libraries -->
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="lib/wow/wow.min.js"></script>
<script src="lib/easing/easing.min.js"></script>
<script src="lib/waypoints/waypoints.min.js"></script>
<script src="lib/owlcarousel/owl.carousel.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> <!-- Ajout de la bibliothèque Swal -->

<!-- Template Javascript -->
<script src="js/main.js"></script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script>
    // Fonction pour afficher la boîte de dialogue avec la note d'information et les animations personnalisées
    function afficherNoteInformation() {
      Swal.fire({
        icon: 'info',
        title: 'INFORMATION IMPORTANTE !!!', 
        html: "Si vous êtes un nouveau client sur Profession libérale et que vous souhaitez prendre un rendez-vous avec un professionnel, vous devez d\'abord créer un compte avant de pouvoir prendre rendez-vous avec les différents professionnels.",
        showConfirmButton: false,
        allowOutsideClick: true,
        showCloseButton: true,
        showClass: {
          popup: 'animate__animated animate__fadeInDown'
        },
        hideClass: {
          popup: 'animate__animated animate__fadeOutUp'
        }
      });
    }

    // Liste des professions
    const professions = ["AVOCAT", "ARCHITECTE", "EXPERT COMPTABLE", "GEOMETRE", "COACH", "INGENIEUR CONSEIL", "NOTAIRE"];
    const professionElement = document.getElementById("profession");

    let currentIndex = 0;
    let currentText = "";
    let isDeleting = false;

    // Fonction pour changer la profession avec animation
    function changeProfession() {
        const currentProfession = professions[currentIndex];
        if (isDeleting) {
            currentText = currentProfession.substring(0, currentText.length - 1);
        } else {
            currentText = currentProfession.substring(0, currentText.length + 1);
        }

        professionElement.textContent = currentText + "|";

        if (!isDeleting && currentText === currentProfession) {
            // Commencer à effacer après un délai
            isDeleting = true;
            setTimeout(() => {
                isDeleting = false;
                currentIndex = (currentIndex + 1) % professions.length;
            }, 3000);
        } else if (isDeleting && currentText === "") {
            // Passer à la profession suivante après effacement complet
            isDeleting = false;
            currentIndex = (currentIndex + 1) % professions.length;
        }
    }

    // Appeler la fonction au chargement de la page
    window.onload = function () {
        afficherNoteInformation(); // Appeler la fonction pour afficher la boîte de dialogue
        setInterval(changeProfession, 400); // Changer avec animation
    };
</script>

<!-- Placez ce script à la fin de votre page avant la balise </body> -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Récupérer le bouton de recherche et le compteur
        var searchButton = document.querySelector('button[type="submit"]');
        var visitorCount = document.querySelector('#visitorCount');

        // Initialiser le compteur
        var count = 0;

        // Ajouter un gestionnaire d'événements au clic sur le bouton de recherche
        searchButton.addEventListener('click', function () {
            // Incrémenter le compteur
            count++;
            // Mettre à jour le texte du compteur
            visitorCount.textContent = count;
        });
    });
</script>

    
</body>

</html>