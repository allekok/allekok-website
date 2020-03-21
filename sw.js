/* Caching static resources */
const cache_ver = 'v112',
      profile = 'style/img/poets/profile/profile_';

self.addEventListener('install', function(event) {
    event.waitUntil(
	caches.open(cache_ver).then(function(cache) {
	    return cache.addAll([
		'sw.js',
		profile+'0.png',
		profile+'1.jpg',
		profile+'2.jpg',
		profile+'3.jpg',
		profile+'4.jpg',
		profile+'5.jpg',
		profile+'6.jpg',
		profile+'7.jpg',
		profile+'8.jpg',
		profile+'9.jpg',
		profile+'10.jpg',
		profile+'11.jpg',
		profile+'12.jpg',
		profile+'13.jpg',
		profile+'14.jpg',
		profile+'15.jpg',
		profile+'16.jpg',
		profile+'17.jpg',
		profile+'18.jpg',
		profile+'19.jpg',
		profile+'20.jpg',
		profile+'21.jpg',
		profile+'22.jpg',
		profile+'23.jpg',
		profile+'24.jpg',
		profile+'25.jpg',
		profile+'26.jpg',
		profile+'28.jpg',
		profile+'29.jpg',
		profile+'30.jpg',
		profile+'31.jpg',
		profile+'32.jpg',
		profile+'33.jpg',
		profile+'38.jpg',
		profile+'55.jpg',
		profile+'58.jpg',
		profile+'60.jpg',
		profile+'52.jpg',
		profile+'41.jpg',
		profile+'51.jpg',
		profile+'48.jpg',
		profile+'39.jpg',
		profile+'42.jpg',
		profile+'46.jpg',
		profile+'56.jpg',
		profile+'62.jpg',
		profile+'49.jpg',
		profile+'65.jpg',
		profile+'67.jpg',
		profile+'72.jpg',
		profile+'69.jpg',
		profile+'78.jpg',
		profile+'53.jpg',
		profile+'61.jpg',
		profile+'82.jpg',
		profile+'83.jpg',
		profile+'84.jpg',
		profile+'85.jpg',
		profile+'87.jpg',
		profile+'88.jpg',
		profile+'59.jpg',
		profile+'36.jpg',
		profile+'92.jpg',
		profile+'50.jpg',
		profile+'89.jpg',
		profile+'71.jpg',
		profile+'73.jpg',
		profile+'93.jpg',
		'script/js/main-comp.js?v39',
		'style/css/main-comp.css?v41',
		'style/css/main-dark-comp.css?v41',
		'favicon/favicon.ico',
		'favicon/site.webmanifest',
		'style/font/DroidNaskh-Regular.woff2',
		'style/font/Material-Icons.woff2',
		'logo/logo-64.png',
		'not-found.html?v7',
	    ]);
	}));
});

self.addEventListener('activate', function(event) {
    const cacheWhitelist = [cache_ver];
    event.waitUntil(
	caches.keys().then(function(keyList) {
	    return Promise.all(keyList.map(function(key) {
		if(cacheWhitelist.indexOf(key) === -1)
		    return caches.delete(key);
	    }));
	}));
});

self.addEventListener('fetch', function(event) {
    event.respondWith(
	caches.match(event.request).then(function(resp) {
	    return resp || fetch(event.request).then(function (R) {
		if(event.request.url.endsWith(".ttf") ||
		   event.request.url.endsWith(".otf")) {
		    return caches.open(cache_ver).then((cache) => {
			console.log(event.request.url);
			cache.put(event.request, R.clone());
			return R;
		    });
		}
		return R;
	    });
	}).catch(function () {
	    return caches.match("not-found.html?v7");
	}));
});


