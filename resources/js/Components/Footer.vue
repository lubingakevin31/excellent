<script setup>
</script>

<template>
  <footer class="bg-slate-950 text-slate-400 py-8 sm:py-12 border-t border-slate-800">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 grid grid-cols-1 md:grid-cols-3 gap-6 sm:gap-8">
      
      <div>
        <h3 class="text-white font-bold text-base sm:text-lg mb-2 sm:mb-3">EXCELLENT UNIT</h3>
        <p class="text-xs sm:text-sm leading-relaxed">
          Organisation axée sur le développement, l'éducation, la recherche et l'impact social durable.
        </p>
      </div>

      <div>
        <h4 class="text-white font-semibold text-xs sm:text-base mb-2 sm:mb-3">Navigation</h4>
        <ul class="space-y-1 sm:space-y-2 text-xs sm:text-sm">
          <li><a href="#about" class="hover:text-amber-400 transition">À Propos</a></li>
          <li><a href="#programs" class="hover:text-amber-400 transition">Nos Programmes</a></li>
          <li><a href="#contact" class="hover:text-amber-400 transition">Contact</a></li>
        </ul>
      </div>

      <div>
        <h4 class="text-white font-semibold text-xs sm:text-base mb-2 sm:mb-3">Contact Officiel</h4>
        <p class="text-xs sm:text-sm mb-1">📧 Email : <a href="mailto:excellentunit@gmail.com" class="text-amber-400 hover:underline">excellentunit@gmail.com</a></p>
      </div>

    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-6 sm:mt-8 pt-4 sm:pt-6 border-t border-slate-900 text-center text-[10px] sm:text-xs">
      &copy; {{ new Date().getFullYear() }} EXCELLENT UNIT. Tous droits réservés.
    </div>
  </footer>
</template>