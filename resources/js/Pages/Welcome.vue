<script setup>
import { ref, onMounted, onUnmounted } from 'vue';
import { Head } from '@inertiajs/vue3';
import Navbar from '@/Components/Navbar.vue';
import Footer from '@/Components/Footer.vue';
import CardThreeCanvas from '@/Components/CardThreeCanvas.vue';

// Gestion du mode Sombre / Clair
const isDarkMode = ref(true);

const toggleTheme = () => {
  isDarkMode.value = !isDarkMode.value;
};

// Suivi de la section active
const activeSection = ref('hero');
const sections = [
  { id: 'hero', title: 'Accueil' },
  { id: 'impact', title: 'Impact Global' },
  { id: 'piliers', title: 'Nos Piliers' },
  { id: 'vision', title: 'Notre Vision' }
];

const stats = [
  { value: '18+', label: 'Programmes Visionnaires' },
  { value: '24', label: 'Communautés Actives' },
  { value: '03', label: 'Centres d\'Innovation' },
  { value: '99%', label: 'Expérience Immersive' }
];

const pillars = [
  { code: '01 • Architecture', title: 'Structures Futures', description: 'Concevoir des espaces capables de fusionner émotion, technologie et puissance visuelle.', image: '/images/archi.jpeg' },
  { code: '02 • Intelligence', title: 'Éducation Moderne', description: 'Formez une génération prête à transformer les systèmes complexes du futur.', image: '/images/education.jpg' },
  { code: '03 • Nature', title: 'Équilibre Digital', description: 'Développer un futur où innovation technologique et environnement avancent ensemble.', image: '/images/environnement.jpeg' },
  { code: '04 • Leadership', title: 'Puissance Humaine', description: 'Accélérer l\'émergence de nouveaux leaders inspirants et engagés.', image: '/images/leadership.jpeg' }
];

let observer = null;

onMounted(() => {
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
});

onUnmounted(() => {
  if (observer) observer.disconnect();
});
</script>

