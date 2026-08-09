<script setup>
import { onMounted, ref, onBeforeUnmount } from 'vue';
import * as THREE from 'three';

const props = defineProps({
  images: {
    type: Array,
    default: () => [
      '/images/archi.jpeg',
      '/images/education.jpg',
      '/images/environnement.jpeg',
      '/images/leadership.jpeg',
      '/images/innovation.jpg'
    ]
  },
  isDark: {
    type: Boolean,
    default: true
  }
});

const emit = defineEmits(['slide-change']);

const containerRef = ref(null);
const currentIndex = ref(0);

let renderer, scene, camera, animationFrameId;
let material, mesh, particlesMesh;
let textures = [];

const vertexShader = `
  varying vec2 vUv;
  uniform float uProgress;
  void main() {
    vUv = uv;
    vec3 pos = position;
    pos.z += sin(pos.x * 3.5 + uProgress * 3.14159) * sin(uProgress * 3.14159) * 0.25;
    gl_Position = projectionMatrix * modelViewMatrix * vec4(pos, 1.0);
  }
`;

const fragmentShader = `
  varying vec2 vUv;
  uniform sampler2D uCurrentTexture;
  uniform sampler2D uNextTexture;
  uniform float uProgress;

  void main() {
    vec2 uv = vUv;
    vec2 distortedUv1 = uv + vec2(uProgress * 0.08, 0.0);
    vec2 distortedUv2 = uv - vec2((1.0 - uProgress) * 0.08, 0.0);

    vec4 tex1 = texture2D(uCurrentTexture, distortedUv1);
    vec4 tex2 = texture2D(uNextTexture, distortedUv2);

    gl_FragColor = mix(tex1, tex2, uProgress);
  }
`;

let mouseX = 0, mouseY = 0;
let targetX = 0, targetY = 0;

const handleMouseMove = (e) => {
  if (!containerRef.value) return;
  const rect = containerRef.value.getBoundingClientRect();
  mouseX = ((e.clientX - rect.left) / rect.width) * 2 - 1;
  mouseY = -((e.clientY - rect.top) / rect.height) * 2 + 1;
};

const goToSlide = (nextIndex) => {
  if (nextIndex === currentIndex.value || textures.length === 0) return;

  const nextTex = textures[nextIndex];
  material.uniforms.uCurrentTexture.value = textures[currentIndex.value];
  material.uniforms.uNextTexture.value = nextTex;

  let startTime = null;
  const duration = 1000;

  const animateTransition = (timestamp) => {
    if (!startTime) startTime = timestamp;
    const elapsed = timestamp - startTime;
    const p = Math.min(elapsed / duration, 1.0);
    const easedP = p < 0.5 ? 4 * p * p * p : 1 - Math.pow(-2 * p + 2, 3) / 2;

    material.uniforms.uProgress.value = easedP;

    if (p < 1.0) {
      requestAnimationFrame(animateTransition);
    } else {
      currentIndex.value = nextIndex;
      material.uniforms.uCurrentTexture.value = nextTex;
      material.uniforms.uProgress.value = 0;
      emit('slide-change', currentIndex.value);
    }
  };

  requestAnimationFrame(animateTransition);
};

let autoSlideTimer = null;

