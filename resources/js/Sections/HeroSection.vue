<script setup>
import PrimaryButton from '@/Components/Buttons/PrimaryButton.vue';
import SecondaryButton from '@/Components/Buttons/SecondaryButton.vue';

defineProps({
  isDark: Boolean
});
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