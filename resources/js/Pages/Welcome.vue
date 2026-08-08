<script setup>
import { Head } from '@inertiajs/vue3';
import { ref, onMounted, onUnmounted } from 'vue';
import Navbar from '@/Components/Navbar.vue';
import Footer from '@/Components/Footer.vue';
import CardThreeCanvas from '@/Components/CardThreeCanvas.vue';

// Suivi de la section active pour animer la scène 3D et la navigation
const activeSection = ref('hero');
const sections = [
  { id: 'hero', title: 'Accueil' },
  { id: 'impact', title: 'Impact Global' },
  { id: 'piliers', title: 'Nos Piliers' },
  { id: 'vision', title: 'Notre Vision' }
];

// Données des statistiques
const stats = [
  { value: '18+', label: 'Programmes Visionnaires' },
  { value: '24', label: 'Communautés Actives' },
  { value: '03', label: 'Centres d\'Innovation' },
  { value: '99%', label: 'Expérience Immersive' }
];

// Données des piliers
const pillars = [
  { code: '01 • Architecture', title: 'Structures Futures', description: 'Concevoir des espaces capables de fusionner émotion, technologie et puissance visuelle.', image: '/images/archi.jpeg' },
  { code: '02 • Intelligence', title: 'Éducation Moderne', description: 'Formez une génération prête à transformer les systèmes complexes du futur.', image: '/images/education.jpg' },
  { code: '03 • Nature', title: 'Équilibre Digital', description: 'Développer un futur où innovation technologique et environnement avancent ensemble.', image: '/images/environnement.jpeg' },
  { code: '04 • Leadership', title: 'Puissance Humaine', description: 'Accélérer l\'émergence de nouveaux leaders inspirants et engagés.', image: '/images/leadership.jpeg' }
];

let observer = null;

