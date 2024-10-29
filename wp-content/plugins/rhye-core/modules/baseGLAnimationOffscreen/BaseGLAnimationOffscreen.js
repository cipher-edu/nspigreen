import * as THREE from './three.module.min.js';

export default class BaseGLAnimationOffscreen {
	constructor({
		canvas,
		aspect,
		viewport,
		rect,
		pixelsRatio = 1
	}) {
		this.canvas = canvas;
		this.rect = rect;
		this.coverMode = aspect ? true : false;
		this.aspect = aspect;
		this.scene = this._getScene();
		this.viewport = viewport;
		this.camera = this._getCamera();
		this.renderer = this._getRenderer();
		this.renderer.setPixelRatio(pixelsRatio);
		this.renderer.setClearColor(0xffffff, 0.0);
		this.renderer.setSize(this.viewport.width, this.viewport.height, false);
		this._render();

		this.loader = this._getTextureLoader();
		this.camera.position.z = 1;
		this.camera.updateProjectionMatrix();
		this._updateScene();
	}

	_render() {
		if (this.renderer) {
			this.renderer.render(this.scene, this.camera);
			requestAnimationFrame(this._render.bind(this));
		}
	}

	_getRenderer() {
		return new THREE.WebGLRenderer({
			canvas: this.canvas,
			powerPreference: 'high-performance',
			alpha: true
		});
	}

	_getScene() {
		return new THREE.Scene();
	}

	_getCamera() {
		return new THREE.PerspectiveCamera(
			53.1,
			this.viewport.aspectRatio,
			0.1,
			1000
		);
	}

	_getPlane({
		geometry,
		material
	}) {
		return new THREE.Mesh(geometry, material);
	}

	_updateScene() {
		this.viewport = this.coverMode ? this._getViewportCover() : this._getViewport();
		this.viewSize = this._getViewSize();

		if (this.camera) {
			this.camera.aspect = this.viewport.width / this.viewport.height;
			this.camera.updateProjectionMatrix();
		}

		if (this.renderer) {
			this.renderer.setSize(this.viewport.width, this.viewport.height, false);
		}
	}

	_getViewport() {
		const width = this.viewport.width;
		const height = this.viewport.height;
		const aspectRatio = width / height;

		return {
			width,
			height,
			aspectRatio
		}
	}

	_getViewportCover() {
		let
			height = parseFloat(this.viewport.height),
			width = parseFloat(height * this.aspect),
			aspectRatio = this.aspect,
			multiplier = 1;

		if (this.aspect > 1) {
			multiplier = this.viewport.width > width ? this.viewport.width / width : 1;
		} else {
			multiplier = this.rect.width / width;
		}

		if (multiplier < 1) {
			multiplier = 1;
		}

		width = width * multiplier;
		height = height * multiplier;

		return {
			width,
			height,
			aspectRatio
		};
	}

	_getViewSize() {
		// fit plane to screen
		// https://gist.github.com/ayamflow/96a1f554c3f88eef2f9d0024fc42940f

		const distance = this.camera.position.z;
		const vFov = (this.camera.fov * Math.PI) / 180;
		const height = 2 * Math.tan(vFov / 2) * distance;
		const width = height * this.viewport.aspectRatio;

		return {
			width,
			height,
			vFov
		};
	}

	_calculatePosition() {
		let
			height = parseFloat(this.viewport.height),
			width = parseFloat(height * this.rect.aspectRatio),
			multiplier = 1;

		if (this.rect.aspectRatio > 1) {
			multiplier = this.viewport.width > width ? this.viewport.width / width : 1;
		} else {
			multiplier = this.rect.width / width;
		}

		if (multiplier < 1) {
			multiplier = 1;
		}

		width = width * multiplier;
		height = height * multiplier;

		return {
			width,
			height
		};
	}

	_getTextureLoader() {
		const loader = new THREE.ImageBitmapLoader();

		loader.setOptions({
			imageOrientation: 'flipY'
		});

		return loader;
	}

	_loadTextures() {
		const promises = [];

		this.images.forEach((item, index) => {
			promises.push(new Promise((resolve) => {
				this.loader.load(item, (bitmap) => {
					this.items[index] = {
						texture: null
					};

					this.items[index].texture = new THREE.Texture(bitmap);
					this.items[index].texture.needsUpdate = true;
					// this.items[index].texture.scale = {
					// 	x: -1,
					// 	y: -1
					// };
					this.items[index].texture.wrapS = THREE.RepeatWrapping;
					this.items[index].texture.wrapT = THREE.RepeatWrapping;
					this.items[index].texture.magFilter = THREE.LinearFilter;
					this.items[index].texture.minFilter = THREE.LinearFilter;
					this.items[index].texture.format = THREE.RGBFormat;
					this.items[index].texture.anisotropy = this.renderer.capabilities.getMaxAnisotropy();

					resolve(true);
				});
			}))
		});

		return promises;
	}

	_coverTexture(texture, aspect) {

		const imageAspect = texture.image.width / texture.image.height;

		if (aspect < imageAspect) {
			texture.matrix.setUvTransform(0, 0, aspect / imageAspect, 1, 0, 0.5, 0.5);

		} else {

			texture.matrix.setUvTransform(0, 0, 1, imageAspect / aspect, 0, 0.5, 0.5);

		}

		return texture;

	}

	destroy() {
		cancelAnimationFrame(this.renderer);
		// this.renderer.setAnimationLoop(null);
		this.camera = null;
		this.scene = null;
		this.loader = null;
		this.material = null;
		// this.renderer = undefined;
		// window.$window.off('resize');
	}
}
