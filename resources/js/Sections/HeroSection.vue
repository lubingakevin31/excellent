<script setup>
<<<<<<< HEAD
import PrimaryButton from '@/Components/Buttons/PrimaryButton.vue';
import SecondaryButton from '@/Components/Buttons/SecondaryButton.vue';
=======
import { ref } from 'vue';
import Hero3DCarousel from '@/Components/Hero3DCarousel.vue';
>>>>>>> 65fbf42 (refactor: update HeroSection with glassmorphism full-surface and 3:4 carousel)

defineProps({
  isDark: Boolean
});
<<<<<<< HEAD
</script>

<template>
  <section id="hero" class="min-h-screen container mx-auto px-6 flex items-center pt-24 pb-16">
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-center w-full">
      <div class="lg:col-span-7 space-y-6 reveal">
        
        <!-- Badge -->
        <span class="inline-block text-xs font-semibold uppercase tracking-widest px-4 py-1.5 rounded-full border border-cocoa/30 backdrop-blur-md"
              :class="isDark ? 'bg-pierre/10 text-pierre' : 'bg-casablanca/10 text-cocoa'">
          Innovation & Impact Social
        </span>
        
        <!-- Main Title -->
        <h1 class="text-4xl sm:text-6xl lg:text-7xl font-black tracking-tight leading-none uppercase">
          GARANTIR LE SENS DU LONG TERME
          <span :class="isDark ? 'text-pierre' : 'text-casablanca'" class="block mt-2">PAR EXCELLENCE.</span>
        </h1>
        
        <!-- Main Content -->
        <p class="text-sm sm:text-base md:text-lg leading-relaxed max-w-xl backdrop-blur-md p-4 rounded-xl border border-cocoa/20"
           :class="isDark ? 'bg-night-card/70 text-slate-300' : 'bg-slate-50/80 text-slate-700'">
            Établir des systèmes communautaires accessibles, universels, actuels, sur mesure et durables. Transformer les défis locaux en opportunités de progrès pour un impact durable.
        </p>
        
        <!-- CTA Group -->
        <div class="flex flex-wrap gap-4 pt-4">
          <PrimaryButton href="#impact" :isDark="isDark">
            Découvrir la vision →
          </PrimaryButton>
          
          <SecondaryButton href="#piliers" :isDark="isDark">
            Nos piliers
          </SecondaryButton>
        </div>

      </div>
    </div>
  </section>
</template>
=======

const carouselRef = ref(null);

const galleryImages = [
  '/images/archi.jpeg',
  '/images/education.jpg',
  '/images/environnement.jpeg',
  '/images/leadership.jpeg',
  '/images/innovation.jpg'
];
</script>

