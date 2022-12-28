var config = {

	map: {
		'*': {
			'easing': 'bannerslider/easing',
			'slick': 'bannerslider/slick',
			'gridSlider': 'bannerslider/grid-slider',
		},
	},

	paths: {
		'bannerslider/easing'		: 'NourCode_Bannerslider/js/plugin/jquery.easing.min',
		'bannerslider/slick'			: 'NourCode_Bannerslider/js/plugin/slick.min',
		'bannerslider/grid-slider'	: 'NourCode_Bannerslider/js/grid-slider',
	},

	shim: {
		'bannerslider/easing': {
			deps: ['jquery']
		},
		'bannerslider/slick': {
			deps: ['jquery']
		}
	}

};
