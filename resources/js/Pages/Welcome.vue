<script setup>
import { ref, onMounted, onUnmounted } from 'vue';
import { Head } from '@inertiajs/vue3';

<<<<<<< HEAD
// Composants de structure
=======
>>>>>>> 65fbf42 (refactor: update HeroSection with glassmorphism full-surface and 3:4 carousel)
import Navbar from '@/Components/Navbar.vue';
import Footer from '@/Components/Footer.vue';
import CardThreeCanvas from '@/Components/CardThreeCanvas.vue';

<<<<<<< HEAD
// Sections
import HeroSection from '@/Sections/HeroSection.vue';
import ImpactSection from '@/Sections/ImpactSection.vue';
import PiliersSection from '@/Sections/PiliersSection.vue';
import VisionSection from '@/Sections/VisionSection.vue';

=======
// Import de la nouvelle section Hero modularisée
import HeroSection from '@/Sections/HeroSection.vue';

// Gestion du mode Sombre / Clair
>>>>>>> 65fbf42 (refactor: update HeroSection with glassmorphism full-surface and 3:4 carousel)
const isDarkMode = ref(true);
const activeSection = ref('hero');

let observer = null;

onMounted(() => {
  // Petit délai pour s'assurer que les composants enfants (comme HeroSection) sont bien rendus dans le DOM
  setTimeout(() => {
    observer = new IntersectionObserver(
      (entries) => {
        entries.forEach((entry) => {
          if (entry.isIntersecting) {
            activeSection.value = entry.target.id;
            entry.target.classList.add('is-visible');
          }
        });
      },
      { threshold: 0.3 }
    );

    document.querySelectorAll('section[id]').forEach((sec) => observer.observe(sec));
    document.querySelectorAll('.reveal').forEach((el) => observer.observe(el));
  }, 100);
});

onUnmounted(() => {
  if (observer) observer.disconnect();
});
</script>

<template>
  <Head title="EXCELLENT UNIT — Beyond Vision" />

  <div :class="[isDarkMode ? 'dark bg-night text-slate-100' : 'light bg-white text-slate-900', 'relative min-h-screen font-sans transition-colors duration-500 overflow-x-hidden']">
    
    <!-- Scène 3D globale en arrière-plan -->
    <div class="fixed inset-0 z-0 pointer-events-none w-full h-full">
      <CardThreeCanvas :activeSection="activeSection" :isDark="isDarkMode" />
    </div>

    <!-- Navigation -->
    <Navbar class="relative z-30" />

    <!-- Sections modulaires -->
    <main class="relative z-10">
<<<<<<< HEAD
      <HeroSection :isDark="isDarkMode" />
      <ImpactSection :isDark="isDarkMode" />
      <PiliersSection :isDark="isDarkMode" />
      <VisionSection :isDark="isDarkMode" />