<template>
  <section id="hero" class="min-h-screen container mx-auto px-4 sm:px-6 flex items-center pt-28 pb-16 relative z-10">
    
    <!-- CADRE PRINCIPAL CONTENANT LES STRATES D'EFFETS -->
    <div class="w-full rounded-3xl relative overflow-hidden shadow-2xl group/hero">
      
      <!-- LAYER 0 (ARRIÈRE-PLAN) : CARROUSEL THREE.JS EN FORMAT 3:4 -->
      <div class="absolute inset-0 z-0 flex items-center justify-end pr-4 sm:pr-12 pointer-events-auto">
        <div class="w-full lg:w-1/2 flex justify-center lg:justify-end">
          <Hero3DCarousel 
            ref="carouselRef"
            :images="galleryImages" 
            :isDark="isDark" 
          />
        </div>
      </div>

      <!-- LAYER 1 : 4 BULLES ET TRAÎNÉES EN ARRIÈRE-PLAN DES TEXTES -->
      <div class="absolute inset-0 pointer-events-none overflow-hidden z-1">
        <div class="drop drop-1 absolute w-16 h-16 rounded-full blur-xs opacity-75 bg-gradient-to-r from-[#CFAE4F] to-transparent shadow-[0_0_30px_#CFAE4F]"></div>
        <div class="drop drop-2 absolute w-20 h-20 rounded-full blur-sm opacity-65 bg-gradient-to-r from-[#D97742] to-transparent shadow-[0_0_35px_#D97742]"></div>
        <div class="drop drop-3 absolute w-14 h-14 rounded-full blur-xs opacity-70 bg-gradient-to-r from-[#9CAF88] to-transparent shadow-[0_0_25px_#9CAF88]"></div>
        <div class="drop drop-4 absolute w-18 h-18 rounded-full blur-sm opacity-65 bg-gradient-to-r from-[#E8C4C4] to-transparent shadow-[0_0_30px_#E8C4C4]"></div>
      </div>

      <!-- LAYER 2 : PLAQUE DE VERRE GLASSMORPHISM (ALLÉGÉE À DROITE ET POUR LES BULLES) -->
      <div 
        class="absolute inset-0 z-10 p-6 sm:p-12 rounded-3xl border transition-all duration-700 pointer-events-none glass-mask"
        :class="isDark 
          ? 'bg-[#0b141a]/50 border-white/10 shadow-black/60' 
          : 'bg-white/50 border-slate-200/60 shadow-slate-300/40'"
      ></div>

      <!-- LAYER 3 : CONTENU TEXTE ET INTERACTIF (AU PREMIER PLAN) -->
      <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-12 items-center p-6 sm:p-12 relative z-20 pointer-events-auto">
        
        <!-- ZONE TEXTE -->
        <div class="lg:col-span-6 space-y-8 reveal">
          
          <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full border backdrop-blur-md text-xs font-bold uppercase tracking-widest"
               :class="isDark 
                 ? 'bg-[#CFAE4F]/10 text-[#CFAE4F] border-[#CFAE4F]/30' 
                 : 'bg-[#D97742]/10 text-[#D97742] border-[#D97742]/30'">
            <span class="w-2 h-2 rounded-full animate-ping" :class="isDark ? 'bg-[#CFAE4F]' : 'bg-[#D97742]'"></span>
            <span>Innovation & Impact Social</span>
          </div>

          <h1 class="text-5xl sm:text-7xl lg:text-8xl font-black tracking-tight uppercase leading-[0.95]">
            GARANTIR LE SENS 
            <span class="block mt-2 bg-gradient-to-r from-[#CFAE4F] via-[#E08A70] via-[#D97742] to-[#E8C4C4] bg-clip-text text-transparent drop-shadow-sm">
              DU LONG TERME.
            </span>
          </h1>

          <p class="text-base sm:text-lg leading-relaxed font-medium opacity-90 max-w-xl border-none p-0 bg-transparent"
             :class="isDark ? 'text-slate-200' : 'text-slate-800'">
              Établir des systèmes communautaires accessibles, universels, actuels, sur mesure et durables. Transformer les défis locaux en opportunités de progrès pour un impact mesurable.
          </p>

          <div class="flex flex-wrap gap-4 pt-2">
            <a 
              href="#impact" 
              class="font-bold text-sm px-8 py-4 rounded-full shadow-xl hover:scale-105 transition-all duration-300 flex items-center gap-2"
              :class="isDark 
                ? 'bg-gradient-to-r from-[#CFAE4F] to-[#D97742] text-slate-950 shadow-[#CFAE4F]/20 hover:brightness-110' 
                : 'bg-[#4a2c2a] text-white hover:bg-[#6d4c41] shadow-[#4a2c2a]/20'"
            >
              Découvrir la vision →
            </a>
            
            <a 
              href="#piliers" 
              class="border font-semibold text-sm px-8 py-4 rounded-full backdrop-blur-md hover:scale-105 transition-all duration-300"
              :class="isDark 
                ? 'border-white/20 text-slate-200 hover:border-[#CFAE4F] hover:text-[#CFAE4F]' 
                : 'border-[#4a2c2a]/30 text-[#4a2c2a] hover:border-[#4a2c2a] bg-white/30'"
            >
              Nos piliers
            </a>
          </div>

        </div>

        <!-- ESPACEMENT DROITE POUR ALIGNEMENT PARFAIT AVEC LE CARROUSEL EN ARRIÈRE-PLAN -->
        <div class="lg:col-span-6 h-[480px] hidden lg:block pointer-events-none"></div>

      </div>

    </div>
  </section>
</template>

<style scoped>
/* Floutage dégradé : plus prononcé à gauche pour la lisibilité du texte, très léger à droite pour rendre le carrousel net */
.glass-mask {
  backdrop-filter: blur(12px);
  -webkit-backdrop-filter: blur(12px);
  mask-image: linear-gradient(to right, rgba(0, 0, 0, 1) 0%, rgba(0, 0, 0, 0.5) 50%, rgba(0, 0, 0, 0.2) 100%);
  -webkit-mask-image: linear-gradient(to right, rgba(0, 0, 0, 1) 0%, rgba(0, 0, 0, 0.5) 50%, rgba(0, 0, 0, 0.2) 100%);
}

/* Animations fluides des 4 bulles */
@keyframes floatDrop1 {
  0% { top: -10%; left: 10%; opacity: 0; }
  20% { opacity: 0.85; }
  80% { opacity: 0.85; }
  100% { top: 110%; left: 80%; opacity: 0; }
}

@keyframes floatDrop2 {
  0% { top: 20%; left: -10%; opacity: 0; }
  20% { opacity: 0.75; }
  80% { opacity: 0.75; }
  100% { top: 90%; left: 110%; opacity: 0; }
}

@keyframes floatDrop3 {
  0% { top: 110%; left: 30%; opacity: 0; }
  20% { opacity: 0.8; }
  80% { opacity: 0.8; }
  100% { top: -10%; left: 70%; opacity: 0; }
}

@keyframes floatDrop4 {
  0% { top: 70%; left: 110%; opacity: 0; }
  20% { opacity: 0.7; }
  80% { opacity: 0.7; }
  100% { top: 10%; left: -10%; opacity: 0; }
}

.drop-1 { animation: floatDrop1 14s infinite ease-in-out; }
.drop-2 { animation: floatDrop2 18s infinite ease-in-out 3s; }
.drop-3 { animation: floatDrop3 16s infinite ease-in-out 6s; }
.drop-4 { animation: floatDrop4 20s infinite ease-in-out 2s; }
</style>
>>>>>>> 65fbf42 (refactor: update HeroSection with glassmorphism full-surface and 3:4 carousel)
