<script setup>
import { ref, onMounted, onBeforeUnmount } from 'vue';
import * as THREE from 'three';

defineProps({
  isDark: {
    type: Boolean,
    default: true
  }
});

// Numéros Mobile Money RDC
const mobileMoneyAccounts = [
  { provider: 'M-Pesa (Vodacom)', number: '+243 810 000 000', color: 'border-red-500/40 text-red-400 bg-red-500/10' },
  { provider: 'Airtel Money', number: '+243 990 000 000', color: 'border-red-600/40 text-red-500 bg-red-600/10' },
  { provider: 'Orange Money', number: '+243 890 000 000', color: 'border-orange-500/40 text-orange-400 bg-orange-500/10' }
];

// Gestion de la copie rapide
const copiedIndex = ref(null);
const copyToastMessage = ref('');

const copyNumber = (number, index) => {
  navigator.clipboard.writeText(number);
  copiedIndex.value = index;
  copyToastMessage.value = `Numéro ${number} copié !`;
  setTimeout(() => {
    copiedIndex.value = null;
  }, 2500);
};

// Modal Rendez-vous Stratégique
const isModalOpen = ref(false);
const appointmentForm = ref({
  name: '',
  email: '',
  organization: '',
  message: ''
});

const openModal = () => { isModalOpen.value = true; };
const closeModal = () => { isModalOpen.value = false; };

const sendAppointmentEmail = () => {
  const mailtoLink = `mailto:davidmathec@gmail.com,excellentunit@gmail.com?subject=Rendez-vous Stratégique - ${encodeURIComponent(appointmentForm.value.organization || appointmentForm.value.name)}&body=${encodeURIComponent(
    `Nom: ${appointmentForm.value.name}\nEmail: ${appointmentForm.value.email}\nOrganisation: ${appointmentForm.value.organization}\n\nMessage:\n${appointmentForm.value.message}`
  )}`;
  window.location.href = mailtoLink;
  closeModal();
};

// Scène 3D Three.js : Vortex d'Énergie Fluide
const canvasContainer = ref(null);
let scene, camera, renderer, animationFrameId;
let vortexParticles, vortexMesh, pointLight;
let isHoveringCTA = ref(false);

