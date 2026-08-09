<script setup>
import { ref, onMounted, onBeforeUnmount } from 'vue';
import { Link } from '@inertiajs/vue3';
import * as THREE from 'three';

const props = defineProps({
  isDark: {
    type: Boolean,
    default: true
  }
});

// Liste exhaustive des 6 programmes
const programs = [
  {
    id: 1,
    code: '01',
    name: 'Éducation',
    description: 'Renforcement des compétences, accès au savoir et autonomisation durable.',
    href: '/programmes/education',
    color: 0xCFAE4F // Or vieilli
  },
  {
    id: 2,
    code: '02',
    name: 'Investissement & Architecture',
    description: 'Conception de cadres durables, infrastructures adaptées et valorisation d’actifs.',
    href: '/programmes/investissement-architecture',
    color: 0xD97742 // Terracotta
  },
  {
    id: 3,
    code: '03',
    name: 'Hygiène & Santé',
    description: 'Prévention, santé communautaire et promotion des standards de vie décents.',
    href: '/programmes/hygiene-sante',
    color: 0x9CAF88 // Vert Sauge
  },
  {
    id: 4,
    code: '04',
    name: 'WASH (Eau, Assainissement & Hygiène)',
    description: 'Accès universel à l’eau potable, réseaux sanitaires et durabilité des ressources.',
    href: '/programmes/wash',
    color: 0x4A8B9B // Bleu Canard
  },
  {
    id: 5,
    code: '05',
    name: 'Leadership & Management',
    description: 'Formation des élites locales, gouvernance éthique et gestion de projets complexes.',
    href: '/programmes/leadership-management',
    color: 0xE8C4C4 // Rose Sand
  },
  {
    id: 6,
    code: '06',
    name: 'Programme de Recherche',
    description: 'Innovation scientifique, analyse de données terrain et prospective d’impact.',
    href: '/programmes/recherche',
    color: 0xE08A70 // Corail Brûlé
  }
];

const metrics = [
  { value: '100%', label: 'Engagement Communautaire' },
  { value: '6 Piliers', label: 'Programmes Stratégiques Majeurs' },
  { value: '24/7', label: 'Disponibilité du Réseau' },
  { value: '∞', label: 'Impact Durable' }
];

// Gestion 3D Three.js
const canvasContainer = ref(null);
const hoveredProgramIndex = ref(null);

let scene, camera, renderer, animationFrameId;
let coreMesh, ringMesh1, ringMesh2, particlesMesh;
let orbMeshes = [];
let energyLines = [];

let mouseX = 0, mouseY = 0;
let targetX = 0, targetY = 0;

const handleMouseMove = (e) => {
  if (!canvasContainer.value) return;
  const rect = canvasContainer.value.getBoundingClientRect();
  mouseX = ((e.clientX - rect.left) / rect.width) * 2 - 1;
  mouseY = -((e.clientY - rect.top) / rect.height) * 2 + 1;
};

