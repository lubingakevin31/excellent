<script setup>
defineProps({
  isDark: Boolean,
  pillars: {
    type: Array,
    default: () => [
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
        description: 'Préservation des écosystèmes et transition écologique.',
        image: '/images/environnement.jpeg'
      },
      {
        code: '04',
        title: 'Leadership & Innovation',
        description: 'Incubation de solutions novatrices à fort impact.',
        image: '/images/innovation.jpg'
      }
    ]
  }
});
</script>

<template>
  <section id="piliers" class="min-h-screen container mx-auto px-6 flex items-center py-20">
    <div class="w-full">
      <div class="max-w-3xl mb-16 reveal">
        <span class="uppercase tracking-widest text-xs font-bold" :class="isDark ? 'text-[#e3d1be]' : 'text-[#4a2c2a]'">
          02 • Univers & Piliers
        </span>
        <h2 class="text-3xl sm:text-5xl font-extrabold mt-2">
          Des idées transformées en expériences réelles.
        </h2>
      </div>

      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
        <div 
          v-for="(pillar, idx) in pillars" 
          :key="idx"
          class="reveal group relative h-[380px] rounded-2xl overflow-hidden border border-[#4a2c2a]/30 hover:border-[#4a2c2a] transition duration-500 shadow-xl backdrop-blur-sm"
          :style="`transition-delay: ${idx * 150}ms`"
        >
          <img 
            :src="pillar.image" 
            :alt="pillar.title" 
            class="absolute inset-0 w-full h-full object-cover group-hover:scale-110 transition duration-700 opacity-40 group-hover:opacity-60" 
          />
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
</template>