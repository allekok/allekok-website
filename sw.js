self.addEventListener('install', function(event) {
  event.waitUntil(
    caches.open('v77').then(function(cache) {
      return cache.addAll([
        '/style/img/poets/profile/profile_0.jpg',
        '/style/img/poets/profile/profile_1.jpg',
        '/style/img/poets/profile/profile_2.jpg',
        '/style/img/poets/profile/profile_3.jpg',
        '/style/img/poets/profile/profile_4.jpg',
        '/style/img/poets/profile/profile_5.jpg',
        '/style/img/poets/profile/profile_6.jpg',
        '/style/img/poets/profile/profile_7.jpg',
        '/style/img/poets/profile/profile_8.jpg',
        '/style/img/poets/profile/profile_9.jpg',
        '/style/img/poets/profile/profile_10.jpg',
        '/style/img/poets/profile/profile_11.jpg',
        '/style/img/poets/profile/profile_12.jpg',
        '/style/img/poets/profile/profile_13.jpg',
        '/style/img/poets/profile/profile_14.jpg',
        '/style/img/poets/profile/profile_15.jpg',
        '/style/img/poets/profile/profile_16.jpg',
        '/style/img/poets/profile/profile_17.jpg',
        '/style/img/poets/profile/profile_18.jpg',
        '/style/img/poets/profile/profile_19.jpg',
        '/style/img/poets/profile/profile_20.jpg',
        '/style/img/poets/profile/profile_21.jpg',
        '/style/img/poets/profile/profile_22.jpg',
        '/style/img/poets/profile/profile_23.jpg',
        '/style/img/poets/profile/profile_24.jpg',
        '/style/img/poets/profile/profile_25.jpg',
        '/style/img/poets/profile/profile_26.jpg',
        '/style/img/poets/profile/profile_28.jpg',
        '/style/img/poets/profile/profile_29.jpg',
        '/style/img/poets/profile/profile_30.jpg',
        '/style/img/poets/profile/profile_31.jpg',
        '/style/img/poets/profile/profile_32.jpg',
        '/style/img/poets/profile/profile_33.jpg',
        '/style/img/poets/profile/profile_38.jpg',
        '/style/img/poets/profile/profile_55.jpg',
        '/style/img/poets/profile/profile_58.jpg',
        '/style/img/poets/profile/profile_60.jpg',
        '/style/img/poets/profile/profile_52.jpg',
        '/style/img/poets/profile/profile_41.jpg',
        '/style/img/poets/profile/profile_51.jpg',
        '/style/img/poets/profile/profile_48.jpg',
        '/style/img/poets/profile/profile_39.jpg',
        '/style/img/poets/profile/profile_42.jpg',
        '/style/img/poets/profile/profile_46.jpg',
        '/style/img/poets/profile/profile_56.jpg',
        '/style/img/poets/profile/profile_62.jpg',
        '/style/img/poets/profile/profile_49.jpg',
        '/style/img/poets/profile/profile_65.jpg',
        '/style/img/poets/profile/profile_67.jpg',
        '/style/img/poets/profile/profile_72.jpg',
        '/style/img/poets/profile/profile_69.jpg',
        '/style/img/poets/profile/profile_78.jpg',
        '/style/img/poets/profile/profile_53.jpg',
        '/style/img/poets/profile/profile_61.jpg',
        '/style/img/poets/profile/profile_82.jpg',
        '/style/img/poets/profile/profile_83.jpg',
        '/style/img/allekok.png',
        '/style/font/DroidNaskh-Regular.woff',
        '/style/font/flUhRq6tzZclQEJ-Vdg-IuiaDsNcIhQ8tQ.woff2',
        '/nf.html',
      ]);
    })
  );
});

self.addEventListener('activate', function(event) {
  var cacheWhitelist = ['v77'];

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
        //let responseClone = response.clone();
        //    caches.open('v77').then(function(cache) {
        //      cache.put(event.request, responseClone);
        //    });
        
        return response;
      });
    }).catch(function() {
      return caches.match('/nf.html');
    })
  );
});