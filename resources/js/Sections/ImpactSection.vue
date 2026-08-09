<script setup>
defineProps({
  isDark: Boolean,
  stats: {
    type: Array,
    default: () => [
      { value: '100%', label: 'Engagement Communautaire' },
      { value: '5+', label: 'Piliers Stratégiques' },
      { value: '24/7', label: 'Disponibilité du Réseau' },
      { value: '∞', label: 'Impact Durable' }
    ]
  }
});
</script>

<template>
  <section id="impact" class="min-h-screen container mx-auto px-6 flex items-center py-20">
    <div class="w-full">
      <div class="max-w-3xl mb-16 reveal">
        <span class="uppercase tracking-widest text-xs font-bold" :class="isDark ? 'text-[#e3d1be]' : 'text-[#4a2c2a]'">
          01 • Impact Global
        </span>
        <h2 class="text-3xl sm:text-5xl font-extrabold mt-2 leading-tight uppercase">
          Vulgariser le bon sens de la valeur: l'impact par la classe et la profondeur.
        </h2>
      </div>

      <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
        <div 
          v-for="(stat, idx) in stats" 
          :key="idx" 
          class="reveal p-6 rounded-2xl border border-[#4a2c2a]/20 backdrop-blur-md hover:-translate-y-2 transition duration-500 shadow-sm"
          :class="isDark ? 'bg-[#111b21]/60' : 'bg-slate-50/70'"
          :style="`transition-delay: ${idx * 150}ms`"
        >
          <h3 class="text-4xl sm:text-5xl font-black" :class="isDark ? 'text-[#e3d1be]' : 'text-[#f4a261]'">
            {{ stat.value }}
          </h3>
          <p class="text-xs sm:text-sm mt-2 font-medium uppercase tracking-wider opacity-80">
            {{ stat.label }}
          </p>
        </div>
      </div>
    </div>
  </section>
</template>