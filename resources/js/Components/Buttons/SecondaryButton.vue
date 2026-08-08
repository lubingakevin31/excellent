<script setup>
defineProps({
  href: String,
  isDark: Boolean
});
</script>

<template>
  <a :href="href" 
     class="border border-cocoa/40 font-semibold text-sm px-7 py-3.5 rounded-full backdrop-blur-md hover:scale-105 transition duration-300 inline-block text-center"
     :class="isDark ? 'text-slate-200 hover:border-pierre' : 'text-cocoa hover:border-cocoa'">
    <slot />
  </a>
</template>