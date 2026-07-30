<script setup>
import { Head } from '@inertiajs/vue3';
import Navbar from '@/Components/Navbar.vue';
import Footer from '@/Components/Footer.vue';
import HeroThreeCanvas from '@/Components/HeroThreeCanvas.vue';
</script>

<template>
    <Head title="EXCELLENT UNIT - Innovation & Impact" />

    <div class="min-h-screen bg-slate-900 text-slate-100 flex flex-col font-sans">
        <!-- Navigation -->
        <Navbar />

        <!-- Hero Section avec Sphère 3D -->
        <section class="relative bg-gradient-to-b from-slate-900 via-slate-800 to-slate-900 py-6 sm:py-16 md:py-24 overflow-hidden border-b border-slate-800">
            <div class="max-w-7xl mx-auto px-2 sm:px-6 lg:px-8 flex flex-col md:grid md:grid-cols-2 gap-6 items-center">
                
                <!-- Texte de présentation + Boutons -->
                <div class="space-y-3 sm:space-y-6 z-10 text-center md:text-left w-full">
                    <span class="inline-block bg-amber-500/10 text-amber-400 text-[9px] sm:text-xs font-semibold uppercase tracking-widest px-2 py-0.5 rounded-full border border-amber-500/20">
                        Organisation & Innovation
                    </span>
                    <h1 class="text-xl sm:text-4xl md:text-6xl font-black text-white tracking-tight leading-tight">
                        Construire un avenir <span class="text-amber-500">Excellence</span> & Impact.
                    </h1>
                    <p class="text-slate-300 text-[11px] sm:text-base md:text-lg leading-relaxed max-w-xl mx-auto md:mx-0">
                        EXCELLENT UNIT est une organisation axée sur le développement, l'éducation, la recherche et l'impact social durable.
                    </p>
                    
                    <!-- Boutons compacts qui restent centrés sans déborder -->
                    <div class="flex flex-col sm:flex-row justify-center md:justify-start gap-2 pt-1 w-full max-w-[240px] sm:max-w-none mx-auto">
                        <a href="#about" class="bg-amber-500 hover:bg-amber-600 text-slate-950 font-bold text-[10px] sm:text-base px-3 py-2 rounded-md shadow transition duration-200 text-center whitespace-nowrap">
                            Découvrir notre mission
                        </a>
                        <a href="#contact" class="border border-slate-700 hover:border-amber-500 text-slate-200 hover:text-amber-400 font-semibold text-[10px] sm:text-base px-3 py-2 rounded-md transition duration-200 text-center whitespace-nowrap">
                            Nous contacter
                        </a>
                    </div>
                </div>

                <!-- Canvas 3D Three.js placé proprement sous les boutons -->
                <div class="relative flex justify-center items-center w-full mt-2 md:mt-0">
                    <HeroThreeCanvas />
                </div>

            </div>
        </section>

        <!-- Section À Propos -->
        <section id="about" class="py-8 sm:py-20 bg-slate-900 border-b border-slate-800">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center max-w-3xl mx-auto mb-6 sm:mb-16">
                    <h2 class="text-lg sm:text-3xl font-bold text-white">À Propos d'EXCELLENT UNIT</h2>
                    <p class="text-slate-400 text-[11px] sm:text-base mt-1 sm:mt-4">Une vision moderne tournée vers le progrès et le renforcement des capacités.</p>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-3 gap-3 sm:gap-8">
                    <div class="bg-slate-800/50 p-3 sm:p-6 rounded-xl border border-slate-700/50">
                        <div class="text-amber-500 text-sm sm:text-2xl font-bold mb-1">01. Éducation</div>
                        <p class="text-slate-300 text-[11px] sm:text-sm">Formation et accompagnement des talents pour un avenir meilleur.</p>
                    </div>
                    <div class="bg-slate-800/50 p-3 sm:p-6 rounded-xl border border-slate-700/50">
                        <div class="text-amber-500 text-sm sm:text-2xl font-bold mb-1">02. Recherche</div>
                        <p class="text-slate-300 text-[11px] sm:text-sm">Analyse et développement de solutions innovantes et adaptées.</p>
                    </div>
                    <div class="bg-slate-800/50 p-3 sm:p-6 rounded-xl border border-slate-700/50">
                        <div class="text-amber-500 text-sm sm:text-2xl font-bold mb-1">03. Impact Social</div>
                        <p class="text-slate-300 text-[11px] sm:text-sm">Projets concrets visant un développement durable pour les communautés.</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Footer -->
        <Footer />
    </div>
</template>