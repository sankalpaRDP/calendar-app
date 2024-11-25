const CACHE_NAME = "calendar-app-cache-v1";
const urlsToCache = [
  "/calender/",
  "/calender/index.html",
  "/calender/1.html",
  "/calender/events.json"
];

self.addEventListener("install", (event) => {
  event.waitUntil(
    caches.open(CACHE_NAME).then((cache) => cache.addAll(urlsToCache))
  );
});

self.addEventListener("fetch", (event) => {
  event.respondWith(
    caches.match(event.request).then((response) => {
      return response || fetch(event.request);
    })
  );
});