// Initialisation de la scène 3D
onMounted(() => {
  if (!canvasContainer.value) return;

  const width = canvasContainer.value.clientWidth;
  const height = canvasContainer.value.clientHeight;

  scene = new THREE.Scene();
  camera = new THREE.PerspectiveCamera(50, width / height, 0.1, 100);
  camera.position.z = 8;

  renderer = new THREE.WebGLRenderer({ alpha: true, antialias: true });
  renderer.setSize(width, height);
  renderer.setPixelRatio(Math.min(window.devicePixelRatio, 2));
  canvasContainer.value.appendChild(renderer.domElement);

  // 1. Noyau Central en verre fumé
  const coreGeometry = new THREE.IcosahedronGeometry(1.2, 3);
  const coreMaterial = new THREE.MeshPhysicalMaterial({
    color: 0x0f171e,
    roughness: 0.2,
    metalness: 0.8,
    transmission: 0.6,
    ior: 1.5,
    clearcoat: 1.0,
    clearcoatRoughness: 0.1,
    transparent: true,
    opacity: 0.95
  });
  coreMesh = new THREE.Mesh(coreGeometry, coreMaterial);
  scene.add(coreMesh);

  // Lumière point d'accentuation interne
  const coreLight = new THREE.PointLight(0xCFAE4F, 2, 10);
  scene.add(coreLight);

  // 2. Anneaux Lumineux
  const ringGeo1 = new THREE.TorusGeometry(2.2, 0.015, 16, 100);
  const ringMat1 = new THREE.MeshBasicMaterial({ color: 0xCFAE4F, transparent: true, opacity: 0.6 });
  ringMesh1 = new THREE.Mesh(ringGeo1, ringMat1);
  ringMesh1.rotation.x = Math.PI / 3;
  scene.add(ringMesh1);

  const ringGeo2 = new THREE.TorusGeometry(2.6, 0.012, 16, 100);
  const ringMat2 = new THREE.MeshBasicMaterial({ color: 0xD97742, transparent: true, opacity: 0.4 });
  ringMesh2 = new THREE.Mesh(ringGeo2, ringMat2);
  ringMesh2.rotation.x = -Math.PI / 4;
  ringMesh2.rotation.y = Math.PI / 6;
  scene.add(ringMesh2);

  // 3. 6 Orbes Orbitales (Programmes)
  programs.forEach((prog, idx) => {
    const orbGeo = new THREE.SphereGeometry(0.18, 32, 32);
    const orbMat = new THREE.MeshStandardMaterial({
      color: prog.color,
      emissive: prog.color,
      emissiveIntensity: 0.8,
      roughness: 0.2
    });
    const orb = new THREE.Mesh(orbGeo, orbMat);
    
    // Calcul d'orbite distribuée
    const radius = 3.2 + (idx % 2) * 0.4;
    const angle = (idx / programs.length) * Math.PI * 2;
    orb.userData = {
      baseRadius: radius,
      angle: angle,
      speed: 0.005 + (idx % 3) * 0.002,
      color: prog.color,
      index: idx
    };

    orb.position.x = Math.cos(angle) * radius;
    orb.position.y = Math.sin(idx) * 0.8;
    orb.position.z = Math.sin(angle) * radius;

    // Lumière dédiée par orbe
    const light = new THREE.PointLight(prog.color, 1, 3);
    orb.add(light);

    orbMeshes.push(orb);
    scene.add(orb);

    // Ligne d'énergie cachée par défaut
    const lineGeo = new THREE.BufferGeometry().setFromPoints([
      new THREE.Vector3(0, 0, 0),
      orb.position
    ]);
    const lineMat = new THREE.LineBasicMaterial({
      color: prog.color,
      transparent: true,
      opacity: 0
    });
    const line = new THREE.Line(lineGeo, lineMat);
    energyLines.push(line);
    scene.add(line);
  });

  // 4. Champ de Poussière d'Étoiles
  const pCount = 300;
  const pGeometry = new THREE.BufferGeometry();
  const positions = new Float32Array(pCount * 3);
  const colors = new Float32Array(pCount * 3);

  const palette = [new THREE.Color(0xF5F1E8), new THREE.Color(0xCFAE4F), new THREE.Color(0xD97742)];

  for (let i = 0; i < pCount * 3; i += 3) {
    positions[i] = (Math.random() - 0.5) * 16;
    positions[i + 1] = (Math.random() - 0.5) * 12;
    positions[i + 2] = (Math.random() - 0.5) * 10;

    const c = palette[Math.floor(Math.random() * palette.length)];
    colors[i] = c.r;
    colors[i + 1] = c.g;
    colors[i + 2] = c.b;
  }

  pGeometry.setAttribute('position', new THREE.BufferAttribute(positions, 3));
  pGeometry.setAttribute('color', new THREE.BufferAttribute(colors, 3));

  const pMaterial = new THREE.PointsMaterial({
    size: 0.035,
    vertexColors: true,
    transparent: true,
    opacity: 0.7
  });

  particlesMesh = new THREE.Points(pGeometry, pMaterial);
  scene.add(particlesMesh);

  // Lumières ambiantes de scène
  const ambientLight = new THREE.AmbientLight(0xffffff, 0.4);
  scene.add(ambientLight);

  const dirLight = new THREE.DirectionalLight(0xffffff, 1.2);
  dirLight.position.set(5, 5, 5);
  scene.add(dirLight);

  // Animation Loop
  const animate = () => {
    animationFrameId = requestAnimationFrame(animate);

    // Effet Parallaxe fluide avec la souris
    targetX += (mouseX - targetX) * 0.03;
    targetY += (mouseY - targetY) * 0.03;

    scene.rotation.y = targetX * 0.25;
    scene.rotation.x = -targetY * 0.25;

    // Rotation du noyau & des anneaux
    if (coreMesh) {
      coreMesh.rotation.y += 0.003;
      coreMesh.rotation.x += 0.002;
    }
    if (ringMesh1) ringMesh1.rotation.z += 0.002;
    if (ringMesh2) ringMesh2.rotation.z -= 0.003;
    if (particlesMesh) particlesMesh.rotation.y += 0.0005;

    // Orbitation des orbes et gestion de l'interaction UI
    orbMeshes.forEach((orb, idx) => {
      if (hoveredProgramIndex.value === null) {
        orb.userData.angle += orb.userData.speed;
        orb.position.x = Math.cos(orb.userData.angle) * orb.userData.baseRadius;
        orb.position.z = Math.sin(orb.userData.angle) * orb.userData.baseRadius;

        // Reset des échelles et opacités
        orb.scale.lerp(new THREE.Vector3(1, 1, 1), 0.1);
        orb.material.emissiveIntensity = THREE.MathUtils.lerp(orb.material.emissiveIntensity, 0.8, 0.1);
        orb.material.opacity = THREE.MathUtils.lerp(orb.material.opacity || 1, 1, 0.1);

        energyLines[idx].material.opacity = THREE.MathUtils.lerp(energyLines[idx].material.opacity, 0, 0.1);
      } else if (hoveredProgramIndex.value === idx) {
        // Orbe survolée : grossit et brille fortement
        orb.scale.lerp(new THREE.Vector3(2.2, 2.2, 2.2), 0.1);
        orb.material.emissiveIntensity = THREE.MathUtils.lerp(orb.material.emissiveIntensity, 2.5, 0.1);

        // Mise à jour de la ligne d'énergie active vers le noyau
        const positions = energyLines[idx].geometry.attributes.position.array;
        positions[3] = orb.position.x;
        positions[4] = orb.position.y;
        positions[5] = orb.position.z;
        energyLines[idx].geometry.attributes.position.needsUpdate = true;
        energyLines[idx].material.opacity = THREE.MathUtils.lerp(energyLines[idx].material.opacity, 0.8, 0.1);
      } else {
        // Orbes non sélectionnées : s'adoucissent
        orb.scale.lerp(new THREE.Vector3(0.7, 0.7, 0.7), 0.1);
        orb.material.emissiveIntensity = THREE.MathUtils.lerp(orb.material.emissiveIntensity, 0.2, 0.1);
        energyLines[idx].material.opacity = THREE.MathUtils.lerp(energyLines[idx].material.opacity, 0, 0.1);
      }
    });

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

const setHoveredProgram = (index) => {
  hoveredProgramIndex.value = index;
};

const clearHoveredProgram = () => {
  hoveredProgramIndex.value = null;
};
</script>

<template>
  <section 
    id="impact" 
    @mousemove="handleMouseMove"
    class="min-h-screen relative overflow-hidden bg-[#070A0F] text-[#F5F1E8] py-24 px-4 sm:px-8 lg:px-16 flex flex-col justify-between z-10"
  >
    <!-- SCÈNE THREE.JS EN ARRIÈRE-PLAN -->
    <div ref="canvasContainer" class="absolute inset-0 z-0 pointer-events-none w-full h-full opacity-80"></div>

    <div class="relative z-10 container mx-auto max-w-7xl flex flex-col justify-between h-full space-y-16">
      
      <!-- A. EN-TÊTE DE SECTION -->
      <div class="space-y-6 max-w-4xl reveal">
        
        <!-- Badge -->
        <div class="inline-flex items-center gap-2.5 px-4 py-1.5 rounded-full border border-[#CFAE4F]/30 bg-[#070A0F]/60 backdrop-blur-md shadow-lg">
          <span class="w-2 h-2 rounded-full bg-[#CFAE4F] animate-pulse shadow-[0_0_8px_#CFAE4F]"></span>
          <span class="text-xs font-bold uppercase tracking-widest text-[#CFAE4F]">
            01 • Impact Global & Vision
          </span>
        </div>

        <!-- Titre Fort -->
        <h2 class="text-3xl sm:text-5xl lg:text-6xl font-black uppercase tracking-tight leading-[1.05]">
          Vulgariser le bon sens de la 
          <span class="bg-gradient-to-r from-[#CFAE4F] via-[#E08A70] to-[#D97742] bg-clip-text text-transparent drop-shadow-md">
            VALEUR
          </span>
          <span class="block text-xl sm:text-3xl lg:text-4xl font-semibold text-slate-300 normal-case mt-3">
            L'impact par la classe, la précision et la profondeur.
          </span>
        </h2>

      </div>

      <!-- B. GRILLE INTERACTIVE DES 6 PROGRAMMES -->
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 relative z-10">
        <Link 
          v-for="(program, index) in programs" 
          :key="program.id"
          :href="program.href"
          @mouseenter="setHoveredProgram(index)"
          @mouseleave="clearHoveredProgram"
          class="group relative p-8 rounded-2xl border border-white/10 bg-[#070A0F]/50 backdrop-blur-xl transition-all duration-500 hover:border-[#CFAE4F]/60 hover:-translate-y-2 hover:shadow-[0_10px_30px_rgba(207,174,79,0.15)] flex flex-col justify-between h-[240px] overflow-hidden"
        >
          <!-- Halo Lumineux de contour au survol -->
          <div class="absolute inset-0 opacity-0 group-hover:opacity-100 transition-opacity duration-700 pointer-events-none bg-gradient-to-br from-[#CFAE4F]/10 via-transparent to-[#D97742]/10"></div>

          <!-- Haut de carte : Numéroteur & Flèche d'Action -->
          <div class="flex items-center justify-between z-10">
            <span class="font-mono text-sm font-bold tracking-widest text-[#CFAE4F] group-hover:text-[#D97742] transition-colors duration-300">
              {{ program.code }}
            </span>
            
            <div class="w-9 h-9 rounded-full border border-white/10 flex items-center justify-center bg-white/5 group-hover:bg-[#CFAE4F] group-hover:text-black group-hover:border-[#CFAE4F] transition-all duration-300 transform group-hover:translate-x-1">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3" />
              </svg>
            </div>
          </div>

          <!-- Centre : Nom & Description -->
          <div class="space-y-2 z-10">
            <h3 class="text-xl font-bold tracking-wide group-hover:text-[#CFAE4F] transition-colors duration-300">
              {{ program.name }}
            </h3>
            <p class="text-xs leading-relaxed text-slate-300/80 font-medium line-clamp-2">
              {{ program.description }}
            </p>
          </div>

          <!-- Ligne décorative au bas de carte -->
          <div class="w-full h-[2px] bg-white/5 group-hover:bg-gradient-to-r group-hover:from-[#CFAE4F] group-hover:to-[#D97742] transition-all duration-500 z-10"></div>
        </Link>
      </div>

      <!-- C. BARRE DE MÉTRIQUES EN BAS DE SECTION -->
      <div class="pt-8 border-t border-white/10 grid grid-cols-2 lg:grid-cols-4 gap-6 z-10">
        <div 
          v-for="(metric, idx) in metrics" 
          :key="idx" 
          class="flex flex-col space-y-1 p-4 rounded-xl bg-white/[0.02] border border-white/5 backdrop-blur-md hover:border-[#CFAE4F]/30 transition-all duration-300"
        >
          <span class="text-3xl sm:text-4xl font-black bg-gradient-to-r from-[#CFAE4F] to-[#D97742] bg-clip-text text-transparent">
            {{ metric.value }}
          </span>
          <span class="text-xs uppercase tracking-wider font-semibold text-slate-400">
            {{ metric.label }}
          </span>
        </div>
      </div>

    </div>
  </section>
</template>

<style scoped>
/* Effet d'apparition douce des éléments */
.reveal {
  animation: fadeIn 1s ease-out forwards;
}

@keyframes fadeIn {
  from {
    opacity: 0;
    transform: translateY(20px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}
</style>