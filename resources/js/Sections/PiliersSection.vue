<script setup>
import { ref, onMounted, onBeforeUnmount } from 'vue';
import { Link } from '@inertiajs/vue3';
import * as THREE from 'three';

defineProps({
  isDark: {
    type: Boolean,
    default: true
  }
});

// Les 6 programmes officiels d'EXCELLENT UNIT
const pillars = [
  {
    code: '01 • PROGRAMME',
    title: 'Éducation & Formation',
    description: 'Formation d\'élite, activités socio-éducatives et accompagnement familial pour la jeunesse.',
    image: '/images/education.jpg',
    href: '/programmes/education',
    themeColor: 0xCFAE4F // Or vieilli
  },
  {
    code: '02 • PROGRAMME',
    title: 'Investissement & Architecture',
    description: 'Conception de cadres durables, études techniques et appui stratégique aux infrastructures.',
    image: '/images/archi.jpeg',
    href: '/programmes/investissement-architecture',
    themeColor: 0xD97742 // Terracotta
  },
  {
    code: '03 • PROGRAMME',
    title: 'Hygiène & Santé',
    description: 'Sensibilisation communautaire et élévation des normes sanitaires locales.',
    image: '/images/sante.jpg',
    href: '/programmes/hygiene-sante',
    themeColor: 0x9CAF88 // Vert Sauge
  },
  {
    code: '04 • PROGRAMME',
    title: 'WASH & Écologie',
    description: 'Gestion des ressources en eau potable, assainissement et protection des écosystèmes.',
    image: '/images/environnement.jpeg',
    href: '/programmes/wash',
    themeColor: 0x2F5D63 // Eau / Bleu Canard
  },
  {
    code: '05 • PROGRAMME',
    title: 'Leadership & Management',
    description: 'Coaching de cadres, gouvernance d\'excellence et autonomisation des talents.',
    image: '/images/leadership.jpeg',
    href: '/programmes/leadership-management',
    themeColor: 0xE8C4C4 // Rose Sand
  },
  {
    code: '06 • PROGRAMME',
    title: 'Programme de Recherche',
    description: 'Analyses scientifiques, data et propositions stratégiques fondées sur la création de valeur.',
    image: '/images/innovation.jpg',
    href: '/programmes/recherche',
    themeColor: 0xE08A70 // Corail Brûlé
  }
];

