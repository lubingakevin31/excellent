<script setup>
defineProps({
  isDark: Boolean
});
</script>

<template>
  <section id="vision" class="min-h-screen container mx-auto px-6 flex items-center py-20">
    <div class="w-full max-w-4xl mx-auto text-center reveal">
      <span class="uppercase tracking-widest text-xs font-bold" :class="isDark ? 'text-[#e3d1be]' : 'text-[#4a2c2a]'">
        03 • Notre Vision
      </span>
      <h2 class="text-3xl sm:text-6xl font-black mt-4 leading-tight uppercase">
        Repousser les limites de ce qui est possible.
      </h2>
      <p class="text-lg sm:text-xl mt-6 leading-relaxed max-w-2xl mx-auto opacity-80">
        Chaque projet mené au sein d'EXCELLENT UNIT est conçu pour durer, inspirer et générer un changement mesurable.
      </p>
    </div>
  </section>
</template>