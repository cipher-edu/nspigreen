import * as THREE from './three.module.min.js';
import BaseGLAnimationOffscreen from './BaseGLAnimationOffscreen.js';

let gl;

class EffectStretchOffscreen extends BaseGLAnimationOffscreen {
	constructor({
		canvas,
		viewport,
		options,
		pixelsRatio
	}) {
		super({
			canvas,
			viewport,
			pixelsRatio
		});

		this.items = [];
		this.viewport = viewport;

		this.options = options || {
			strength: 0.2,
			scaleTexture: 1.8,
			scalePlane: 1
		};
	}

	run() {
		this.mouse = new THREE.Vector2();
		this.position = new THREE.Vector3(0, 0, 0);
		this.scale = new THREE.Vector3(1, 1, 1);

		this.uniforms = {
			uTexture: {
				value: null
			},
			uOffset: {
				value: new THREE.Vector2(0.0, 0.0)
			},
			uAlpha: {
				value: 0
			},
			uScale: {
				value: Math.abs(this.options.scaleTexture - 2)
			}
		};

		this.geometry = this._getPlaneBufferGeometry();
		this.material = this._getShaderMaterial();
		this.plane = this._getPlane({
			geometry: this.geometry,
			material: this.material
		});

		this.scene.add(this.plane);
	}

	updateViewPort({
		viewport,
		rect
	}) {
		this.viewport = viewport;
		this.rect = rect;
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

	_getPlaneBufferGeometry() {
		return new THREE.PlaneBufferGeometry(1, 1, 8, 8);
	}

	_getVertexShader() {
		return `
			uniform vec2 uOffset;

			varying vec2 vUv;

			vec3 deformationCurve(vec3 position, vec2 uv, vec2 offset) {
				float M_PI = 3.1415926535897932384626433832795;
				position.x = position.x + (sin(uv.y * M_PI) * offset.x);
				position.y = position.y + (sin(uv.x * M_PI) * offset.y);
				return position;
			}

			void main() {
				vUv =  uv + (uOffset * 2.);
				vec3 newPosition = position;
				newPosition = deformationCurve(position,uv,uOffset);
				gl_Position = projectionMatrix * modelViewMatrix * vec4( newPosition, 1.0 );
			}
		`;
	}

	_getFragmentShader() {
		return `
			uniform sampler2D uTexture;
			uniform float uAlpha;
			uniform float uScale;

			varying vec2 vUv;

			vec2 scaleUV(vec2 uv,float scale) {
				float center = 0.5;
				return ((uv - center) * scale) + center;
			}

			void main() {
				vec3 color = texture2D(uTexture,scaleUV(vUv,uScale)).rgb;
				gl_FragColor = vec4(color,uAlpha);
			}
		`;
	}

	_getShaderMaterial() {
		return new THREE.ShaderMaterial({
			uniforms: this.uniforms,
			vertexShader: this._getVertexShader('list-hover-vs'),
			fragmentShader: this._getFragmentShader('list-hover-fs'),
			transparent: true
		});
	}

	setAlpha({
		value
	}) {

		if (this.currentItem) {
			this.uniforms.uAlpha.value = value;
		}
	}

	_map(number, in_min, in_max, out_min, out_max) {
		return ((number - in_min) * (out_max - out_min)) / (in_max - in_min) + out_min;
	}

	getOffset() {
		let x = this._map(
			this.mouse.x,
			-1,
			1,
			-this.viewSize.width / 2,
			this.viewSize.width / 2
		);

		let y = this._map(
			this.mouse.y,
			-1,
			1,
			-this.viewSize.height / 2,
			this.viewSize.height / 2
		);

		this.position = new THREE.Vector3(x, y, 0);

		return {
			x,
			y
		};
	}

	setPosition({
		position
	}) {
		this.plane.position.x = position.x;
		this.plane.position.y = position.y;

		// compute offset
		let offset = this.plane.position
			.clone()
			.sub(this.position)
			.multiplyScalar(-this.options.strength);

		this.uniforms.uOffset.value = offset;
	}

	setTarget({
		index
	}) {

		if (!this.items[index]) {
			return;
		}
		// item target changed
		this.currentItem = this.items[index];

		// compute image ratio
		const imageRatio = this._getTextureRatio();

		this.scale = new THREE.Vector3(imageRatio * this.options.scalePlane, 1 * this.options.scalePlane, 1 * this.options.scalePlane);
		this.uniforms.uTexture.value = this.currentItem.texture;
		this.plane.scale.copy(this.scale);
	}

	updateMousePosition({
		mouse
	}) {
		this.mouse.x = mouse.x;
		this.mouse.y = mouse.y;
	}

	_getTextureRatio() {
		return this.currentItem.texture.image.width / this.currentItem.texture.image.height;
	}

}

self.onmessage = function (e) {
	switch (e.data.type) {
		case 'init':
			gl = new EffectStretchOffscreen(e.data);
			break;
		case 'run':
			gl.run();
			break;
		case 'loadTexture':
			gl.loadTexture(e.data);
			break;
		case 'setAlpha':
			gl.setAlpha(e.data);
			break;
		case 'setTarget':
			gl.setTarget(e.data);
			break;
		case 'setPosition':
			gl.setPosition(e.data);
			break;
		case 'movePlane':
			gl.movePlane(e.data);
			break;
		case 'updateMousePosition':
			gl.updateMousePosition(e.data);
			break;
		case 'getOffset':
			postMessage({
				type: 'planeOffset',
				offset: gl.getOffset()
			});
			break;
		case 'updateViewport':
			gl.updateViewPort(e.data);
			break;
		case 'kill':
			self.close();
			break;
	}
}
