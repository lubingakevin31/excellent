<script setup>
import { ref, onMounted, onUnmounted } from 'vue';
import { Head } from '@inertiajs/vue3';

// Composants de structure
import Navbar from '@/Components/Navbar.vue';
import Footer from '@/Components/Footer.vue';
import CardThreeCanvas from '@/Components/CardThreeCanvas.vue';

// Sections modulaires
import HeroSection from '@/Sections/HeroSection.vue';
import ImpactSection from '@/Sections/ImpactSection.vue';
import PiliersSection from '@/Sections/PiliersSection.vue';
import VisionSection from '@/Sections/VisionSection.vue';

// Données statiques
const stats = [
  { value: '100%', label: 'Engagement Communautaire' },
  { value: '5+', label: 'Piliers Stratégiques' },
  { value: '24/7', label: 'Disponibilité du Réseau' },
  { value: '∞', label: 'Impact Durable' }
];

const pillars = [
  {
    code: '01',
    title: 'Architecture & Design',
    description: 'Conception de cadres durables et adaptés aux réalités locales.',
    image: '/images/archi.jpeg'
  },
  {
    code: '02',
    title: 'Éducation & Formation',
    description: 'Renforcement des compétences et autonomisation des acteurs.',
    image: '/images/education.jpg'
  },
  {
    code: '03',
    title: 'Environnement',
    description: 'Preservation des écosystèmes et transition écologique.',
    image: '/images/environnement.jpeg'
  },
  {
    code: '04',
    title: 'Leadership & Innovation',
    description: 'Inkubation de solutions novatrices à fort impact.',
    image: '/images/innovation.jpg'
  }
];

// Gestion du mode Sombre / Clair et navigation active
const isDarkMode = ref(true);
const activeSection = ref('hero');

let observer = null;

onMounted(() => {
  // Délai pour s'assurer du rendu complet des composants enfants dans le DOM
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
      <HeroSection :isDark="isDarkMode" />
      <ImpactSection :isDark="isDarkMode" :stats="stats" />
      <PiliersSection :isDark="isDarkMode" :pillars="pillars" />
      <VisionSection :isDark="isDarkMode" />
    </main>

    <!-- Pied de page -->
    <Footer class="relative z-10 border-t border-cocoa/30 backdrop-blur-md" :class="isDarkMode ? 'bg-night/90' : 'bg-white/90'" />
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