// Ref pour la scène 3D Three.js en arrière-plan
const canvasContainer = ref(null);
const activePillarIndex = ref(null);

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

  // Anneau 3D Géométrique
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

  // Sphère centrale sombre
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

  // Lumières
  ambientLight = new THREE.AmbientLight(0xffffff, 0.5);
  scene.add(ambientLight);

  pointLight = new THREE.PointLight(0xCFAE4F, 2, 10);
  pointLight.position.set(2, 3, 4);
  scene.add(pointLight);

  // Boucle d'animation
  const animate = () => {
    animationFrameId = requestAnimationFrame(animate);

    if (torusMesh) {
      torusMesh.rotation.y += 0.002;
      torusMesh.rotation.x += 0.001;
    }

    if (coreMesh) {
      coreMesh.rotation.y -= 0.0015;
    }

    // Réactions 3D selon la carte survolée
    if (activePillarIndex.value !== null) {
      const activePillar = pillars[activePillarIndex.value];
      
      // Adaptation de couleur de lumière
      pointLight.color.setHex(activePillar.themeColor);

      // Si Architecture (index 1) : Wireframe
      torusMesh.material.wireframe = (activePillarIndex.value === 1);
      
      // Si WASH (index 3) : Légère impulsion de taille (vague)
      if (activePillarIndex.value === 3) {
        torusMesh.scale.x = 1 + Math.sin(Date.now() * 0.005) * 0.05;
        torusMesh.scale.y = 1 + Math.sin(Date.now() * 0.005) * 0.05;
      } else {
        torusMesh.scale.set(1, 1, 1);
      }
    } else {
      torusMesh.material.wireframe = false;
      pointLight.color.setHex(0xCFAE4F);
      torusMesh.scale.set(1, 1, 1);
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

const onCardHover = (index) => {
  activePillarIndex.value = index;
};

const onCardLeave = () => {
  activePillarIndex.value = null;
};
</script>

<template>
  <section id="piliers" class="min-h-screen relative overflow-hidden bg-[#070A0F] text-[#F5F1E8] py-24 px-4 sm:px-8 lg:px-16 flex flex-col justify-center z-10">
    
    <!-- ARRIÈRE-PLAN THREE.JS (Sphère + Anneau 3D) -->
    <div ref="canvasContainer" class="absolute inset-0 z-0 pointer-events-none w-full h-full opacity-60"></div>

    <div class="relative z-10 container mx-auto max-w-7xl space-y-16">
      
      <!-- EN-TÊTE DE SECTION -->
      <div class="max-w-3xl space-y-4 reveal">
        <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full border border-[#CFAE4F]/30 bg-[#070A0F]/60 backdrop-blur-md shadow-lg">
          <span class="w-2 h-2 rounded-full bg-[#CFAE4F] animate-pulse shadow-[0_0_8px_#CFAE4F]"></span>
          <span class="text-xs font-bold uppercase tracking-widest text-[#CFAE4F]">
            02 • UNIVERS & PILIERS
          </span>
        </div>

        <h2 class="text-3xl sm:text-5xl lg:text-6xl font-black uppercase tracking-tight leading-tight">
          Des idées transformées en 
          <span class="bg-gradient-to-r from-[#F5F1E8] via-[#CFAE4F] to-[#D97742] bg-clip-text text-transparent">
            expériences réelles.
          </span>
        </h2>
      </div>

      <!-- GRILLE DYNAMIQUE 3x2 DES 6 PROGRAMMES -->
      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
        <Link 
          v-for="(pillar, idx) in pillars" 
          :key="idx"
          :href="pillar.href"
          @mouseenter="onCardHover(idx)"
          @mouseleave="onCardLeave"
          class="reveal group relative h-[400px] rounded-3xl overflow-hidden border border-white/10 hover:border-[#CFAE4F] transition-all duration-500 shadow-2xl backdrop-blur-md hover:-translate-y-2 hover:shadow-[0_15px_35px_rgba(207,174,79,0.2)] flex flex-col justify-end"
          :style="`transition-delay: ${idx * 100}ms`"
        >
          <!-- VISUEL IMMERSIF AVEC ZOOM AU SURVOL -->
          <img 
            :src="pillar.image" 
            :alt="pillar.title" 
            class="absolute inset-0 w-full h-full object-cover transition-transform duration-700 ease-out group-hover:scale-110 opacity-40 group-hover:opacity-60" 
          />

          <!-- FILTRE GRADIENT ET EFFET VERRE DÉPOLI (GLASSMORPHISM) -->
          <div class="absolute inset-0 bg-gradient-to-t from-[#070A0F] via-[#070A0F]/50 to-transparent transition-opacity duration-500"></div>

          <!-- CONTENU TEXTE -->
          <div class="relative z-10 p-8 space-y-3">
            <span class="text-[#CFAE4F] text-xs font-mono font-bold uppercase tracking-widest block group-hover:text-[#D97742] transition-colors duration-300">
              {{ pillar.code }}
            </span>
            
            <h3 class="text-2xl font-black tracking-wide group-hover:text-[#CFAE4F] transition-colors duration-300">
              {{ pillar.title }}
            </h3>

            <p class="text-xs leading-relaxed text-slate-300 font-medium opacity-90 group-hover:opacity-100 transition-opacity duration-300">
              {{ pillar.description }}
            </p>

            <!-- BOUTON FLECHE ACTION -->
            <div class="pt-2 flex items-center gap-2 text-xs font-bold text-[#CFAE4F] group-hover:translate-x-1 transition-transform duration-300">
              <span>En savoir plus</span>
              <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3" />
              </svg>
            </div>
          </div>

          <!-- BORDURE LUMINEUSE DÉCORATIVE -->
          <div class="absolute inset-0 rounded-3xl border border-transparent group-hover:border-[#CFAE4F]/40 transition-all duration-500 pointer-events-none"></div>
        </Link>
      </div>

    </div>
  </section>
</template>

<style scoped>
.reveal {
  opacity: 0;
  transform: translateY(2rem);
  will-change: opacity, transform;
  transition: opacity 0.8s ease, transform 0.8s ease;
}

.reveal.is-visible {
  opacity: 1 !important;
  transform: translateY(0) !important;
}
</style>