onMounted(() => {
  if (!containerRef.value) return;

  const width = containerRef.value.clientWidth;
  const height = containerRef.value.clientHeight;

  scene = new THREE.Scene();
  camera = new THREE.PerspectiveCamera(45, width / height, 0.1, 100);
  camera.position.z = 4.2;

  renderer = new THREE.WebGLRenderer({ alpha: true, antialias: true });
  renderer.setSize(width, height);
  renderer.setPixelRatio(Math.min(window.devicePixelRatio, 2));
  containerRef.value.appendChild(renderer.domElement);

  const textureLoader = new THREE.TextureLoader();
  let loadedCount = 0;

  props.images.forEach((src, idx) => {
    textureLoader.load(src, (tex) => {
      tex.generateMipmaps = true;
      tex.minFilter = THREE.LinearMipmapLinearFilter;
      textures[idx] = tex;
      loadedCount++;

      if (loadedCount === props.images.length) {
        initMesh();
        initParticles();
        animate();
        startAutoSlide();
      }
    });
  });

  function initMesh() {
    // Dimensionnement strict au format 3:4 (Largeur 2.1, Hauteur 2.8)
    const geometry = new THREE.PlaneGeometry(2.1, 2.8, 32, 32);
    material = new THREE.ShaderMaterial({
      vertexShader,
      fragmentShader,
      uniforms: {
        uCurrentTexture: { value: textures[0] },
        uNextTexture: { value: textures[1] || textures[0] },
        uProgress: { value: 0 }
      },
      transparent: true
    });

    mesh = new THREE.Mesh(geometry, material);
    scene.add(mesh);
  }

  function initParticles() {
    const pCount = 50;
    const pGeometry = new THREE.BufferGeometry();
    const positions = new Float32Array(pCount * 3);

    for (let i = 0; i < pCount * 3; i += 3) {
      positions[i] = (Math.random() - 0.5) * 5;
      positions[i + 1] = (Math.random() - 0.5) * 4;
      positions[i + 2] = (Math.random() - 0.5) * 3;
    }

    pGeometry.setAttribute('position', new THREE.BufferAttribute(positions, 3));
    const pMaterial = new THREE.PointsMaterial({
      size: 0.03,
      color: 0xCFAE4F,
      transparent: true,
      opacity: 0.6
    });

    particlesMesh = new THREE.Points(pGeometry, pMaterial);
    scene.add(particlesMesh);
  }

  function animate() {
    animationFrameId = requestAnimationFrame(animate);

    targetX += (mouseX - targetX) * 0.05;
    targetY += (mouseY - targetY) * 0.05;

    if (mesh) {
      mesh.rotation.y = targetX * 0.1;
      mesh.rotation.x = -targetY * 0.1;
    }

    if (particlesMesh) {
      particlesMesh.rotation.y += 0.001;
    }

    renderer.render(scene, camera);
  }

  function startAutoSlide() {
    autoSlideTimer = setInterval(() => {
      const next = (currentIndex.value + 1) % props.images.length;
      goToSlide(next);
    }, 5000);
  }

  const handleResize = () => {
    if (!containerRef.value) return;
    const w = containerRef.value.clientWidth;
    const h = containerRef.value.clientHeight;
    camera.aspect = w / h;
    camera.updateProjectionMatrix();
    renderer.setSize(w, h);
  };

  window.addEventListener('resize', handleResize);
});

onBeforeUnmount(() => {
  if (autoSlideTimer) clearInterval(autoSlideTimer);
  if (animationFrameId) cancelAnimationFrame(animationFrameId);
  if (renderer) renderer.dispose();
});

defineExpose({ goToSlide, currentIndex });
</script>

<template>
  <!-- Conteneur forcé au ratio 3:4 -->
  <div 
    ref="containerRef" 
    @mousemove="handleMouseMove" 
    class="w-full max-w-[360px] aspect-[3/4] mx-auto relative rounded-3xl overflow-hidden cursor-grab active:cursor-grabbing"
  >
    <!-- Pagination -->
    <div class="absolute bottom-4 right-4 z-20 flex items-center gap-2 backdrop-blur-md px-3 py-1.5 rounded-full border border-white/10 bg-black/40 text-slate-200">
      <span class="text-[10px] font-black tracking-widest">
        0{{ currentIndex + 1 }} / 0{{ images.length }}
      </span>
      <div class="flex gap-1">
        <button 
          v-for="(_, idx) in images" 
          :key="idx" 
          @click="goToSlide(idx)"
          class="h-1 rounded-full transition-all duration-300"
          :class="currentIndex === idx ? 'w-4 bg-[#CFAE4F]' : 'w-1 bg-white/30'"
        ></button>
      </div>
    </div>
  </div>
</template>