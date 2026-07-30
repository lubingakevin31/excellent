<script setup>
import { Link } from '@inertiajs/vue3';
</script>

<template>
  <nav class="bg-slate-900 text-white border-b border-slate-800 sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-1 sm:px-4 lg:px-8">
      <div class="flex items-center justify-between h-12 sm:h-16">
        
        <!-- Logo -->
        <div class="flex items-center shrink-0">
          <span class="font-extrabold text-[10px] xs:text-xs sm:text-xl tracking-wider text-amber-500 whitespace-nowrap">
            EXCELLENT UNIT
          </span>
        </div>

        <!-- Menu en ligne très compact -->
        <div class="flex items-center space-x-1 sm:space-x-8 text-[8px] xs:text-[10px] sm:text-sm font-medium">
          <Link href="/" class="hover:text-amber-400 transition-colors whitespace-nowrap">Accueil</Link>
          <a href="#about" class="hover:text-amber-400 transition-colors whitespace-nowrap">À Propos</a>
          <a href="#programs" class="hover:text-amber-400 transition-colors whitespace-nowrap">Programmes</a>
          <a href="#contact" class="hover:text-amber-400 transition-colors whitespace-nowrap">Contact</a>
        </div>

      </div>
    </div>
  </nav>
</template>