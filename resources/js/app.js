require('./bootstrap')

window.Vue = require('vue').default
require('./components')

const app = new Vue({
    el: '#app',
})
