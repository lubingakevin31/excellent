<script setup>
import { onMounted, ref, onBeforeUnmount } from 'vue';
import * as THREE from 'three';

const canvasRef = ref(null);
let renderer, scene, camera, globe;

onMounted(() => {
    // 1. Scène & Caméra
    scene = new THREE.Scene();
    camera = new THREE.PerspectiveCamera(75, canvasRef.value.clientWidth / canvasRef.value.clientHeight, 0.1, 1000);
    camera.position.z = 3;

    // 2. Rendu
    renderer = new THREE.WebGLRenderer({ canvas: canvasRef.value, alpha: true, antialias: true });
    renderer.setSize(canvasRef.value.clientWidth, canvasRef.value.clientHeight);
    renderer.setPixelRatio(Math.min(window.devicePixelRatio, 2));

    // 3. Objet 3D (Sphère / Globe interactif)
    const geometry = new THREE.SphereGeometry(1.2, 32, 32);
    const material = new THREE.MeshBasicMaterial({
        color: 0x2563eb,
        wireframe: true
    });
    globe = new THREE.Mesh(geometry, material);
    scene.add(globe);

    // 4. Animation
    const animate = () => {
        requestAnimationFrame(animate);
        globe.rotation.y += 0.005;
        renderer.render(scene, camera);
    };
    animate();
});

onBeforeUnmount(() => {
    if (renderer) renderer.dispose();
});
</script>

<template>
    <div class="w-full h-[400px]">
        <canvas ref="canvasRef" class="w-full h-full"></canvas>
    </div>
</template>