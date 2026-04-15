/**
 * Vanilla JavaScript Lightbox
 * Simple lightbox implementation for data-lightbox attribute
 *
 * @package boldface-design
 */

( function() {
	'use strict';

	class Lightbox {
		constructor() {
			this.currentIndex = 0;
			this.images = [];
			this.modal = null;
			this.init();
		}

		init() {
			this.createModal();
			this.bindEvents();
		}

		createModal() {
			// Create modal container
			this.modal = document.createElement( 'div' );
			this.modal.className = 'lightbox-modal';
			this.modal.innerHTML = `
				<div class="lightbox-backdrop"></div>
				<div class="lightbox-container">
					<button class="lightbox-close" aria-label="Close lightbox">
						<svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
							<line x1="18" y1="6" x2="6" y2="18"></line>
							<line x1="6" y1="6" x2="18" y2="18"></line>
						</svg>
					</button>
					<button class="lightbox-prev" aria-label="Previous image">
						<svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
							<polyline points="15 18 9 12 15 6"></polyline>
						</svg>
					</button>
					<div class="lightbox-content">
						<img class="lightbox-image" src="" alt="" />
					</div>
					<button class="lightbox-next" aria-label="Next image">
						<svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
							<polyline points="9 18 15 12 9 6"></polyline>
						</svg>
					</button>
					<div class="lightbox-counter">
						<span class="lightbox-current">1</span> / <span class="lightbox-total">1</span>
					</div>
				</div>
			`;

			// Add styles
			this.addStyles();

			document.body.appendChild( this.modal );
		}

		addStyles() {
			const style = document.createElement( 'style' );
			style.textContent = `
				.lightbox-modal {
					display: none;
					position: fixed;
					top: 0;
					left: 0;
					width: 100%;
					height: 100%;
					z-index: 9999;
				}

				.lightbox-modal.active {
					display: flex;
					align-items: center;
					justify-content: center;
				}

				.lightbox-backdrop {
					position: absolute;
					top: 0;
					left: 0;
					width: 100%;
					height: 100%;
					background-color: rgba(0, 0, 0, 0.9);
					cursor: pointer;
				}

				.lightbox-container {
					position: relative;
					width: 90%;
					max-width: 900px;
					height: 90vh;
					display: flex;
					align-items: center;
					justify-content: center;
					z-index: 10000;
				}

				.lightbox-content {
					width: 100%;
					height: 100%;
					display: flex;
					align-items: center;
					justify-content: center;
					position: relative;
				}

				.lightbox-image {
					max-width: 100%;
					max-height: 100%;
					width: auto;
					height: auto;
					object-fit: contain;
				}

				.lightbox-close {
					position: absolute;
					top: 20px;
					right: 20px;
					background: none;
					border: none;
					color: white;
					cursor: pointer;
					padding: 8px;
					display: flex;
					align-items: center;
					justify-content: center;
					z-index: 10001;
					transition: opacity 0.3s ease;
				}

				.lightbox-close:hover {
					opacity: 0.7;
				}

				.lightbox-prev,
				.lightbox-next {
					position: absolute;
					top: 50%;
					transform: translateY(-50%);
					background: rgba(255, 255, 255, 0.2);
					border: none;
					color: white;
					cursor: pointer;
					padding: 12px;
					display: flex;
					align-items: center;
					justify-content: center;
					z-index: 10001;
					transition: background-color 0.3s ease;
					border-radius: 4px;
				}

				.lightbox-prev:hover,
				.lightbox-next:hover {
					background-color: rgba(255, 255, 255, 0.4);
				}

				.lightbox-prev {
					left: 20px;
				}

				.lightbox-next {
					right: 20px;
				}

				.lightbox-counter {
					position: absolute;
					bottom: 20px;
					left: 50%;
					transform: translateX(-50%);
					color: white;
					font-size: 14px;
					background: rgba(0, 0, 0, 0.5);
					padding: 8px 12px;
					border-radius: 4px;
					z-index: 10001;
				}

				@media (max-width: 768px) {
					.lightbox-container {
						height: 85vh;
					}

					.lightbox-prev,
					.lightbox-next {
						padding: 8px;
					}

					.lightbox-prev svg,
					.lightbox-next svg {
						width: 24px;
						height: 24px;
					}
				}
			`;

			document.head.appendChild( style );
		}

		bindEvents() {
			// Get all lightbox links
			document.addEventListener( 'click', ( e ) => {
				const link = e.target.closest( '[data-lightbox]' );
				if ( link ) {
					e.preventDefault();
					this.openLightbox( link );
				}
			} );

			// Close button
			this.modal.querySelector( '.lightbox-close' ).addEventListener( 'click', () => {
				this.closeLightbox();
			} );

			// Backdrop click
			this.modal.querySelector( '.lightbox-backdrop' ).addEventListener( 'click', () => {
				this.closeLightbox();
			} );

			// Navigation buttons
			this.modal.querySelector( '.lightbox-prev' ).addEventListener( 'click', () => {
				this.prevImage();
			} );

			this.modal.querySelector( '.lightbox-next' ).addEventListener( 'click', () => {
				this.nextImage();
			} );

			// Keyboard navigation
			document.addEventListener( 'keydown', ( e ) => {
				if ( ! this.modal.classList.contains( 'active' ) ) {
					return;
				}

				if ( e.key === 'Escape' ) {
					this.closeLightbox();
				} else if ( e.key === 'ArrowLeft' ) {
					this.prevImage();
				} else if ( e.key === 'ArrowRight' ) {
					this.nextImage();
				}
			} );
		}

		openLightbox( link ) {
			const lightboxName = link.getAttribute( 'data-lightbox' );
			this.images = Array.from( document.querySelectorAll( `[data-lightbox="${lightboxName}"]` ) );
			this.currentIndex = this.images.indexOf( link );

			this.displayImage();
			this.modal.classList.add( 'active' );
			document.body.style.overflow = 'hidden';
		}

		closeLightbox() {
			this.modal.classList.remove( 'active' );
			document.body.style.overflow = '';
		}

		displayImage() {
			if ( this.images.length === 0 ) {
				return;
			}

			const image = this.images[ this.currentIndex ];
			const img = this.modal.querySelector( '.lightbox-image' );
			img.src = image.href;
			img.alt = image.querySelector( 'img' )?.alt || 'Gallery image';

			// Update counter
			this.modal.querySelector( '.lightbox-current' ).textContent = this.currentIndex + 1;
			this.modal.querySelector( '.lightbox-total' ).textContent = this.images.length;

			// Update button visibility
			const prevBtn = this.modal.querySelector( '.lightbox-prev' );
			const nextBtn = this.modal.querySelector( '.lightbox-next' );

			prevBtn.style.display = this.currentIndex > 0 ? 'flex' : 'none';
			nextBtn.style.display = this.currentIndex < this.images.length - 1 ? 'flex' : 'none';
		}

		nextImage() {
			if ( this.currentIndex < this.images.length - 1 ) {
				this.currentIndex++;
				this.displayImage();
			}
		}

		prevImage() {
			if ( this.currentIndex > 0 ) {
				this.currentIndex--;
				this.displayImage();
			}
		}
	}

	// Initialize lightbox when DOM is ready
	if ( document.readyState === 'loading' ) {
		document.addEventListener( 'DOMContentLoaded', () => {
			new Lightbox();
		} );
	} else {
		new Lightbox();
	}
} )();
