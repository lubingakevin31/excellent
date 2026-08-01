<script setup>
import { Head } from '@inertiajs/vue3';
import Navbar from '@/Components/Navbar.vue';
import Footer from '@/Components/Footer.vue';
import HeroThreeCanvas from '@/Components/HeroThreeCanvas.vue';
</script>

<template>
    <Head title="EXCELLENT UNIT — Beyond Vision" />

    <div class="min-h-screen bg-slate-900 text-slate-100 flex flex-col font-sans selection:bg-amber-500 selection:text-slate-950">
        <!-- Navigation -->
        <Navbar />

        <!-- Hero Section avec Canvas 3D -->
        <section class="relative bg-gradient-to-b from-slate-900 via-slate-800/80 to-slate-900 py-6 sm:py-16 md:py-20 overflow-hidden border-b border-slate-800">
            <div class="max-w-7xl mx-auto px-3 sm:px-6 lg:px-8 flex flex-col md:grid md:grid-cols-2 gap-6 items-center">
                
                <!-- Texte Hero (Issu de la fusion HTML/Vue) -->
                <div class="space-y-3 sm:space-y-6 z-10 text-center md:text-left w-full">
                    <span class="inline-block bg-amber-500/10 text-amber-400 text-[9px] sm:text-xs font-semibold uppercase tracking-widest px-2.5 py-1 rounded-full border border-amber-500/20">
                        Innovation & Impact Social
                    </span>
                    
                    <h1 class="text-xl sm:text-4xl md:text-5xl lg:text-6xl font-black text-white tracking-tight leading-tight">
                        Construire des systèmes pour <span class="text-amber-500">une unité durable.</span>
                    </h1>
                    
                    <p class="text-slate-300 text-[11px] sm:text-base md:text-lg leading-relaxed max-w-xl mx-auto md:mx-0">
                        Nous transformons les défis structurels en opportunités de croissance pour les communautés à travers nos piliers stratégiques.
                    </p>
                    
                    <!-- Boutons d'action -->
                    <div class="flex flex-col sm:flex-row justify-center md:justify-start gap-2 pt-1 w-full max-w-[260px] sm:max-w-none mx-auto">
                        <a href="#contact" class="bg-amber-500 hover:bg-amber-600 text-slate-950 font-bold text-[10px] sm:text-sm px-4 py-2.5 rounded-full shadow-lg transition duration-200 text-center whitespace-nowrap">
                            Commencer un projet →
                        </a>
                        <a href="#univers" class="border border-slate-700 hover:border-amber-500 text-slate-200 hover:text-amber-400 font-semibold text-[10px] sm:text-sm px-4 py-2.5 rounded-full transition duration-200 text-center whitespace-nowrap">
                            Voir nos réalisations
                        </a>
                    </div>
                </div>

                <!-- Sphère 3D Interactive -->
                <div class="relative flex justify-center items-center w-full mt-2 md:mt-0">
                    <HeroThreeCanvas />
                </div>

            </div>
        </section>

        <!-- Section Statistiques : Global Impact -->
        <section class="py-10 sm:py-16 bg-slate-900 border-b border-slate-800/80">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center max-w-3xl mx-auto mb-8 sm:mb-12">
                    <span class="text-amber-500 uppercase tracking-widest text-[10px] sm:text-xs font-bold">Global Impact</span>
                    <h2 class="text-lg sm:text-3xl font-extrabold text-white mt-1">Construire une présence avec élégance et innovation.</h2>
                </div>

                <div class="grid grid-cols-2 sm:grid-cols-4 gap-3 sm:gap-6">
                    <div class="bg-slate-800/40 p-4 sm:p-6 rounded-2xl border border-slate-700/50 text-center hover:border-amber-500/50 transition duration-300">
                        <h3 class="text-2xl sm:text-4xl font-extrabold text-amber-500">18+</h3>
                        <p class="text-slate-400 text-[10px] sm:text-xs mt-1">Programmes Visionnaires</p>
                    </div>
                    <div class="bg-slate-800/40 p-4 sm:p-6 rounded-2xl border border-slate-700/50 text-center hover:border-amber-500/50 transition duration-300">
                        <h3 class="text-2xl sm:text-4xl font-extrabold text-amber-500">24</h3>
                        <p class="text-slate-400 text-[10px] sm:text-xs mt-1">Communautés Actives</p>
                    </div>
                    <div class="bg-slate-800/40 p-4 sm:p-6 rounded-2xl border border-slate-700/50 text-center hover:border-amber-500/50 transition duration-300">
                        <h3 class="text-2xl sm:text-4xl font-extrabold text-amber-500">03</h3>
                        <p class="text-slate-400 text-[10px] sm:text-xs mt-1">Centres d'Innovation</p>
                    </div>
                    <div class="bg-slate-800/40 p-4 sm:p-6 rounded-2xl border border-slate-700/50 text-center hover:border-amber-500/50 transition duration-300">
                        <h3 class="text-2xl sm:text-4xl font-extrabold text-amber-500">99%</h3>
                        <p class="text-slate-400 text-[10px] sm:text-xs mt-1">Expérience Immersive</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Section Univers & Piliers -->
        <section id="univers" class="py-10 sm:py-20 bg-slate-950/60 border-b border-slate-800">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center max-w-3xl mx-auto mb-8 sm:mb-16">
                    <span class="text-amber-500 uppercase tracking-widest text-[10px] sm:text-xs font-bold">Univers & Piliers</span>
                    <h2 class="text-lg sm:text-3xl font-extrabold text-white mt-1">Des idées transformées en expériences réelles.</h2>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6">
                    
                    <div class="bg-slate-800/50 rounded-2xl p-5 border border-slate-700/60 hover:border-amber-500 transition duration-300 flex flex-col justify-between">
                        <div>
                            <span class="text-amber-500 text-[10px] font-bold uppercase tracking-wider">01 • Architecture</span>
                            <h3 class="text-base sm:text-lg font-bold text-white mt-1 mb-2">Structures Futures</h3>
                            <p class="text-slate-400 text-[11px] sm:text-xs leading-relaxed">Concevoir des espaces capables de fusionner émotion, technologie et puissance visuelle.</p>
                        </div>
                    </div>

                    <div class="bg-slate-800/50 rounded-2xl p-5 border border-slate-700/60 hover:border-amber-500 transition duration-300 flex flex-col justify-between">
                        <div>
                            <span class="text-amber-500 text-[10px] font-bold uppercase tracking-wider">02 • Intelligence</span>
                            <h3 class="text-base sm:text-lg font-bold text-white mt-1 mb-2">Éducation Moderne</h3>
                            <p class="text-slate-400 text-[11px] sm:text-xs leading-relaxed">Formez une génération prête à transformer les systèmes complexes du futur.</p>
                        </div>
                    </div>

                    <div class="bg-slate-800/50 rounded-2xl p-5 border border-slate-700/60 hover:border-amber-500 transition duration-300 flex flex-col justify-between">
                        <div>
                            <span class="text-amber-500 text-[10px] font-bold uppercase tracking-wider">03 • Nature</span>
                            <h3 class="text-base sm:text-lg font-bold text-white mt-1 mb-2">Équilibre Digital</h3>
                            <p class="text-slate-400 text-[11px] sm:text-xs leading-relaxed">Développer un futur où innovation technologique et environnement avancent ensemble.</p>
                        </div>
                    </div>

                    <div class="bg-slate-800/50 rounded-2xl p-5 border border-slate-700/60 hover:border-amber-500 transition duration-300 flex flex-col justify-between">
                        <div>
                            <span class="text-amber-500 text-[10px] font-bold uppercase tracking-wider">04 • Leadership</span>
                            <h3 class="text-base sm:text-lg font-bold text-white mt-1 mb-2">Puissance Humaine</h3>
                            <p class="text-slate-400 text-[11px] sm:text-xs leading-relaxed">Accélérer l'émergence de nouveaux leaders inspirants et engagés.</p>
                        </div>
                    </div>

                </div>
            </div>
        </section>

        <!-- Footer -->
        <Footer />
    </div>
</template>