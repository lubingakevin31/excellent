<script setup>
import { ref, onMounted, onBeforeUnmount } from 'vue';
import Hero3DCarousel from '@/Components/Hero3DCarousel.vue';
import * as THREE from 'three';

defineProps({
  isDark: Boolean
});

const carouselRef = ref(null);
const canvasContainer = ref(null);

const galleryImages = [
  '/images/archi.jpeg',
  '/images/education.jpg',
  '/images/environnement.jpeg',
  '/images/leadership.jpeg',
  '/images/innovation.jpg'
];

let scene, camera, renderer, animationFrameId;
let torusMesh, coreMesh, ambientLight, pointLight;

onMounted(() => {
  if (!canvasContainer.value) return;

  const width = canvasContainer.value.clientWidth;
  const height = canvasContainer.value.clientHeight;

  scene = new THREE.Scene();
  camera = new THREE.PerspectiveCamera(50, width / height, 0.1, 100);
  camera.position.z = 7;

  renderer = new THREE.WebGLRenderer({ alpha: true, antialias: true });
  renderer.setSize(width, height);
  renderer.setPixelRatio(Math.min(window.devicePixelRatio, 2));
  canvasContainer.value.appendChild(renderer.domElement);

  const torusGeo = new THREE.TorusGeometry(2.8, 0.15, 24, 100);
  const torusMat = new THREE.MeshStandardMaterial({
    color: 0xCFAE4F,
    wireframe: false,
    roughness: 0.3,
    metalness: 0.8
  });
  torusMesh = new THREE.Mesh(torusGeo, torusMat);
  torusMesh.rotation.x = Math.PI / 3;
  scene.add(torusMesh);

  const coreGeo = new THREE.IcosahedronGeometry(1.6, 2);
  const coreMat = new THREE.MeshPhysicalMaterial({
    color: 0x070A0F,
    roughness: 0.1,
    metalness: 0.9,
    clearcoat: 1.0,
    transparent: true,
    opacity: 0.85
  });
  coreMesh = new THREE.Mesh(coreGeo, coreMat);
  scene.add(coreMesh);

  ambientLight = new THREE.AmbientLight(0xffffff, 0.5);
  scene.add(ambientLight);

  pointLight = new THREE.PointLight(0xCFAE4F, 2, 10);
  pointLight.position.set(2, 3, 4);
  scene.add(pointLight);

  const animate = () => {
    animationFrameId = requestAnimationFrame(animate);

    if (torusMesh) {
      torusMesh.rotation.y += 0.002;
      torusMesh.rotation.x += 0.001;
    }

    if (coreMesh) {
      coreMesh.rotation.y -= 0.0015;
    }

    renderer.render(scene, camera);
  };

  animate();

  const handleResize = () => {
    if (!canvasContainer.value) return;
    const w = canvasContainer.value.clientWidth;
    const h = canvasContainer.value.clientHeight;
    camera.aspect = w / h;
    camera.updateProjectionMatrix();
    renderer.setSize(w, h);
  };

  window.addEventListener('resize', handleResize);
});

onBeforeUnmount(() => {
  if (animationFrameId) cancelAnimationFrame(animationFrameId);
  if (renderer) renderer.dispose();
});
</script>

