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
                        <a href="{{ route("welcome") }}" class="nav-item nav-link ">Accueil</a>
                        <a href="{{ route("contact") }}" class="nav-item nav-link active">Nous contacter</a>
                        <div class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Se connecter</a>
                            <div class="dropdown-menu rounded-0 m-0">
                                <a href="" class="dropdown-item">Je suis un professionel</a>
                                <a href="{{route("login-visiteur")}}" class="dropdown-item">Je suis un Client</a>
                            </div>
                        </div>
                    </div>
                </div>
            </nav>
        </div>
        <!-- Navbar End -->

                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

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


        <!-- Contact Start -->
        <div class="container-xxl py-5">
            <div class="container">
                <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">
                    <h1 class="mb-3">Nous contactez</h1>
                    <p>Nous serions ravis d'avoir de vos nouvelles ! Si vous avez des questions, des commentaires ou si vous souhaitez en savoir plus sur nos services, n'hésitez pas à nous contacter. Notre équipe est là pour vous aider et répondre à toutes vos demandes. Remplissez le formulaire de contact ci-dessous et nous vous répondrons dans les plus brefs délais. Nous sommes impatients d'échanger avec vous !</p>
                </div>
                <div class="row g-4">
                    <div class="col-12">
                        <div class="row gy-4">
                            <div class="col-md-6 col-lg-4 wow fadeIn" data-wow-delay="0.1s">
                                <div class="bg-light rounded p-3">
                                    <div class="d-flex align-items-center bg-white rounded p-3" style="border: 1px dashed rgba(0, 185, 142, .3)">
                                        <div class="icon me-3" style="width: 45px; height: 45px;">
                                            <i class="fa fa-map-marker-alt text-primary"></i>
                                        </div>
                                        <span>Riviera synacass-ci, Abidjan, Côte d'Ivoire</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-4 wow fadeIn" data-wow-delay="0.3s">
                                <div class="bg-light rounded p-3">
                                    <div class="d-flex align-items-center bg-white rounded p-3" style="border: 1px dashed rgba(0, 185, 142, .3)">
                                        <div class="icon me-3" style="width: 45px; height: 45px;">
                                            <i class="fa fa-envelope-open text-primary"></i>
                                        </div>
                                        <span>info@e-thik.net</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-4 wow fadeIn" data-wow-delay="0.5s">
                                <div class="bg-light rounded p-3">
                                    <div class="d-flex align-items-center bg-white rounded p-3" style="border: 1px dashed rgba(0, 185, 142, .3)">
                                        <div class="icon me-3" style="width: 45px; height: 45px;">
                                            <i class="fa fa-phone-alt text-primary"></i>
                                        </div>
                                        <span>+225 05 85 00 03 00</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                        <iframe class="position-relative rounded w-100 h-100"
                            src="https://www.google.com/maps?q=Cocody+Riviera+Synacass-ci,+Abidjan,+C%C3%B4te+d'Ivoire&output=embed"
                            frameborder="0" style="min-height: 400px; border:0;" allowfullscreen="" aria-hidden="false"
                            tabindex="0"></iframe>

                    </div>
                    <div class="col-md-6">
                        <div class="wow fadeInUp" data-wow-delay="0.5s">
                            <center><h1 class="mb-4">Formulaire</h1></center>
                            <form action="{{ route('avis.store') }}" method="post">
                                @csrf
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <div class="form-floating">
                                            <input type="text" class="form-control" id="name" name="nom" placeholder="Votre nom" required>
                                            <label for="name">votre nom</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-floating">
                                            <input type="email" class="form-control" id="email" name="email" placeholder="Votre e-mail" required>
                                            <label for="email">Votre e-mail</label>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-floating">
                                            <input type="text" class="form-control" id="subject" name="sujet" placeholder="Sujet" required>
                                            <label for="subject">Sujet</label>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-floating">
                                            <textarea class="form-control" placeholder="Leave a message here" id="message" name="message" style="height: 150px"></textarea>
                                            <label for="message">Message</label>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <button class="btn btn-primary w-100 py-3" type="submit">Envoyer le message</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Contact End -->


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
</body>

</html>