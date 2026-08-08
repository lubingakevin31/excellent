<script setup>
import { ref, onMounted, onUnmounted } from 'vue';
import { Head } from '@inertiajs/vue3';

// Composants de structure
import Navbar from '@/Components/Navbar.vue';
import Footer from '@/Components/Footer.vue';
import CardThreeCanvas from '@/Components/CardThreeCanvas.vue';

// Sections
import HeroSection from '@/Sections/HeroSection.vue';
import ImpactSection from '@/Sections/ImpactSection.vue';
import PiliersSection from '@/Sections/PiliersSection.vue';
import VisionSection from '@/Sections/VisionSection.vue';

const isDarkMode = ref(true);
const activeSection = ref('hero');

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
      <ImpactSection :isDark="isDarkMode" />
      <PiliersSection :isDark="isDarkMode" />
      <VisionSection :isDark="isDarkMode" />
    </main>

    <!-- Pied de page -->
    <Footer class="relative z-10 border-t border-cocoa/30 backdrop-blur-md" :class="isDarkMode ? 'bg-night/90' : 'bg-white/90'" />
  </div>
</template>