onMounted(() => {
  // IntersectionObserver pour détecter la section active lors du scroll
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

  <div class="relative min-h-screen bg-slate-950 text-slate-100 font-sans selection:bg-amber-500 selection:text-slate-950 overflow-x-hidden">
    
    <!-- 1. GRILLE VISUELLE EN ARRIÈRE-PLAN (Style Musée) -->
    <div class="pointer-events-none fixed inset-0 z-20 size-full">
      <div class="container relative grid h-full grid-cols-4 mx-auto px-6 opacity-15">
        <div class="border-r border-slate-700/40 border-l"></div>
        <div class="border-r border-slate-700/40"></div>
        <div class="border-r border-slate-700/40 hidden md:block"></div>
        <div class="border-r border-slate-700/40 hidden lg:block"></div>
      </div>
    </div>

    <!-- 2. SCÈNE 3D THREE.JS EN ARRIÈRE-PLAN FIXE -->
    <div class="fixed inset-0 z-0 pointer-events-none w-full h-full">
      <CardThreeCanvas :activeSection="activeSection" />
    </div>

    <!-- 3. NAVBAR -->
    <Navbar class="relative z-30" />

    <!-- 4. NAVIGATION LATÉRALE INTERACTIVE (Puces de suivi de scroll) -->
    <nav aria-label="Sections de la page" class="hidden lg:flex pointer-events-none fixed inset-0 z-30 items-center">
      <ul class="container mx-auto px-6 space-y-4">
        <li v-for="sec in sections" :key="sec.id" class="pointer-events-auto">
          <a
            :href="`#${sec.id}`"
            :title="sec.title"
            class="group flex items-center gap-3 py-1 text-xs uppercase tracking-widest transition-all duration-300"
            :class="activeSection === sec.id ? 'text-amber-400 font-bold' : 'text-slate-500 hover:text-slate-300'"
          >
            <span
              class="block h-0.5 rounded-full transition-all duration-500"
              :class="activeSection === sec.id ? 'w-8 bg-amber-400' : 'w-2 bg-slate-600 group-hover:w-4'"
            ></span>
            <span class="opacity-0 group-hover:opacity-100 transition-opacity duration-300">{{ sec.title }}</span>
          </a>
        </li>
      </ul>
    </nav>

    <!-- 5. CONTENU SCROLLABLE -->
    <main class="relative z-10">
      
      <!-- SECTION 1 : HERO -->
      <section id="hero" class="min-h-screen container mx-auto px-6 flex items-center pt-24 pb-16">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-center w-full">
          <div class="lg:col-span-7 space-y-6 reveal opacity-0 translate-y-12 transition-all duration-1000">
            <span class="inline-block bg-amber-500/10 text-amber-400 text-xs font-semibold uppercase tracking-widest px-4 py-1.5 rounded-full border border-amber-500/20 backdrop-blur-md">
              Innovation & Impact Social
            </span>
            
            <h1 class="text-4xl sm:text-6xl lg:text-7xl font-black text-white tracking-tight leading-none uppercase">
              GARANTIR LE SENS DU LONG TERME<span class="text-amber-500 block mt-2">PAR EXCELLENCE.</span>
            </h1>
            
            <p class="text-slate-300 text-sm sm:text-base md:text-lg leading-relaxed max-w-xl backdrop-blur-sm bg-slate-950/40 p-4 rounded-xl border border-slate-800/40">
                Établir des systèmes communautaires accessibles, universels, actuels, sur mesure et durables. Transformer les défis locaux en opportunités de progrès pour un impact durable.
            </p>
            
            <div class="flex flex-wrap gap-4 pt-4">
              <a href="#impact" class="bg-amber-500 hover:bg-amber-400 text-slate-950 font-bold text-sm px-7 py-3.5 rounded-full shadow-lg hover:shadow-amber-500/20 hover:scale-105 transition duration-300">
                Découvrir la vision →
              </a>
              <a href="#piliers" class="border border-slate-700 hover:border-amber-500/60 text-slate-200 hover:text-amber-400 font-semibold text-sm px-7 py-3.5 rounded-full backdrop-blur-md hover:scale-105 transition duration-300">
                Nos piliers
              </a>
            </div>
          </div>
        </div>
      </section>

      <!-- SECTION 2 : IMPACT GLOBAL & STATISTIQUES -->
      <section id="impact" class="min-h-screen container mx-auto px-6 flex items-center py-20">
        <div class="w-full">
          <div class="max-w-3xl mb-16 reveal opacity-0 translate-y-12 transition-all duration-1000">
            <span class="text-amber-500 uppercase tracking-widest text-xs font-bold">01 • Impact Global</span>
            <h2 class="text-3xl sm:text-5xl font-extrabold text-white mt-2 leading-tight">
                vulgariser le bon sens de la valeur: l'impact par la classe et la profondeur.
            </h2>
          </div>

          <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
            <div v-for="(stat, idx) in stats" :key="idx" 
                 class="reveal opacity-0 translate-y-12 transition-all duration-700 bg-slate-900/40 backdrop-blur-md p-6 rounded-2xl border border-slate-800/80 hover:border-amber-500/50 hover:-translate-y-2 transition duration-500"
                 :style="`transition-delay: ${idx * 150}ms`">
              <h3 class="text-4xl sm:text-5xl font-black text-amber-500">{{ stat.value }}</h3>
              <p class="text-slate-400 text-xs sm:text-sm mt-2 font-medium uppercase tracking-wider">{{ stat.label }}</p>
            </div>
          </div>
        </div>
      </section>

      <!-- SECTION 3 : PILIERS STRATÉGIQUES -->
      <section id="piliers" class="min-h-screen container mx-auto px-6 flex items-center py-20">
        <div class="w-full">
          <div class="max-w-3xl mb-16 reveal opacity-0 translate-y-12 transition-all duration-1000">
            <span class="text-amber-500 uppercase tracking-widest text-xs font-bold">02 • Univers & Piliers</span>
            <h2 class="text-3xl sm:text-5xl font-extrabold text-white mt-2">
              Des idées transformées en expériences réelles.
            </h2>
          </div>

          <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            <div v-for="(pillar, idx) in pillars" :key="idx"
                 class="reveal opacity-0 translate-y-12 transition-all duration-700 group relative h-[380px] rounded-2xl overflow-hidden border border-slate-800 hover:border-amber-500/80 transition duration-500 shadow-2xl backdrop-blur-sm"
                 :style="`transition-delay: ${idx * 150}ms`">
              <img :src="pillar.image" :alt="pillar.title" class="absolute inset-0 w-full h-full object-cover group-hover:scale-110 transition duration-700 opacity-40 group-hover:opacity-60" />
              <div class="absolute inset-0 bg-gradient-to-t from-slate-950 via-slate-950/40 to-transparent"></div>
              <div class="absolute inset-0 p-6 flex flex-col justify-end z-10">
                <span class="text-amber-400 text-xs font-bold uppercase tracking-widest">{{ pillar.code }}</span>
                <h3 class="text-xl font-bold text-white mt-1 mb-2 group-hover:text-amber-400 transition duration-300">{{ pillar.title }}</h3>
                <p class="text-slate-300 text-xs leading-relaxed opacity-90">{{ pillar.description }}</p>
              </div>
            </div>
          </div>
        </div>
      </section>

      <!-- SECTION 4 : NOTRE VISION -->
      <section id="vision" class="min-h-screen container mx-auto px-6 flex items-center py-20">
        <div class="w-full max-w-4xl mx-auto text-center reveal opacity-0 translate-y-12 transition-all duration-1000">
          <span class="text-amber-500 uppercase tracking-widest text-xs font-bold">03 • Notre Vision</span>
          <h2 class="text-3xl sm:text-6xl font-black text-white mt-4 leading-tight">
            Repousser les limites de ce qui est possible.
          </h2>
          <p class="text-slate-300 text-lg sm:text-xl mt-6 leading-relaxed max-w-2xl mx-auto">
            Chaque projet mené au sein d'EXCELLENT UNIT est conçu pour durer, inspirer et générer un changement mesurable.
          </p>
        </div>
      </section>

    </main>

   <!-- FOOTER -->
    <Footer class="relative z-10 border-t border-slate-800/80 bg-slate-950/90 backdrop-blur-md" />
  </div>
</template>

<style scoped>
/* État initial : masqué et décalé vers le bas */
.reveal {
  opacity: 0;
  transform: translateY(3rem);
  will-change: opacity, transform;
}

/* État révélé au scroll via l'IntersectionObserver */
.reveal.is-visible {
  opacity: 1 !important;
  transform: translateY(0) !important;
}
</style>