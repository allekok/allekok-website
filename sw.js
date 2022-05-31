/* Globals */
const cacheVer = 'v112'
const notFound = 'not-found.html?v9'
const toSave = [
	'script/js/main-comp.js?v549',
	'style/css/main-comp.css?v169',
	'style/font/Material-Icons.woff2',
	'style/font/DroidNaskh-Regular.woff2',
	notFound,
	'sw.js',
]
const extsToSave = [
	'.ttf', '.otf', '.woff', '.woff2',
	'.jpeg', '.jpg', '.png', '.svg', '.ico',
	'.webmanifest',
]

/* Functions */
function endsWithP (str, arr) {
	for(const o of arr)
		if(str.endsWith(o))
			return true
	return false
}

/* Service Worker */
self.addEventListener('install', event => {
	event.waitUntil(caches.open(cacheVer).then(
		cache => cache.addAll(toSave)))
})

self.addEventListener('activate', event => {
	event.waitUntil(caches.keys().then(keyList => {
		return Promise.all(keyList.map(key => {
			if(cacheVer != key)
				return caches.delete(key)
		}))
	}))
})

self.addEventListener('fetch', event => {
	event.respondWith(caches.match(event.request).then(resp => {
		return resp || fetch(event.request).then(R => {
			if(endsWithP(event.request.url, extsToSave)) {
				return caches.open(cacheVer).then(cache => {
					cache.put(event.request, R.clone())
					return R
				})
			}
			return R
		})
	}).catch(() => caches.match(notFound)))
})
