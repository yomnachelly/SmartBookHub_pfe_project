@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-blue-50/50 via-white to-amber-50/50">
    <div class="fixed inset-0 overflow-hidden pointer-events-none">
        <div class="absolute top-1/4 left-10 w-72 h-72 bg-gradient-to-br from-[#01B3BB]/10 to-transparent rounded-full blur-3xl"></div>
        <div class="absolute bottom-1/4 right-10 w-96 h-96 bg-gradient-to-tr from-[#FFC62A]/10 to-transparent rounded-full blur-3xl"></div>
        <div class="absolute top-1/2 left-1/3 w-64 h-64 bg-gradient-to-r from-purple-100/30 to-pink-100/30 rounded-full blur-3xl"></div>
    </div>

    <!-- hero section -->
    <section class="relative pt-20 pb-16 md:pt-28 md:pb-20">
        <div class="container mx-auto px-4 relative">
            <div class="max-w-3xl mx-auto text-center">
                <div class="inline-flex items-center gap-2 bg-gradient-to-r from-[#01B3BB]/20 via-[#FFC62A]/20 to-[#01B3BB]/20 px-4 py-2 rounded-full mb-6 backdrop-blur-sm">
                    <span class="w-2 h-2 bg-gradient-to-r from-[#01B3BB] to-[#FFC62A] rounded-full animate-pulse"></span>
                    <span class="text-sm font-medium text-gray-700">Contactez-nous</span>
                </div>
                
                <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold mb-6 leading-tight">
                    <span class="bg-clip-text text-transparent bg-gradient-to-r from-gray-900 via-[#01B3BB] to-gray-800">
                        Parlez avec
                    </span>
                    <br>
                    <span class="bg-clip-text text-transparent bg-gradient-to-r from-[#FFC62A] via-[#01B3BB] to-[#FFC62A]">
                        notre équipe
                    </span>
                </h1>
                
                <p class="text-lg md:text-xl text-gray-600 mb-8 max-w-2xl mx-auto leading-relaxed backdrop-blur-sm bg-white/30 px-6 py-4 rounded-2xl">
                    Nous sommes à votre écoute pour toutes vos questions. Notre équipe vous répond dans les plus brefs délais.
                </p>
            </div>
        </div>
    </section>

    <section class="py-12 md:py-20 relative">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-16">
                <!-- address card -->
                <div class="group relative">
                    <div class="absolute inset-0 bg-gradient-to-br from-[#01B3BB]/20 via-blue-100/50 to-[#01B3BB]/10 rounded-3xl opacity-70 group-hover:opacity-100 transition-all duration-500 transform group-hover:scale-105"></div>
                    <div class="relative bg-gradient-to-br from-white via-blue-50/50 to-white rounded-2xl p-8 shadow-lg border border-blue-100 hover:border-blue-200 transition-all duration-300 hover:shadow-xl">
                        <div class="w-14 h-14 bg-gradient-to-br from-[#01B3BB] to-blue-500 rounded-xl flex items-center justify-center mb-6 transform group-hover:rotate-6 transition-transform duration-300 shadow-lg shadow-blue-200/50">
                            <svg class="w-7 h-7 text-white" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-900 mb-3">Visitez-nous</h3>
                        <p class="text-gray-600 mb-4 leading-relaxed">
                            Immeuble Espace Tunis Montplaisir<br>
                            Avenue de la Liberté<br>
                            Tunis 1002, Tunisie
                        </p>
                        <a href="#map-section" class="inline-flex items-center gap-2 text-[#01B3BB] font-medium hover:gap-3 transition-all duration-300 group/arrow">
                            Voir sur la carte
                            <svg class="w-4 h-4 transform group-hover/arrow:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                            </svg>
                        </a>
                    </div>
                </div>

                <!-- phone card -->
                <div class="group relative">
                    <div class="absolute inset-0 bg-gradient-to-br from-[#FFC62A]/20 via-amber-100/50 to-[#FFC62A]/10 rounded-3xl opacity-70 group-hover:opacity-100 transition-all duration-500 transform group-hover:scale-105"></div>
                    <div class="relative bg-gradient-to-br from-white via-amber-50/50 to-white rounded-2xl p-8 shadow-lg border border-amber-100 hover:border-amber-200 transition-all duration-300 hover:shadow-xl">
                        <div class="w-14 h-14 bg-gradient-to-br from-[#FFC62A] to-amber-500 rounded-xl flex items-center justify-center mb-6 transform group-hover:-rotate-6 transition-transform duration-300 shadow-lg shadow-amber-200/50">
                            <svg class="w-7 h-7 text-white" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z"/>
                            </svg>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-900 mb-3">Appelez-nous</h3>
                        <p class="text-2xl font-bold bg-gradient-to-r from-amber-600 to-amber-700 bg-clip-text text-transparent mb-1">71 903 181</p>
                        <p class="text-sm text-amber-600 mb-4">Lun-Ven: 8h-18h | Sam: 9h-13h</p>
                        <a href="tel:71903181" class="inline-flex items-center gap-2 text-amber-600 font-medium hover:gap-3 transition-all duration-300 group/arrow">
                            Appeler maintenant
                            <svg class="w-4 h-4 transform group-hover/arrow:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                            </svg>
                        </a>
                    </div>
                </div>

                <!-- email card -->
                <div class="group relative">
                    <div class="absolute inset-0 bg-gradient-to-br from-[#01B3BB]/20 via-teal-100/50 to-[#FFC62A]/10 rounded-3xl opacity-70 group-hover:opacity-100 transition-all duration-500 transform group-hover:scale-105"></div>
                    <div class="relative bg-gradient-to-br from-white via-teal-50/50 to-white rounded-2xl p-8 shadow-lg border border-teal-100 hover:border-teal-200 transition-all duration-300 hover:shadow-xl">
                        <div class="w-14 h-14 bg-gradient-to-br from-[#01B3BB] via-teal-400 to-[#FFC62A] rounded-xl flex items-center justify-center mb-6 transform group-hover:rotate-12 transition-transform duration-300 shadow-lg shadow-teal-200/50">
                            <svg class="w-7 h-7 text-white" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"/>
                                <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"/>
                            </svg>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-900 mb-3">Envoyez un email</h3>
                        <p class="text-lg font-medium bg-gradient-to-r from-[#01B3BB] to-teal-600 bg-clip-text text-transparent mb-1">contact@smartbookhub.com</p>
                        <p class="text-sm text-teal-600 mb-4">Réponse sous 24h ouvrables</p>
                        <a href="mailto:contact@smartbookhub.com" class="inline-flex items-center gap-2 text-teal-600 font-medium hover:gap-3 transition-all duration-300 group/arrow">
                            Écrire un message
                            <svg class="w-4 h-4 transform group-hover/arrow:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>

            <!-- social media -->
            <div class="max-w-md mx-auto text-center mb-20">
                <p class="text-gray-600 mb-6 font-medium">Restez connecté sur les réseaux</p>
                <div class="flex justify-center gap-8">
                    <a href="#" class="group relative">
                        <div class="absolute inset-0 bg-gradient-to-br from-blue-500 to-blue-600 rounded-full opacity-0 group-hover:opacity-100 blur transition-all duration-500"></div>
                        <div class="relative w-16 h-16 bg-gradient-to-br from-blue-500 to-blue-600 rounded-full flex items-center justify-center shadow-lg shadow-blue-200 group-hover:shadow-xl group-hover:shadow-blue-300 group-hover:scale-110 transition-all duration-300">
                            <svg class="w-7 h-7 text-white" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                            </svg>
                        </div>
                    </a>
                    <a href="#" class="group relative">
                        <div class="absolute inset-0 bg-gradient-to-br from-pink-500 via-red-500 to-orange-500 rounded-full opacity-0 group-hover:opacity-100 blur transition-all duration-500"></div>
                        <div class="relative w-16 h-16 bg-gradient-to-br from-pink-500 via-red-500 to-orange-500 rounded-full flex items-center justify-center shadow-lg shadow-pink-200 group-hover:shadow-xl group-hover:shadow-pink-300 group-hover:scale-110 transition-all duration-300">
                            <svg class="w-7 h-7 text-white" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/>
                            </svg>
                        </div>
                    </a>
                    <a href="#" class="group relative">
                        <div class="absolute inset-0 bg-gradient-to-br from-green-500 to-emerald-600 rounded-full opacity-0 group-hover:opacity-100 blur transition-all duration-500"></div>
                        <div class="relative w-16 h-16 bg-gradient-to-br from-green-500 to-emerald-600 rounded-full flex items-center justify-center shadow-lg shadow-green-200 group-hover:shadow-xl group-hover:shadow-green-300 group-hover:scale-110 transition-all duration-300">
                            <svg class="w-7 h-7 text-white" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/>
                            </svg>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Map-->
    <section id="map-section" class="py-16 md:py-24 bg-gradient-to-b from-blue-50/50 to-white">
        <div class="container mx-auto px-4">
            <div class="text-center mb-12">
                <div class="inline-flex items-center justify-center gap-3 mb-6">
                    <div class="w-8 h-0.5 bg-gradient-to-r from-transparent via-[#01B3BB] to-transparent"></div>
                    <h2 class="text-3xl md:text-4xl font-bold text-gray-900">Notre <span class="bg-gradient-to-r from-[#01B3BB] to-blue-600 bg-clip-text text-transparent">Emplacement</span></h2>
                    <div class="w-8 h-0.5 bg-gradient-to-r from-transparent via-[#01B3BB] to-transparent"></div>
                </div>
                <p class="text-gray-600 max-w-2xl mx-auto text-lg">
                    Venez nous rencontrer dans nos locaux à Tunis Montplaisir
                </p>
            </div>
            
            <div class="max-w-6xl mx-auto">
                <div class="glass-effect rounded-3xl overflow-hidden shadow-2xl border border-gray-100/50 backdrop-blur-sm">
                    <div id="contact-map" class="h-96 w-full"></div>
                    <div class="p-6 bg-gradient-to-r from-white to-blue-50/30">
                        <div class="flex flex-col md:flex-row justify-between items-center gap-4">
                            <div>
                                <h3 class="text-xl font-semibold text-gray-900">Smart Book Hub</h3>
                                <p class="text-gray-600">Immeuble Espace Tunis Montplaisir, Tunis</p>
                            </div>
                            <a href="https://maps.google.com/?q=36.8184854,10.1870578" 
                               target="_blank" 
                               rel="noopener noreferrer"
                               class="px-6 py-3 bg-gradient-to-r from-[#01B3BB] to-blue-600 text-white rounded-full font-medium hover:shadow-xl transition-all duration-300 hover:scale-[1.02] flex items-center gap-2 group">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/>
                                </svg>
                                Voir sur Google Maps
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- FAQ Section -->
    <section class="py-16 md:py-24 bg-gradient-to-br from-white via-blue-50/30 to-amber-50/30">
        <div class="container mx-auto px-4">
            <div class="text-center mb-12">
                <div class="inline-flex items-center gap-2 mb-4">
                    <span class="w-3 h-3 bg-gradient-to-br from-[#01B3BB] to-blue-500 rounded-full animate-pulse"></span>
                    <span class="text-sm font-semibold bg-gradient-to-r from-[#01B3BB] to-[#FFC62A] bg-clip-text text-transparent">FAQ</span>
                    <span class="w-3 h-3 bg-gradient-to-br from-[#FFC62A] to-amber-500 rounded-full animate-pulse"></span>
                </div>
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">
                    Questions fréquentes
                </h2>
                <p class="text-gray-600 max-w-xl mx-auto text-lg">
                    Trouvez rapidement les réponses à vos questions les plus courantes
                </p>
            </div>
            
            <div class="max-w-3xl mx-auto">
                <div class="space-y-4">
                    <!-- FAQ 1 -->
                    <div class="group" x-data="{ open: false }">
                        <div class="absolute inset-0 bg-gradient-to-r from-blue-100/50 to-transparent rounded-2xl opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                        <button @click="open = !open" 
                                :class="{ 'bg-gradient-to-r from-blue-50 to-blue-100/50 border-blue-200': open }"
                                class="relative w-full flex items-center justify-between p-6 bg-white/80 hover:bg-white rounded-2xl transition-all duration-300 border border-gray-100/80 group-hover:border-blue-200/50 backdrop-blur-sm">
                            <span class="text-lg font-medium text-gray-900 text-left" :class="{ 'text-blue-600': open }">
                                Quels sont vos horaires d'ouverture ?
                            </span>
                            <svg class="w-6 h-6 text-gray-400 transition-transform duration-300" :class="{ 'rotate-180 text-blue-600': open }" 
                                 fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </button>
                        <div x-show="open" x-collapse class="relative px-6 pb-6">
                            <div class="absolute left-0 top-0 w-1 h-full bg-gradient-to-b from-blue-400 to-blue-300 rounded-full"></div>
                            <p class="text-gray-600 leading-relaxed pl-4">
                                Notre équipe est disponible du lundi au vendredi de 8h à 18h et le samedi de 9h à 13h. 
                                Vous pouvez nous contacter par téléphone, email ou via notre formulaire de contact.
                            </p>
                        </div>
                    </div>
                    
                    <!-- FAQ 2 -->
                    <div class="group" x-data="{ open: false }">
                        <div class="absolute inset-0 bg-gradient-to-r from-amber-100/50 to-transparent rounded-2xl opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                        <button @click="open = !open" 
                                :class="{ 'bg-gradient-to-r from-amber-50 to-amber-100/50 border-amber-200': open }"
                                class="relative w-full flex items-center justify-between p-6 bg-white/80 hover:bg-white rounded-2xl transition-all duration-300 border border-gray-100/80 group-hover:border-amber-200/50 backdrop-blur-sm">
                            <span class="text-lg font-medium text-gray-900 text-left" :class="{ 'text-amber-600': open }">
                                Proposez-vous des remises pour les écoles ?
                            </span>
                            <svg class="w-6 h-6 text-gray-400 transition-transform duration-300" :class="{ 'rotate-180 text-amber-600': open }" 
                                 fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </button>
                        <div x-show="open" x-collapse class="relative px-6 pb-6">
                            <div class="absolute left-0 top-0 w-1 h-full bg-gradient-to-b from-amber-400 to-amber-300 rounded-full"></div>
                            <p class="text-gray-600 leading-relaxed pl-4">
                                Oui, nous proposons des tarifs préférentiels pour les établissements scolaires, 
                                les bibliothèques et les institutions éducatives. Contactez-nous pour discuter 
                                de vos besoins spécifiques et obtenir un devis personnalisé.
                            </p>
                        </div>
                    </div>
                    
                    <!-- FAQ 3 -->
                    <div class="group" x-data="{ open: false }">
                        <div class="absolute inset-0 bg-gradient-to-r from-teal-100/50 to-transparent rounded-2xl opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                        <button @click="open = !open" 
                                :class="{ 'bg-gradient-to-r from-teal-50 to-teal-100/50 border-teal-200': open }"
                                class="relative w-full flex items-center justify-between p-6 bg-white/80 hover:bg-white rounded-2xl transition-all duration-300 border border-gray-100/80 group-hover:border-teal-200/50 backdrop-blur-sm">
                            <span class="text-lg font-medium text-gray-900 text-left" :class="{ 'text-teal-600': open }">
                                Quel est le délai de livraison ?
                            </span>
                            <svg class="w-6 h-6 text-gray-400 transition-transform duration-300" :class="{ 'rotate-180 text-teal-600': open }" 
                                 fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </button>
                        <div x-show="open" x-collapse class="relative px-6 pb-6">
                            <div class="absolute left-0 top-0 w-1 h-full bg-gradient-to-b from-teal-400 to-teal-300 rounded-full"></div>
                            <p class="text-gray-600 leading-relaxed pl-4">
                                Pour Tunis et ses environs, la livraison est effectuée sous 24h. 
                                Pour les autres régions de Tunisie, le délai est de 2 à 3 jours ouvrables. 
                                Nous proposons également une option de livraison express sur demande.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<!-- Alpine.js -->