=======
      
      <!-- HERO SECTION MODULARISÉE -->
      <HeroSection :isDark="isDarkMode" />

      <!-- IMPACT GLOBAL -->
      <section id="impact" class="min-h-screen container mx-auto px-6 flex items-center py-20">
        <div class="w-full">
          <div class="max-w-3xl mb-16 reveal">
            <span class="uppercase tracking-widest text-xs font-bold" :class="isDarkMode ? 'text-[#e3d1be]' : 'text-[#4a2c2a]'">01 • Impact Global</span>
            <h2 class="text-3xl sm:text-5xl font-extrabold mt-2 leading-tight uppercase">
                vulgariser le bon sens de la valeur: l'impact par la classe et la profondeur.
            </h2>
          </div>

          <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
            <div v-for="(stat, idx) in stats" :key="idx" 
                 class="reveal p-6 rounded-2xl border border-[#4a2c2a]/20 backdrop-blur-md hover:-translate-y-2 transition duration-500 shadow-sm"
                 :class="isDarkMode ? 'bg-[#111b21]/60' : 'bg-slate-50/70'"
                 :style="`transition-delay: ${idx * 150}ms`">
              <h3 class="text-4xl sm:text-5xl font-black" :class="isDarkMode ? 'text-[#e3d1be]' : 'text-[#f4a261]'">{{ stat.value }}</h3>
              <p class="text-xs sm:text-sm mt-2 font-medium uppercase tracking-wider opacity-80">{{ stat.label }}</p>
            </div>
          </div>
        </div>
      </section>

      <!-- PILIERS STRATÉGIQUES -->
      <section id="piliers" class="min-h-screen container mx-auto px-6 flex items-center py-20">
        <div class="w-full">
          <div class="max-w-3xl mb-16 reveal">
            <span class="uppercase tracking-widest text-xs font-bold" :class="isDarkMode ? 'text-[#e3d1be]' : 'text-[#4a2c2a]'">02 • Univers & Piliers</span>
            <h2 class="text-3xl sm:text-5xl font-extrabold mt-2">
              Des idées transformées en expériences réelles.
            </h2>
          </div>

          <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            <div v-for="(pillar, idx) in pillars" :key="idx"
                 class="reveal group relative h-[380px] rounded-2xl overflow-hidden border border-[#4a2c2a]/30 hover:border-[#4a2c2a] transition duration-500 shadow-xl backdrop-blur-sm"
                 :style="`transition-delay: ${idx * 150}ms`">
              <img :src="pillar.image" :alt="pillar.title" class="absolute inset-0 w-full h-full object-cover group-hover:scale-110 transition duration-700 opacity-40 group-hover:opacity-60" />
              <div class="absolute inset-0 bg-gradient-to-t from-[#4a2c2a] via-[#4a2c2a]/30 to-transparent"></div>
              <div class="absolute inset-0 p-6 flex flex-col justify-end z-10 text-white">
                <span class="text-[#e3d1be] text-xs font-bold uppercase tracking-widest">{{ pillar.code }}</span>
                <h3 class="text-xl font-bold mt-1 mb-2 group-hover:text-[#e3d1be] transition duration-300">{{ pillar.title }}</h3>
                <p class="text-xs leading-relaxed opacity-90 text-slate-200">{{ pillar.description }}</p>
              </div>
            </div>
          </div>
        </div>
      </section>

      <!-- VISION -->
      <section id="vision" class="min-h-screen container mx-auto px-6 flex items-center py-20">
        <div class="w-full max-w-4xl mx-auto text-center reveal">
          <span class="uppercase tracking-widest text-xs font-bold" :class="isDarkMode ? 'text-[#e3d1be]' : 'text-[#4a2c2a]'">03 • Notre Vision</span>
          <h2 class="text-3xl sm:text-6xl font-black mt-4 leading-tight">
            Repousser les limites de ce qui est possible.
          </h2>
          <p class="text-lg sm:text-xl mt-6 leading-relaxed max-w-2xl mx-auto opacity-80">
            Chaque projet mené au sein d'EXCELLENT UNIT est conçu pour durer, inspirer et générer un changement mesurable.
          </p>
        </div>
      </section>

>>>>>>> 65fbf42 (refactor: update HeroSection with glassmorphism full-surface and 3:4 carousel)
    </main>

    <!-- Pied de page -->
    <Footer class="relative z-10 border-t border-cocoa/30 backdrop-blur-md" :class="isDarkMode ? 'bg-night/90' : 'bg-white/90'" />
  </div>
<<<<<<< HEAD
</template>
=======
</template>

<style scoped>
/* Conserve cette partie dans ton Welcome.vue tant que les autres sections ne sont pas modularisées */
.reveal {
  opacity: 0;
  transform: translateY(3rem);
  will-change: opacity, transform;
  transition: opacity 0.8s ease, transform 0.8s ease;
}

.reveal.is-visible {
  opacity: 1 !important;
  transform: translateY(0) !important;
}
</style>
>>>>>>> 65fbf42 (refactor: update HeroSection with glassmorphism full-surface and 3:4 carousel)
