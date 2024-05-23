import './bootstrap';
import './fuel-price/ron95.js';
import './fuel-price/ron97.js';
import './fuel-price/diesel.js';
import './population/bar.js';
import './population/stacked-bar.js';
import './population/group-bar.js';

import axios from 'axios';
window.axios = axios;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

import Chart from 'chart.js/auto';
window.Chart = Chart;