<script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

<style>
    .glass-effect {
        background: rgba(255, 255, 255, 0.7);
        backdrop-filter: blur(10px);
        -webkit-backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.3);
    }
    
    * {
        transition-property: color, background-color, border-color, transform, box-shadow, opacity;
        transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
        transition-duration: 300ms;
    }
    
    @keyframes gradientShift {
        0%, 100% { background-position: 0% 50%; }
        50% { background-position: 100% 50%; }
    }
    
    .gradient-animate {
        background-size: 200% 200%;
        animation: gradientShift 3s ease infinite;
    }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    initializeContactMap();
    
    document.querySelectorAll('.group').forEach(card => {
        card.addEventListener('mouseenter', () => {
            card.style.transform = 'translateY(-2px)';
        });
        
        card.addEventListener('mouseleave', () => {
            card.style.transform = 'translateY(0)';
        });
    });
    
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            const targetId = this.getAttribute('href');
            if (targetId === '#') return;
            
            const targetElement = document.querySelector(targetId);
            if (targetElement) {
                targetElement.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });
});

function initializeContactMap() {
    const mapElement = document.getElementById('contact-map');
    
    if (!mapElement) return;
    
    const companyLatLng = [36.8184854, 10.1870578];
    
    try {
        if (typeof L === 'undefined') {
            showStaticContactMap(mapElement);
            return;
        }
        
        const map = L.map('contact-map', {
            center: companyLatLng,
            zoom: 16,
            scrollWheelZoom: false,
            dragging: true,
            zoomControl: true,
            attributionControl: true
        });
        
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; OpenStreetMap',
            maxZoom: 19,
        }).addTo(map);
        
        const customIcon = L.icon({
            iconUrl: 'https://unpkg.com/leaflet@1.9.4/dist/images/marker-icon.png',
            iconRetinaUrl: 'https://unpkg.com/leaflet@1.9.4/dist/images/marker-icon-2x.png',
            shadowUrl: 'https://unpkg.com/leaflet@1.9.4/dist/images/marker-shadow.png',
            iconSize: [25, 41],
            iconAnchor: [12, 41],
            popupAnchor: [1, -34],
            shadowSize: [41, 41]
        });
        
        const marker = L.marker(companyLatLng, {icon: customIcon}).addTo(map);
        marker.bindPopup(`
            <div class="p-2">
                <h3 class="font-bold text-lg text-[#01B3BB]">Smart Book Hub</h3>
                <p class="text-sm">Immeuble Espace Tunis Montplaisir</p>
                <p class="text-sm">Avenue de la Liberté</p>
                <p class="text-sm">Tunis 1002, Tunisie</p>
                <p class="text-sm mt-2">
                    <a href="tel:+21671903181" class="text-[#01B3BB] hover:underline">71 903 181</a>
                </p>
            </div>
        `).openPopup();
        
        setTimeout(() => {
            map.invalidateSize();
        }, 300);
        
    } catch (error) {
        console.error('Error initializing contact map:', error);
        showStaticContactMap(mapElement);
    }
}

function showStaticContactMap(mapElement) {
    const companyLatLng = [36.8184854, 10.1870578];
    
    const staticMapUrl = `https://maps.geoapify.com/v1/staticmap?style=osm-bright&width=800&height=400&center=lonlat:${companyLatLng[1]},${companyLatLng[0]}&zoom=16&marker=lonlat:${companyLatLng[1]},${companyLatLng[0]};color:%2301B3BB;size:large&apiKey=b3399cdfbeb44ef78e2d7b05e2a4cfe8`;
    
    mapElement.innerHTML = `
        <a href="https://www.google.com/maps?q=${companyLatLng[0]},${companyLatLng[1]}" 
           target="_blank" 
           rel="noopener noreferrer"
           class="block w-full h-full">
            <img src="${staticMapUrl}" 
                 alt="Smart Book Hub Location" 
                 class="w-full h-full object-cover hover:opacity-90 transition duration-300">
        </a>
    `;
}
</script>
@endsection