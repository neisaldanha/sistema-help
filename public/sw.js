
self.addEventListener('install', (e) => {
  e.waitUntil(
    caches.open('fox-store').then((cache) => cache.addAll([
      '/help/public/',
      '/help/public/js/addtohomescreen.min.js',
      '/help/public/css/addtohomescreen.css',
      '/help/public/index.php',
      '/help/public/index.js',
           
    ])),
  );
});

self.addEventListener('fetch', (e) => {
  console.log(e.request.url);
  e.respondWith(
    caches.match(e.request).then((response) => response || fetch(e.request)),
  );
});