onMounted(() => {
  if (!canvasContainer.value) return;

  const width = canvasContainer.value.clientWidth;
  const height = canvasContainer.value.clientHeight;

  scene = new THREE.Scene();
  camera = new THREE.PerspectiveCamera(50, width / height, 0.1, 100);
  camera.position.z = 6;

  renderer = new THREE.WebGLRenderer({ alpha: true, antialias: true });
  renderer.setSize(width, height);
  renderer.setPixelRatio(Math.min(window.devicePixelRatio, 2));
  canvasContainer.value.appendChild(renderer.domElement);

  // 1. Vortex d'Énergie (Torus Knot géométrique basculé)
  const knotGeo = new THREE.TorusKnotGeometry(2, 0.35, 128, 32);
  const knotMat = new THREE.MeshPhysicalMaterial({
    color: 0xCFAE4F,
    emissive: 0xD97742,
    emissiveIntensity: 0.4,
    roughness: 0.2,
    metalness: 0.8,
    clearcoat: 1.0,
    wireframe: true,
    transparent: true,
    opacity: 0.45
  });
  vortexMesh = new THREE.Mesh(knotGeo, knotMat);
  vortexMesh.rotation.x = Math.PI / 2.2; // Basculé
  scene.add(vortexMesh);

  // 2. Particules du Vortex
  const pCount = 500;
  const pGeo = new THREE.BufferGeometry();
  const positions = new Float32Array(pCount * 3);
  for (let i = 0; i < pCount * 3; i += 3) {
    const angle = Math.random() * Math.PI * 2;
    const r = 1.5 + Math.random() * 2.5;
    positions[i] = Math.cos(angle) * r;
    positions[i + 1] = (Math.random() - 0.5) * 2;
    positions[i + 2] = Math.sin(angle) * r;
  }
  pGeo.setAttribute('position', new THREE.BufferAttribute(positions, 3));

  const pMat = new THREE.PointsMaterial({
    color: 0xCFAE4F,
    size: 0.03,
    transparent: true,
    opacity: 0.7
  });
  vortexParticles = new THREE.Points(pGeo, pMat);
  scene.add(vortexParticles);

  // Lumières
  const ambientLight = new THREE.AmbientLight(0xffffff, 0.3);
  scene.add(ambientLight);

  pointLight = new THREE.PointLight(0xCFAE4F, 2, 8);
  pointLight.position.set(0, 0, 2);
  scene.add(pointLight);

  // Animation Loop
  const animate = () => {
    animationFrameId = requestAnimationFrame(animate);

    const speedMultiplier = isHoveringCTA.value ? 2.8 : 1.0;

    if (vortexMesh) {
      vortexMesh.rotation.z += 0.003 * speedMultiplier;
      vortexMesh.rotation.y += 0.001 * speedMultiplier;
    }

    if (vortexParticles) {
      vortexParticles.rotation.y += 0.002 * speedMultiplier;
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
  <section id="vision" class="relative min-h-screen bg-[#070A0F] text-[#F5F1E8] py-24 px-4 sm:px-6 lg:px-12 flex flex-col justify-center overflow-hidden z-10 times-font">
    
    <!-- ARRIÈRE-PLAN THREE.JS (VORTEX 3D) -->
    <div ref="canvasContainer" class="absolute inset-0 z-0 pointer-events-none w-full h-full opacity-60"></div>

    <!-- GOUTTELETTES LUMINEUSES FLOTTANTES (HERO SECTION STYLE) -->
    <div class="absolute inset-0 pointer-events-none overflow-hidden z-1">
      <div class="drop drop-1 absolute w-20 h-20 rounded-full blur-md opacity-60 bg-gradient-to-r from-[#9CAF88] to-transparent shadow-[0_0_35px_#9CAF88]"></div>
      <div class="drop drop-2 absolute w-16 h-16 rounded-full blur-sm opacity-50 bg-gradient-to-r from-[#E8C4C4] to-transparent shadow-[0_0_30px_#E8C4C4]"></div>
      <div class="drop drop-3 absolute w-24 h-24 rounded-full blur-md opacity-40 bg-gradient-to-r from-[#CFAE4F] to-transparent shadow-[0_0_40px_#CFAE4F]"></div>
    </div>

    <!-- MONOLITHE DE VERRE LUMINEUX (GLASSMORPHISM PLEINE SURFACE) -->
    <div class="relative z-10 container mx-auto max-w-6xl rounded-3xl border border-[#CFAE4F]/30 bg-[#070A0F]/60 backdrop-blur-2xl p-8 sm:p-14 lg:p-16 shadow-[0_20px_50px_rgba(7,10,15,0.8)] overflow-hidden">
      
      <!-- EN-TÊTE & MESSAGE MONUMENTAL -->
      <div class="text-center max-w-4xl mx-auto space-y-6 reveal">
        
        <div class="inline-flex items-center gap-2.5 px-4 py-1.5 rounded-full border border-[#CFAE4F]/40 bg-[#070A0F]/80 backdrop-blur-md">
          <span class="w-2 h-2 rounded-full bg-[#CFAE4F] animate-ping"></span>
          <span class="text-xs font-bold uppercase tracking-widest text-[#CFAE4F]">
            03 • NOTRE VISION & ENGAGEMENT
          </span>
        </div>

        <h2 class="text-4xl sm:text-6xl lg:text-7xl font-black uppercase tracking-tight leading-none bg-gradient-to-r from-[#F5F1E8] via-[#CFAE4F] via-[#E08A70] to-[#D97742] bg-clip-text text-transparent drop-shadow-lg">
          Impacter à 100%
        </h2>

        <p class="text-base sm:text-xl font-medium leading-relaxed text-slate-300 max-w-3xl mx-auto">
          Chaque projet mené au sein d'EXCELLENT UNIT est conçu pour durer, inspirer et générer un changement mesurable en RDC et à travers l'Afrique.
        </p>

      </div>

      <!-- HUB D'ENGAGEMENT (SOUTIEN & RDV) -->
      <div class="mt-14 pt-10 border-t border-white/10 grid grid-cols-1 lg:grid-cols-12 gap-10 items-stretch">
        
        <!-- A. BLOC SOUTENIR LA VISION (MOBILE MONEY) -->
        <div class="lg:col-span-7 p-6 sm:p-8 rounded-2xl border border-white/10 bg-white/[0.02] backdrop-blur-md space-y-6 flex flex-col justify-between">
          <div>
            <span class="text-xs font-mono uppercase font-bold text-[#CFAE4F] tracking-widest block mb-1">
              SOUTIEN DIRECT & DONATIONS
            </span>
            <h3 class="text-xl font-bold">Encourager l'Initiative (Mobile Money RDC)</h3>
          </div>

          <!-- Badges Opérateurs Copie Rapide -->
          <div class="space-y-3">
            <div 
              v-for="(acc, idx) in mobileMoneyAccounts" 
              :key="idx"
              class="flex items-center justify-between p-3.5 rounded-xl border bg-black/40 backdrop-blur-sm transition-all duration-300 hover:border-[#CFAE4F]"
              :class="acc.color"
            >
              <div class="flex items-center gap-3">
                <span class="text-xs font-bold uppercase tracking-wider">{{ acc.provider }}</span>
                <span class="font-mono text-sm font-semibold text-slate-200">{{ acc.number }}</span>
              </div>

              <button 
                @click="copyNumber(acc.number, idx)"
                class="px-3 py-1 rounded-lg text-xs font-bold bg-white/10 hover:bg-[#CFAE4F] hover:text-black transition-all duration-300 flex items-center gap-1"
              >
                <span v-if="copiedIndex === idx" class="text-green-400 font-bold">Copié !</span>
                <span v-else>Copier</span>
              </button>
            </div>
          </div>

          <!-- Bouton WhatsApp Direct -->
          <a 
            href="https://wa.me/243810000000?text=Bonjour%20l'équipe%20EXCELLENT%20UNIT,%20je%20souhaite%20confirmer%20mon%20soutien%20à%20votre%20vision." 
            target="_blank"
            @mouseenter="isHoveringCTA = true"
            @mouseleave="isHoveringCTA = false"
            class="w-full py-4 rounded-xl border border-emerald-500/40 bg-emerald-950/30 text-emerald-400 font-bold text-sm hover:bg-emerald-500 hover:text-black transition-all duration-300 flex items-center justify-center gap-2 shadow-lg shadow-emerald-950/50"
          >
            <span>Confirmé via WhatsApp</span>
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
            </svg>
          </a>
        </div>

        <!-- B. BLOC BÂTIR ENSEMBLE (RDV STRATÉGIQUE) -->
        <div class="lg:col-span-5 p-6 sm:p-8 rounded-2xl border border-[#CFAE4F]/30 bg-gradient-to-br from-[#070A0F] to-[#121a24] flex flex-col justify-between space-y-6">
          <div>
            <span class="text-xs font-mono uppercase font-bold text-[#D97742] tracking-widest block mb-1">
              PARTENARIATS & BÂTISSEURS
            </span>
            <h3 class="text-xl font-bold">Collaborer avec l'Équipe</h3>
            <p class="text-xs text-slate-300 mt-2 leading-relaxed">
              Pour les décideurs, leaders et institutions souhaitant développer un projet à fort impact.
            </p>
          </div>

          <button 
            @click="openModal"
            @mouseenter="isHoveringCTA = true"
            @mouseleave="isHoveringCTA = false"
            class="w-full py-5 rounded-xl font-black text-sm uppercase tracking-wider bg-gradient-to-r from-[#CFAE4F] to-[#D97742] text-slate-950 hover:brightness-110 hover:scale-[1.02] transition-all duration-300 shadow-xl shadow-[#CFAE4F]/20 flex items-center justify-center gap-2"
          >
            <span>Planifier un RDV Stratégique</span>
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
            </svg>
          </button>
        </div>

      </div>

    </div>

    <!-- MODAL RENDEZ-VOUS STRATÉGIQUE -->
    <div v-if="isModalOpen" class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/80 backdrop-blur-md">
      <div class="relative w-full max-w-lg p-8 rounded-3xl border border-[#CFAE4F]/40 bg-[#070A0F] text-[#F5F1E8] shadow-2xl space-y-6 modal-content">
        
        <div class="flex items-center justify-between">
          <h3 class="text-xl font-bold text-[#CFAE4F]">Planifier un Rendez-vous</h3>
          <button @click="closeModal" class="text-slate-400 hover:text-white font-bold text-lg">✕</button>
        </div>

        <form @submit.prevent="sendAppointmentEmail" class="space-y-4 text-xs">
          <div>
            <label class="block font-semibold mb-1 text-slate-300">Nom Complet</label>
            <input v-model="appointmentForm.name" type="text" required class="w-full p-3 rounded-xl border border-white/10 bg-white/5 text-white focus:border-[#CFAE4F] focus:outline-none" placeholder="Ex: Jean Dupont" />
          </div>

          <div>
            <label class="block font-semibold mb-1 text-slate-300">Adresse Email</label>
            <input v-model="appointmentForm.email" type="email" required class="w-full p-3 rounded-xl border border-white/10 bg-white/5 text-white focus:border-[#CFAE4F] focus:outline-none" placeholder="jean@example.com" />
          </div>

          <div>
            <label class="block font-semibold mb-1 text-slate-300">Organisation / Entreprise</label>
            <input v-model="appointmentForm.organization" type="text" class="w-full p-3 rounded-xl border border-white/10 bg-white/5 text-white focus:border-[#CFAE4F] focus:outline-none" placeholder="Nom de l'organisation" />
          </div>

          <div>
            <label class="block font-semibold mb-1 text-slate-300">Objet de la collaboration</label>
            <textarea v-model="appointmentForm.message" rows="3" required class="w-full p-3 rounded-xl border border-white/10 bg-white/5 text-white focus:border-[#CFAE4F] focus:outline-none" placeholder="Décrivez brièvement votre projet..."></textarea>
          </div>

          <button type="submit" class="w-full py-3.5 rounded-xl font-bold bg-[#CFAE4F] text-black hover:bg-[#D97742] transition-colors">
            Envoyer la demande
          </button>
        </form>
      </div>
    </div>

    <!-- TRANSITION GRADIENT VERS LE FOOTER -->
    <div class="absolute bottom-0 inset-x-0 h-32 bg-gradient-to-t from-[#070A0F] to-transparent pointer-events-none z-20"></div>

  </section>
</template>

<style scoped>
.times-font,
.times-font button,
.times-font input,
.times-font textarea,
.times-font label,
.times-font a,
.modal-content,
.modal-content button,
.modal-content input,
.modal-content textarea,
.modal-content label {
  font-family: 'Times New Roman', Times, serif !important;
}

/* Animations des gouttelettes d'eau fluides */
@keyframes floatDrop1 {
  0% { top: -10%; left: 15%; opacity: 0; }
  50% { opacity: 0.6; }
  100% { top: 110%; left: 75%; opacity: 0; }
}

@keyframes floatDrop2 {
  0% { top: 110%; left: 80%; opacity: 0; }
  50% { opacity: 0.5; }
  100% { top: -10%; left: 20%; opacity: 0; }
}

@keyframes floatDrop3 {
  0% { top: 30%; left: -10%; opacity: 0; }
  50% { opacity: 0.4; }
  100% { top: 80%; left: 110%; opacity: 0; }
}

.drop-1 { animation: floatDrop1 16s infinite ease-in-out; }
.drop-2 { animation: floatDrop2 18s infinite ease-in-out 4s; }
.drop-3 { animation: floatDrop3 20s infinite ease-in-out 2s; }
</style>