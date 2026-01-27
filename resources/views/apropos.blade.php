@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-b from-white via-gray-50/30 to-[#01B3BB]/5">
    <!-- Hero Section avec plus de couleur -->
    <section class="relative overflow-hidden pt-32 pb-24 md:pt-40 md:pb-32 bg-gradient-to-br from-[#01B3BB]/10 via-white to-[#FFC62A]/10">
        <!-- Formes décoratives colorées -->
        <div class="absolute top-10 left-1/4 w-96 h-96 bg-[#FFC62A]/20 rounded-full blur-3xl"></div>
        <div class="absolute bottom-10 right-1/4 w-96 h-96 bg-[#01B3BB]/20 rounded-full blur-3xl"></div>
        
        <div class="container mx-auto px-4 relative z-10">
            <div class="max-w-4xl mx-auto text-center">
                <!-- Badge coloré -->
                <div class="inline-flex items-center gap-3 px-5 py-3 bg-gradient-to-r from-[#01B3BB]/10 to-[#FFC62A]/10 backdrop-blur-sm rounded-full border border-white/50 shadow-lg mb-10">
                    <div class="flex items-center gap-2">
                        <div class="w-2 h-2 bg-[#FFC62A] rounded-full animate-pulse"></div>
                        <span class="text-sm font-medium text-gray-700">Notre histoire commence en</span>
                        <span class="font-bold text-[#01B3BB]">2010</span>
                    </div>
                </div>
                
                <h1 class="text-5xl md:text-6xl lg:text-7xl font-bold text-gray-900 mb-8 leading-tight">
                    <span class="block">Plus qu'une librairie,</span>
                    <span class="bg-gradient-to-r from-[#01B3BB] to-[#FFC62A] bg-clip-text text-transparent">
                        un partenaire éducatif
                    </span>
                </h1>
                
                <p class="text-xl md:text-2xl text-gray-700 mb-12 leading-relaxed max-w-3xl mx-auto">
                    Chez Smart Book Hub, nous créons des ponts entre les meilleures ressources 
                    pédagogiques et les apprenants de tous âges, pour une éducation accessible et transformatrice.
                </p>
                
                <!-- Stats avec fond coloré -->
                <div class="inline-flex flex-wrap justify-center gap-6 md:gap-12 bg-white/80 backdrop-blur-sm rounded-2xl p-8 shadow-lg border border-white/50">
                    <div class="text-center">
                        <div class="text-4xl md:text-5xl font-bold bg-gradient-to-r from-[#01B3BB] to-[#01B3BB]/80 bg-clip-text text-transparent mb-2">13+</div>
                        <div class="text-gray-600 text-sm uppercase tracking-wider font-medium">Années d'expérience</div>
                    </div>
                    <div class="text-center">
                        <div class="text-4xl md:text-5xl font-bold bg-gradient-to-r from-[#FFC62A] to-[#FFC62A]/80 bg-clip-text text-transparent mb-2">50K+</div>
                        <div class="text-gray-600 text-sm uppercase tracking-wider font-medium">Livres accompagnés</div>
                    </div>
                    <div class="text-center">
                        <div class="text-4xl md:text-5xl font-bold bg-gradient-to-r from-[#01B3BB] to-[#FFC62A] bg-clip-text text-transparent mb-2">98%</div>
                        <div class="text-gray-600 text-sm uppercase tracking-wider font-medium">Satisfaction client</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="py-24 md:py-32 bg-gradient-to-b from-white to-gray-50">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
                <div class="relative order-2 lg:order-1">
                    <div class="relative aspect-square rounded-3xl overflow-hidden group">
                        <div class="absolute -inset-4 bg-gradient-to-br from-[#01B3BB]/20 to-[#FFC62A]/20 rounded-3xl blur-xl opacity-50"></div>
                        <div class="absolute inset-0 bg-gradient-to-br from-[#01B3BB]/10 to-[#FFC62A]/10 rounded-3xl"></div>
                        
                        <img src="images/etudiant.png" 
                             alt="Étudiants apprenant" 
                             class="relative w-full h-full object-cover rounded-2xl transition-transform duration-700 group-hover:scale-110">
                        
                        <div class="absolute -bottom-4 -right-4 bg-gradient-to-br from-[#FFC62A] to-[#FFC62A]/90 rounded-2xl p-6 shadow-2xl transform rotate-3">
                            <div class="flex items-center gap-3">
                                <div class="w-12 h-12 bg-white rounded-xl flex items-center justify-center shadow-lg">
                                    <svg class="w-6 h-6 text-[#FFC62A]" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M12.395 2.553a1 1 0 00-1.45-.385c-.345.23-.614.558-.822.88-.214.33-.403.713-.57 1.116-.334.804-.614 1.768-.84 2.734a31.365 31.365 0 00-.613 3.58 2.64 2.64 0 01-.945-1.067c-.328-.68-.398-1.534-.398-2.654A1 1 0 005.05 6.05 6.981 6.981 0 003 11a7 7 0 1011.95-4.95c-.592-.591-.98-.985-1.348-1.467-.363-.476-.724-1.063-1.207-2.03zM12.12 15.12A3 3 0 017 13s.879.5 2.5.5c0-1 .5-4 1.25-4.5.5 1 .786 1.293 1.371 1.879A2.99 2.99 0 0113 13a2.99 2.99 0 01-.879 2.121z" clip-rule="evenodd"/>
                                    </svg>
                                </div>
                                <div>
                                    <div class="text-xl font-bold text-white">Excellence</div>
                                    <div class="text-white/90 text-sm">Éducative</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="order-1 lg:order-2">
                    <div class="inline-flex items-center gap-3 mb-6">
                        <div class="w-16 h-1 bg-gradient-to-r from-[#01B3BB] to-[#FFC62A] rounded-full"></div>
                        <span class="text-sm font-semibold text-[#01B3BB] uppercase tracking-wider">Notre Raison d'Être</span>
                    </div>
                    
                    <h2 class="text-4xl md:text-5xl font-bold text-gray-900 mb-8 leading-tight">
                        Nous croyons en une éducation
                        <span class="bg-gradient-to-r from-[#01B3BB] to-[#FFC62A] bg-clip-text text-transparent">
                            accessible à tous
                        </span>
                    </h2>
                    
                    <div class="space-y-6">
                        <p class="text-lg text-gray-700 leading-relaxed">
                            Notre mission est de démocratiser l'accès aux meilleures ressources pédagogiques. 
                            Nous sélectionnons méticuleusement chaque livre pour garantir son impact éducatif 
                            et sa capacité à inspirer les générations futures.
                        </p>
                        
                        <div class="space-y-5 mt-10">
                            <div class="flex items-start gap-5 group">
                                <div class="w-12 h-12 bg-gradient-to-br from-[#01B3BB] to-[#01B3BB]/80 rounded-xl flex items-center justify-center flex-shrink-0 shadow-lg group-hover:scale-110 transition-transform duration-300">
                                    <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                    </svg>
                                </div>
                                <div class="bg-white/50 backdrop-blur-sm rounded-xl p-4 flex-1 border border-gray-100">
                                    <h4 class="font-bold text-gray-900 mb-2 text-lg">Sélection Expert</h4>
                                    <p class="text-gray-600">Chaque ressource est validée par notre comité pédagogique</p>
                                </div>
                            </div>
                            
                            <div class="flex items-start gap-5 group">
                                <div class="w-12 h-12 bg-gradient-to-br from-[#FFC62A] to-[#FFC62A]/80 rounded-xl flex items-center justify-center flex-shrink-0 shadow-lg group-hover:scale-110 transition-transform duration-300">
                                    <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"/>
                                    </svg>
                                </div>
                                <div class="bg-white/50 backdrop-blur-sm rounded-xl p-4 flex-1 border border-gray-100">
                                    <h4 class="font-bold text-gray-900 mb-2 text-lg">Accompagnement Sur Mesure</h4>
                                    <p class="text-gray-600">Conseils personnalisés pour chaque profil d'apprenant</p>
                                </div>
                            </div>
                            
                            <div class="flex items-start gap-5 group">
                                <div class="w-12 h-12 bg-gradient-to-br from-[#01B3BB] to-[#FFC62A] rounded-xl flex items-center justify-center flex-shrink-0 shadow-lg group-hover:scale-110 transition-transform duration-300">
                                    <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M13 7H7v6h6V7z"/>
                                        <path fill-rule="evenodd" d="M7 2a1 1 0 012 0v1h2V2a1 1 0 112 0v1h2a2 2 0 012 2v2h1a1 1 0 110 2h-1v2h1a1 1 0 110 2h-1v2a2 2 0 01-2 2h-2v1a1 1 0 11-2 0v-1H9v1a1 1 0 11-2 0v-1H5a2 2 0 01-2-2v-2H2a1 1 0 110-2h1V9H2a1 1 0 010-2h1V5a2 2 0 012-2h2V2zM5 5h10v10H5V5z" clip-rule="evenodd"/>
                                    </svg>
                                </div>
                                <div class="bg-white/50 backdrop-blur-sm rounded-xl p-4 flex-1 border border-gray-100">
                                    <h4 class="font-bold text-gray-900 mb-2 text-lg">Innovation Pédagogique</h4>
                                    <p class="text-gray-600">Méthodes modernes et ressources innovantes</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="py-24 md:py-32 bg-gradient-to-b from-gray-50/50 to-white">
        <div class="container mx-auto px-4">
            <div class="text-center max-w-3xl mx-auto mb-16">
                <div class="inline-flex items-center gap-4 mb-8">
                    <div class="w-20 h-1 bg-gradient-to-r from-[#01B3BB] to-[#FFC62A] rounded-full"></div>
                    <span class="text-sm font-semibold text-gray-600 uppercase tracking-wider">Nos Fondations</span>
                    <div class="w-20 h-1 bg-gradient-to-r from-[#FFC62A] to-[#01B3BB] rounded-full"></div>
                </div>
                
                <h2 class="text-4xl md:text-5xl font-bold text-gray-900 mb-6">
                    Les piliers de notre
                    <span class="bg-gradient-to-r from-[#01B3BB] to-[#FFC62A] bg-clip-text text-transparent">
                        engagement
                    </span>
                </h2>
                <p class="text-xl text-gray-700">
                    Des valeurs qui guident chaque décision et chaque action
                </p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 max-w-6xl mx-auto">
                <div class="group relative">
                    <div class="absolute -inset-1 bg-gradient-to-r from-[#01B3BB] to-[#01B3BB]/30 rounded-3xl blur opacity-30 group-hover:opacity-50 transition-opacity duration-300"></div>
                    <div class="relative bg-white rounded-3xl p-8 border border-gray-100 shadow-lg hover:shadow-2xl transition-all duration-500 hover:-translate-y-3 h-full">
                        <div class="w-20 h-20 bg-gradient-to-br from-[#01B3BB] to-[#01B3BB]/80 rounded-2xl flex items-center justify-center mb-8 shadow-lg">
                            <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/>
                            </svg>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900 mb-4">Excellence Pédagogique</h3>
                        <p class="text-gray-700 mb-6 leading-relaxed">
                            Chaque ressource est sélectionnée pour son impact éducatif 
                            et sa capacité à transformer durablement l'apprentissage.
                        </p>
                        <div class="absolute bottom-8 right-8 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                            <div class="w-10 h-10 bg-gradient-to-br from-[#01B3BB] to-[#01B3BB]/80 rounded-full flex items-center justify-center">
                                <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M12.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd"/>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="group relative">
                    <div class="absolute -inset-1 bg-gradient-to-r from-[#FFC62A] to-[#FFC62A]/30 rounded-3xl blur opacity-30 group-hover:opacity-50 transition-opacity duration-300"></div>
                    <div class="relative bg-white rounded-3xl p-8 border border-gray-100 shadow-lg hover:shadow-2xl transition-all duration-500 hover:-translate-y-3 h-full">
                        <div class="w-20 h-20 bg-gradient-to-br from-[#FFC62A] to-[#FFC62A]/80 rounded-2xl flex items-center justify-center mb-8 shadow-lg">
                            <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900 mb-4">Accessibilité Pour Tous</h3>
                        <p class="text-gray-700 mb-6 leading-relaxed">
                            Rendre l'éducation de qualité accessible à chaque apprenant, 
                            indépendamment de son niveau scolaire ou de ses moyens.
                        </p>
                        <div class="absolute bottom-8 right-8 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                            <div class="w-10 h-10 bg-gradient-to-br from-[#FFC62A] to-[#FFC62A]/80 rounded-full flex items-center justify-center">
                                <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M12.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd"/>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="group relative">
                    <div class="absolute -inset-1 bg-gradient-to-r from-[#01B3BB] to-[#FFC62A] rounded-3xl blur opacity-30 group-hover:opacity-50 transition-opacity duration-300"></div>
                    <div class="relative bg-white rounded-3xl p-8 border border-gray-100 shadow-lg hover:shadow-2xl transition-all duration-500 hover:-translate-y-3 h-full">
                        <div class="w-20 h-20 bg-gradient-to-br from-[#01B3BB] to-[#FFC62A] rounded-2xl flex items-center justify-center mb-8 shadow-lg">
                            <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                            </svg>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900 mb-4">Innovation Continue</h3>
                        <p class="text-gray-700 mb-6 leading-relaxed">
                            Toujours à l'affût des dernières méthodes pédagogiques 
                            et ressources éducatives pour rester à la pointe.
                        </p>
                        <div class="absolute bottom-8 right-8 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                            <div class="w-10 h-10 bg-gradient-to-br from-[#01B3BB] to-[#FFC62A] rounded-full flex items-center justify-center">
                                <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M12.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd"/>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Témoignages -->
    <section class="py-24 md:py-32 bg-gradient-to-b from-white to-[#01B3BB]/5">
        <div class="container mx-auto px-4">
            <div class="text-center max-w-3xl mx-auto mb-16">
                <div class="inline-flex items-center gap-3 mb-8">
                    <div class="w-16 h-1 bg-gradient-to-r from-[#01B3BB] to-[#FFC62A] rounded-full"></div>
                    <span class="text-sm font-semibold text-gray-700 uppercase tracking-wider">La Voix de Notre Communauté</span>
                    <div class="w-16 h-1 bg-gradient-to-r from-[#FFC62A] to-[#01B3BB] rounded-full"></div>
                </div>
                
                <h2 class="text-4xl md:text-5xl font-bold text-gray-900 mb-6">
                    Ils nous font
                    <span class="bg-gradient-to-r from-[#01B3BB] to-[#FFC62A] bg-clip-text text-transparent">
                        confiance
                    </span>
                </h2>
                <p class="text-xl text-gray-700">
                    Découvrez les témoignages authentiques de notre communauté éducative
                </p>
            </div>

            <div class="relative max-w-6xl mx-auto">
                <button class="absolute left-0 top-1/2 -translate-y-1/2 -translate-x-4 z-10 w-12 h-12 bg-white rounded-full shadow-xl flex items-center justify-center hover:scale-110 transition-all duration-300 hover:shadow-2xl hidden md:flex" id="prev-testimonial">
                    <svg class="w-6 h-6 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                    </svg>
                </button>
                
                <button class="absolute right-0 top-1/2 -translate-y-1/2 translate-x-4 z-10 w-12 h-12 bg-white rounded-full shadow-xl flex items-center justify-center hover:scale-110 transition-all duration-300 hover:shadow-2xl hidden md:flex" id="next-testimonial">
                    <svg class="w-6 h-6 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </button>

                <div class="overflow-x-auto pb-8 scrollbar-hide" id="testimonials-scroll">
                    <div class="flex gap-8 min-w-min px-4" id="testimonials-container">
                        <!-- Témoignage 1 -->
                        <div class="testimonial-card min-w-[350px] md:min-w-[400px]">
                            <div class="relative">
                                <div class="absolute -inset-0.5 bg-gradient-to-br from-[#01B3BB]/20 to-[#FFC62A]/20 rounded-3xl blur opacity-30 transition-opacity duration-300"></div>
                                
                                <div class="relative bg-white rounded-3xl p-8 border border-gray-100 shadow-lg h-full">
                                    <div class="flex items-start justify-between mb-6">
                                        <div class="flex items-center gap-4">
                                            <div class="w-14 h-14 bg-gradient-to-br from-[#01B3BB] to-[#FFC62A] rounded-2xl flex items-center justify-center shadow-lg">
                                                <span class="text-white font-bold text-xl">LS</span>
                                            </div>
                                            <div>
                                                <h4 class="font-bold text-gray-900 text-lg">Leïla S.</h4>
                                                <p class="text-sm text-gray-600">Mère de trois enfants</p>
                                            </div>
                                        </div>
                                        <div class="flex gap-1">
                                            <?php for($i = 0; $i < 5; $i++): ?>
                                            <svg class="w-5 h-5 text-[#FFC62A] fill-current" viewBox="0 0 20 20">
                                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                            </svg>
                                            <?php endfor; ?>
                                        </div>
                                    </div>
                                    
                                    <!-- Citation -->
                                    <div class="relative mb-8">
                                        <svg class="absolute -top-3 -left-1 w-8 h-8 text-[#01B3BB]/20" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M14.017 21v-7.391c0-5.704 3.731-9.57 8.983-10.609l.995 2.151c-2.432.917-3.995 3.638-3.995 5.849h4v10h-9.983zm-14.017 0v-7.391c0-5.704 3.748-9.57 9-10.609l.996 2.151c-2.433.917-3.996 3.638-3.996 5.849h3.983v10h-9.983z"/>
                                        </svg>
                                        <p class="text-gray-700 text-lg leading-relaxed italic pl-8">
                                            "Une véritable révolution dans l'apprentissage de mes enfants ! Les ressources sont adaptées à chaque niveau et les progrès sont visibles en quelques semaines seulement."
                                        </p>
                                    </div>
                                    
                                    <div class="inline-flex items-center gap-2 px-3 py-1 bg-gradient-to-r from-[#01B3BB]/10 to-[#FFC62A]/10 rounded-full">
                                        <div class="w-2 h-2 bg-[#01B3BB] rounded-full"></div>
                                        <span class="text-xs font-medium text-gray-700">Famille satisfaite</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Témoignage 2 -->
                        <div class="testimonial-card min-w-[350px] md:min-w-[400px]">
                            <div class="relative">
                                <div class="absolute -inset-0.5 bg-gradient-to-br from-[#FFC62A]/20 to-[#01B3BB]/20 rounded-3xl blur opacity-30 transition-opacity duration-300"></div>
                                
                                <div class="relative bg-white rounded-3xl p-8 border border-gray-100 shadow-lg h-full">
                                    <div class="flex items-start justify-between mb-6">
                                        <div class="flex items-center gap-4">
                                            <div class="w-14 h-14 bg-gradient-to-br from-[#FFC62A] to-[#01B3BB] rounded-2xl flex items-center justify-center shadow-lg">
                                                <span class="text-white font-bold text-xl">MT</span>
                                            </div>
                                            <div>
                                                <h4 class="font-bold text-gray-900 text-lg">Mohamed T.</h4>
                                                <p class="text-sm text-gray-600">Professeur de Sciences</p>
                                            </div>
                                        </div>
                                        <div class="flex gap-1">
                                            <?php for($i = 0; $i < 5; $i++): ?>
                                            <svg class="w-5 h-5 text-[#FFC62A] fill-current" viewBox="0 0 20 20">
                                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                            </svg>
                                            <?php endfor; ?>
                                        </div>
                                    </div>
                                    
                                    <div class="relative mb-8">
                                        <svg class="absolute -top-3 -left-1 w-8 h-8 text-[#FFC62A]/20" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M14.017 21v-7.391c0-5.704 3.731-9.57 8.983-10.609l.995 2.151c-2.432.917-3.995 3.638-3.995 5.849h4v10h-9.983zm-14.017 0v-7.391c0-5.704 3.748-9.57 9-10.609l.996 2.151c-2.433.917-3.996 3.638-3.996 5.849h3.983v10h-9.983z"/>
                                        </svg>
                                        <p class="text-gray-700 text-lg leading-relaxed italic pl-8">
                                            "En tant qu'enseignant, je trouve chez Smart Book Hub des ressources pédagogiques innovantes qui captivent mes élèves. Leur collection scientifique est particulièrement remarquable."
                                        </p>
                                    </div>
                                    
                                    <div class="inline-flex items-center gap-2 px-3 py-1 bg-gradient-to-r from-[#FFC62A]/10 to-[#01B3BB]/10 rounded-full">
                                        <div class="w-2 h-2 bg-[#FFC62A] rounded-full"></div>
                                        <span class="text-xs font-medium text-gray-700">Expert pédagogique</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Témoignage 3 -->
                        <div class="testimonial-card min-w-[350px] md:min-w-[400px]">
                            <div class="relative">
                                <div class="absolute -inset-0.5 bg-gradient-to-br from-[#01B3BB]/20 via-purple-400/20 to-[#FFC62A]/20 rounded-3xl blur opacity-30 transition-opacity duration-300"></div>
                                
                                <div class="relative bg-white rounded-3xl p-8 border border-gray-100 shadow-lg h-full">
                                    <div class="flex items-start justify-between mb-6">
                                        <div class="flex items-center gap-4">
                                            <div class="w-14 h-14 bg-gradient-to-br from-[#01B3BB] via-purple-500 to-[#FFC62A] rounded-2xl flex items-center justify-center shadow-lg">
                                                <span class="text-white font-bold text-xl">YR</span>
                                            </div>
                                            <div>
                                                <h4 class="font-bold text-gray-900 text-lg">Yasmine R.</h4>
                                                <p class="text-sm text-gray-600">Élève de Terminale S</p>
                                            </div>
                                        </div>
                                        <div class="flex gap-1">
                                            <?php for($i = 0; $i < 5; $i++): ?>
                                            <svg class="w-5 h-5 text-[#FFC62A] fill-current" viewBox="0 0 20 20">
                                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                            </svg>
                                            <?php endfor; ?>
                                        </div>
                                    </div>
                                    
                                    <div class="relative mb-8">
                                        <svg class="absolute -top-3 -left-1 w-8 h-8 text-[#01B3BB]/20" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M14.017 21v-7.391c0-5.704 3.731-9.57 8.983-10.609l.995 2.151c-2.432.917-3.995 3.638-3.995 5.849h4v10h-9.983zm-14.017 0v-7.391c0-5.704 3.748-9.57 9-10.609l.996 2.151c-2.433.917-3.996 3.638-3.996 5.849h3.983v10h-9.983z"/>
                                        </svg>
                                        <p class="text-gray-700 text-lg leading-relaxed italic pl-8">
                                            "Grâce aux livres de Smart Book Hub, j'ai pu améliorer mes notes en physique de 3 points. Les explications sont claires et les exercices pertinents pour le bac."
                                        </p>
                                    </div>
                                    
                                    <div class="inline-flex items-center gap-2 px-3 py-1 bg-gradient-to-r from-[#01B3BB]/10 via-purple-400/10 to-[#FFC62A]/10 rounded-full">
                                        <div class="w-2 h-2 bg-purple-500 rounded-full"></div>
                                        <span class="text-xs font-medium text-gray-700">Élève brillante</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Témoignage 4 -->
                        <div class="testimonial-card min-w-[350px] md:min-w-[400px]">
                            <div class="relative">
                                <div class="absolute -inset-0.5 bg-gradient-to-br from-[#FFC62A]/20 to-[#01B3BB]/20 rounded-3xl blur opacity-30 transition-opacity duration-300"></div>
                                
                                <div class="relative bg-white rounded-3xl p-8 border border-gray-100 shadow-lg h-full">
                                    <div class="flex items-start justify-between mb-6">
                                        <div class="flex items-center gap-4">
                                            <div class="w-14 h-14 bg-gradient-to-br from-[#FFC62A] to-[#01B3BB] rounded-2xl flex items-center justify-center shadow-lg">
                                                <span class="text-white font-bold text-xl">AB</span>
                                            </div>
                                            <div>
                                                <h4 class="font-bold text-gray-900 text-lg">Amine B.</h4>
                                                <p class="text-sm text-gray-600">Père et enseignant</p>
                                            </div>
                                        </div>
                                        <div class="flex gap-1">
                                            <?php for($i = 0; $i < 5; $i++): ?>
                                            <svg class="w-5 h-5 text-[#FFC62A] fill-current" viewBox="0 0 20 20">
                                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                            </svg>
                                            <?php endfor; ?>
                                        </div>
                                    </div>
                                    
                                    <div class="relative mb-8">
                                        <svg class="absolute -top-3 -left-1 w-8 h-8 text-[#FFC62A]/20" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M14.017 21v-7.391c0-5.704 3.731-9.57 8.983-10.609l.995 2.151c-2.432.917-3.995 3.638-3.995 5.849h4v10h-9.983zm-14.017 0v-7.391c0-5.704 3.748-9.57 9-10.609l.996 2.151c-2.433.917-3.996 3.638-3.996 5.849h3.983v10h-9.983z"/>
                                        </svg>
                                        <p class="text-gray-700 text-lg leading-relaxed italic pl-8">
                                            "En tant que père et enseignant, je recommande vivement Smart Book Hub. La qualité des ouvrages et la variété des ressources sont exceptionnelles."
                                        </p>
                                    </div>
                                    
                                    <div class="inline-flex items-center gap-2 px-3 py-1 bg-gradient-to-r from-[#FFC62A]/10 to-[#01B3BB]/10 rounded-full">
                                        <div class="w-2 h-2 bg-[#FFC62A] rounded-full"></div>
                                        <span class="text-xs font-medium text-gray-700">Double expertise</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Témoignage 5 -->
                        <div class="testimonial-card min-w-[350px] md:min-w-[400px]">
                            <div class="relative">
                                <div class="absolute -inset-0.5 bg-gradient-to-br from-[#01B3BB]/20 to-[#FFC62A]/20 rounded-3xl blur opacity-30 transition-opacity duration-300"></div>
                                
                                <div class="relative bg-white rounded-3xl p-8 border border-gray-100 shadow-lg h-full">
                                    <div class="flex items-start justify-between mb-6">
                                        <div class="flex items-center gap-4">
                                            <div class="w-14 h-14 bg-gradient-to-br from-[#01B3BB] to-[#FFC62A] rounded-2xl flex items-center justify-center shadow-lg">
                                                <span class="text-white font-bold text-xl">FC</span>
                                            </div>
                                            <div>
                                                <h4 class="font-bold text-gray-900 text-lg">Fatma C.</h4>
                                                <p class="text-sm text-gray-600">Directrice d'école</p>
                                            </div>
                                        </div>
                                        <div class="flex gap-1">
                                            <?php for($i = 0; $i < 5; $i++): ?>
                                            <svg class="w-5 h-5 text-[#FFC62A] fill-current" viewBox="0 0 20 20">
                                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                            </svg>
                                            <?php endfor; ?>
                                        </div>
                                    </div>
                                    
                                    <div class="relative mb-8">
                                        <svg class="absolute -top-3 -left-1 w-8 h-8 text-[#01B3BB]/20" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M14.017 21v-7.391c0-5.704 3.731-9.57 8.983-10.609l.995 2.151c-2.432.917-3.995 3.638-3.995 5.849h4v10h-9.983zm-14.017 0v-7.391c0-5.704 3.748-9.57 9-10.609l.996 2.151c-2.433.917-3.996 3.638-3.996 5.849h3.983v10h-9.983z"/>
                                        </svg>
                                        <p class="text-gray-700 text-lg leading-relaxed italic pl-8">
                                            "Notre école travaille avec Smart Book Hub depuis 3 ans. La qualité des manuels et le service client sont tout simplement excellents."
                                        </p>
                                    </div>
                                    
                                    <div class="inline-flex items-center gap-2 px-3 py-1 bg-gradient-to-r from-[#01B3BB]/10 to-[#FFC62A]/10 rounded-full">
                                        <div class="w-2 h-2 bg-[#01B3BB] rounded-full"></div>
                                        <span class="text-xs font-medium text-gray-700">Partenaire scolaire</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Indicateurs de progression -->
                <div class="flex justify-center gap-2 mt-8">
                    <div class="w-8 h-2 bg-gray-200 rounded-full overflow-hidden">
                        <div class="h-full bg-gradient-to-r from-[#01B3BB] to-[#FFC62A] rounded-full testimonial-progress" style="width: 20%"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA -->
    <section class="py-24 md:py-32 relative overflow-hidden">
        <div class="absolute inset-0 bg-gradient-to-br from-[#01B3BB]/5 via-white to-[#FFC62A]/5"></div>
        <div class="absolute -top-40 -right-40 w-80 h-80 bg-[#01B3BB]/10 rounded-full blur-3xl"></div>
        <div class="absolute -bottom-40 -left-40 w-80 h-80 bg-[#FFC62A]/10 rounded-full blur-3xl"></div>
        
        <div class="container mx-auto px-4 relative z-10">
            <div class="max-w-4xl mx-auto">
                <div class="bg-gradient-to-br from-white to-gray-50/50 rounded-3xl p-12 md:p-16 border border-white/50 shadow-2xl text-center relative overflow-hidden">
                    <div class="absolute inset-0 bg-gradient-to-r from-[#01B3BB]/10 via-transparent to-[#FFC62A]/10 rounded-3xl"></div>
                    
                    <div class="relative z-10">
                        <div class="inline-flex items-center gap-3 px-5 py-3 bg-gradient-to-r from-[#01B3BB]/10 to-[#FFC62A]/10 rounded-full backdrop-blur-sm mb-10">
                            <div class="flex items-center gap-2">
                                <div class="w-2 h-2 bg-gradient-to-r from-[#01B3BB] to-[#FFC62A] rounded-full animate-pulse"></div>
                                <span class="text-sm font-semibold text-gray-700">Votre Prochaine Étape</span>
                            </div>
                        </div>
                        
                        <h2 class="text-4xl md:text-5xl font-bold text-gray-900 mb-8 leading-tight">
                            Prêt à transformer
                            <span class="bg-gradient-to-r from-[#01B3BB] to-[#FFC62A] bg-clip-text text-transparent block">
                                l'apprentissage ?
                            </span>
                        </h2>
                        
                        <p class="text-xl text-gray-700 mb-12 max-w-2xl mx-auto">
                            Rejoignez des milliers de parents, enseignants et étudiants 
                            qui ont déjà transformé leur expérience éducative avec nous.
                        </p>
                        
                        <div class="flex flex-col sm:flex-row gap-5 justify-center">
                            <a href="{{ route('contact') }}" 
                               class="px-10 py-5 bg-gradient-to-r from-[#01B3BB] to-[#01B3BB]/90 text-white rounded-full font-bold hover:shadow-2xl transition-all duration-300 hover:scale-105 flex items-center justify-center gap-3 group shadow-lg">
                                <span>Démarrer l'aventure</span>
                                <svg class="w-6 h-6 transform group-hover:translate-x-2 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                                </svg>
                            </a>
                            <a href="{{ route('welcome') }}" 
                               class="px-10 py-5 bg-white border-2 border-gray-200 text-gray-700 rounded-full font-bold hover:border-gradient-to-r hover:from-[#01B3BB] hover:to-[#FFC62A] hover:text-[#01B3BB] transition-all duration-300 hover:scale-105 shadow-lg">
                                Explorer nos ressources
                            </a>
                        </div>
                        
                        <!-- stats bottom -->
                        <div class="flex flex-wrap justify-center gap-8 mt-16 pt-8 border-t border-gray-100">
                            <div class="text-center">
                                <div class="text-2xl font-bold text-[#01B3BB] mb-1">24/7</div>
                                <div class="text-sm text-gray-600">Support disponible</div>
                            </div>
                            <div class="text-center">
                                <div class="text-2xl font-bold text-[#FFC62A] mb-1">100%</div>
                                <div class="text-sm text-gray-600">Satisfaction garantie</div>
                            </div>
                            <div class="text-center">
                                <div class="text-2xl font-bold text-[#01B3BB] mb-1">15K+</div>
                                <div class="text-sm text-gray-600">Livres disponibles</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<style>
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .testimonial-card {
        animation: fadeInUp 0.6s cubic-bezier(0.4, 0, 0.2, 1) forwards;
        opacity: 0;
        will-change: transform, opacity;
        flex-shrink: 0;
        min-width: 300px !important;
        max-width: 300px !important;
    }

    .testimonial-card:nth-child(1) { animation-delay: 0.1s; }
    .testimonial-card:nth-child(2) { animation-delay: 0.2s; }
    .testimonial-card:nth-child(3) { animation-delay: 0.3s; }
    .testimonial-card:nth-child(4) { animation-delay: 0.4s; }
    .testimonial-card:nth-child(5) { animation-delay: 0.5s; }

    .testimonial-card .relative.bg-white {
        padding: 1.5rem !important;
    }

    .testimonial-card .w-14.h-14 {
        width: 2.5rem !important;
        height: 2.5rem !important;
    }

    .testimonial-card .text-xl {
        font-size: 1.125rem !important;
    }

    .testimonial-card .text-lg {
        font-size: 1rem !important;
    }

    .testimonial-card .text-sm {
        font-size: 0.75rem !important;
    }

    .testimonial-card .w-5.h-5 {
        width: 1rem !important;
        height: 1rem !important;
    }

    .testimonial-card .mb-6 {
        margin-bottom: 1rem !important;
    }

    .testimonial-card .mb-8 {
        margin-bottom: 1.5rem !important;
    }

    .testimonial-card .w-8.h-8 {
        width: 1.5rem !important;
        height: 1.5rem !important;
    }

    .testimonial-card .pl-8 {
        padding-left: 1.5rem !important;
    }

    .scrollbar-hide {
        -ms-overflow-style: none;
        scrollbar-width: none;
    }
    
    .scrollbar-hide::-webkit-scrollbar {
        display: none;
    }

    #testimonials-scroll {
        scroll-behavior: smooth;
        cursor: grab;
    }
    
    #testimonials-scroll:active {
        cursor: grabbing;
    }

    #testimonials-container {
        gap: 1.5rem !important;
    }

    #prev-testimonial,
    #next-testimonial {
        width: 2.5rem !important;
        height: 2.5rem !important;
    }

    @media (max-width: 768px) {
        .testimonial-card {
            min-width: 280px !important;
            max-width: 280px !important;
        }
        
        .testimonial-card .relative.bg-white {
            padding: 1.25rem !important;
        }
        
        #testimonials-container {
            gap: 1rem !important;
        }
    }

    @media (max-width: 640px) {
        .testimonial-card {
            min-width: 260px !important;
            max-width: 260px !important;
        }
    }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const container = document.getElementById('testimonials-scroll');
    const testimonialsContainer = document.getElementById('testimonials-container');
    const prevBtn = document.getElementById('prev-testimonial');
    const nextBtn = document.getElementById('next-testimonial');
    const progressBar = document.querySelector('.testimonial-progress');
    
    let isDragging = false;
    let startX;
    let scrollLeft;

    function updateProgressBar() {
        const scrollWidth = container.scrollWidth - container.clientWidth;
        const scrollPosition = container.scrollLeft;
        const progress = (scrollPosition / scrollWidth) * 100;
        
        if (progressBar) {
            progressBar.style.width = `${Math.min(100, Math.max(0, progress))}%`;
        }
    }

    function getCardWidth() {
        const firstCard = container.querySelector('.testimonial-card');
        if (firstCard) {
            const cardStyle = window.getComputedStyle(firstCard);
            const containerStyle = window.getComputedStyle(testimonialsContainer);
            const cardWidth = firstCard.offsetWidth;
            const gap = parseInt(containerStyle.gap) || 24;
            return cardWidth + gap;
        }
        return 320;
    }

    if (prevBtn && nextBtn) {
        prevBtn.addEventListener('click', () => {
            const scrollAmount = getCardWidth();
            container.scrollBy({
                left: -scrollAmount,
                behavior: 'smooth'
            });
        });

        nextBtn.addEventListener('click', () => {
            const scrollAmount = getCardWidth();
            container.scrollBy({
                left: scrollAmount,
                behavior: 'smooth'
            });
        });
    }

    document.addEventListener('keydown', (e) => {
        if (e.key === 'ArrowLeft') {
            const scrollAmount = getCardWidth();
            container.scrollBy({ left: -scrollAmount, behavior: 'smooth' });
        } else if (e.key === 'ArrowRight') {
            const scrollAmount = getCardWidth();
            container.scrollBy({ left: scrollAmount, behavior: 'smooth' });
        }
    });

    container.addEventListener('mousedown', (e) => {
        isDragging = true;
        startX = e.pageX - container.offsetLeft;
        scrollLeft = container.scrollLeft;
        container.style.cursor = 'grabbing';
    });

    container.addEventListener('mouseleave', () => {
        isDragging = false;
        container.style.cursor = 'grab';
    });

    container.addEventListener('mouseup', () => {
        isDragging = false;
        container.style.cursor = 'grab';
    });

    container.addEventListener('mousemove', (e) => {
        if (!isDragging) return;
        e.preventDefault();
        const x = e.pageX - container.offsetLeft;
        const walk = (x - startX) * 1.5;
        container.scrollLeft = scrollLeft - walk;
    });

    container.addEventListener('touchstart', (e) => {
        isDragging = true;
        startX = e.touches[0].pageX - container.offsetLeft;
        scrollLeft = container.scrollLeft;
    });

    container.addEventListener('touchend', () => {
        isDragging = false;
    });

    container.addEventListener('touchmove', (e) => {
        if (!isDragging) return;
        e.preventDefault();
        const x = e.touches[0].pageX - container.offsetLeft;
        const walk = (x - startX) * 1.5;
        container.scrollLeft = scrollLeft - walk;
    });

    container.addEventListener('scroll', updateProgressBar);

    window.addEventListener('resize', updateProgressBar);

    updateProgressBar();

    const observerOptions = {
        threshold: 0.2,
        rootMargin: '0px 0px -50px 0px'
    };

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.opacity = '1';
                entry.target.style.transform = 'translateY(0)';
            }
        });
    }, observerOptions);

    document.querySelectorAll('.testimonial-card').forEach(el => {
        observer.observe(el);
    });
});
</script>

@endsection