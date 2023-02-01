self.addEventListener('install', function() {
  console.log('Install!');
});
self.addEventListener("activate", event => {
  console.log('Activate!');
});
self.addEventListener('fetch', function(event) {
  console.log('Fetch!', event.request);
});

window.addEventListener('beforeinstallprompt', e => {
  console.log('beforeinstallprompt Event fired');
  e.preventDefault();
  // Stash the event so it can be triggered later.
  this.deferredPrompt = e;
  return false;
  });
// When you want to trigger prompt:
this.deferredPrompt.prompt();
  this.deferredPrompt.userChoice.then(choice => {
  console.log(choice);
  });
this.deferredPrompt = null;