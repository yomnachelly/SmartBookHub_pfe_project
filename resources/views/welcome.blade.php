<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Accueil - {{ config('app.name') }}</title>
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        .hero-section {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 80vh;
            display: flex;
            align-items: center;
            color: white;
            padding: 100px 0;
        }
        
        .feature-card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
            margin-bottom: 30px;
        }
        
        .feature-card:hover {
            transform: translateY(-10px);
        }
        
        .feature-icon {
            font-size: 3rem;
            margin-bottom: 20px;
            color: #667eea;
        }
        
        .btn-custom {
            background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
            border: none;
            color: white;
            padding: 12px 30px;
            border-radius: 50px;
            font-weight: bold;
            transition: all 0.3s ease;
        }
        
        .btn-custom:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
            color: white;
        }
        
        .navbar {
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body>
    <!-- Inclure l'entête -->
    @include('layouts.header')
    
    <!-- Section Hero -->
    <section class="hero-section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <h1 class="display-4 fw-bold mb-4">
                        Bienvenue sur <span class="text-warning">{{ config('app.name') }}</span>
                    </h1>
                    <p class="lead mb-4">
                        Une application moderne développée avec Laravel et Bootstrap. 
                        Gérez vos projets, collaborez avec votre équipe et boostez votre productivité.
                    </p>
                    
                    <div class="d-flex gap-3">
                        @auth
                            @if(Auth::user()->role === 'admin')
                                <a href="{{ route('admin.dashboard') }}" class="btn btn-warning btn-lg btn-custom">
                                    <i class="fas fa-tachometer-alt me-2"></i>
                                    Dashboard Admin
                                </a>
                            @elseif(Auth::user()->role === 'client')
                                <a href="{{ route('client.dashboard') }}" class="btn btn-warning btn-lg btn-custom">
                                    <i class="fas fa-tachometer-alt me-2"></i>
                                    Mon Espace
                                </a>
                            @endif
                        @else
                            <a href="{{ route('login') }}" class="btn btn-light btn-lg">
                                <i class="fas fa-sign-in-alt me-2"></i>
                                Se connecter
                            </a>
                            <a href="{{ route('register') }}" class="btn btn-warning btn-lg">
                                <i class="fas fa-user-plus me-2"></i>
                                S'inscrire
                            </a>
                        @endauth
                    </div>
                </div>
                <div class="col-lg-6 text-center">
                    <img src="https://via.placeholder.com/500x400/667eea/ffffff?text=Laravel+Bootstrap" 
                         alt="Illustration" 
                         class="img-fluid rounded shadow-lg">
                </div>
            </div>
        </div>
    </section>
    
    <!-- Features Section -->
    <section class="py-5">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="fw-bold">Fonctionnalités Principales</h2>
                <p class="text-muted">Découvrez tout ce que notre plateforme offre</p>
            </div>
            
            <div class="row">
                <div class="col-md-4">
                    <div class="card feature-card text-center p-4">
                        <div class="feature-icon">
                            <i class="fas fa-shield-alt"></i>
                        </div>
                        <h4>Sécurité</h4>
                        <p class="text-muted">
                            Authentification sécurisée avec Breeze et protection des données.
                        </p>
                    </div>
                </div>
                
                <div class="col-md-4">
                    <div class="card feature-card text-center p-4">
                        <div class="feature-icon">
                            <i class="fas fa-bolt"></i>
                        </div>
                        <h4>Performance</h4>
                        <p class="text-muted">
                            Application rapide et optimisée avec Laravel et Bootstrap 5.
                        </p>
                    </div>
                </div>
                
                <div class="col-md-4">
                    <div class="card feature-card text-center p-4">
                        <div class="feature-icon">
                            <i class="fas fa-mobile-alt"></i>
                        </div>
                        <h4>Responsive</h4>
                        <p class="text-muted">
                            Design adaptatif qui fonctionne sur tous les appareils.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <!-- Footer -->
    <footer class="bg-dark text-white py-4">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h5>{{ config('app.name') }}</h5>
                    <p>Application développée avec Laravel et Bootstrap</p>
                </div>
                <div class="col-md-6 text-md-end">
                    <p class="mb-0">&copy; {{ date('Y') }} {{ config('app.name') }}. Tous droits réservés.</p>
                </div>
            </div>
        </div>
    </footer>
    
    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Scripts supplémentaires si besoin -->
    @stack('scripts')
</body>
</html>