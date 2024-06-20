import axios from 'axios';
import 'toastr/toastr';window.toastr = require('toastr');
window.axios = axios;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
