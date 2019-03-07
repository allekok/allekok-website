// This file is service worker file. we call this file in almost every page of allekok.com
// to cache the most static resources and that improves speed and efficiency of loading site.

const cache_ver = "v110";
const profile_path = "/style/img/poets/profile/profile_";

self.addEventListener('install', function(event) {
    event.waitUntil(
	caches.open(cache_ver).then(function(cache) {
	    return cache.addAll([
		profile_path+"0.jpg",
		profile_path+"1.jpg",
		profile_path+"2.jpg",
		profile_path+"3.jpg",
		profile_path+"4.jpg",
		profile_path+"5.jpg",
		profile_path+"6.jpg",
		profile_path+"7.jpg",
		profile_path+"8.jpg",
		profile_path+"9.jpg",
		profile_path+"10.jpg",
		profile_path+"11.jpg",
		profile_path+"12.jpg",
		profile_path+"13.jpg",
		profile_path+"14.jpg",
		profile_path+"15.jpg",
		profile_path+"16.jpg",
		profile_path+"17.jpg",
		profile_path+"18.jpg",
		profile_path+"19.jpg",
		profile_path+"20.jpg",
		profile_path+"21.jpg",
		profile_path+"22.jpg",
		profile_path+"23.jpg",
		profile_path+"24.jpg",
		profile_path+"25.jpg",
		profile_path+"26.jpg",
		profile_path+"28.jpg",
		profile_path+"29.jpg",
		profile_path+"30.jpg",
		profile_path+"31.jpg",
		profile_path+"32.jpg",
		profile_path+"33.jpg",
		profile_path+"38.jpg",
		profile_path+"55.jpg",
		profile_path+"58.jpg",
		profile_path+"60.jpg",
		profile_path+"52.jpg",
		profile_path+"41.jpg",
		profile_path+"51.jpg",
		profile_path+"48.jpg",
		profile_path+"39.jpg",
		profile_path+"42.jpg",
		profile_path+"46.jpg",
		profile_path+"56.jpg",
		profile_path+"62.jpg",
		profile_path+"49.jpg",
		profile_path+"65.jpg",
		profile_path+"67.jpg",
		profile_path+"72.jpg",
		profile_path+"69.jpg",
		profile_path+"78.jpg",
		profile_path+"53.jpg",
		profile_path+"61.jpg",
		profile_path+"82.jpg",
		profile_path+"83.jpg",
		profile_path+"84.jpg",
		profile_path+"85.jpg",
		profile_path+"87.jpg",
		profile_path+"88.jpg",
		profile_path+"59.jpg",
		profile_path+"36.jpg",
		profile_path+"92.jpg",
		'/script/js/main.js?v7',
		'/style/css/main.css?v10',
		'/favicon.ico',
		'/style/font/DroidNaskh-Regular.woff2',
		'/style/font/Material-Icons.woff2',
		'/nf.html?v2',
	    ]);
	})
    );
});

self.addEventListener('activate', function(event) {
    var cacheWhitelist = [cache_ver];

    event.waitUntil(
	caches.keys().then(function(keyList) {
	    return Promise.all(keyList.map(function(key) {
		if (cacheWhitelist.indexOf(key) === -1) {
		    return caches.delete(key);
		}
	    }));
	})
    );
});

self.addEventListener('fetch', function(event) {
    event.respondWith(
	caches.match(event.request).then(function(resp) {
	    return resp || fetch(event.request).then(function(response) {
		return response;
	    });
	}).catch(function() {
	    return caches.match('/nf.html?v2');
	})
    );
});
