<script setup>
defineProps({
  href: String,
  isDark: Boolean
});
</script>

<template>
  <a :href="href" 
     class="font-bold text-sm px-7 py-3.5 rounded-full shadow-lg hover:scale-105 transition duration-300 inline-block text-center"
     :class="isDark ? 'bg-pierre text-night hover:bg-white' : 'bg-cocoa text-white hover:bg-cocoa-light'">
    <slot />
  </a>
</template>