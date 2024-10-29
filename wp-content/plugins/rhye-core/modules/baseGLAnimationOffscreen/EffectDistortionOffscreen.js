import * as THREE from './three.module.min.js';
import BaseGLAnimationOffscreen from './BaseGLAnimationOffscreen.js';

let gl;

class EffectDistortionOffscreen extends BaseGLAnimationOffscreen {
	constructor({
		slider,
		viewport,
		rect,
		canvas,
		aspect = 1.5,
		displacementImage,
		pixelsRatio = 1
	}) {
		super({
			viewport,
			rect,
			canvas,
			aspect,
			pixelsRatio
		});

		this.aspect = aspect;
		this.canvas = canvas;
		this.dispImage = displacementImage;
		this.slider = slider;
		this.items = [];
		this.viewport = viewport;

		this.disp = this._loadDispImage();
	}

	run() {
		this.uniforms = {
			effectFactor: {
				type: 'f',
				value: 0.20
			},
			dispFactor: {
				type: 'f',
				value: 0.0
			},
			cTexture: {
				type: 't',
				value: this.items[0].texture
			},
			cTexture2: {
				type: 't',
				value: this.items[0].texture // only one slide
			},
			disp: {
				type: 't',
				value: this.disp
			}
		};

		this.geometry = this._getPlaneBufferGeometry();
		this.material = this._getShaderMaterial();

		this.plane = this._getPlane({
			geometry: this.geometry,
			material: this.material
		});

		this.scene.add(this.plane);

		this._updateScene();
	}

	loadTexture({
		index,
		url
	}) {
		this.loader.load(url, (bitmap) => {
			this.items[index] = {
				texture: null
			};

			this.items[index].texture = new THREE.Texture(bitmap);
			this.items[index].texture.needsUpdate = true;
			this.items[index].texture.wrapS = THREE.RepeatWrapping;
			this.items[index].texture.wrapT = THREE.RepeatWrapping;
			this.items[index].texture.magFilter = THREE.LinearFilter;
			this.items[index].texture.minFilter = THREE.LinearFilter;
			this.items[index].texture.format = THREE.RGBFormat;
			this.items[index].texture.anisotropy = this.renderer.capabilities.getMaxAnisotropy();

			postMessage({
				type: 'textureReady',
				index: index
			});
		});
	}

	_loadDispImage() {
		return new Promise((resolve) => {
			this.loader.load(this.dispImage, (bitmap) => {
				this.disp = new THREE.Texture(bitmap);
				this.disp.needsUpdate = true;
				this.disp.wrapS = this.disp.wrapT = THREE.RepeatWrapping;
				resolve(true);
			});
		});
	}

	_getPlaneBufferGeometry() {
		const {
			width,
			height,
		} = this._calculatePosition();

		return new THREE.PlaneBufferGeometry(
			width,
			height
		);
	}

	_getCamera() {
		return new THREE.OrthographicCamera(
			this.viewport.width / -2,
			this.viewport.width / 2,
			this.viewport.height / 2,
			this.viewport.height / -2,
		);
	}

	_getVertexShader() {
		return `
			varying vec2 vUv;
			void main() {
				vUv = uv;
				gl_Position = projectionMatrix * modelViewMatrix * vec4( position, 1.0 );
			}
		`;
	}

	_getFragmentShader(id) {
		switch (id) {
			case 'slider-textures-horizontal-fs':
				return `
					varying vec2 vUv;

					uniform sampler2D cTexture;
					uniform sampler2D cTexture2;
					uniform sampler2D disp;

					uniform float dispFactor;
					uniform float effectFactor;

					void main() {
						vec2 uv = vUv;

						vec4 disp = texture2D(disp, uv);

						vec2 distortedPosition = vec2(uv.x + dispFactor * (disp.r*effectFactor), uv.y);
						vec2 distortedPosition2 = vec2(uv.x - (1.0 - dispFactor) * (disp.r*effectFactor), uv.y);

						vec4 _texture = texture2D(cTexture, distortedPosition);
						vec4 _texture2 = texture2D(cTexture2, distortedPosition2);

						vec4 finalTexture = mix(_texture, _texture2, dispFactor);

						gl_FragColor = finalTexture;

					}
				`;
			case 'slider-textures-vertical-fs':
				return `
					varying vec2 vUv;

					uniform sampler2D cTexture;
					uniform sampler2D cTexture2;
					uniform sampler2D disp;

					uniform float dispFactor;
					uniform float effectFactor;

					void main() {
						vec2 uv = vUv;

						vec4 disp = texture2D(disp, uv);

						vec2 distortedPosition = vec2(uv.x, uv.y - dispFactor * (disp.r*effectFactor));
						vec2 distortedPosition2 = vec2(uv.x, uv.y + (1.0 - dispFactor) * (disp.r*effectFactor));

						vec4 _texture = texture2D(cTexture, distortedPosition);
						vec4 _texture2 = texture2D(cTexture2, distortedPosition2);

						vec4 finalTexture = mix(_texture, _texture2, dispFactor);

						gl_FragColor = finalTexture;

					}
				`;
			default:
				return false;
		}
	}

	_getShaderMaterial() {
		const fsID = this.slider.params.direction === 'horizontal' ? 'slider-textures-horizontal-fs' : 'slider-textures-vertical-fs';

		return new THREE.ShaderMaterial({
			uniforms: this.uniforms,
			vertexShader: this._getVertexShader('slider-textures-vs'),
			fragmentShader: this._getFragmentShader(fsID),
			opacity: 1
		});
	}

	updateViewPort({
		viewport,
		rect
	}) {
		this.viewport = viewport;
		this.rect = rect;
		this._updateScene();
	}

	_updateScene() {
		// this.viewport = this.coverMode ? this._getViewportCover() : this._getViewport();
		// this.viewSize = this._getViewSize();

		if (this.camera) {
			this.camera.left = this.viewport.width / -2;
			this.camera.right = this.viewport.width / 2;
			this.camera.top = this.viewport.height / 2;
			this.camera.bottom = this.viewport.height / -2;
			this.camera.updateProjectionMatrix();
		}

		if (this.renderer) {
			this.renderer.setSize(this.viewport.width, this.viewport.height, false);
		}
	}

}

self.onmessage = function (e) {
	if (e.data.type === 'init') {
		gl = new EffectDistortionOffscreen(e.data);
	}

	if (e.data.type === 'loadTexture') {
		gl.loadTexture(e.data);
	}

	if (e.data.type === 'run') {
		gl.run();
	}

	if (e.data.type === 'updateViewport') {
		gl.updateViewPort(e.data);
	}

	if (e.data.type === 'setChange' && gl.material && gl.material.uniforms) {

		if (gl.items[e.data.from] && gl.items[e.data.from].texture) {
			gl.material.uniforms.cTexture.value = gl.items[e.data.from].texture;
		}

		if (gl.items[e.data.to] && gl.items[e.data.to].texture) {
			gl.material.uniforms.cTexture2.value = gl.items[e.data.to].texture;
		}

		gl.material.uniforms.effectFactor.value = e.data.intensity;
	}

	if (e.data.type === 'changeAnimate' && gl.material && gl.material.uniforms) {
		gl.material.uniforms.dispFactor.value = e.data.value;
	}

	if (e.data.type === 'kill') {
		gl = null;
		self.close();
	}
}
