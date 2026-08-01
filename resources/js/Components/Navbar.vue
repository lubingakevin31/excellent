<script setup>
import { Link } from '@inertiajs/vue3';
import { ref } from 'vue';

const searchQuery = ref('');
</script>

<template>
  <nav class="bg-slate-900/90 backdrop-blur-md text-white border-b border-slate-800 sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-2 sm:px-6 lg:px-8">
      <div class="flex items-center justify-between h-12 sm:h-16">
        
        <!-- Logo -->
        <div class="flex items-center space-x-2 shrink-0">
          <Link href="/" class="font-extrabold text-[11px] xs:text-xs sm:text-xl tracking-wider text-amber-500 whitespace-nowrap flex items-center gap-1.5">
            EXCELLENT <span class="text-white">UNIT</span>
          </Link>
        </div>

        <!-- Links Principaux -->
        <div class="flex items-center space-x-1 sm:space-x-6 text-[8px] xs:text-[10px] sm:text-sm font-medium">
          <Link href="/" class="hover:text-amber-400 transition-colors whitespace-nowrap">Accueil</Link>
          <a href="#about" class="hover:text-amber-400 transition-colors whitespace-nowrap">À Propos</a>
          <a href="#programs" class="hover:text-amber-400 transition-colors whitespace-nowrap">Programmes</a>
          <a href="#univers" class="hover:text-amber-400 transition-colors whitespace-nowrap">Univers</a>
          <a href="#contact" class="hover:text-amber-400 transition-colors whitespace-nowrap">Contact</a>
        </div>

        <!-- Search Bar Compacte (PC & Tablette) -->
        <div class="hidden md:flex items-center relative w-48 lg:w-64">
          <input 
            v-model="searchQuery"
            type="text" 
            placeholder="Rechercher un projet..." 
            class="w-full bg-slate-800 text-xs text-slate-200 placeholder-slate-400 pl-8 pr-3 py-1.5 rounded-full border border-slate-700 focus:outline-none focus:border-amber-500 transition"
          />
          <svg class="w-3.5 h-3.5 text-slate-400 absolute left-2.5 top-1/2 -translate-y-1/2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
          </svg>
        </div>

      </div>
    </div>
  </nav>
</template>