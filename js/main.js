var CRUMINA = {};
(function(_0xdf6ax2) {
	'use strict';
	var _0xdf6ax3 = _0xdf6ax2(window),
	_0xdf6ax4 = _0xdf6ax2(document),
	_0xdf6ax5 = _0xdf6ax2('body'),
	_0xdf6ax6 = {},
	_0xdf6ax7 = _0xdf6ax2('.skills-item'),
	_0xdf6ax8 = _0xdf6ax2('.fixed-sidebar');
	CRUMINA['equalHeight'] = function() {
		_0xdf6ax2('.js-equal-child')['find']('.theme-module')['matchHeight']({
			property: 'min-height'
		})
	};
	
	CRUMINA['TopSearch'] = function() {
		_0xdf6ax2('.js-user-search')['selectize']({
			persist: false,
			maxItems: 2,
			valueField: 'name',
			labelField: 'name',
			searchField: ['name'],
			options: [{
				image: 'img/avatar30-sm.jpg',
				name: 'Marie Claire Stevens',
				message: '12 Friends in Common',
				icon: 'olymp-happy-face-icon'
			}, {
				image: 'img/avatar54-sm.jpg',
				name: 'Marie Davidson',
				message: '4 Friends in Common',
				icon: 'olymp-happy-face-icon'
			}, {
				image: 'img/avatar49-sm.jpg',
				name: 'Marina Polson',
				message: 'Mutual Friend: Mathilda Brinker',
				icon: 'olymp-happy-face-icon'
			}, {
				image: 'img/avatar36-sm.jpg',
				name: 'Ann Marie Gibson',
				message: 'New York, NY',
				icon: 'olymp-happy-face-icon'
			}, {
				image: 'img/avatar22-sm.jpg',
				name: 'Dave Marinara',
				message: '8 Friends in Common',
				icon: 'olymp-happy-face-icon'
			}, {
				image: 'img/avatar41-sm.jpg',
				name: 'The Marina Bar',
				message: 'Restaurant / Bar',
				icon: 'olymp-star-icon'
			}],
			render: {
				option: function(_0xdf6ax9, _0xdf6axa) {
					return '<div class="inline-items">' + (_0xdf6ax9['image'] ? '<div class="author-thumb"><img src="' + _0xdf6axa(_0xdf6ax9['image']) + '" alt="avatar"></div>' : '') + '<div class="notification-event">' + (_0xdf6ax9['name'] ? '<span class="h6 notification-friend"></a>' + _0xdf6axa(_0xdf6ax9['name']) + '</span>' : '') + (_0xdf6ax9['message'] ? '<span class="chat-message-item">' + _0xdf6axa(_0xdf6ax9['message']) + '</span>' : '') + '</div>' + (_0xdf6ax9['icon'] ? '<span class="notification-icon"><svg class="' + _0xdf6axa(_0xdf6ax9['icon']) + '"><use xlink:href="icons/icons.svg#' + _0xdf6axa(_0xdf6ax9['icon']) + '"></use></svg></span>' : '') + '</div>'
				},
				item: function(_0xdf6ax9, _0xdf6axa) {
					var _0xdf6axb = _0xdf6ax9['name'];
					return '<div>' + '<span class="label">' + _0xdf6axa(_0xdf6axb) + '</span>' + '</div>'
				}
			}
		})
	};
	CRUMINA['Materialize'] = function() {
		_0xdf6ax2['material']['init']();
		_0xdf6ax2('.checkbox > label')['on']('click', function() {
			_0xdf6ax2(this)['closest']('.checkbox')['addClass']('clicked')
		})
	};
	CRUMINA['Bootstrap'] = function() {
		_0xdf6ax2('[data-toggle="tooltip"], [rel="tooltip"]')['tooltip']();
		_0xdf6ax2('[data-toggle="popover"]')['popover']();
		_0xdf6ax2('.selectpicker')['selectpicker']();
		var _0xdf6axc = _0xdf6ax2('input[name="datetimepicker"]');
		if (_0xdf6axc['length']) {
			var _0xdf6axd = moment()['subtract'](29, 'days');
			_0xdf6axc['daterangepicker']({
				startDate: _0xdf6axd,
				autoUpdateInput: false,
				singleDatePicker: true,
				showDropdowns: true,
				locale: {
					format: 'DD/MM/YYYY'
				}
			});
			_0xdf6axc['on']('focus', function() {
				_0xdf6ax2(this)['closest']('.form-group')['addClass']('is-focused')
			});
			_0xdf6axc['on']('apply.daterangepicker', function(_0xdf6axe, _0xdf6axf) {
				_0xdf6ax2(this)['val'](_0xdf6axf['startDate']['format']('DD/MM/YYYY'));
				_0xdf6ax2(this)['closest']('.form-group')['addClass']('is-focused')
			});
			_0xdf6axc['on']('hide.daterangepicker', function() {
				if ('' === _0xdf6ax2(this)['val']()) {
					_0xdf6ax2(this)['closest']('.form-group')['removeClass']('is-focused')
				}
			})
		}
	};
	CRUMINA['mediaPopups'] = function() {
		_0xdf6ax2('.play-video')['magnificPopup']({
			disableOn: 700,
			type: 'iframe',
			mainClass: 'mfp-fade',
			removalDelay: 160,
			preloader: false,
			fixedContentPos: false
		});
		_0xdf6ax2('.js-zoom-image')['magnificPopup']({
			type: 'image',
			removalDelay: 500,
			callbacks: {
				beforeOpen: function() {
					this['st']['image']['markup'] = this['st']['image']['markup']['replace']('mfp-figure', 'mfp-figure mfp-with-anim');
					this['st']['mainClass'] = 'mfp-zoom-in'
				}
			},
			closeOnContentClick: true,
			midClick: true
		});
		_0xdf6ax2('.js-zoom-gallery')['each'](function() {
			_0xdf6ax2(this)['magnificPopup']({
				delegate: 'a',
				type: 'image',
				gallery: {
					enabled: true
				},
				removalDelay: 500,
				callbacks: {
					beforeOpen: function() {
						this['st']['image']['markup'] = this['st']['image']['markup']['replace']('mfp-figure', 'mfp-figure mfp-with-anim');
						this['st']['mainClass'] = 'mfp-zoom-in'
					}
				},
				closeOnContentClick: true,
				midClick: true
			})
		})
	};
	CRUMINA['initSwiper'] = function() {
		var _0xdf6ax10 = 0;
		var _0xdf6ax11 = false;
		_0xdf6ax2('.swiper-container')['each'](function() {
			var _0xdf6ax12 = _0xdf6ax2(this);
			var _0xdf6ax13 = 'swiper-unique-id-' + _0xdf6ax10;
			_0xdf6ax12['addClass']('swiper-' + _0xdf6ax13 + ' initialized')['attr']('id', _0xdf6ax13);
			_0xdf6ax12['find']('.swiper-pagination')['addClass']('pagination-' + _0xdf6ax13);
			var _0xdf6ax14 = (_0xdf6ax12['data']('effect')) ? _0xdf6ax12['data']('effect') : 'slide',
			_0xdf6ax15 = (_0xdf6ax12['data']('crossfade')) ? _0xdf6ax12['data']('crossfade') : true,
			_0xdf6ax16 = (_0xdf6ax12['data']('loop') == false) ? _0xdf6ax12['data']('loop') : true,
			_0xdf6ax17 = (_0xdf6ax12['data']('show-items')) ? _0xdf6ax12['data']('show-items') : 1,
			_0xdf6ax18 = (_0xdf6ax12['data']('scroll-items')) ? _0xdf6ax12['data']('scroll-items') : 1,
			_0xdf6ax19 = (_0xdf6ax12['data']('direction')) ? _0xdf6ax12['data']('direction') : 'horizontal',
			_0xdf6ax1a = (_0xdf6ax12['data']('mouse-scroll')) ? _0xdf6ax12['data']('mouse-scroll') : false,
			_0xdf6ax1b = (_0xdf6ax12['data']('autoplay')) ? parseInt(_0xdf6ax12['data']('autoplay'), 10) : 0,
			_0xdf6ax1c = (_0xdf6ax12['hasClass']('auto-height')) ? true : false,
			_0xdf6ax1d = (_0xdf6ax17 > 1) ? 20 : 0;
			if (_0xdf6ax17 > 1) {
				_0xdf6ax11 = {
					480: {
						slidesPerView: 1,
						slidesPerGroup: 1
					},
					768: {
						slidesPerView: 2,
						slidesPerGroup: 2
					}
				}
			};
			_0xdf6ax6['swiper-' + _0xdf6ax13] = new Swiper('.swiper-' + _0xdf6ax13, {
				pagination: '.pagination-' + _0xdf6ax13,
				paginationClickable: true,
				direction: _0xdf6ax19,
				mousewheelControl: _0xdf6ax1a,
				mousewheelReleaseOnEdges: _0xdf6ax1a,
				slidesPerView: _0xdf6ax17,
				slidesPerGroup: _0xdf6ax18,
				spaceBetween: _0xdf6ax1d,
				keyboardControl: true,
				setWrapperSize: true,
				preloadImages: true,
				updateOnImagesReady: true,
				autoplay: _0xdf6ax1b,
				autoHeight: _0xdf6ax1c,
				loop: _0xdf6ax16,
				breakpoints: _0xdf6ax11,
				effect: _0xdf6ax14,
				fade: {
					crossFade: _0xdf6ax15
				},
				parallax: true,
				onSlideChangeStart: function(_0xdf6ax1e) {
					var _0xdf6ax1f = _0xdf6ax12['siblings']('.slider-slides');
					if (_0xdf6ax1f['length']) {
						_0xdf6ax1f['find']('.slide-active')['removeClass']('slide-active');
						var _0xdf6ax20 = _0xdf6ax1e['slides']['eq'](_0xdf6ax1e['activeIndex'])['attr']('data-swiper-slide-index');
						_0xdf6ax1f['find']('.slides-item')['eq'](_0xdf6ax20)['addClass']('slide-active')
					}
				}
			});
			_0xdf6ax10++
		});
		_0xdf6ax2('.btn-prev')['on']('click', function() {
			var _0xdf6ax21 = _0xdf6ax2(this)['closest']('.slider-slides')['siblings']('.swiper-container')['attr']('id');
			_0xdf6ax6['swiper-' + _0xdf6ax21]['slidePrev']()
		});
		_0xdf6ax2('.btn-next')['on']('click', function() {
			var _0xdf6ax21 = _0xdf6ax2(this)['closest']('.slider-slides')['siblings']('.swiper-container')['attr']('id');
			_0xdf6ax6['swiper-' + _0xdf6ax21]['slideNext']()
		});
		_0xdf6ax2('.btn-prev-without')['on']('click', function() {
			var _0xdf6ax21 = _0xdf6ax2(this)['closest']('.swiper-container')['attr']('id');
			_0xdf6ax6['swiper-' + _0xdf6ax21]['slidePrev']()
		});
		_0xdf6ax2('.btn-next-without')['on']('click', function() {
			var _0xdf6ax21 = _0xdf6ax2(this)['closest']('.swiper-container')['attr']('id');
			_0xdf6ax6['swiper-' + _0xdf6ax21]['slideNext']()
		});
		_0xdf6ax2('.slider-slides .slides-item')['on']('click', function() {
			if (_0xdf6ax2(this)['hasClass']('slide-active')) {
				return false
			};
			var _0xdf6ax22 = _0xdf6ax2(this)['parent']()['find']('.slides-item')['index'](this);
			var _0xdf6ax21 = _0xdf6ax2(this)['closest']('.slider-slides')['siblings']('.swiper-container')['attr']('id');
			_0xdf6ax6['swiper-' + _0xdf6ax21]['slideTo'](_0xdf6ax22 + 1);
			_0xdf6ax2(this)['parent']()['find']('.slide-active')['removeClass']('slide-active');
			_0xdf6ax2(this)['addClass']('slide-active');
			return false
		})
	};
	CRUMINA['progresBars'] = function() {
		_0xdf6ax7['appear']({
			force_process: true
		});
		_0xdf6ax7['on']('appear', function() {
			var _0xdf6ax23 = _0xdf6ax2(this);
			if (!_0xdf6ax23['data']('inited')) {
				_0xdf6ax23['find']('.skills-item-meter-active')['fadeTo'](300, 1)['addClass']('skills-animate');
				_0xdf6ax23['data']('inited', true)
			}
		})
	};
	CRUMINA['IsotopeSort'] = function() {
		var _0xdf6ax24 = _0xdf6ax2('.sorting-container');
		_0xdf6ax24['each'](function() {
			var _0xdf6ax25 = _0xdf6ax2(this);
			var _0xdf6ax26 = (_0xdf6ax25['data']('layout')['length']) ? _0xdf6ax25['data']('layout') : 'masonry';
			_0xdf6ax25['isotope']({
				itemSelector: '.sorting-item',
				layoutMode: _0xdf6ax26,
				percentPosition: true
			});
			_0xdf6ax25['imagesLoaded']()['progress'](function() {
				_0xdf6ax25['isotope']('layout')
			});
			var _0xdf6ax27 = _0xdf6ax25['siblings']('.sorting-menu')['find']('li');
			_0xdf6ax27['on']('click', function() {
				if (_0xdf6ax2(this)['hasClass']('active')) {
					return false
				};
				_0xdf6ax2(this)['parent']()['find']('.active')['removeClass']('active');
				_0xdf6ax2(this)['addClass']('active');
				var _0xdf6ax28 = _0xdf6ax2(this)['data']('filter');
				if (typeof _0xdf6ax28 != 'undefined') {
					_0xdf6ax25['isotope']({
						filter: _0xdf6ax28
					});
					return false
				}
			})
		})
	};
	_0xdf6ax2('a[data-toggle="tab"]')['on']('shown.bs.tab', function(_0xdf6ax29) {
		var _0xdf6ax2a = _0xdf6ax2(_0xdf6ax29['target'])['attr']('href');
		if ('#events' === _0xdf6ax2a) {
			_0xdf6ax2('.fc-state-active')['click']()
		}
	});
	_0xdf6ax2('.js-sidebar-open')['on']('click', function() {
		_0xdf6ax2(this)['toggleClass']('active');
		_0xdf6ax2(this)['closest'](_0xdf6ax8)['toggleClass']('open');
		return false
	});
	_0xdf6ax3['keydown'](function(_0xdf6ax2b) {
		if (_0xdf6ax2b['which'] == 27 && _0xdf6ax8['is'](':visible')) {
			_0xdf6ax8['removeClass']('open')
		}
	});
	_0xdf6ax4['on']('click', function(_0xdf6ax2c) {
		if (!_0xdf6ax2(_0xdf6ax2c['target'])['closest'](_0xdf6ax8)['length'] && _0xdf6ax8['is'](':visible')) {
			_0xdf6ax8['removeClass']('open')
		}
	});
	var _0xdf6ax2d = _0xdf6ax2('.window-popup');
	_0xdf6ax2('.js-open-popup')['on']('click', function(_0xdf6ax2c) {
		var _0xdf6ax2e = _0xdf6ax2(this)['data']('popup-target');
		var _0xdf6ax2f = _0xdf6ax2d['filter'](_0xdf6ax2e);
		var _0xdf6ax30 = _0xdf6ax2(this)['offset']();
		_0xdf6ax2f['addClass']('open');
		_0xdf6ax2f['css']('top', (_0xdf6ax30['top'] - (_0xdf6ax2f['innerHeight']() / 2)));
		_0xdf6ax5['addClass']('overlay-enable');
		return false
	});
	_0xdf6ax3['keydown'](function(_0xdf6ax2b) {
		if (_0xdf6ax2b['which'] == 27) {
			_0xdf6ax2d['removeClass']('open');
			_0xdf6ax5['removeClass']('overlay-enable');
			_0xdf6ax2('.profile-menu')['removeClass']('expanded-menu');
			_0xdf6ax2('.popup-chat-responsive')['removeClass']('open-chat');
			_0xdf6ax2('.profile-settings-responsive')['removeClass']('open');
			_0xdf6ax2('.header-menu')['removeClass']('open')
		}
	});
	_0xdf6ax4['on']('click', function(_0xdf6ax2c) {
		if (!_0xdf6ax2(_0xdf6ax2c['target'])['closest'](_0xdf6ax2d)['length']) {
			_0xdf6ax2d['removeClass']('open');
			_0xdf6ax5['removeClass']('overlay-enable');
			_0xdf6ax2('.profile-menu')['removeClass']('expanded-menu');
			_0xdf6ax2('.header-menu')['removeClass']('open')
		}
	});
	_0xdf6ax2('[data-toggle=tab]')['on']('click', function() {
		if (_0xdf6ax2(this)['hasClass']('active') && _0xdf6ax2(this)['closest']('ul')['hasClass']('mobile-app-tabs')) {
			_0xdf6ax2(_0xdf6ax2(this)['attr']('href'))['toggleClass']('active');
			_0xdf6ax2(this)['removeClass']('active');
			return false
		}
	});
	_0xdf6ax2('.js-close-popup')['on']('click', function() {
		_0xdf6ax2(this)['closest'](_0xdf6ax2d)['removeClass']('open');
		_0xdf6ax5['removeClass']('overlay-enable');
		return false
	});
	_0xdf6ax2('.profile-settings-open')['on']('click', function() {
		_0xdf6ax2('.profile-settings-responsive')['toggleClass']('open');
		return false
	});
	_0xdf6ax2('.js-expanded-menu')['on']('click', function() {
		_0xdf6ax2('.profile-menu')['toggleClass']('expanded-menu');
		return false
	});
	_0xdf6ax2('.js-chat-open')['on']('click', function() {
		var id_graph = $(this).find(".chat_graph").val();
		_0xdf6ax2('.popup-chat-responsive').alterClass("ajout_*", '');
		_0xdf6ax2('.popup-chat-responsive')['toggleClass']('open-chat');
		_0xdf6ax2('.popup-chat-responsive').addClass("ajout_"+id_graph);
		return false
	});
	_0xdf6ax2('.js-chat-close')['on']('click', function() {
		_0xdf6ax2('.popup-chat-responsive')['removeClass']('open-chat');
		return false
	});
	_0xdf6ax2('.js-open-responsive-menu')['on']('click', function() {
		_0xdf6ax2('.header-menu')['toggleClass']('open');
		return false
	});
	_0xdf6ax2('.js-close-responsive-menu')['on']('click', function() {
		_0xdf6ax2('.header-menu')['removeClass']('open');
		return false
	});
	_0xdf6ax4['ready'](function() {
		CRUMINA.Bootstrap();
		CRUMINA.Materialize();
		CRUMINA['initSwiper']();
		CRUMINA['progresBars']();
		CRUMINA.IsotopeSort();
		if (typeof _0xdf6ax2['fn']['selectize'] !== 'undefined') {
			CRUMINA.TopSearch()
		};
		if (typeof _0xdf6ax2['fn']['matchHeight'] !== 'undefined') {
			CRUMINA['equalHeight']()
		};
		if (typeof _0xdf6ax2['fn']['magnificPopup'] !== 'undefined') {
			CRUMINA['mediaPopups']()
		};
		if (typeof _0xdf6ax2['fn']['gifplayer'] !== 'undefined') {
			_0xdf6ax2('.gif-play-image')['gifplayer']()
		};
		if (typeof _0xdf6ax2['fn']['mediaelementplayer'] !== 'undefined') {
			_0xdf6ax2('#mediaplayer')['mediaelementplayer']({
				"\x66\x65\x61\x74\x75\x72\x65\x73": ['prevtrack', 'playpause', 'nexttrack', 'loop', 'shuffle', 'current', 'progress', 'duration', 'volume']
			})
		};
		_0xdf6ax2('.mCustomScrollbar')['perfectScrollbar']({
			wheelPropagation: false
		})
	})
})(jQuery)