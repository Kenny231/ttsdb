define(['app'], function (app) {
	app.controller('HomeController', ['$scope', function ($scope) {
		// Carousel.
		$scope.slideInterval = 5000;
		$scope.active = 0;
		$scope.slides = [
			{image: 'app/images/photos/image-1.jpg', id: 0},
			{image: 'app/images/photos/image-2.jpg', id: 1}
		];
	}]);
});
