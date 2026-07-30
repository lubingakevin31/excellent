<script setup>
import { onMounted, ref, onBeforeUnmount } from 'vue';
import * as THREE from 'three';

const canvasRef = ref(null);
let renderer, scene, camera, globe, animationFrameId;

onMounted(() => {
    if (!canvasRef.value) return;

    // 1. Scène & Caméra
    scene = new THREE.Scene();
    const width = canvasRef.value.clientWidth || 300;
    const height = canvasRef.value.clientHeight || 300;

    camera = new THREE.PerspectiveCamera(75, width / height, 0.1, 1000);
    camera.position.z = 2.5;

    // 2. Rendu
    renderer = new THREE.WebGLRenderer({ canvas: canvasRef.value, alpha: true, antialias: true });
    renderer.setSize(width, height);
    renderer.setPixelRatio(Math.min(window.devicePixelRatio, 2));

    // 3. Sphère réseau (Wireframe)
    const geometry = new THREE.IcosahedronGeometry(1.2, 2);
    const material = new THREE.MeshBasicMaterial({
        color: 0xd97706, // Amber/Gold Theme
        wireframe: true,
        transparent: true,
        opacity: 0.85
    });
    
    globe = new THREE.Mesh(geometry, material);
    scene.add(globe);

    // 4. Animation
    const animate = () => {
        animationFrameId = requestAnimationFrame(animate);
        globe.rotation.y += 0.003;
        globe.rotation.x += 0.001;
        renderer.render(scene, camera);
    };
    animate();

    // Redimensionnement réactif
    const handleResize = () => {
        if (!canvasRef.value) return;
        const newWidth = canvasRef.value.clientWidth;
        const newHeight = canvasRef.value.clientHeight;
        camera.aspect = newWidth / newHeight;
        camera.updateProjectionMatrix();
        renderer.setSize(newWidth, newHeight);
    };

    window.addEventListener('resize', handleResize);
});

onBeforeUnmount(() => {
    if (animationFrameId) cancelAnimationFrame(animationFrameId);
    if (renderer) renderer.dispose();
});
</script>

<template>
    <!-- Hauteur réduite à 200px sur mobile très étroit, puis 350px et 450px sur grand écran -->
    <div class="w-full h-[200px] sm:h-[350px] md:h-[450px] relative flex justify-center items-center">
        <canvas ref="canvasRef" class="w-full h-full block"></canvas>
    </div>
</template>