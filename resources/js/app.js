import './bootstrap';

import.meta.glob([
    '../images/**',
    '../fonts/**',
]);

import anchor from '@alpinejs/anchor';
Alpine.plugin(anchor)

import collapse from '@alpinejs/collapse';
Alpine.plugin(collapse)

import moment from 'moment'
Alpine.plugin(moment)

import Chart from 'chart.js/auto';
window.Chart = Chart;

import { Colors } from 'chart.js';
window.Colors = Colors;

import 'animate.css';
