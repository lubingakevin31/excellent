<script setup>
import { onMounted, ref, onBeforeUnmount, watch } from 'vue';
import * as THREE from 'three';

const props = defineProps({
    activeSection: {
        type: String,
        default: 'hero'
    }
});

const canvasRef = ref(null);
let renderer, scene, camera, mainGroup, animationFrameId;
let coreSphere, outerRing, nodeGroup;

onMounted(() => {
    if (!canvasRef.value) return;

    // 1. Initialisation Scène & Caméra plein écran
    scene = new THREE.Scene();
    const width = window.innerWidth;
    const height = window.innerHeight;

    camera = new THREE.PerspectiveCamera(50, width / height, 0.1, 1000);
    camera.position.set(0, 0, 7);

    // 2. Rendu WebGL avec antialiasing
    renderer = new THREE.WebGLRenderer({ canvas: canvasRef.value, alpha: true, antialias: true });
    renderer.setSize(width, height);
    renderer.setPixelRatio(Math.min(window.devicePixelRatio, 2));

    // 3. Éclairage volumétrique (Amber Gold & Dark Slate)
    const ambientLight = new THREE.AmbientLight(0xffffff, 0.8);
    scene.add(ambientLight);

    const goldLight = new THREE.PointLight(0xf59e0b, 3.5, 25);
    goldLight.position.set(4, 4, 5);
    scene.add(goldLight);

    const accentLight = new THREE.PointLight(0x38bdf8, 2, 20);
    accentLight.position.set(-5, -4, -2);
    scene.add(accentLight);

    // 4. Groupe 3D principal (Objet plein sans wireframe)
    mainGroup = new THREE.Group();

    // Noyau sombre et métallique
    const coreMaterial = new THREE.MeshStandardMaterial({
        color: 0x0f172a,
        roughness: 0.15,
        metalness: 0.85
    });
    coreSphere = new THREE.Mesh(new THREE.SphereGeometry(1.8, 64, 64), coreMaterial);
    mainGroup.add(coreSphere);

    // Anneau d'accentuation Doré
    const ringMaterial = new THREE.MeshStandardMaterial({
        color: 0xf59e0b,
        roughness: 0.2,
        metalness: 0.9
    });
    outerRing = new THREE.Mesh(new THREE.TorusGeometry(2.4, 0.04, 32, 100), ringMaterial);
    outerRing.rotation.x = Math.PI / 3;
    mainGroup.add(outerRing);

    // Constellation de noeuds en orbite
    nodeGroup = new THREE.Group();
    const nodeMaterial = new THREE.MeshStandardMaterial({
        color: 0xfbbf24,
        emissive: 0xd97706,
        emissiveIntensity: 0.6,
        roughness: 0.1
    });

    const nodeCount = 14;
    for (let i = 0; i < nodeCount; i++) {
        const node = new THREE.Mesh(new THREE.SphereGeometry(0.1, 16, 16), nodeMaterial);
        const phi = Math.acos(-1 + (2 * i) / nodeCount);
        const theta = Math.sqrt(nodeCount * Math.PI) * phi;
        node.position.setFromSphericalCoords(2.2, phi, theta);
        nodeGroup.add(node);
    }
    mainGroup.add(nodeGroup);

    scene.add(mainGroup);

    // 5. Animation réactive aux props (LERP)
    let targetX = 2.0;
    let targetY = 0;
    let targetScale = 1;

    const animate = () => {
        animationFrameId = requestAnimationFrame(animate);

        // Auto-rotation constante de l'ensemble
        mainGroup.rotation.y += 0.0025;
        outerRing.rotation.z += 0.004;
        nodeGroup.rotation.y -= 0.003;

        // Repositionnement selon la section courante
        const isMobile = window.innerWidth < 1024;

        if (props.activeSection === 'hero') {
            targetX = isMobile ? 0 : 2.2;
            targetY = isMobile ? -1.2 : 0;
            targetScale = 1;
        } else if (props.activeSection === 'impact') {
            targetX = isMobile ? 0 : -2.2;
            targetY = isMobile ? 1.0 : 0.2;
            targetScale = 1.15;
        } else if (props.activeSection === 'piliers') {
            targetX = 0;
            targetY = isMobile ? -1.5 : -0.8;
            targetScale = 0.85;
        } else if (props.activeSection === 'vision') {
            targetX = 0;
            targetY = 0;
            targetScale = 1.35;
        }

        // Interpolation fluide (Amortissement)
        mainGroup.position.x += (targetX - mainGroup.position.x) * 0.04;
        mainGroup.position.y += (targetY - mainGroup.position.y) * 0.04;

        const currentScale = mainGroup.scale.x;
        const nextScale = currentScale + (targetScale - currentScale) * 0.04;
        mainGroup.scale.set(nextScale, nextScale, nextScale);

        renderer.render(scene, camera);
    };
    animate();

    // 6. Handling du Resize
    const handleResize = () => {
        if (!canvasRef.value) return;
        const w = window.innerWidth;
        const h = window.innerHeight;
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
    <div class="w-full h-full relative overflow-hidden">
        <canvas ref="canvasRef" class="w-full h-full block pointer-events-none"></canvas>
    </div>
</template>