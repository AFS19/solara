import * as THREE from 'three';
import { GLTFLoader } from 'three/addons/loaders/GLTFLoader.js';
import { OrbitControls } from 'three/addons/controls/OrbitControls.js';

export class ProductScene {
    constructor(container, options = {}) {
        this.container = container;
        this.options = {
            modelUrl: options.modelUrl || null,
            color: options.color || '#f59e0b',
            pixelRatio: options.pixelRatio || 0.75,
            autoRotate: options.autoRotate !== false,
            ...options
        };
        
        this.scene = null;
        this.camera = null;
        this.renderer = null;
        this.controls = null;
        this.model = null;
        this.fallbackMesh = null;
        this.animationId = null;
        this.isVisible = true;
        
        this.init();
    }
    
    init() {
        this.setupScene();
        this.setupCamera();
        this.setupRenderer();
        this.setupLights();
        this.setupControls();
        
        if (this.options.modelUrl) {
            this.loadModel();
        } else {
            this.createFallback();
        }
        
        this.setupVisibilityObserver();
        this.animate();
        this.setupScrollTilt();
        
        window.addEventListener('resize', () => this.onResize());
    }
    
    setupScene() {
        this.scene = new THREE.Scene();
        this.scene.background = null;
    }
    
    setupCamera() {
        const aspect = this.container.clientWidth / this.container.clientHeight;
        this.camera = new THREE.PerspectiveCamera(45, aspect, 0.1, 100);
        this.camera.position.set(0, 0, 5);
    }
    
    setupRenderer() {
        this.renderer = new THREE.WebGLRenderer({
            antialias: true,
            alpha: true,
            powerPreference: 'high-performance'
        });
        
        const pixelRatio = Math.min(window.devicePixelRatio * this.options.pixelRatio, 2);
        this.renderer.setPixelRatio(pixelRatio);
        this.renderer.setSize(this.container.clientWidth, this.container.clientHeight);
        this.renderer.setClearColor(0x000000, 0);
        this.renderer.shadowMap.enabled = true;
        this.renderer.shadowMap.type = THREE.PCFSoftShadowMap;
        this.renderer.toneMapping = THREE.ACESFilmicToneMapping;
        this.renderer.toneMappingExposure = 1.0;
        
        this.container.appendChild(this.renderer.domElement);
    }
    
    setupLights() {
        // Soft ambient
        const ambientLight = new THREE.AmbientLight(0xffffff, 0.4);
        this.scene.add(ambientLight);
        
        // Warm directional (golden hour feel)
        const mainLight = new THREE.DirectionalLight(0xffd699, 1.2);
        mainLight.position.set(3, 4, 5);
        mainLight.castShadow = true;
        mainLight.shadow.mapSize.width = 1024;
        mainLight.shadow.mapSize.height = 1024;
        mainLight.shadow.bias = -0.001;
        this.scene.add(mainLight);
        
        // Rim light for definition
        const rimLight = new THREE.DirectionalLight(0x38bdf8, 0.5);
        rimLight.position.set(-3, 2, -3);
        this.scene.add(rimLight);
        
        // Fill light
        const fillLight = new THREE.DirectionalLight(0xffffff, 0.3);
        fillLight.position.set(-3, 0, 3);
        this.scene.add(fillLight);
    }
    
    setupControls() {
        this.controls = new OrbitControls(this.camera, this.renderer.domElement);
        this.controls.enableDamping = true;
        this.controls.dampingFactor = 0.05;
        this.controls.enableZoom = false;
        this.controls.enablePan = false;
        this.controls.autoRotate = this.options.autoRotate;
        this.controls.autoRotateSpeed = 2.0;
        
        // Limit angles
        this.controls.minPolarAngle = Math.PI / 3;
        this.controls.maxPolarAngle = Math.PI / 1.8;
        this.controls.minAzimuthAngle = -Math.PI / 3;
        this.controls.maxAzimuthAngle = Math.PI / 3;
    }
    
    loadModel() {
        const loader = new GLTFLoader();
        loader.load(
            this.options.modelUrl,
            (gltf) => {
                this.model = gltf.scene;
                this.model.traverse((child) => {
                    if (child.isMesh) {
                        child.castShadow = true;
                        child.receiveShadow = true;
                        if (child.material) {
                            child.material.needsUpdate = true;
                        }
                    }
                });
                
                // Center and scale
                const box = new THREE.Box3().setFromObject(this.model);
                const center = box.getCenter(new THREE.Vector3());
                const size = box.getSize(new THREE.Vector3());
                const maxDim = Math.max(size.x, size.y, size.z);
                const scale = 2.5 / maxDim;
                
                this.model.scale.setScalar(scale);
                this.model.position.sub(center.multiplyScalar(scale));
                this.model.position.y = -0.5;
                
                this.scene.add(this.model);
            },
            undefined,
            (error) => {
                console.warn('GLTF load failed, using fallback:', error);
                this.createFallback();
            }
        );
    }
    
