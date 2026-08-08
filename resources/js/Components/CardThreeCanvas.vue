<script setup>
import { onMounted, ref, onBeforeUnmount, watch } from 'vue';
import * as THREE from 'three';

const props = defineProps({
    activeSection: {
        type: String,
        default: 'hero'
    },
    isDark: {
        type: Boolean,
        default: true
    }
});

const canvasRef = ref(null);
let renderer, scene, camera, mainGroup, animationFrameId;
let coreSphere, outerRing, nodeGroup;
let ambientLight, mainLight, accentLight;
let coreMaterial, ringMaterial, nodeMaterial;

// Mise à jour complète de l'ambiance visuelle 3D selon le mode
const applyThemeStyle = (dark) => {
    if (!coreMaterial || !ringMaterial || !nodeMaterial) return;

    if (dark) {
        // --- AMBIANCE MODE SOMBRE (Bleu Nuit WhatsApp & Pierre de France) ---
        scene.background = null;

        // Lumières intenses et contrastées
        ambientLight.intensity = 0.6;
        mainLight.color.setHex(0xe3d1be); // Pierre de France
        mainLight.intensity = 3.5;
        accentLight.color.setHex(0x111b21); // Bleu Nuit
        accentLight.intensity = 2.0;

        // Noyau métallique profond
        coreMaterial.color.setHex(0x0f172a);
        coreMaterial.roughness = 0.15;
        coreMaterial.metalness = 0.85;
        coreMaterial.opacity = 1.0;
        coreMaterial.transparent = false;

        // Anneau Doré Pierre de France
        ringMaterial.color.setHex(0xe3d1be);
        ringMaterial.roughness = 0.2;
        ringMaterial.metalness = 0.8;

        // Nœuds lumineux
        nodeMaterial.color.setHex(0xe3d1be);
        nodeMaterial.emissive.setHex(0x4a2c2a);
        nodeMaterial.emissiveIntensity = 0.6;
    } else {
        // --- AMBIANCE MODE CLAIR (Blanc, Casablanca & Cocoa) ---
        scene.background = null;

        // Lumière douce et lumineuse
        ambientLight.intensity = 1.2;
        mainLight.color.setHex(0xf4a261); // Casablanca
        mainLight.intensity = 2.5;
        accentLight.color.setHex(0x4a2c2a); // Cocoa
        accentLight.intensity = 1.0;

        // Noyau effet "Verre dépoli / Quartz lumineux"
        coreMaterial.color.setHex(0xffffff);
        coreMaterial.roughness = 0.1;
        coreMaterial.metalness = 0.1;
        coreMaterial.opacity = 0.85;
        coreMaterial.transparent = true;

        // Anneau couleur Casablanca / Warm Gold
        ringMaterial.color.setHex(0xf4a261);
        ringMaterial.roughness = 0.3;
        ringMaterial.metalness = 0.4;

        // Nœuds couleur Cocoa chaleureux
        nodeMaterial.color.setHex(0x4a2c2a);
        nodeMaterial.emissive.setHex(0xf4a261);
        nodeMaterial.emissiveIntensity = 0.4;
    }
};

watch(() => props.isDark, (newVal) => {
    applyThemeStyle(newVal);
});

onMounted(() => {
    if (!canvasRef.value) return;

    // 1. Initialisation Scène & Caméra
    scene = new THREE.Scene();
    const width = window.innerWidth;
    const height = window.innerHeight;

    camera = new THREE.PerspectiveCamera(50, width / height, 0.1, 1000);
    camera.position.set(0, 0, 7);

    // 2. Rendu WebGL
    renderer = new THREE.WebGLRenderer({ canvas: canvasRef.value, alpha: true, antialias: true });
    renderer.setSize(width, height);
    renderer.setPixelRatio(Math.min(window.devicePixelRatio, 2));

    // 3. Lumières
    ambientLight = new THREE.AmbientLight(0xffffff, 0.8);
    scene.add(ambientLight);

    mainLight = new THREE.PointLight(0xe3d1be, 3.5, 25);
    mainLight.position.set(4, 4, 5);
    scene.add(mainLight);

    accentLight = new THREE.PointLight(0x111b21, 2, 20);
    accentLight.position.set(-5, -4, -2);
    scene.add(accentLight);

    // 4. Groupe 3D principal
    mainGroup = new THREE.Group();

    // Noyau adaptable
    coreMaterial = new THREE.MeshStandardMaterial({
        color: 0x0f172a,
        roughness: 0.15,
        metalness: 0.85
    });
    coreSphere = new THREE.Mesh(new THREE.SphereGeometry(1.8, 64, 64), coreMaterial);
    mainGroup.add(coreSphere);

    // Anneau d'orbitation
    ringMaterial = new THREE.MeshStandardMaterial({
        color: 0xe3d1be,
        roughness: 0.2,
        metalness: 0.9
    });
    outerRing = new THREE.Mesh(new THREE.TorusGeometry(2.4, 0.04, 32, 100), ringMaterial);
    outerRing.rotation.x = Math.PI / 3;
    mainGroup.add(outerRing);

    // Nœuds satellite
    nodeGroup = new THREE.Group();
    nodeMaterial = new THREE.MeshStandardMaterial({
        color: 0xe3d1be,
        emissive: 0x4a2c2a,
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

    // Application initiale du thème
    applyThemeStyle(props.isDark);

    // 5. Animation et positionnement au scroll (LERP)
    let targetX = 2.0;
    let targetY = 0;
    let targetScale = 1;

    const animate = () => {
        animationFrameId = requestAnimationFrame(animate);

        // Auto-rotations
        mainGroup.rotation.y += 0.0025;
        outerRing.rotation.z += 0.004;
        nodeGroup.rotation.y -= 0.003;

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

        mainGroup.position.x += (targetX - mainGroup.position.x) * 0.04;
        mainGroup.position.y += (targetY - mainGroup.position.y) * 0.04;

        const currentScale = mainGroup.scale.x;
        const nextScale = currentScale + (targetScale - currentScale) * 0.04;
        mainGroup.scale.set(nextScale, nextScale, nextScale);

        renderer.render(scene, camera);
    };
    animate();

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