<template>
  <section id="hero" class="w-full min-h-screen relative overflow-hidden flex items-center pt-28 pb-16 z-10 bg-[#070A0F]">
    
    <!-- LAYER 0.1 (ARRIÈRE-PLAN THREE.JS ORBITAL) -->
    <div ref="canvasContainer" class="absolute inset-0 z-0 pointer-events-none w-full h-full opacity-60"></div>

    <!-- LAYER 0.2 : CARROUSEL THREE.JS OCCUPANT PLEINEMENT SA ZONE 3:4 -->
    <div class="absolute inset-0 z-0 flex items-center justify-end pr-4 sm:pr-8 lg:pr-12 pointer-events-auto">
      <div class="w-full lg:w-1/2 flex justify-center lg:justify-end">
        
        <!-- CONTENEUR 3:4 AGRANDI QUI FORCE L'IMAGE/CANVAS A REMPLIR 100% DE L'ESPACE -->
        <div class="w-80 sm:w-[460px] lg:w-[560px] xl:w-[600px] aspect-[3/4] relative overflow-hidden rounded-2xl shadow-[0_10px_40px_rgba(0,0,0,0.5)]">
          <Hero3DCarousel 
            ref="carouselRef"
            :images="galleryImages" 
            :isDark="isDark"
            class="w-full h-full object-cover"
          />
        </div>

      </div>
    </div>

    <!-- LAYER 1 : BULLES ET TRAÎNÉES -->
    <div class="absolute inset-0 pointer-events-none overflow-hidden z-1">
      <div class="drop drop-1 absolute w-16 h-16 rounded-full blur-xs opacity-75 bg-gradient-to-r from-[#CFAE4F] to-transparent shadow-[0_0_30px_#CFAE4F]"></div>
      <div class="drop drop-2 absolute w-20 h-20 rounded-full blur-sm opacity-65 bg-gradient-to-r from-[#D97742] to-transparent shadow-[0_0_35px_#D97742]"></div>
      <div class="drop drop-3 absolute w-14 h-14 rounded-full blur-xs opacity-70 bg-gradient-to-r from-[#9CAF88] to-transparent shadow-[0_0_25px_#9CAF88]"></div>
      <div class="drop drop-4 absolute w-18 h-18 rounded-full blur-sm opacity-65 bg-gradient-to-r from-[#E8C4C4] to-transparent shadow-[0_0_30px_#E8C4C4]"></div>
    </div>

    <!-- LAYER 2 : PLAQUE DE VERRE GLASSMORPHISM PLEINE SURFACE -->
    <div 
      class="absolute inset-0 z-10 transition-all duration-700 pointer-events-none glass-mask"
      :class="isDark ? 'bg-[#070A0F]/60' : 'bg-white/40'"
    ></div>

    <!-- LAYER 3 : CONTENU TEXTE -->
    <div class="container mx-auto px-6 sm:px-12 relative z-20 pointer-events-auto w-full">
      <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-12 items-center">
        
        <!-- ZONE TEXTE -->
        <div class="lg:col-span-6 space-y-8 reveal">
          
          <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full border backdrop-blur-md text-xs font-bold uppercase tracking-widest"
               :class="isDark 
                 ? 'bg-[#CFAE4F]/10 text-[#CFAE4F] border-[#CFAE4F]/30' 
                 : 'bg-[#D97742]/10 text-[#D97742] border-[#D97742]/30'">
            <span class="w-2 h-2 rounded-full animate-ping" :class="isDark ? 'bg-[#CFAE4F]' : 'bg-[#D97742]'"></span>
            <span>Innovation & Impact Social</span>
          </div>

          <h1 class="text-5xl sm:text-7xl lg:text-8xl font-black tracking-tight uppercase leading-[0.95]">
            GARANTIR LE SENS 
            <span class="block mt-2 bg-gradient-to-r from-[#CFAE4F] via-[#E08A70] via-[#D97742] to-[#E8C4C4] bg-clip-text text-transparent drop-shadow-sm">
              DU LONG TERME.
            </span>
          </h1>

          <p class="text-base sm:text-lg leading-relaxed font-medium opacity-90 max-w-xl border-none p-0 bg-transparent"
             :class="isDark ? 'text-slate-200' : 'text-slate-800'">
              Établir des systèmes communautaires accessibles, universels, actuels, sur mesure et durables. Transformer les défis locaux en opportunités de progrès pour un impact mesurable.
          </p>

          <div class="flex flex-wrap gap-4 pt-2">
            <a 
              href="#impact" 
              class="font-bold text-sm px-8 py-4 rounded-full shadow-xl hover:scale-105 transition-all duration-300 flex items-center gap-2"
              :class="isDark 
                ? 'bg-gradient-to-r from-[#CFAE4F] to-[#D97742] text-slate-950 shadow-[#CFAE4F]/20 hover:brightness-110' 
                : 'bg-[#4a2c2a] text-white hover:bg-[#6d4c41] shadow-[#4a2c2a]/20'"
            >
              Découvrir la vision →
            </a>
            
            <a 
              href="#piliers" 
              class="border font-semibold text-sm px-8 py-4 rounded-full backdrop-blur-md hover:scale-105 transition-all duration-300"
              :class="isDark 
                ? 'border-white/20 text-slate-200 hover:border-[#CFAE4F] hover:text-[#CFAE4F]' 
                : 'border-[#4a2c2a]/30 text-[#4a2c2a] hover:border-[#4a2c2a] bg-white/30'"
            >
              Nos piliers
            </a>
          </div>

        </div>

        <!-- ESPACEMENT ADAPTÉ À LA HAUTEUR DU CARROUSEL -->
        <div class="lg:col-span-6 h-[600px] hidden lg:block pointer-events-none"></div>

      </div>
    </div>

  </section>
</template>

<style scoped>
.glass-mask {
  backdrop-filter: blur(16px);
  -webkit-backdrop-filter: blur(16px);
  mask-image: linear-gradient(to right, rgba(0, 0, 0, 1) 0%, rgba(0, 0, 0, 0.6) 50%, rgba(0, 0, 0, 0.25) 100%);
  -webkit-mask-image: linear-gradient(to right, rgba(0, 0, 0, 1) 0%, rgba(0, 0, 0, 0.6) 50%, rgba(0, 0, 0, 0.25) 100%);
}

@keyframes floatDrop1 {
  0% { top: -10%; left: 10%; opacity: 0; }
  20% { opacity: 0.85; }
  80% { opacity: 0.85; }
  100% { top: 110%; left: 80%; opacity: 0; }
}

@keyframes floatDrop2 {
  0% { top: 20%; left: -10%; opacity: 0; }
  20% { opacity: 0.75; }
  80% { opacity: 0.75; }
  100% { top: 90%; left: 110%; opacity: 0; }
}

@keyframes floatDrop3 {
  0% { top: 110%; left: 30%; opacity: 0; }
  20% { opacity: 0.8; }
  80% { opacity: 0.8; }
  100% { top: -10%; left: 70%; opacity: 0; }
}

@keyframes floatDrop4 {
  0% { top: 70%; left: 110%; opacity: 0; }
  20% { opacity: 0.7; }
  80% { opacity: 0.7; }
  100% { top: 10%; left: -10%; opacity: 0; }
}

.drop-1 { animation: floatDrop1 14s infinite ease-in-out; }
.drop-2 { animation: floatDrop2 18s infinite ease-in-out 3s; }
.drop-3 { animation: floatDrop3 16s infinite ease-in-out 6s; }
.drop-4 { animation: floatDrop4 20s infinite ease-in-out 2s; }
</style>