    createFallback() {
        // Procedural sunscreen tube
        const group = new THREE.Group();
        
        // Tube body
        const tubeGeometry = new THREE.CapsuleGeometry(0.6, 2.2, 8, 16);
        const tubeMaterial = new THREE.MeshStandardMaterial({
            color: this.options.color,
            roughness: 0.3,
            metalness: 0.1,
        });
        const tube = new THREE.Mesh(tubeGeometry, tubeMaterial);
        tube.castShadow = true;
        tube.receiveShadow = true;
        group.add(tube);
        
        // Cap
        const capGeometry = new THREE.CylinderGeometry(0.62, 0.62, 0.4, 32);
        const capMaterial = new THREE.MeshStandardMaterial({
            color: 0x1a1a1a,
            roughness: 0.5,
            metalness: 0.3,
        });
        const cap = new THREE.Mesh(capGeometry, capMaterial);
        cap.position.y = -1.3;
        cap.castShadow = true;
        cap.receiveShadow = true;
        group.add(cap);
        
        // Label band
        const labelGeometry = new THREE.CylinderGeometry(0.61, 0.61, 1.0, 32, 1, true);
        const labelMaterial = new THREE.MeshStandardMaterial({
            color: 0xffffff,
            roughness: 0.4,
            metalness: 0.0,
            transparent: true,
            opacity: 0.9,
        });
        const label = new THREE.Mesh(labelGeometry, labelMaterial);
        label.position.y = 0.3;
        label.castShadow = true;
        group.add(label);
        
        // SPF badge
        const badgeGeometry = new THREE.CircleGeometry(0.25, 32);
        const badgeMaterial = new THREE.MeshStandardMaterial({
            color: 0xf59e0b,
            emissive: 0xf59e0b,
            emissiveIntensity: 0.2,
        });
        const badge = new THREE.Mesh(badgeGeometry, badgeMaterial);
        badge.position.set(0, 0.5, 0.62);
        badge.rotation.y = 0;
        group.add(badge);
        
        this.fallbackMesh = group;
        this.model = group;
        this.scene.add(group);
    }
    
    setupVisibilityObserver() {
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                this.isVisible = entry.isIntersecting;
                if (this.isVisible && !this.animationId) {
                    this.animate();
                }
            });
        }, { threshold: 0.1 });
        
        observer.observe(this.container);
        
        // Pause when tab hidden
        document.addEventListener('visibilitychange', () => {
            if (document.hidden) {
                this.isVisible = false;
            } else {
                this.isVisible = true;
            }
        });
    }
    
    setupScrollTilt() {
        let ticking = false;
        
        window.addEventListener('scroll', () => {
            if (!ticking) {
                requestAnimationFrame(() => {
                    const scrollY = window.scrollY;
                    const tiltX = Math.max(-0.3, Math.min(0.3, scrollY * 0.0005));
                    
                    if (this.model) {
                        this.model.rotation.x = tiltX;
                    }
                    ticking = false;
                });
                ticking = true;
            }
        }, { passive: true });
    }
    
    changeColor(color) {
        if (this.fallbackMesh) {
            this.fallbackMesh.children[0].material.color.set(color);
        } else if (this.model) {
            this.model.traverse((child) => {
                if (child.isMesh && child.material) {
                    child.material.color.set(color);
                }
            });
        }
    }
    
    swapModel(modelUrl) {
        if (this.model) {
            this.scene.remove(this.model);
        }
        
        this.options.modelUrl = modelUrl;
        this.fallbackMesh = null;
        
        if (modelUrl) {
            this.loadModel();
        } else {
            this.createFallback();
        }
    }
    
    onResize() {
        if (!this.container || !this.camera || !this.renderer) return;
        
        const width = this.container.clientWidth;
        const height = this.container.clientHeight;
        
        this.camera.aspect = width / height;
        this.camera.updateProjectionMatrix();
        this.renderer.setSize(width, height);
    }
    
    animate() {
        if (!this.isVisible) {
            this.animationId = null;
            return;
        }
        
        this.animationId = requestAnimationFrame(() => this.animate());
        
        if (this.controls) {
            this.controls.update();
        }
        
        if (this.renderer && this.scene && this.camera) {
            this.renderer.render(this.scene, this.camera);
        }
    }
    
    destroy() {
        this.isVisible = false;
        
        if (this.animationId) {
            cancelAnimationFrame(this.animationId);
        }
        
        if (this.controls) {
            this.controls.dispose();
        }
        
        if (this.renderer) {
            this.renderer.dispose();
            this.container.removeChild(this.renderer.domElement);
        }
        
        window.removeEventListener('resize', () => this.onResize());
    }
}

export default ProductScene;