<template>
  <Head title="EXCELLENT UNIT — Beyond Vision" />

  <div :class="[isDarkMode ? 'dark bg-[#0b141a] text-slate-100' : 'light bg-white text-slate-900', 'relative min-h-screen font-sans transition-colors duration-500 overflow-x-hidden']">
    
    <!-- Bouton Bascule Mode Sombre / Mode Clair -->
    <button 
      @click="toggleTheme" 
      class="fixed top-24 right-6 z-50 p-3 rounded-full backdrop-blur-md border border-[#4a2c2a]/30 shadow-lg transition-transform hover:scale-110"
      :class="isDarkMode ? 'bg-[#111b21] text-[#e3d1be]' : 'bg-slate-100 text-[#4a2c2a]'"
    >
      <span v-if="isDarkMode">☀️ Light</span>
      <span v-else>🌙 Dark</span>
    </button>

    <!-- 1. GRILLE VISUELLE EN ARRIÈRE-PLAN -->
    <div class="pointer-events-none fixed inset-0 z-20 size-full">
      <div class="container relative grid h-full grid-cols-4 mx-auto px-6 opacity-10">
        <div class="border-r border-[#4a2c2a]"></div>
        <div class="border-r border-[#4a2c2a]"></div>
        <div class="border-r border-[#4a2c2a] hidden md:block"></div>
        <div class="border-r border-[#4a2c2a] hidden lg:block"></div>
      </div>
    </div>

    <!-- 2. SCÈNE 3D THREE.JS EN ARRIÈRE-PLAN FIXE -->
    <div class="fixed inset-0 z-0 pointer-events-none w-full h-full">
      <CardThreeCanvas :activeSection="activeSection" :isDark="isDarkMode" />
    </div>

    <!-- 3. NAVBAR -->
    <Navbar class="relative z-30" />

    <!-- 4. NAVIGATION LATÉRALE INTERACTIVE -->
    <nav aria-label="Sections de la page" class="hidden lg:flex pointer-events-none fixed inset-0 z-30 items-center">
      <ul class="container mx-auto px-6 space-y-4">
        <li v-for="sec in sections" :key="sec.id" class="pointer-events-auto">
          <a
            :href="`#${sec.id}`"
            :title="sec.title"
            class="group flex items-center gap-3 py-1 text-xs uppercase tracking-widest transition-all duration-300"
            :class="activeSection === sec.id ? (isDarkMode ? 'text-[#e3d1be] font-bold' : 'text-[#f4a261] font-bold') : 'text-[#4a2c2a]/60 hover:text-[#4a2c2a]'"
          >
            <span
              class="block h-0.5 rounded-full transition-all duration-500"
              :class="activeSection === sec.id ? (isDarkMode ? 'w-8 bg-[#e3d1be]' : 'w-8 bg-[#f4a261]') : 'w-2 bg-[#4a2c2a]/40 group-hover:w-4'"
            ></span>
            <span class="opacity-0 group-hover:opacity-100 transition-opacity duration-300">{{ sec.title }}</span>
          </a>
        </li>
      </ul>
    </nav>

    <!-- 5. CONTENU SCROLLABLE -->
    <main class="relative z-10">
      
      <!-- HERO -->
      <section id="hero" class="min-h-screen container mx-auto px-6 flex items-center pt-24 pb-16">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-center w-full">
          <div class="lg:col-span-7 space-y-6 reveal">
            <span class="inline-block text-xs font-semibold uppercase tracking-widest px-4 py-1.5 rounded-full border border-[#4a2c2a]/30 backdrop-blur-md"
                  :class="isDarkMode ? 'bg-[#e3d1be]/10 text-[#e3d1be]' : 'bg-[#f4a261]/10 text-[#4a2c2a]'">
              Innovation & Impact Social
            </span>
            
            <h1 class="text-4xl sm:text-6xl lg:text-7xl font-black tracking-tight leading-none uppercase">
              GARANTIR LE SENS DU LONG TERME<span :class="isDarkMode ? 'text-[#e3d1be]' : 'text-[#f4a261]'" class="block mt-2">PAR EXCELLENCE.</span>
            </h1>
            
            <p class="text-sm sm:text-base md:text-lg leading-relaxed max-w-xl backdrop-blur-md p-4 rounded-xl border border-[#4a2c2a]/20"
               :class="isDarkMode ? 'bg-[#111b21]/70 text-slate-300' : 'bg-slate-50/80 text-slate-700'">
                Établir des systèmes communautaires accessibles, universels, actuels, sur mesure et durables. Transformer les défis locaux en opportunités de progrès pour un impact durable.
            </p>
            
            <div class="flex flex-wrap gap-4 pt-4">
              <a href="#impact" 
                 class="font-bold text-sm px-7 py-3.5 rounded-full shadow-lg hover:scale-105 transition duration-300"
                 :class="isDarkMode ? 'bg-[#e3d1be] text-[#0b141a] hover:bg-white' : 'bg-[#4a2c2a] text-white hover:bg-[#6d4c41]'">
                Découvrir la vision →
              </a>
              <a href="#piliers" 
                 class="border border-[#4a2c2a]/40 font-semibold text-sm px-7 py-3.5 rounded-full backdrop-blur-md hover:scale-105 transition duration-300"
                 :class="isDarkMode ? 'text-slate-200 hover:border-[#e3d1be]' : 'text-[#4a2c2a] hover:border-[#4a2c2a]'">
                Nos piliers
              </a>
            </div>
          </div>
        </div>
      </section>

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

    </main>

    <!-- FOOTER -->
    <Footer class="relative z-10 border-t border-[#4a2c2a]/30 backdrop-blur-md" :class="isDarkMode ? 'bg-[#0b141a]/90' : 'bg-white/90'" />
  </div>
</template>

<style scoped>
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