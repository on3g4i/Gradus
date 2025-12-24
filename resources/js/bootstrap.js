import $ from 'jquery';
window.$ = window.jQuery = $;
console.log($.fn.jquery);

//Registro e importações alocadas para o arquivo de bootstrap
import {
    Chart,
    registerables
} from 'chart.js';

// Register all components
Chart.register(...registerables);

// Make Chart available globally
window.Chart = Chart;

import 'bootstrap';

import Swal from 'sweetalert2'
window.Swal = Swal;

import SignaturePad from 'signature_pad';
window.SignaturePad = SignaturePad;

import axios from 'axios';
window.axios = axios;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

import { animate, stagger } from "motion"
window.animate = animate;
window.stagger = stagger;
