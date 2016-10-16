/**
 * First we will load all of this project's JavaScript dependencies which
 * include Vue and Vue Resource. This gives a great starting point for
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap')

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('example', require('./components/Example.vue'))
Vue.component('laws', require('./components/LatestLaws.vue'))

const app = new Vue({
  el: '#app'
})

$('#show-leyes').click(function () {
  $('#ultimas-leyes').fadeIn('slow', function () {
    $('html, body').animate({
      scrollTop: $('#ultimas-leyes').offset().top
    }, 2000)

    $('#representantes').fadeIn('slow', function () {})
  })
})
